<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Tests;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\ObjectTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class ObjectTypeCheckerTest extends BaseTypeCheckerTest
{
    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = new \stdClass(),
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
        return new ObjectTypeChecker();
    }
}
