<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Node;

class VarTypeCheckNode extends \Twig_Node
{
    /**
     * VarTypeCheckNode constructor.
     *
     * @param array                      $line
     * @param \Twig_Node                 $name
     * @param \Twig_Node                 $type
     * @param bool                       $required
     * @param \Twig_Node_Expression|null $structure
     * @param string|null                $tag
     */
    public function __construct($line, \Twig_Node $name, \Twig_Node $type, $required = false, \Twig_Node_Expression $structure = null, $tag = null)
    {
        $nodes = [
            'name' => $name,
            'type' => $type
        ];

        if (null !== $structure) {
            $nodes['structure'] = $structure;
        }
        parent::__construct($nodes, ['required' => $required], $line, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $required = $this->getAttribute('required');
        $structure = null;
        if ($this->hasNode('structure')) {
            $structure = $this->getNode('structure');
        }
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
        $compiler->raw("\$checker = \$this->env->getExtension('\\Trapvincenzo\\Bundle\\VarTypeCheckBundle\\Twig\\Extension\\VarTypeCheckExtension');\n");
        $compiler->raw('}');
        $compiler->raw("\$validator = \$checker->getTypeChecker('$expectedType');\n");
        $compiler->raw("if (!\$checker->getTypeChecker('$expectedType')->validate(\$context['$variableName'])) {");
        $compiler->write('');
        $compiler->raw("throw new \Exception(sprintf(\"Expected type for the variable %s is %s\", '$variableName', '$expectedType'));");
        $compiler->raw('}');

        // Check if there's a structure definition and if the type allows it
        if (null !== $structure) {
            $compiler->write('if (!$validator->allowStructureDefinition()) {');
            $compiler->raw("throw new \Exception(sprintf(\"%s type does not allow a structure definition\", '$expectedType'));");
            $compiler->write('}');
            $compiler->write("if (!\$validator->validateStructure(\$context['$variableName'], ");
            $compiler->subcompile($structure);
            $compiler->raw(", \$checker)) {\n");
            $compiler->raw("throw new \Exception(sprintf(\"The structure validation failed for the '%s' variable using the type '%s'\", '$variableName', '$expectedType'));\n");
            $compiler->write('}');
        }
        $compiler->raw('}');
    }
}
