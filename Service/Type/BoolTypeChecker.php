<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class BoolTypeChecker implements TypeCheckerInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_bool($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bool';
    }
}
