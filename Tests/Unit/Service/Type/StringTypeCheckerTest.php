<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\StringTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class StringTypeCheckerTest extends BaseTypeCheckerTest
{
    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = 1,
                $expectedResult = false,
            ],
            [
                $value = 'hey',
                $expectedResult = true,
            ],
        ];
    }

    /**
     * @return TypeCheckerInterface
     */
    public function getInstance()
    {
        return new StringTypeChecker();
    }
}
