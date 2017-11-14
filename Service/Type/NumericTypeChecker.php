<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class NumericTypeChecker implements TypeCheckerInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_numeric($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'numeric';
    }
}
