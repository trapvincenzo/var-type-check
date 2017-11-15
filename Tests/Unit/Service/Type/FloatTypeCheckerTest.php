<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\FloatTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class FloatTypeCheckerTest extends BaseTypeCheckerTest
{
    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = 1.5,
                $expectedResult = true,
            ],
            [
                $value = 'hey',
                $expectedResult = false,
            ],
            [
                $value = 1,
                $expectedResult = false,
            ],
        ];
    }

    /**
     * @return TypeCheckerInterface
     */
    public function getInstance()
    {
        return new FloatTypeChecker();
    }
}
