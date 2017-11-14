<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Service;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Exception\TypeCheckerNotFoundException;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;

class TypeCheckerLoader
{
    /**
     * @var TypeCheckerInterface[]
     */
    private $typeCheckers = [];

    /**
     * @param TypeCheckerInterface $typeCheck
     */
    public function addTypeChecker(TypeCheckerInterface $typeCheck)
    {
        $this->typeCheckers[$typeCheck->getName()] = $typeCheck;
    }

    /**
     * @param $type
     *
     * @return TypeCheckerInterface
     *
     * @throws TypeCheckerNotFoundException
     */
    public function getTypeChecker($type)
    {
        if (!isset($this->typeCheckers[$type])) {
            throw new TypeCheckerNotFoundException(sprintf('%s checker not found.', $type));
        }

        return $this->typeCheckers[$type];
    }

    /**
     * @return TypeCheckerInterface[]
     */
    public function getTypeCheckers()
    {
        return $this->typeCheckers;
    }
}
