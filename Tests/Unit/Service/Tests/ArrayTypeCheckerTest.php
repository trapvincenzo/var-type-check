<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Tests;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\ArrayTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class ArrayTypeCheckerTest extends BaseTypeCheckerTest
{
    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = [],
                $expectedResult = true,
            ],
            [
                $value = new \stdClass(),
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
        return new ArrayTypeChecker();
    }
}
