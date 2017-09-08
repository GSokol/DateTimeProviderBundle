<?php

/**
 * @author Grigorii Sokolik <g.sokol99@g-sokol.info>
 */

namespace GSokol\DateTimeProviderBundle;

use GSokol\DateTimeProviderBundle\DependencyInjection\DateTimePorviderExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * DateTimePorviderBundle
 */
class DateTimePorviderBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new DateTimePorviderExtension();
    }
}
