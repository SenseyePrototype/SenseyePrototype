<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillSkillPriorityCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('senseye:fill:skill:priority');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var */
        $repository = $this
            ->getContainer()
            ->get('doctrine')
            ->getRepository('AppBundle:SkillPriority');

        $aliases = [
            'php',
            'net',
            'java',
            'python',
            'ruby',
            'javascript',
            'android',
            'c++',
            'c#',
            'mysql',
            'nodejs',
            'html',
            'css',
            'react',
            'sql',
            'git',
            'jira',
        ];

        $repository->add($aliases);
    }
}
