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
            [
                'alias' => 'machinelearning',
                'name' => 'Machine Learning',
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
                'alias' => 'memcached',
                'name' => 'Memcached',
            ],
            [
                'alias' => 'mongodb',
                'name' => 'MongoDB',
            ],
            [
                'alias' => 'cassandra',
                'name' => 'Cassandra',
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
                'alias' => 'firebird',
                'name' => 'Firebird',
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
            [
                'alias' => 'yii',
                'name' => 'Yii',
            ],
            [
                'alias' => 'cucumber',
                'name' => 'Cucumber',
            ],
            [
                'alias' => 'phpunit',
                'name' => 'PHPUnit',
            ],
            [
                'alias' => 'behat',
                'name' => 'Behat',
            ],
            [
                'alias' => 'codeception',
                'name' => 'Codeception',
            ],
            [
                'alias' => 'nunit',
                'name' => 'NUnit',
            ],
            [
                'alias' => 'rspec',
                'name' => 'RSpec',
            ],
            [
                'alias' => 'reactnative',
                'name' => 'React Native',
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
            [
                'alias' => 'underscorejs',
                'name' => 'Underscore.js',
            ],

            /**
             * Web Design
             */
            [
                'alias' => 'webdesign',
                'name' => 'Web Design',
            ],
            [
                'alias' => 'responsivedesign',
                'name' => 'Responsive Design',
            ],
            [
                'alias' => 'materialdesign',
                'name' => 'Material Design',
            ],
            [
                'alias' => 'gamedesign',
                'name' => 'Game Design',
            ],
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
                'alias' => 'bem',
                'name' => 'BEM',
            ],
            [
                'alias' => 'bootstrap',
                'name' => 'Bootstrap',
            ],
            [
                'alias' => 'foundation',
                'name' => 'Foundation',
            ],
            [
                'alias' => 'xpath',
                'name' => 'XPath',
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
            [
                'alias' => 'adobeindesign',
                'name' => 'Adobe InDesign',
            ],
            [
                'alias' => 'adobemuse',
                'name' => 'Adobe Muse',
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
                'alias' => 'businessdevelopment',
                'name' => 'Business development',
            ],
            [
                'alias' => 'googleanalytics',
                'name' => 'Google Analytics',
            ],
            [
                'alias' => 'smm',
                'name' => 'SMM',
            ],
            [
                'alias' => 'qualityassurance',
                'name' => 'Quality Assurance (QA)',
            ],
            [
                'alias' => 'usability',
                'name' => 'Usability',
            ],
            [
                'alias' => 'marketing',
                'name' => 'Marketing',
            ],
            [
                'alias' => 'emailmarketing',
                'name' => 'Email Marketing',
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
            [
                'alias' => 'unrealengine',
                'name' => 'Unreal Engine',
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
            [
                'alias' => 'dns',
                'name' => 'DNS',
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
            [
                'alias' => 'mercurial',
                'name' => 'Mercurial',
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
                'alias' => 'invision',
                'name' => 'InVision',
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
                'alias' => 'docker',
                'name' => 'Docker',
            ],
            [
                'alias' => 'vagrant',
                'name' => 'Vagrant',
            ],
            [
                'alias' => 'ansible',
                'name' => 'Ansible',
            ],
            [
                'alias' => 'testrail',
                'name' => 'TestRail',
            ],
            [
                'alias' => 'zabbix',
                'name' => 'Zabbix',
            ],
            [
                'alias' => 'asterisk',
                'name' => 'Asterisk',
            ],
            [
                'alias' => 'teamcity',
                'name' => 'TeamCity',
            ],
            [
                'alias' => 'trello',
                'name' => 'Trello',
            ],
            [
                'alias' => 'qt',
                'name' => 'QT',
            ],
            [
                'alias' => 'swing',
                'name' => 'Swing',
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
            [
                'alias' => 'ant',
                'name' => 'Ant',
            ],
            [
                'alias' => 'capistrano',
                'name' => 'Capistrano',
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
                'alias' => 'webstorm',
                'name' => 'WebStorm',
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
            [
                'alias' => 'visualstudio',
                'name' => 'Visual Studio',
            ],
            [
                'alias' => 'xcode',
                'name' => 'xcode',
            ],
            [
                'alias' => 'rstudio',
                'name' => 'RStudio',
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
                'alias' => 'gruntjs',
                'name' => 'Grunt',
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
            [
                'alias' => 'azure',
                'name' => 'Azure',
            ],
            [
                'alias' => 'aws',
                'name' => 'AWS',
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
            [
                'alias' => 'bugzilla',
                'name' => 'Bugzilla',
            ],
            [
                'alias' => 'youtrack',
                'name' => 'YouTrack',
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
                'alias' => 'continuousintegration',
                'name' => 'Continuous Integration',
            ],
            [
                'alias' => 'bdd',
                'name' => 'BDD',
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
                'alias' => 'solid',
                'name' => 'SOLID',
            ],
            [
                'alias' => 'etl',
                'name' => 'ETL',
            ],
            [
                'alias' => 'uml',
                'name' => 'UML',
            ],
            [
                'alias' => 'productmanagement',
                'name' => 'Product management',
            ],
            [
                'alias' => 'projectmanagement',
                'name' => 'Project Management',
            ],
            [
                'alias' => 'highload',
                'name' => 'Highload',
            ],

            /**
             * Operating system
             */
            [
                'alias' => 'unix',
                'name' => 'Unix',
            ],
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
            [
                'alias' => 'ubuntu',
                'name' => 'Ubuntu',
            ],
            [
                'alias' => 'debian',
                'name' => 'Debian',
            ],
            [
                'alias' => 'centos',
                'name' => 'CentOS',
            ],
            [
                'alias' => 'freebsd',
                'name' => 'FreeBSD',
            ],

            /**
             * Shell
             */
            [
                'alias' => 'bash',
                'name' => 'Bash',
            ],

            /**
             * CMS & CRM & Platrom
             */
            [
                'alias' => 'joomla',
                'name' => 'Joomla',
            ],
            [
                'alias' => 'wordpress',
                'name' => 'WordPress',
            ],
            [
                'alias' => 'magento',
                'name' => 'Magento',
            ],
            [
                'alias' => 'drupal',
                'name' => 'Drupal',
            ],
            [
                'alias' => 'opencart',
                'name' => 'Opencart',
            ],
            [
                'alias' => 'bitrix',
                'name' => 'Bitrix',
            ],

            /**
             * Templating
             */
            [
                'alias' => 'twig',
                'name' => 'Twig',
            ],
            [
                'alias' => 'jade',
                'name' => 'Jade',
            ],
            [
                'alias' => 'haml',
                'name' => 'HAML',
            ],

            /**
             * Big data & Machine Learning
             */
            [
                'alias' => 'hadoop',
                'name' => 'Hadoop',
            ],
            [
                'alias' => 'spark',
                'name' => 'Spark',
            ],
            [
                'alias' => 'hbase',
                'name' => 'HBase',
            ],
            [
                'alias' => 'pandas',
                'name' => 'Pandas',
            ],
            [
                'alias' => 'hive',
                'name' => 'Hive',
            ],
            [
                'alias' => 'rabbitmq',
                'name' => 'RabbitMQ',
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
            'javascript' => ['js', 'es6'],
            'r' => ['rlanguage'],
            'tcp' => ['tcpip'],
            'go' => ['golang'],
            'adobeillustrator' => ['illustrator'],
            'adobephotoshop' => ['photoshop'],
            'dotnet' => ['net', '.net'],
            'express' => ['expressjs'],
            'reactjs' => ['react'],
            'angularjs' => ['angular', 'angular2'],
            'symfony' => ['symfony2', 'symfony3'],
            'rubyonrails' => ['rails', 'ror'],
            'yii' => ['yii2'],
            'unrealengine' => ['unrealengine4'],
            'magento' => ['magento2'],
            'spring' => ['springmvc', 'springframework'],
            'teamlead' => ['teamleadership', 'teamleading'],
            'testcase' => ['testcasedesign', 'testcases', 'testcasescreation'],
            'manualtesting' => ['manualtestingqa'],
            'presentation' => ['presentations'],
            'gulpjs' => ['gulp'],
            'gruntjs' => ['grunt'],
            'jquery' => ['jqueryui'],
            'googleanalytics' => ['googleanalytic'],
            'continuousintegration' => ['ci'],
            'gamedevelopment' => ['gamedev'],
            'tdd' => ['testdrivendevelopment', 'testdrivendevelopmenttdd'],
            'ood' => ['oopood'],
            'scrum' => ['agilescrum'],
            'rest' => ['restapi'],
            'cplusplus' => ['cc++', 'c++'],
            'csharp' => ['c#'],
            'fsharp' => ['f#'],
            'css' => ['css3'],
            'sass' => ['scss'],
            'html' => ['html5', 'htmlcss'],
            'bootstrap' => ['twitterbootstrap'],
            'actionscript' => ['actionscript3as3'],
            'userexperience' => ['userexperienceux', 'uiux'],
            'userinterface' => ['userinterfaceui'],
            'spark' => ['apachespark'],
            'mssql' => ['mssqlserver', 'microsoftsqlserver'],
            'selenium' => ['seleniumide', 'seleniumwebdriver'],
            'blender' => ['blender3d'],
            'bugreport' => ['bugreporting', 'bugreports', 'bugtracking'],
            'businessanalysis' => ['businessanalisys', 'businessanalyst', 'businessanalytics'],
        ]);
    }
}
