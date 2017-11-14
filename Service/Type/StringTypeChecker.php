<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

class StringTypeChecker implements TypeCheckerInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'string';
    }
}
