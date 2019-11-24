<?php

namespace Owp\OwpCore;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Owp\OwpCore\DependencyInjection\Compiler\OwpCorePass;

class OwpCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OwpCorePass());
    }
}
