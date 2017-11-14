<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class FloatTypeChecker implements TypeCheckerInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_float($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'float';
    }
}
