<?php

namespace Tests\AppBundle\Service;

class ProfileAvailableCriteriaTest extends TestCase
{
    public function test()
    {
        $searchable = $this->container->get('senseye.developer.index')->getFilter();

        $index = $searchable->getIndex();

        $this->clearIndex($index);

        $source = [
            'multi' => [
                'cities' => [
                    [
                        'alias' => 'kiev',
                        'name' => 'Київ',
                    ],
                    [
                        'alias' => 'lviv',
                        'name' => 'Львів',
                    ],
                    [
                        'alias' => 'odessa',
                        'name' => 'Одеса',
                    ],
                ],
            ],
            'must' => [
                'skills' => [
                    [
                        'alias' => 'php',
                        'name' => 'PHP',
                    ],
                    [
                        'alias' => 'mysql',
                        'name' => 'MySQL',
                    ],
                    [
                        'alias' => 'javascript',
                        'name' => 'JavaScript',
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
                        'alias' => 'phpunit',
                        'name' => 'PHPUnit',
                    ],
                    [
                        'alias' => 'symfony',
                        'name' => 'Symfony',
                    ],
                    [
                        'alias' => 'git',
                        'name' => 'Git',
                    ],
                    [
                        'alias' => 'html',
                        'name' => 'HTML',
                    ],
                    [
                        'alias' => 'css',
                        'name' => 'CSS',
                    ],
                    [
                        'alias' => 'sass',
                        'name' => 'SASS',
                    ],
                    [
                        'alias' => 'less',
                        'name' => 'LESS',
                    ],
                    [
                        'alias' => 'Java',
                        'name' => 'Java',
                    ],
                    [
                        'alias' => 'cpp',
                        'name' => 'C++',
                    ],
                    [
                        'alias' => 'swift',
                        'name' => 'Swift',
                    ],
                    [
                        'alias' => 'golang',
                        'name' => 'Go',
                    ],
                ],
            ],
            'range' => [
                'salary' => [
                    'from' => 1500,
                    'to' => 5000,
                ],
                'experience' => [
                    'from' => 2,
                    'to' => 17,
                ],
            ],
        ];

        $repository = $this->container->get('senseye.profile.available.criteria.repository');

        $repository->store($source);

        $criteria = $repository->get();

        $this->assertSame($source['multi'], $criteria->getMultiMap());
        $this->assertSame($source['must'], $criteria->getMustMap());
        $this->assertSame($source['range'], $criteria->getRangeMap());
    }
}
