<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Tests;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\IntTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class IntTypeCheckerTest extends BaseTypeCheckerTest
{
    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = 1,
                $expectedResult = true,
            ],
            [
                $value = 'hey',
                $expectedResult = false,
            ],
            [
                $value = 1.5,
                $expectedResult = false,
            ],
        ];
    }

    /**
     * @return TypeCheckerInterface
     */
    public function getInstance()
    {
        return new IntTypeChecker();
    }
}
