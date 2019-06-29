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
     * @test
     * @dataProvider rangesProvider
     */
    public function testPaginationRange($current, $last, $range)
    {
        $this->assertEquals(getPaginationRange($current, $last), $range);
    }
}