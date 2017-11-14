<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class ObjectTypeChecker implements TypeCheckerInterface
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
}
