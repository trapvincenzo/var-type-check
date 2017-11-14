<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class ArrayTypeChecker implements TypeCheckerInterface
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
}
