<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trapvincenzo\Bundle\VarTypeCheckBundle\DependencyInjection\TrapvincenzoVarTypeCheckCompilerPass;

class TrapvincenzoVarTypeCheckBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new TrapvincenzoVarTypeCheckCompilerPass());
    }
}
