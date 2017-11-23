<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Parser;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Node\VarTypeCheckNode;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Parser\VarTypeCheckTokenParser;

class VarTypeCheckTokenParserTest extends \PHPUnit_Framework_TestCase
{
    public function testTagNameIsCorrect()
    {
        $parser = new VarTypeCheckTokenParser();
        $this->assertEquals('varType', $parser->getTag());
    }

    public function testParseWorksCorrectly()
    {
        $tokenStream = $this->prophesize(MockTwig_TokenStream::class);
        $tokenStream->nextIf(\Twig_Token::NAME_TYPE, 'of')->willReturn(true);
        $tokenStream->nextIf(\Twig_Token::NAME_TYPE, 'required')->willReturn(true);
        $tokenStream->expect(\Twig_Token::BLOCK_END_TYPE)->shouldBeCalled();

        $expectsNode = $this->prophesize(\Twig_Node::class);
        $expectsNode->getAttribute('name')->willReturn('expects');

        $expects = $this->prophesize(\Twig_Node::class);
        $expects->getNode(0)->willReturn($expectsNode->reveal());

        $variableNode = $this->prophesize(\Twig_Node::class);
        $variableNode->getAttribute('name')->willReturn('title');

        $variable = $this->prophesize(\Twig_Node::class);
        $variable->getNode(0)->willReturn($variableNode->reveal());

        $typeNode = $this->prophesize(\Twig_Node::class);
        $typeNode->getAttribute('name')->willReturn('type');

        $type = $this->prophesize(\Twig_Node::class);
        $type->getNode(0)->willReturn($typeNode->reveal());

        $nodeExpression = $this->prophesize(\Twig_Node_Expression::class);

        $expressionParser = $this->prophesize(\Twig_ExpressionParser::class);
        $expressionParser->parseAssignmentExpression()->willReturn($variable->reveal(), $expects->reveal(), $type->reveal());
        $expressionParser->parseExpression()->willReturn($nodeExpression->reveal());

        $parser = $this->prophesize(\Twig_Parser::class);
        $parser->getStream()->willReturn($tokenStream->reveal());
        $parser->getExpressionParser()->willReturn($expressionParser->reveal());

        $token = $this->prophesize(\Twig_Token::class);
        $token->getLine()->willReturn(1);

        $tokenParser = new VarTypeCheckTokenParser();
        $tokenParser->setParser($parser->reveal());

        /** @var VarTypeCheckNode $typeCheckNode */
        $typeCheckNode = $tokenParser->parse($token->reveal());

        $this->assertInstanceOf(VarTypeCheckNode::class, $typeCheckNode);
        $this->assertEquals(true, $typeCheckNode->getAttribute('required'));
        $this->assertEquals($variable->reveal(), $typeCheckNode->getNode('name'));
        $this->assertEquals($type->reveal(), $typeCheckNode->getNode('type'));
        $this->assertEquals($nodeExpression->reveal(), $typeCheckNode->getNode('structure'));
    }
}

class MockTwig_TokenStream extends \Twig_TokenStream
{
}
