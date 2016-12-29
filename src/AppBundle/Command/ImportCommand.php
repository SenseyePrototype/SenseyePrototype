<?php

namespace AppBundle\Command;

use Doctrine\DBAL\Connection;
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
        /* @var $connection Connection */
        $connection = $this->getContainer()->get('doctrine')->getConnection();

        $cityStatement = $connection->prepare('
            SELECT `alias`, `name`
            FROM `city`;
        ');

        $cityStatement->execute();

        $cities = $cityStatement->fetchAll(\PDO::FETCH_ASSOC);

        $cityNameMap = array_column($cities, null, 'name');

        $skillStatement = $connection->prepare('
            SELECT `alias`, `name`
            FROM `skill`;
        ');

        $skillStatement->execute();

        $skills = $skillStatement->fetchAll(\PDO::FETCH_ASSOC);

        $preparedSkills = array_slice($skills, 0, 100);

        $rangeStatement = $connection->prepare('
            SELECT 
                MIN(`salary`) AS `salary_from`,
                MAX(`salary`) AS `salary_to`,
                MIN(`experience`) AS `experience_from`,
                MAX(`experience`) AS `experience_to`
            FROM `profile`;
        ');

        $rangeStatement->execute();

        $ranges = $rangeStatement->fetch(\PDO::FETCH_ASSOC);

        $available = [
            'multi' => [
                'cities' => $cities,
            ],
            'must' => [
                'skills' => $preparedSkills,
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

        $profileStatement = $connection->prepare('
            SELECT * FROM `profile`;
        ');

        $profileStatement->execute();

        $profiles = $profileStatement->fetchAll(\PDO::FETCH_ASSOC);

        $skillAliasMap = array_column($skills, null, 'alias');

        $searchable = $this->getContainer()->get('senseye.developer.index')->getProfile();

        $index = $searchable->getIndex();

        try {
            $index->delete();
        } catch (\Exception $e) {}

        foreach ($profiles as $profile) {
            $document = [
                'title' => $profile['title'],
                'description' => $profile['description'],
                'cities' => [
                    $cityNameMap[$profile['city']]
                ],
                'salary' => (int)$profile['salary'],
                'experience' => (int)$profile['experience'],
                'link' => $profile['link'],
                'skills' => array_values(
                    array_intersect_key(
                        $skillAliasMap,
                        array_flip(json_decode($profile['skills'], true))
                    )
                ),
            ];
            $searchable->addDocument(new Document($profile['id'], $document));
        }

        $index->refresh();
    }
}
