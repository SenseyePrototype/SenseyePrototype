<?php

namespace AppBundle\Command;

use AppBundle\Repository\SkillPriorityRepository;
use AppBundle\Repository\SkillSynonymRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillSkillCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('senseye:fill:skill');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');

        /* @var $priority SkillPriorityRepository */
        $priority = $doctrine->getRepository('AppBundle:SkillPriority');
        $priority->add([
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
        ]);

        /* @var $synonym SkillSynonymRepository */
        $synonym = $doctrine->getRepository('AppBundle:SkillSynonym');

        $synonym->add([
            'php' => ['php5', 'php7'],
            'css' => ['css', 'css3'],
            'html' => ['html', 'html5'],
        ]);
    }
}
