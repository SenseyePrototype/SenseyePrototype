<?php

namespace Tests\AppBundle\Service;

class ProfileSearchServiceTest extends AbstractServiceTest
{
    public function test()
    {
        $this->container->get('senseye.elasticsearch.client')->getStatus();
    }
}
