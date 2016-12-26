<?php

namespace Tests\AppBundle\Service;

class ProfileAvailableCriteriaTest extends TestCase
{
    public function test()
    {
        $searchable = $this->container->get('senseye.developer.index')->getFilter();

        $index = $searchable->getIndex();

        $this->clearIndex($index);
    }
}
