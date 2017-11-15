<?php
/**
 * Created by PhpStorm.
 * User: vincenzo
 * Date: 15/11/2017
 * Time: 08:39
 */

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\DependencyInjection;

use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Trapvincenzo\Bundle\VarTypeCheckBundle\DependencyInjection\TrapvincenzoVarTypeCheckCompilerPass;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\TypeCheckerLoader;

class TrapvincenzoVarTypeCheckCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessAddTheRightTaggedServicesToTheLoader()
    {
        $checker1 = $this->prophesize(TypeCheckerInterface::class);
        $checker2 = $this->prophesize(TypeCheckerInterface::class);
        $checker3 = $this->prophesize(TypeCheckerInterface::class);

        $services = [
            $checker1->reveal(),
            $checker2->reveal(),
            $checker3->reveal(),
        ];

        $loader = $this->prophesize(Definition::class);

        $container = $this->prophesize(ContainerBuilder::class);
        $container->findTaggedServiceIds(TrapvincenzoVarTypeCheckCompilerPass::TYPE_CHECKER_TAG)->willReturn($services);
        $container->findDefinition(TrapvincenzoVarTypeCheckCompilerPass::TYPE_CHECKER_LOADER_SERVICE_ID)->willReturn($loader->reveal());


        $loader->addMethodCall('addTypeChecker', Argument::type('array'))->shouldBeCalledTimes(3);

        $compilerPass = new TrapvincenzoVarTypeCheckCompilerPass();
        $compilerPass->process($container->reveal());
    }
}