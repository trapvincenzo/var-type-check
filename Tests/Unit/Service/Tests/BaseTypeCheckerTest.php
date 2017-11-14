<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Tests;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

abstract class BaseTypeCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string|int $value
     * @param bool       $expectedResult
     *
     * @dataProvider provideValidateWorksAsExpected
     */
    public function testValidateWorksAsExpected($value, $expectedResult)
    {
        $checker = $this->getInstance();
        $this->assertEquals($expectedResult, $checker->validate($value));
    }

    /**
     * @return TypeCheckerInterface
     */
    abstract public function getInstance();

    /**
     * @return array
     */
    abstract public function provideValidateWorksAsExpected();
}
