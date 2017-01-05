<?php

namespace Tests\AppBundle\Service;

use Elastica\Index;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class TestCase extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function setUp()
    {
        static::bootKernel();

        $this->container =  static::$kernel->getContainer();
    }

    public function clearIndex(Index $index)
    {
        try {
            $index->delete();
        } catch (\Exception $e) {
        }
    }
}
