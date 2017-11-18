<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension;

class ArrayTypeChecker extends AbstractType
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_array($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'array';
    }

    /**
     * {@inheritdoc}
     */
    public function allowStructureDefinition()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function validateStructure($variable, array $structure, VarTypeCheckExtension $extension)
    {
        if (!$this->validate($variable)) {
            return false;
        }

        foreach ($structure as $property => $definition) {
            $required = false;
            if (isset($definition['required'])) {
                $required = $definition['required'];
            }

            // The property is not defined but is not required
            // we can validate it
            if (!$required && !isset($variable[$property])) {
                continue;
            }

            if(!$extension->getTypeChecker($definition['type'])->validate($variable[$property])) {
                return false;
            }
        }

        return true;
    }
}
