<?php

/**
 * @author Grigorii Sokolik <g.sokol99@g-sokol.info>
 */

namespace GSokol\DateTimeProviderBundle\Tests;

use GSokol\DateTimeProviderBundle\DateTimePorviderBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * TestKernel
 */
class TestKernel extends Kernel
{
    public function registerBundles()
    {
        return [new DateTimePorviderBundle()];
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return __DIR__ . '/tmp/cache';
    }

    public function getLogDir()
    {
        return __DIR__ . '/tmp/log';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}
