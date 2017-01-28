<?php

namespace AppBundle\Command;

use AppBundle\Repository\SkillPriorityRepository;
use AppBundle\Repository\SkillRepository;
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

        /* @var $repository SkillRepository */
        $repository = $doctrine->getRepository('AppBundle:Skill');
        $repository->add([
            [
                'alias' => 'php',
                'name' => 'PHP',
            ],
            [
                'alias' => 'mysql',
                'name' => 'MySQL',
            ],
            [
                'alias' => 'git',
                'name' => 'Git',
            ],
        ]);

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
            'golang' => ['go'],
            'express' => ['expressjs'],
            'react' => ['reactjs'],
            'symfony' => ['symfony2', 'symfony3'],
            'teamlead' => ['teamleadership', 'teamleading'],
            'testcase' => ['testcasedesign', 'testcases', 'testcasescreation'],
            'manualtesting' => ['manualtestingqa'],
            'presentation' => ['presentations'],
            'gulp' => ['gulpjs'],
            'googleanalytics' => ['googleanalytic'],
            'gamedevelopment' => ['gamedev'],
            'c++' => ['cc++'],
            'css' => ['css3'],
            'html' => ['html5', 'htmlcss'],
            'actionscript' => ['actionscript3as3'],
            'blender' => ['blender3d'],
            'bugreport' => ['bugreporting', 'bugreports', 'bugtracking'],
            'businessanalysis' => ['businessanalisys', 'businessanalyst', 'businessanalytics'],
        ]);
    }
}
