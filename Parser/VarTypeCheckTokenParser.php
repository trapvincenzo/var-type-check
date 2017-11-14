<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Parser;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Node\VarTypeCheckNode;
use Twig_Error_Syntax;
use Twig_NodeInterface;
use Twig_Token;

class VarTypeCheckTokenParser extends \Twig_TokenParser
{
    const EXPECTS_TOKEN = 'expects';

    /**
     * Parses a token and returns a node.
     *
     * @return Twig_NodeInterface
     *
     * @throws Twig_Error_Syntax
     */
    public function parse(Twig_Token $token)
    {
        $required = false;
        $lineNumber = $token->getLine();
        $stream = $this->parser->getStream();
        $variableToCheck = $this->parser->getExpressionParser()->parseAssignmentExpression();
        $expects = $this->parser->getExpressionParser()->parseAssignmentExpression();
        $expectsName = $this->getExpressionName($expects);
        if (self::EXPECTS_TOKEN !== $expectsName) {
            throw new \Twig_Error_Syntax(sprintf("Token expected was '%s', '%s' got", self::EXPECTS_TOKEN, $expectsName));
        }
        $type = $this->parser->getExpressionParser()->parseAssignmentExpression();

        if ($stream->nextIf(\Twig_Token::NAME_TYPE, 'required')) {
            $required = true;
        }

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new VarTypeCheckNode($lineNumber, $variableToCheck, $type, $required);
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'varType';
    }

    /**
     * @param \Twig_Node $expression
     * @param int        $node
     *
     * @return string
     */
    private function getExpressionName(\Twig_Node $expression, $node = 0)
    {
        return $expression->getNode($node)->getAttribute('name');
    }
}
