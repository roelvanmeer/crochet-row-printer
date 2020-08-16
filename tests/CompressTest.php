<?php

namespace CrochetRowPrinter;

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
    public function testCompress(string $input, array $repeats, string $formatted): void
    {
        $crp = new CrochetRowPrinter();
        $crp->parse($input);
        $crp->findRepeats();
        $this->assertEquals($repeats, $crp->getRepeats());
        $crp->format();
        $this->assertEquals($formatted, $crp->getFormatted());
    }

    /**
     * Dataprovider for testCompress.
     *
     * @return array
     */
    public function inputProvider(): array
    {
        return [
            [
                'A,A',
                [
                    new Repeat(2, ['A']),
                ],
                '2A',
            ],
            [
                'A,B,A,B',
                [
                    new Repeat(2, ['A', 'B']),
                ],
                '(A, B)x2',
            ],
            [
                'C,A,B,A,B,C',
                [
                    new Repeat(1, ['C']),
                    new Repeat(2, ['A', 'B']),
                    new Repeat(1, ['C']),
                ],
                'C, (A, B)x2, C',
            ],
            [
                'A,A,B,A,A,B',
                [
                    new Repeat(2, ['A', 'A', 'B']),
                ],
                '(2A, B)x2',
            ],
            [
                'A,B,A,A,B,A',
                [
                    new Repeat(2, ['A', 'B', 'A']),
                ],
                '(A, B, A)x2',
            ],
            [
                'C,C,C,A,A,B,B,A,A,B,B,A,A,B,B,A,A,C',
                [
                    new Repeat(1, ['C', 'C', 'C']),
                    new Repeat(3, ['A', 'A', 'B', 'B']),
                    new Repeat(1, ['A', 'A', 'C']),
                ],
                '3C, (2A, 2B)x3, 2A, C',
            ],
            [
                'D,3E,mE,E,3D,mD,D,3E,mE,E,3D,mD,D,3E,mE,E,3D,mD,D,3E,mE,E,3D,mD,2D,2E,mE,3E,D,mD',
                [
                    new Repeat(4, ['D', '3E', 'mE', 'E', '3D', 'mD']),
                    new Repeat(1, ['2D', '2E', 'mE', '3E', 'D', 'mD']),
                ],
                '(D, 3E, mE, E, 3D, mD)x4, 2D, 2E, mE, 3E, D, mD',
            ],
        ];
    }
}
