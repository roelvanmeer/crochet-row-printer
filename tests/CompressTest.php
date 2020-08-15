<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CompressTest extends TestCase
{
    /**
     * Test the input parser.
     *
     * @dataProvider inputProvider
     *
     * @param string $input
     * @param array  $expected
     */
    public function testCompress(string $input, array $expected): void
    {
        $crp = new CrochetRowPrinter();
        $crp->parse($input);
        $this->assertEquals($expected, $crp->compress());
    }

    /**
     * Dataprovider for testCompress
     *
     * @return array
     */
    public function inputProvider(): array
    {
        return [
            [
		        'A,A',
                [
                    [
                        'stitches' => ['A'],
                        'repeat' => 2,
                    ],
                ],
            ],
            [
                'A,B,A,B',
                [
                    [
                        'stitches' => ['A', 'B'],
                        'repeat' => 2,
                    ],
                ],
            ],
            [
                'C,A,B,A,B,C',
                [
                    [
                        'stitches' => ['C'],
                        'repeat' => 1,
                    ],
                    [
                        'stitches' => ['A', 'B'],
                        'repeat' => 2,
                    ],
                    [
                        'stitches' => ['C'],
                        'repeat' => 1,
                    ],
                ],
            ],
            [
                'A,B,A,A,B,A',
                [
                    [
                        'stitches' => ['A', 'B', 'A'],
                        'repeat' => 2,
                    ],
                ],
            ],
            [
                'D,3E,mE,E,3D,mD,D,3E,mE,E,3D,mD,D,3E,mE,E,3D,mD,D,3E,mE,E,3D,mD,2D,2E,mE,3E,D,mD',
                [
                    [
                        'stitches' => ['D', '3E', 'mE', 'E', '3D', 'mD'],
                        'repeat' => 4,
                    ],
                    [
                        'stitches' => ['2D', '2E', 'mE', '3E', 'D', 'mD'],
                        'repeat' => 1,
                    ],
                ],
            ],
        ];
    }
}
