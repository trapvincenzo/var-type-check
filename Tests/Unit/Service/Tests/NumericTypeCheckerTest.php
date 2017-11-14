<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Tests;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\NumericTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class NumericTypeCheckerTest extends BaseTypeCheckerTest
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
        ];
    }

    /**
     * @return TypeCheckerInterface
     */
    public function getInstance()
    {
        return new NumericTypeChecker();
    }
}
