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
            [
                'alias' => 'sql',
                'name' => 'SQL',
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
            [
                'alias' => 'tsql',
                'name' => 'T-SQL',
            ],
            [
                'alias' => 'plsql',
                'name' => 'PL/SQL',
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
            [
                'alias' => 'entityframework',
                'name' => 'Entity Framework',
            ],
            [
                'alias' => 'aspnetmvc',
                'name' => 'ASP.NET MVC',
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
             * Web design
             */
            [
                'alias' => 'html',
                'name' => 'html',
            ],
            [
                'alias' => 'css',
                'name' => 'CSS',
            ],
            [
                'alias' => 'less',
                'name' => 'LESS',
            ],
            [
                'alias' => 'sass',
                'name' => 'SASS',
            ],
            [
                'alias' => 'bootstrap',
                'name' => 'Bootstrap',
            ],
            [
                'alias' => 'foundation',
                'name' => 'Foundation',
            ],

            /**
             * Design
             */
            [
                'alias' => 'adobephotoshop',
                'name' => 'Adobe Photoshop',
            ],
            [
                'alias' => 'adobeillustrator',
                'name' => 'Adobe Illustrator',
            ],

            /**
             * User Experience (UX) & User Interface (UI)
             */
            [
                'alias' => 'userexperience',
                'name' => 'User Experience (UX)',
            ],
            [
                'alias' => 'userinterface',
                'name' => 'User Interface (UI)',
            ],
            [
                'alias' => 'businessanalysis',
                'name' => 'Business Analysis',
            ],
            [
                'alias' => 'qualityassurance',
                'name' => 'Quality Assurance (QA)',
            ],

            /**
             * Web development
             */
            [
                'alias' => 'ajax',
                'name' => 'AJAX',
            ],
            [
                'alias' => 'rest',
                'name' => 'REST',
            ],
            [
                'alias' => 'seo',
                'name' => 'SEO',
            ],

            /**
             * Game development
             */
            [
                'alias' => 'unity3d',
                'name' => 'Unity',
            ],

            /**
             * Server
             */
            [
                'alias' => 'nginx',
                'name' => 'Nginx',
            ],
            [
                'alias' => 'apache',
                'name' => 'Apache',
            ],
            [
                'alias' => 'tomcat',
                'name' => 'Tomcat',
            ],

            /**
             * Protocol
             */
            [
                'alias' => 'ip',
                'name' => 'IP',
            ],
            [
                'alias' => 'http',
                'name' => 'HTTP',
            ],
            [
                'alias' => 'tcp',
                'name' => 'TCP',
            ],

            /**
             * Data format
             */
            [
                'alias' => 'json',
                'name' => 'JSON',
            ],
            [
                'alias' => 'xml',
                'name' => 'XML',
            ],

            /**
             * Version control system
             */
            [
                'alias' => 'git',
                'name' => 'Git',
            ],
            [
                'alias' => 'svn',
                'name' => 'SVN',
            ],

            /**
             * Tool
             */
            [
                'alias' => 'wolframmathematica',
                'name' => 'Wolfram Mathematica',
            ],
            [
                'alias' => 'axure',
                'name' => 'Axure',
            ],
            [
                'alias' => 'sketch',
                'name' => 'Sketch',
            ],
            [
                'alias' => 'firebug',
                'name' => 'Firebug',
            ],
            [
                'alias' => 'junit',
                'name' => 'JUnit',
            ],
            [
                'alias' => 'jenkins',
                'name' => 'Jenkins',
            ],
            [
                'alias' => 'jmeter',
                'name' => 'JMeter',
            ],
            [
                'alias' => 'selenium',
                'name' => 'Selenium',
            ],
            [
                'alias' => 'virtualbox',
                'name' => 'VirtualBox',
            ],
            [
                'alias' => 'vmware',
                'name' => 'VMware',
            ],
            [
                'alias' => 'testrail',
                'name' => 'TestRail',
            ],

            /**
             * Build manager
             */
            [
                'alias' => 'gradle',
                'name' => 'Gradle',
            ],
            [
                'alias' => 'maven',
                'name' => 'Maven',
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
            [
                'alias' => 'androidstudio',
                'name' => 'Android Studio',
            ],
            [
                'alias' => 'eclipse',
                'name' => 'Eclipse',
            ],
            [
                'alias' => 'intellijidea',
                'name' => 'IntelliJ IDEA',
            ],

            /**
             * ORM
             */
            [
                'alias' => 'linq',
                'name' => 'LINQ',
            ],
            [
                'alias' => 'doctrine',
                'name' => 'Doctrine',
            ],
            [
                'alias' => 'hibernate',
                'name' => 'Hibernate',
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
             * Bug Tracker & team
             */
            [
                'alias' => 'jira',
                'name' => 'Jira',
            ],
            [
                'alias' => 'mantis',
                'name' => 'Mantis',
            ],
            [
                'alias' => 'redmine',
                'name' => 'Redmine',
            ],
            [
                'alias' => 'confluence',
                'name' => 'Confluence',
            ],

            /**
             * Software development
             */
            [
                'alias' => 'agile',
                'name' => 'Agile',
            ],
            [
                'alias' => 'scrum',
                'name' => 'Scrum',
            ],
            [
                'alias' => 'kanban',
                'name' => 'Kanban',
            ],
            [
                'alias' => 'waterfall',
                'name' => 'Waterfall',
            ],
            [
                'alias' => 'tdd',
                'name' => 'TDD',
            ],
            [
                'alias' => 'designpatterns',
                'name' => 'Design Patterns',
            ],
            [
                'alias' => 'multithreading',
                'name' => 'Multithreading',
            ],
            [
                'alias' => 'mvc',
                'name' => 'MVC',
            ],
            [
                'alias' => 'oop',
                'name' => 'OOP',
            ],
            [
                'alias' => 'ood',
                'name' => 'OOD',
            ],
            [
                'alias' => 'uml',
                'name' => 'UML',
            ],
            [
                'alias' => 'productmanagement',
                'name' => 'Product management',
            ],

            /**
             * Operating system
             */
            [
                'alias' => 'linux',
                'name' => 'Linux',
            ],
            [
                'alias' => 'windows',
                'name' => 'Windows',
            ],
            [
                'alias' => 'macos',
                'name' => 'MacOS',
            ],

            /**
             * Shell
             */
            [
                'alias' => 'bash',
                'name' => 'Bash',
            ],

            /**
             * CMS
             */
            [
                'alias' => 'joomla',
                'name' => 'Joomla',
            ],
            [
                'alias' => 'wordpress',
                'name' => 'WordPress',
            ],

            /**
             * Other
             */
            [
                'alias' => 'nodejs',
                'name' => 'Node.js',
            ],
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
            'dotnet',
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
            'android' => ['androidsdk'],
            'java' => ['javacore'],
            'tcp' => ['tcpip'],
            'go' => ['golang'],
            'adobeillustrator' => ['illustrator'],
            'adobephotoshop' => ['photoshop'],
            'dotnet' => ['net', '.net'],
            'express' => ['expressjs'],
            'reactjs' => ['react'],
            'angularjs' => ['angular', 'angular2'],
            'symfony' => ['symfony2', 'symfony3'],
            'spring' => ['springmvc'],
            'teamlead' => ['teamleadership', 'teamleading'],
            'testcase' => ['testcasedesign', 'testcases', 'testcasescreation'],
            'manualtesting' => ['manualtestingqa'],
            'presentation' => ['presentations'],
            'gulpjs' => ['gulp'],
            'googleanalytics' => ['googleanalytic'],
            'gamedevelopment' => ['gamedev'],
            'ood' => ['oopood'],
            'rest' => ['restapi'],
            'cplusplus' => ['cc++', 'c++'],
            'csharp' => ['c#'],
            'fsharp' => ['f#'],
            'css' => ['css3'],
            'sass' => ['scss'],
            'html' => ['html5', 'htmlcss'],
            'bootstrap' => ['twitterbootstrap'],
            'actionscript' => ['actionscript3as3'],
            'userexperience' => ['userexperienceux'],
            'userinterface' => ['userinterfaceui'],
            'mssql' => ['mssqlserver'],
            'selenium' => ['seleniumide', 'seleniumwebdriver'],
            'blender' => ['blender3d'],
            'bugreport' => ['bugreporting', 'bugreports', 'bugtracking'],
            'businessanalysis' => ['businessanalisys', 'businessanalyst', 'businessanalytics'],
        ]);
    }
}
