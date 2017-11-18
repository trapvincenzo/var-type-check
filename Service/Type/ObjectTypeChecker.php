<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension;

class ObjectTypeChecker extends AbstractType
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_object($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'object';
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

            $value = null;

            $reflect = new \ReflectionClass($variable);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

            foreach ($props as $prop) {
                if ($prop->getName() === $property) {
                    $value = $variable->$property;
                    break;
                }
            }

            if (null === $value) {
                $methodName = 'get'.ucwords($property);
                if (method_exists($variable, $methodName)) {
                    $value = $variable->$methodName();
                }
            }

            if (null === $value && !$required) {
                continue;
            }

            if (!$extension->getTypeChecker($definition['type'])->validate($value)) {
                return false;
            }
        }

        return true;
    }
}
