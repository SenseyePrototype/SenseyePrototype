<?php

namespace AppBundle\Command;

use Doctrine\DBAL\Connection;
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
            SELECT `name`
            FROM `city`;
        ');

        $cityStatement->execute();

        $cities = $cityStatement->fetchAll(\PDO::FETCH_COLUMN);

        $preparedCities = [];
        foreach ($cities as $city) {
            $preparedCities[] = [
                'alias' => crc32($city),
                'name' => $city,
            ];
        }

        $skillStatement = $connection->prepare('
            SELECT `alias`, `name`
            FROM `skill`;
        ');

        $skillStatement->execute();

        $skills = $cityStatement->fetchAll(\PDO::FETCH_ASSOC);

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
                'cities' => $preparedCities,
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
    }
}
