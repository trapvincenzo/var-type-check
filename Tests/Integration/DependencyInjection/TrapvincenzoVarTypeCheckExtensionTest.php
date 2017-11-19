<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Integration\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Trapvincenzo\Bundle\VarTypeCheckBundle\DependencyInjection\TrapvincenzoVarTypeCheckExtension;

class TrapvincenzoVarTypeCheckExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testExtensionLoadTheServicesFile()
    {
        $configs = [];
        $containerBuilder = new ContainerBuilder();
        $extension = new TrapvincenzoVarTypeCheckExtension();
        $extension->load($configs, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('trapvincenzo.var_type_check_extension'));
    }
}
