<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension;

abstract class AbstractType implements TypeCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function allowStructureDefinition()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function validateStructure($variable, array $structure, VarTypeCheckExtension $extension)
    {
        return false;
    }
}
