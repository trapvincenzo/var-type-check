<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Exception\TypeCheckerNotFoundException;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\TypeCheckerLoader;

class TypeCheckerLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TypeCheckerLoader
     */
    private $typeCheckerLoader;

    public function setUp()
    {
        $typeChecker1 = $this->prophesize(TypeCheckerInterface::class);
        $typeChecker1->getName()->willReturn('string');

        $typeChecker2 = $this->prophesize(TypeCheckerInterface::class);
        $typeChecker2->getName()->willReturn('int');

        $typeChecker3 = $this->prophesize(TypeCheckerInterface::class);
        $typeChecker3->getName()->willReturn('array');

        $this->typeCheckerLoader = new TypeCheckerLoader();
        $this->typeCheckerLoader->addTypeChecker($typeChecker1->reveal());
        $this->typeCheckerLoader->addTypeChecker($typeChecker2->reveal());
        $this->typeCheckerLoader->addTypeChecker($typeChecker3->reveal());
    }

    public function testAddTypeCheckAddsTypesToTheStack()
    {
        $this->assertCount(3, $this->typeCheckerLoader->getTypeCheckers());
    }

    public function testTheReturnedCheckerIsTheOneExpected()
    {
        $this->assertEquals('int', $this->typeCheckerLoader->getTypeChecker('int')->getName());
    }

    public function testNotFoundCheckerShouldThrowAnExcpetion()
    {
        $this->setExpectedException(TypeCheckerNotFoundException::class);
        $this->typeCheckerLoader->getTypeChecker('not_found');
    }
}
