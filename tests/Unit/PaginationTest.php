<?php

namespace Tests\Unit;

use Tests\TestCase;

class PaginationTest extends TestCase
{
    public function rangesProvider()
    {
        return [
            [
                1,
                2,
                [
                    0 => 1,
                    1 => 2,
                ]
            ],
            [
                2,
                2,
                [
                    0 => 1,
                    1 => 2,
                ]
            ],
            [
                1,
                20,
                [
                    0 => 1,
                    1 => 2,
                    2 => 3,
                    3 => 4,
                    4 => 5,
                ]
            ],
            [
                5,
                20,
                [
                    0 => 3,
                    1 => 4,
                    2 => 5,
                    3 => 6,
                    4 => 7,
                ]
            ],
            [
                19,
                20,
                [
                    0 => 16,
                    1 => 17,
                    2 => 18,
                    3 => 19,
                    4 => 20,
                ]
            ],
            [
                20,
                20,
                [
                    0 => 16,
                    1 => 17,
                    2 => 18,
                    3 => 19,
                    4 => 20,
                ]
            ],
            // Draw the pagination indexes as it was selecting the last index
            [
                21,
                20,
                [
                    0 => 16,
                    1 => 17,
                    2 => 18,
                    3 => 19,
                    4 => 20,
                ]
            ]
        ];
    }

    /**
     * @param int $current
     * @param int $last
     * @param array $range
     * @test
     * @dataProvider rangesProvider
     */
    public function paginationRange($current, $last, $range)
    {
        $this->assertEquals(getPaginationRange($current, $last), $range);
    }

    public function paginationIndexesProvider()
    {
        return [
            [
                1,
                2,
                [
                    'prev'      => [
                        'URL'        => url('/expenses/?page=0'),
                        'disability' => true,
                    ],
                    'next'      => [
                        'URL'        => url('/expenses/?page=2'),
                        'disability' => false,
                    ],
                    'indexes'   => [
                        0 => 1,
                        1 => 2,
                    ],
                    'firstPage' => [
                        'URL'     => url('/expenses/'),
                        'display' => false,
                        'active'  => true
                    ],
                    'lastPage'  => [
                        'URL'     => url('/expenses/?page=2'),
                        'display' => false,
                        'active'  => false
                    ]
                ]
            ],
            [
                2,
                2,
                [
                    'prev'      => [
                        'URL'        => url('/expenses/?page=1'),
                        'disability' => false,
                    ],
                    'next'      => [
                        'URL'        => url('/expenses/?page=3'),
                        'disability' => true,
                    ],
                    'indexes'   => [
                        0 => 1,
                        1 => 2,
                    ],
                    'firstPage' => [
                        'URL'     => url('/expenses/'),
                        'display' => false,
                        'active'  => false,
                    ],
                    'lastPage'  => [
                        'URL'     => url('/expenses/?page=2'),
                        'display' => false,
                        'active'  => true,
                    ]
                ]
            ],
            [
                1,
                20,
                [
                    'prev'      => [
                        'URL'        => url('/expenses/?page=0'),
                        'disability' => true,
                    ],
                    'next'      => [
                        'URL'        => url('/expenses/?page=2'),
                        'disability' => false,
                    ],
                    'indexes'   => [
                        0 => 1,
                        1 => 2,
                        2 => 3,
                        3 => 4,
                        4 => 5,
                    ],
                    'firstPage' => [
                        'URL'     => url('/expenses/'),
                        'display' => false,
                        'active'  => true
                    ],
                    'lastPage'  => [
                        'URL'     => url('/expenses/?page=20'),
                        'display' => true,
                        'active'  => false
                    ]
                ]
            ],
            [

                10,
                20,
                [
                    'prev'      => [
                        'URL'        => url('/expenses/?page=9'),
                        'disability' => false,
                    ],
                    'next'      => [
                        'URL'        => url('/expenses/?page=11'),
                        'disability' => false,
                    ],
                    'indexes'   => [
                        0 => 8,
                        1 => 9,
                        2 => 10,
                        3 => 11,
                        4 => 12,
                    ],
                    'firstPage' => [
                        'URL'     => url('/expenses/'),
                        'display' => true,
                        'active'  => false
                    ],
                    'lastPage'  => [
                        'URL'     => url('/expenses/?page=20'),
                        'display' => true,
                        'active'  => false
                    ]
                ]
            ],
            [

                19,
                20,
                [
                    'prev'      => [
                        'URL'        => url('/expenses/?page=18'),
                        'disability' => false,
                    ],
                    'next'      => [
                        'URL'        => url('/expenses/?page=20'),
                        'disability' => false,
                    ],
                    'indexes'   => [
                        0 => 16,
                        1 => 17,
                        2 => 18,
                        3 => 19,
                        4 => 20,
                    ],
                    'firstPage' => [
                        'URL'     => url('/expenses/'),
                        'display' => true,
                        'active'  => false
                    ],
                    'lastPage'  => [
                        'URL'     => url('/expenses/?page=20'),
                        'display' => false,
                        'active'  => false
                    ]
                ]
            ],
            [
                20,
                20,
                [
                    'prev'      => [
                        'URL'        => url('/expenses/?page=19'),
                        'disability' => false,
                    ],
                    'next'      => [
                        'URL'        => url('/expenses/?page=21'),
                        'disability' => true,
                    ],
                    'indexes'   => [
                        0 => 16,
                        1 => 17,
                        2 => 18,
                        3 => 19,
                        4 => 20,
                    ],
                    'firstPage' => [
                        'URL'     => url('/expenses/'),
                        'display' => true,
                        'active'  => false
                    ],
                    'lastPage'  => [
                        'URL'     => url('/expenses/?page=20'),
                        'display' => false,
                        'active'  => true
                    ]
                ]
            ]
        ];
    }

    /**
     * @param int $current
     * @param int $last
     * @param array $paginationInfo
     * @test
     * @throws \Exception
     * @dataProvider paginationIndexesProvider
     */
    public function paginationInfo($current, $last, $paginationInfo)
    {
        $this->assertEquals(paginationIndexes($current, $last), $paginationInfo);
    }
}