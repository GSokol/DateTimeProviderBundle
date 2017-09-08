<?php

/**
 * @author Grigorii Sokolik <g.sokol99@g-sokol.info>
 */

namespace GSokol\DateTimeProviderBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * DateTimePorviderExtensionTest
 */
class DateTimePorviderBundleTest extends TestCase
{
    private $container;

    public function setUp()
    {
        $kernel = new TestKernel('test', false);
//        $kernel->loadClassCache();
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    public function testServices()
    {
        $this->assertTrue($this->container->has('date-time-provider.greedy'));
        $this->assertTrue($this->container->has('date-time-provider.lazy'));
    }

    public function testGreedy()
    {
        sleep(2);
        $this->assertEquals(
            2,
            $this->container->get('date-time-provider.lazy')
                ->getRequestTime()
                ->getTimestamp()
            - $this->container->get('date-time-provider.greedy')
                ->getRequestTime()
                ->getTimestamp()
        );
    }
}
