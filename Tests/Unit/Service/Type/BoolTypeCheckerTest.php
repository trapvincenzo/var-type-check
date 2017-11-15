<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\BoolTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class BoolTypeCheckerTest extends BaseTypeCheckerTest
{
    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = true,
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
        return new BoolTypeChecker();
    }
}
