<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type\Traits;

use Prophecy\Argument;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension;

trait StructureDefinitionTestTrait
{
    /**
     * @param mixed $variable
     * @param array $structure
     * @param bool $valid
     *
     * @dataProvider provideValidateStructureWorksAsExpected
     */
    public function testValidateStructureWorksAsExpected($variable, array $structure, $valid)
    {
        $validator = $this->getInstance();
        if (!$validator->allowStructureDefinition()) {
            $this->assertTrue(true);
        } else {

            // Argument::any is used to test the wrong cases
            $stringValidator = $this->prophesize(TypeCheckerInterface::class);
            $stringValidator->validate(Argument::any())->will(function ($args) {
                return is_string($args[0]);
            });

            $boolValidator = $this->prophesize(TypeCheckerInterface::class);
            $boolValidator->validate(Argument::any())->will(function ($args) {
                return is_bool($args[0]);
            });

            $extension = $this->prophesize(VarTypeCheckExtension::class);
            $extension->getTypeChecker('string')->willReturn($stringValidator->reveal());
            $extension->getTypeChecker('bool')->willReturn($boolValidator->reveal());


            $this->assertEquals($valid, $validator->validateStructure($variable, $structure, $extension->reveal()));
        }
    }

}