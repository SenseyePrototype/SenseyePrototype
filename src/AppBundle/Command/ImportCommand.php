<?php

namespace AppBundle\Command;

use AppBundle\Entity\ExternalDeveloperProfile;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Mapping\ClassMetadata;
use Elastica\Document;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('senseye:import');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);

        $this->storeExternalDeveloperProfile();

        $cities = $this->getCities();

        $cityNameMap = array_column($cities, null, 'name');

        $skills = $this->getSkills();

        $ranges = $this->getRanges();

        $available = [
            'multi' => [
                'cities' => $cities,
            ],
            'must' => [
                'skills' => $skills,
            ],
            'range' => [
                'salary' => [
                    'from' => $ranges['salary_from'],
                    'to' => $ranges['salary_to'],
                ],
                'experience' => [
                    'from' => $ranges['experience_from'],
                    'to' => $ranges['experience_to'],
                ],
            ],
        ];

        $repository = $this->getContainer()->get('senseye.profile.available.criteria.repository');

        $repository->store($available);

        $profiles = $this->getProfiles();

        $skillAliasMap = array_column($skills, null, 'alias');

        $synonymMap = $this->getSynonymMap();

        $searchable = $this->getContainer()->get('senseye.developer.index')->getProfile();

        $index = $searchable->getIndex();

        try {
            $index->delete();
        } catch (\Exception $e) {
        }

        $index->create();
        $searchable->setMapping($this->getMapping());

        $documents = [];
        foreach ($profiles as $profile) {
            $externalSkills = json_decode($profile['skills'], true);

            $skills = [];

            foreach ($externalSkills as $externalSkill) {
                $alias = $externalSkill['alias'];
                if (isset($synonymMap[$alias])) {
                    $alias = $synonymMap[$alias];
                }

                if (isset($skillAliasMap[$alias])) {
                    $skills[] = [
                        'alias' => $alias,
                        'name' => $skillAliasMap[$alias]['name'],
                        'score' => $externalSkill['score'],
                    ];
                }
            }

            $document = [
                'id' => $profile['id'],
                'title' => $profile['title'],
                'description' => $profile['description'],
                'cities' => [
                    $cityNameMap[$profile['city']]
                ],
                'salary' => (int)$profile['salary'],
                'experience' => (int)$profile['experience'],
                'expect' => null,
                'assert' => null,
                'link' => $profile['link'],
                'skills' => $skills,
            ];
            $documents[] = new Document("e.{$profile['id']}", $document);
        }

        $searchable->addDocuments($documents);

        $index->refresh();

        $duration = microtime(true) - $startTime;

        $output->writeln("<info>Runtime: $duration</info>");
    }

    private function getSkills()
    {
        $skillStatement = $this->getConnection()->prepare('
            SELECT `alias`, `name`
            FROM `s_skill`
            LEFT JOIN `s_skill_priority` USING (`alias`)
            ORDER BY `priority` DESC;
        ');

        $skillStatement->execute();

        return $skillStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getCities()
    {
        $cityStatement = $this->getConnection()->prepare('
            SELECT `alias`, `name`
            FROM `s_city`;
        ');

        $cityStatement->execute();

        return $cityStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getSynonymMap()
    {
        $synonymStatement = $this->getConnection()->prepare('
            SELECT `alias`, `synonym`
            FROM `s_skill_synonym`;
        ');

        $synonymStatement->execute();

        $list = $synonymStatement->fetchAll(\PDO::FETCH_ASSOC);

        return array_column($list, 'alias', 'synonym');
    }

    private function getRanges()
    {
        $rangeStatement = $this->getConnection()->prepare('
            SELECT 
                MIN(`salary`) AS `salary_from`,
                MAX(`salary`) AS `salary_to`,
                MIN(`experience`) AS `experience_from`,
                MAX(`experience`) AS `experience_to`
            FROM `profile`;
        ');

        $rangeStatement->execute();

        return $rangeStatement->fetch(\PDO::FETCH_ASSOC);
    }

    private function storeExternalDeveloperProfile()
    {
        $statement = $this->getConnection()->prepare("
            INSERT INTO `s_external_developer_profile` (
                `external_id`,
                `source_id`,
                `title`,
                `description`,
                `experience`,
                `link`,
                `created`,
                `updated`
            ) 
            SELECT
                `external_id`,
                :sourceId,
                `title`,
                `description`,
                `experience`,
                `link`,
                NOW(),
                NOW()
            FROM `profile`
            ON DUPLICATE KEY UPDATE
                `title` = VALUES(`title`),
                `description` = VALUES(`description`),
                `experience` = VALUES(`experience`),
                `updated` = NOW()
            ;
        ");

        $statement->execute([
            'sourceId' => ExternalDeveloperProfile::SOURCE_DJINNI,
        ]);
    }

    private function getConnection()
    {
        /* @var $connection Connection */
        $connection = $this->getContainer()->get('doctrine')->getConnection();

        return $connection;
    }

    private function getMapping()
    {
        return [
            'hash_code' => [
                'type' => 'long',
            ],
            'title' => [
                'type' => 'text',
            ],
            'cities' => [
                'properties' => [
                    'alias' => [
                        'type' => 'text',
                        'index' => 'not_analyzed',
                        'fielddata' => true,
                    ],
                    'name' => [
                        'type' => 'text',
                        'index' => 'no',
                    ],
                ],
            ],
            'description' => [
                'type' => 'text',
            ],
            'salary' => [
                'type' => 'long',
            ],
            'experience' => [
                'type' => 'long',
            ],
            'expect' => [
                'type' => 'text',
            ],
            'assert' => [
                'type' => 'text',
            ],
            'profiles' => [
                'properties' => [
                    'alias' => [
                        'type' => 'text',
                        'index' => 'not_analyzed',
                    ],
                    'link' => [
                        'type' => 'text',
                        'index' => 'no',
                    ],
                    'name' => [
                        'type' => 'text',
                        'index' => 'no',
                    ],
                    'verified' => [
                        'type' => 'boolean',
                    ],
                ],
            ],
            'link' => [
                'type' => 'text',
                'index' => 'no',
            ],
            'created' => [
                'type' => 'text',
                'index' => 'no',
            ],
            'skills' => [
                'properties' => [
                    'alias' => [
                        'type' => 'text',
                        'fielddata' => true,
                        'index' => 'not_analyzed',
                    ],
                    'name' => [
                        'type' => 'text',
                        'index' => 'no',
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    private function getProfiles()
    {
        $statement = $this
            ->getConnection()
            ->prepare('
                SELECT
                  `e`.`id`,
                  `p`.`link`,
                  `p`.`city`,
                  `p`.`title`,
                  `p`.`salary`,
                  `p`.`experience`,
                  `p`.`description`,
                  `p`.`skills`
                FROM `profile` `p`
                INNER JOIN `s_external_developer_profile` `e`
                  ON (`e`.`external_id` = `p`.`external_id` AND `e`.`source_id` = :sourceId);
            ');

        $statement->execute([
            'sourceId' => ExternalDeveloperProfile::SOURCE_DJINNI,
        ]);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
