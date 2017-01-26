<?php

namespace AppBundle\Command;

use AppBundle\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillCityCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('senseye:fill:city');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');

        /* @var $repository CityRepository */
        $repository = $doctrine->getRepository('AppBundle:City');

        $repository->add([
            ['alias' => 'kyiv', 'name' => 'Киев'],
            ['alias' => 'kharkiv', 'name' => 'Харьков'],
            ['alias' => 'lviv', 'name' => 'Львов'],
            ['alias' => 'dnipro', 'name' => 'Днепропетровск'],
            ['alias' => 'odesa', 'name' => 'Одесса'],
            ['alias' => 'ukraine', 'name' => 'Украина'],
            ['alias' => 'vinnytsya', 'name' => 'Винница'],
            ['alias' => 'mykolaiv', 'name' => 'Николаев'],
            ['alias' => 'zaporizhzhya', 'name' => 'Запорожье'],
            ['alias' => 'khmelnytskyi', 'name' => 'Хмельницкий'],
            ['alias' => 'ivano-frankivsk', 'name' => 'Ивано-Франковск'],
            ['alias' => 'cherkasy', 'name' => 'Черкассы'],
            ['alias' => 'chernivtsi', 'name' => 'Черновцы'],
            ['alias' => 'zhytomyr', 'name' => 'Житомир'],
            ['alias' => 'chernihiv', 'name' => 'Чернигов'],
            ['alias' => 'simferopol', 'name' => 'Симферополь'],
            ['alias' => 'donetsk', 'name' => 'Донецк'],
            ['alias' => 'sevastopol', 'name' => 'Севастополь'],
        ]);
    }
}
