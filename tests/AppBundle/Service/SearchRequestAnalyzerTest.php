<?php

namespace Tests\AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileSearchCriteria;
use Symfony\Component\HttpFoundation\Request;

class SearchRequestAnalyzerTestCase extends TestCase
{
    private $availableMulti = [
        'cities' => [
            [
                'alias' => 'kiev',
                'name' => 'Київ',
            ],
            [
                'alias' => 'lviv',
                'name' => 'Львів',
            ],
        ],
    ];

    public function testEmpty()
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria([], []),
                new Request()
            );

        $this->assertInstanceOf(ProfileSearchCriteria::class, $searchCriteria);
    }

    public function testCity()
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria($this->availableMulti, []),
                new Request(['cities' => 'lviv'])
            );

        $this->assertSame(
            [
                'cities' => [
                    [
                        'alias' => 'lviv',
                        'name' => 'Львів',
                    ],
                ]
            ],
            $searchCriteria->getMultiMap()
        );
    }

    private function getService()
    {
        return $this->container->get('senseye.profile.search.request.analyzer');
    }
}
