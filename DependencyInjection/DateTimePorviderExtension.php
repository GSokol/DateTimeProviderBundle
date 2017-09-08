<?php

/**
 * @author Grigorii Sokolik <g.sokol99@g-sokol.info>
 */

namespace GSokol\DateTimeProviderBundle\DependencyInjection;

use GSokol\DateTimeProvider\GreedyDateTimeProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * DateTimePorviderExtension
 */
class DateTimePorviderExtension extends Extension implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        GreedyDateTimeProvider::setup();
    }
}
