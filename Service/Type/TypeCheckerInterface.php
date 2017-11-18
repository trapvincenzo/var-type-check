<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension\VarTypeCheckExtension;

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

    /**
     * When true, the user can explicit the structure
     * of the type with an object
     * eg. type of {keyName: type}
     *
     * @return bool
     */
    public function allowStructureDefinition();

    /**
     * @param mixed $variable
     * @param array $structure
     * @param VarTypeCheckExtension $extension
     *
     * @return bool
     */
    public function validateStructure($variable, array $structure, VarTypeCheckExtension $extension);
}
