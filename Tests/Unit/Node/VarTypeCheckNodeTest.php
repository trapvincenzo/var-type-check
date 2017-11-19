<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Node;

use Prophecy\Argument;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Node\VarTypeCheckNode;

class VarTypeCheckNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param bool        $required
     * @param string|null $structure
     * @param string      $expectedCompiled
     *
     * @dataProvider provideCompiledCodeIsCorrect
     */
    public function testCompiledCodeIsCorrect($required, $structure, $expectedCompiled)
    {
        $compiled = '';

        $collect = function ($args) use (&$compiled) {
            $compiled .= $args[0];
        };

        $compiler = $this->prophesize(\Twig_Compiler::class);
        $compiler->raw(Argument::any('string'))->will($collect);
        $compiler->write(Argument::any('string'))->will($collect);

        $nameNode = $this->prophesize(\Twig_Node::class);
        $nameNode->getAttribute('name')->willReturn('title');

        $name = $this->prophesize(\Twig_Node::class);
        $name->getNode(0)->willReturn($nameNode->reveal());

        $typeNode = $this->prophesize(\Twig_Node::class);
        $typeNode->getAttribute('name')->willReturn('custom');

        $type = $this->prophesize(\Twig_Node::class);
        $type->getNode(0)->willReturn($typeNode->reveal());

        $structureExpression = null;

        if (null !== $structure) {
            $structureExpression = $this->prophesize(\Twig_Node_Expression::class);
            $compiler->subcompile($structureExpression->reveal())->willReturn($structure);
            $structureExpression = $structureExpression->reveal();
        }

        $node = new VarTypeCheckNode(1, $name->reveal(), $type->reveal(), $required, $structureExpression);
        $node->compile($compiler->reveal());

        $this->assertEquals($expectedCompiled, $compiled);
    }

    /**
     * @return array
     */
    public function provideCompiledCodeIsCorrect()
    {
        return [
            [
                $required = true,
                $structure = null,
                $compiled = 'if (!isset($context[\'title\'])) {throw new \Exception(sprintf("Expected variable %s", \'title\'));}if (isset($context[\'title\'])) {if (!isset($checker)) {$checker = $this->env->getExtension(\'\Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension\');
}$validator = $checker->getTypeChecker(\'custom\');
if (!$checker->getTypeChecker(\'custom\')->validate($context[\'title\'])) {throw new \Exception(sprintf("Expected type for the variable %s is %s", \'title\', \'custom\'));}}',
            ],
            [
                $required = true,
                $structure = "['header' => ['type' => 'string']]",
                $compiled = 'if (!isset($context[\'title\'])) {throw new \Exception(sprintf("Expected variable %s", \'title\'));}if (isset($context[\'title\'])) {if (!isset($checker)) {$checker = $this->env->getExtension(\'\Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension\');
}$validator = $checker->getTypeChecker(\'custom\');
if (!$checker->getTypeChecker(\'custom\')->validate($context[\'title\'])) {throw new \Exception(sprintf("Expected type for the variable %s is %s", \'title\', \'custom\'));}if (!$validator->allowStructureDefinition()) {throw new \Exception(sprintf("%s type does not allow a structure definition", \'custom\'));}if (!$validator->validateStructure($context[\'title\'], , $checker)) {
throw new \Exception(sprintf("The structure validation failed for the \'%s\' variable using the type \'%s\'", \'title\', \'custom\'));
}}',
            ],
            [
                $required = false,
                $structure = null,
                $compiled = 'if (isset($context[\'title\'])) {if (!isset($checker)) {$checker = $this->env->getExtension(\'\Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension\');
}$validator = $checker->getTypeChecker(\'custom\');
if (!$checker->getTypeChecker(\'custom\')->validate($context[\'title\'])) {throw new \Exception(sprintf("Expected type for the variable %s is %s", \'title\', \'custom\'));}}',
            ],
        ];
    }
}
