<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Node;

class VarTypeCheckNode extends \Twig_Node
{
    /**
     * VarTypeCheckNode constructor.
     *
     * @param array       $line
     * @param \Twig_Node  $name
     * @param \Twig_Node  $type
     * @param bool        $required
     * @param string|null $tag
     */
    public function __construct($line, \Twig_Node $name, \Twig_Node $type, $required = false, $tag = null)
    {
        $nodes = [
            'name' => $name,
            'type' => $type,
        ];
        parent::__construct($nodes, ['required' => $required], $line, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $required = $this->getAttribute('required');
        $variableName = $this->getNode('name')->getNode(0)->getAttribute('name');

        if ($required) {
            $compiler->raw("if (!isset(\$context['$variableName'])) {");
            $compiler->write('');
            $compiler->raw("throw new \Exception(sprintf(\"Expected variable %s\", '$variableName'));");
            $compiler->raw('}');
        }

        $expectedType = $this->getNode('type')->getNode(0)->getAttribute('name');
        $compiler->raw("if (isset(\$context['$variableName'])) {");
        $compiler->write('');
        $compiler->raw('if (!isset($checker)) {');
        $compiler->raw(sprintf("\$checker = \$this->env->getExtension('\\Trapvincenzo\\Bundle\\VarTypeCheckBundle\\Twig\\Extension\\VarTypeCheckExtension');\n"));
        $compiler->raw('}');
        $compiler->raw("if (!\$checker->getTypeChecker('$expectedType')->validate(\$context['$variableName'])) {");
        $compiler->write('');
        $compiler->raw("throw new \Exception(sprintf(\"Expected type for the variable %s is %s\", '$variableName', '$expectedType'));");
        $compiler->raw('}');
        $compiler->raw('}');
    }
}
