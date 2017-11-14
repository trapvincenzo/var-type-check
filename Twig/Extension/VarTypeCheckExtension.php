<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Twig\Extension;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Parser\VarTypeCheckTokenParser;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\TypeCheckerLoader;

class VarTypeCheckExtension extends \Twig_Extension
{
    /**
     * @var TypeCheckerLoader
     */
    private $typeCheckerLoader;

    /**
     * VarTypeCheckExtension constructor.
     *
     * @param TypeCheckerLoader $typeCheckerLoader
     */
    public function __construct(TypeCheckerLoader $typeCheckerLoader)
    {
        $this->typeCheckerLoader = $typeCheckerLoader;
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return [new VarTypeCheckTokenParser()];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::class;
    }

    /**
     * @param string $type
     *
     * @return TypeCheckerInterface
     */
    public function getTypeChecker($type)
    {
        return $this->typeCheckerLoader->getTypeChecker($type);
    }
}
