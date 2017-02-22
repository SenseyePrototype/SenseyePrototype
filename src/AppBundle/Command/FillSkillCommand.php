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
            /**
             * Base
             */
            [
                'alias' => 'algorithms',
                'name' => 'Algorithms',
            ],

            /**
             * Language
             */
            [
                'alias' => 'assembler',
                'name' => 'Assembler',
            ],
            [
                'alias' => 'ada',
                'name' => 'Ada',
            ],
            [
                'alias' => 'fortran',
                'name' => 'Fortran',
            ],
            [
                'alias' => 'c',
                'name' => 'c',
            ],
            [
                'alias' => 'cplusplus',
                'name' => 'C++',
            ],
            [
                'alias' => 'smalltalk',
                'name' => 'Smalltalk',
            ],
            [
                'alias' => 'pascal',
                'name' => 'Pascal',
            ],
            [
                'alias' => 'erlang',
                'name' => 'Erlang',
            ],
            [
                'alias' => 'perl',
                'name' => 'Perl',
            ],
            [
                'alias' => 'haskell',
                'name' => 'Haskell',
            ],
            [
                'alias' => 'python',
                'name' => 'Python',
            ],
            [
                'alias' => 'ruby',
                'name' => 'Ruby',
            ],
            [
                'alias' => 'lua',
                'name' => 'Lua',
            ],
            [
                'alias' => 'r',
                'name' => 'R',
            ],
            [
                'alias' => 'java',
                'name' => 'Java',
            ],
            [
                'alias' => 'delphi',
                'name' => 'Delphi',
            ],
            [
                'alias' => 'javascript',
                'name' => 'JavaScript',
            ],
            [
                'alias' => 'php',
                'name' => 'PHP',
            ],
            [
                'alias' => 'd',
                'name' => 'D',
            ],
            [
                'alias' => 'csharp',
                'name' => 'C#',
            ],
            [
                'alias' => 'groovy',
                'name' => 'Groovy',
            ],
            [
                'alias' => 'scala',
                'name' => 'Scala',
            ],
            [
                'alias' => 'fsharp',
                'name' => 'F#',
            ],
            [
                'alias' => 'clojure',
                'name' => 'Clojure',
            ],
            [
                'alias' => 'go',
                'name' => 'Go',
            ],
            [
                'alias' => 'rust',
                'name' => 'Rust',
            ],
            [
                'alias' => 'dart',
                'name' => 'Dart',
            ],
            [
                'alias' => 'julia',
                'name' => 'Julia',
            ],
            [
                'alias' => 'swift',
                'name' => 'Swift',
            ],
            [
                'alias' => 'typescript',
                'name' => 'TypeScript',
            ],
            [
                'alias' => 'coffeescript',
                'name' => 'CoffeeScript',
            ],
            [
                'alias' => 'elixir',
                'name' => 'Elixir',
            ],
            [
                'alias' => 'crystal',
                'name' => 'Crystal',
            ],
            [
                'alias' => 'kotlin',
                'name' => 'Kotlin',
            ],
            [
                'alias' => 'roslyn',
                'name' => 'Roslyn',
            ],
            [
                'alias' => 'powershell',
                'name' => 'PowerShell',
            ],
            [
                'alias' => 'elm',
                'name' => 'Elm',
            ],
            [
                'alias' => 'nim',
                'name' => 'Nim',
            ],
            [
                'alias' => 'lily',
                'name' => 'Lily',
            ],
            [
                'alias' => 'actionscript',
                'name' => 'ActionScript',
            ],
            [
                'alias' => 'objectivec',
                'name' => 'Objective-C',
            ],

            /**
             * Database & search engine
             */
            [
                'alias' => 'mysql',
                'name' => 'MySQL',
            ],
            [
                'alias' => 'elasticsearch',
                'name' => 'Elasticsearch',
            ],
            [
                'alias' => 'redis',
                'name' => 'Redis',
            ],
            [
                'alias' => 'mongodb',
                'name' => 'MongoDB',
            ],
            [
                'alias' => 'neo4j',
                'name' => 'Neo4j',
            ],
            [
                'alias' => 'couchdb',
                'name' => 'CouchDB',
            ],
            [
                'alias' => 'riak',
                'name' => 'Riak',
            ],
            [
                'alias' => 'postgresql',
                'name' => 'PostgreSQL',
            ],
            [
                'alias' => 'sqlite',
                'name' => 'SQLite',
            ],
            [
                'alias' => 'oracle',
                'name' => 'Oracle',
            ],
            [
                'alias' => 'mssql',
                'name' => 'MS SQL',
            ],

            /**
             * Framework
             */
            [
                'alias' => 'symfony',
                'name' => 'Symfony',
            ],
            [
                'alias' => 'rubyonrails',
                'name' => 'Ruby on Rails',
            ],
            [
                'alias' => 'meteor',
                'name' => 'Meteor',
            ],
            [
                'alias' => 'express',
                'name' => 'Express',
            ],
            [
                'alias' => 'laravel',
                'name' => 'Laravel',
            ],
            [
                'alias' => 'flask',
                'name' => 'Flask',
            ],
            [
                'alias' => 'django',
                'name' => 'Django',
            ],
            [
                'alias' => 'spring',
                'name' => 'Spring',
            ],
            [
                'alias' => 'sinatra',
                'name' => 'Sinatra',
            ],
            [
                'alias' => 'play',
                'name' => 'Play',
            ],
            [
                'alias' => 'revel',
                'name' => 'Revel',
            ],
            [
                'alias' => 'cakephp',
                'name' => 'CakePHP',
            ],

            /**
             * Front-end JavaScript Framework
             */
            [
                'alias' => 'reactjs',
                'name' => 'React',
            ],
            [
                'alias' => 'angularjs',
                'name' => 'Angular',
            ],
            [
                'alias' => 'vuejs',
                'name' => 'Vue',
            ],
            [
                'alias' => 'emberjs',
                'name' => 'Ember',
            ],
            [
                'alias' => 'jquery',
                'name' => 'jQuery',
            ],
            [
                'alias' => 'backbonejs',
                'name' => 'Backbone',
            ],

            /**
             * Web Design
             */
            [
                'alias' => 'html',
                'name' => 'html',
            ],
            [
                'alias' => 'css',
                'name' => 'CSS',
            ],

            /**
             * Tool
             */
            [
                'alias' => 'wolframmathematica',
                'name' => 'Wolfram Mathematica',
            ],
            [
                'alias' => 'git',
                'name' => 'Git',
            ],

            /**
             * IDE
             */
            [
                'alias' => 'atom',
                'name' => 'Atom',
            ],
            [
                'alias' => 'phpstorm',
                'name' => 'PhpStorm',
            ],
            [
                'alias' => 'netbeans',
                'name' => 'NetBeans',
            ],

            /**
             * ORM
             */
            [
                'alias' => 'doctrine',
                'name' => 'Doctrine',
            ],

            /**
             * Package manager
             */
            [
                'alias' => 'composer',
                'name' => 'Composer',
            ],
            [
                'alias' => 'npm',
                'name' => 'NPM',
            ],
            [
                'alias' => 'bower',
                'name' => 'Bower',
            ],
            [
                'alias' => 'gulpjs',
                'name' => 'Gulp',
            ],
            [
                'alias' => 'webpack',
                'name' => 'Webpack',
            ],
            [
                'alias' => 'cargo',
                'name' => 'Cargo',
            ],

            /**
             * Platform
             */
            [
                'alias' => 'android',
                'name' => 'Android',
            ],
            [
                'alias' => 'ios',
                'name' => 'iOS',
            ],

            /**
             * Bug Tracker
             */
            [
                'alias' => 'jira',
                'name' => 'Jira',
            ],

            /**
             * Other
             */
            [
                'alias' => 'dotnet',
                'name' => '.NET',
            ],
            [
                'alias' => 'aspnet',
                'name' => 'ASP.NET',
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
            'cplusplus',
            'csharp',
            'mysql',
            'nodejs',
            'html',
            'css',
            'reactjs',
            'sql',
            'git',
            'jira',
        ]);

        /* @var $synonym SkillSynonymRepository */
        $synonym = $doctrine->getRepository('AppBundle:SkillSynonym');
        $synonym->add([
            'php' => ['php5', 'php7'],
            'go' => ['golang'],
            'dotnet' => ['.net'],
            'express' => ['expressjs'],
            'reactjs' => ['react'],
            'symfony' => ['symfony2', 'symfony3'],
            'teamlead' => ['teamleadership', 'teamleading'],
            'testcase' => ['testcasedesign', 'testcases', 'testcasescreation'],
            'manualtesting' => ['manualtestingqa'],
            'presentation' => ['presentations'],
            'gulp' => ['gulpjs'],
            'googleanalytics' => ['googleanalytic'],
            'gamedevelopment' => ['gamedev'],
            'cplusplus' => ['cc++', 'c++'],
            'cshrap' => ['c#'],
            'fshrap' => ['f#'],
            'css' => ['css3'],
            'html' => ['html5', 'htmlcss'],
            'actionscript' => ['actionscript3as3'],
            'blender' => ['blender3d'],
            'bugreport' => ['bugreporting', 'bugreports', 'bugtracking'],
            'businessanalysis' => ['businessanalisys', 'businessanalyst', 'businessanalytics'],
        ]);
    }
}
