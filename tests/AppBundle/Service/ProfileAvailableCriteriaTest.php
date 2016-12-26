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
            'multi' => [],
            'must' => [],
            'range' => [],
        ];

        $repository = $this->container->get('senseye.profile.available.criteria.repository');

        $repository->store($source);

        $criteria = $repository->get();

        $this->assertSame($source['multi'], $criteria->getMultiMap());
        $this->assertSame($source['must'], $criteria->getMustMap());
        $this->assertSame($source['range'], $criteria->getRangeMap());
    }
}
