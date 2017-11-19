<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\ObjectTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type\Traits\StructureDefinitionTestTrait;

class ObjectTypeCheckerTest extends BaseTypeCheckerTest
{
    use StructureDefinitionTestTrait;

    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = new \stdClass(),
                $expectedResult = true,
            ],
            [
                $value = 'hey',
                $expectedResult = false,
            ],
            [
                $value = 1,
                $expectedResult = false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function provideValidateStructureWorksAsExpected()
    {
        $obj = new ObjectTypeCheckerObjectTest('My title', 'My description');
        $obj2 = new ObjectTypeCheckerObjectTest('My title', null);
        $obj3 = new ObjectTypeCheckerObjectTest('My title', null);
        $obj3->isVisible = true;

        return [
            [
                $obj,
                $structure = [
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'string',
                    ],
                ],
                $valid = true,
            ],
            [
                $obj2,
                $structure = [
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'string',
                    ],
                ],
                $valid = true,
            ],
            [
                $obj2,
                $structure = [
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'string',
                        'required' => true,
                    ],
                ],
                $valid = false,
            ],
            [
                $obj3,
                $structure = [
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'string',
                    ],
                    'isVisible' => [
                        'type' => 'string',
                    ],
                ],
                $valid = false,
            ],
            [
                $obj3,
                $structure = [
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'string',
                    ],
                    'isVisible' => [
                        'type' => 'bool',
                    ],
                ],
                $valid = true,
            ],
        ];
    }

    /**
     * @return TypeCheckerInterface
     */
    public function getInstance()
    {
        return new ObjectTypeChecker();
    }
}

class ObjectTypeCheckerObjectTest
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * For test sake.
     *
     * @var bool
     */
    public $isVisible;

    /**
     * ObjectTypeCheckerObjectTest constructor.
     *
     * @param string $title
     * @param string $description
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
