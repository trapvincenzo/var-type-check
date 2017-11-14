<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

interface TypeCheckerInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value);

    /**
     * @return string
     */
    public function getName();
}
