<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class IntTypeChecker extends AbstractType
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_int($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'int';
    }
}
