<?php

namespace Owp\OwpCore;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OwpCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

    }
}
