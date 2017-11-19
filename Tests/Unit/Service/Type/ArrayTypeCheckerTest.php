<?php

namespace Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type;

use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\ArrayTypeChecker;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface;
use Trapvincenzo\Bundle\VarTypeCheckBundle\Tests\Unit\Service\Type\Traits\StructureDefinitionTestTrait;

class ArrayTypeCheckerTest extends BaseTypeCheckerTest
{
    use StructureDefinitionTestTrait;

    /**
     * @return array
     */
    public function provideValidateWorksAsExpected()
    {
        return [
            [
                $value = [],
                $expectedResult = true,
            ],
            [
                $value = new \stdClass(),
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
        return [
            [
                $array = [
                    'title' => 'my title',
                    'description' => 'my description'
                ],
                $structure = [
                    'title' =>[
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'string'
                    ]
                ],
                $valid = true
            ],
            [
                $array = [
                    'title' => 'my title',
                ],
                $structure = [
                    'title' =>[
                        'type' => 'string',
                        'required' => true,
                    ],
                    'description' => [
                        'type' => 'bool'
                    ]
                ],
                $valid = true
            ],
            [
                $array = [
                    'title' => 'my title',
                    'is_valid' => 'wrong type'
                ],
                $structure = [
                    'title' =>[
                        'type' => 'string',
                        'required' => true,
                    ],
                    'is_valid' => [
                        'type' => 'bool'
                    ]
                ],
                $valid = false
            ]
        ];
    }


    /**
     * @return TypeCheckerInterface
     */
    public function getInstance()
    {
        return new ArrayTypeChecker();
    }
}
