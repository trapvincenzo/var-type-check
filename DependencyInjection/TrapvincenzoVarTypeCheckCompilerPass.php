<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TrapvincenzoVarTypeCheckCompilerPass extends CompilerPass
{
    const TYPE_CHECKER_TAG = 'trapvincenzo.vartypecheck.type_checker';
    const TYPE_CHECKER_LOADER_SERVICE_ID = 'trapvincenzo.vartypecheck.typer_checker_loader';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds(self::TYPE_CHECKER_TAG);
        $service = $container->findDefinition(self::TYPE_CHECKER_LOADER_SERVICE_ID);

        foreach ($taggedServices as $taggedServiceId => $taggedService) {
            $service->addMethodCall('addTypeChecker', [new Reference($taggedServiceId)]);
        }
    }
}
