<?php

declare(strict_types=1);

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
        $crp->compress();
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
                '(A)x2',
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
                'A,B,A,A,B,A',
                [
                    new Repeat(2, ['A', 'B', 'A']),
                ],
                '(A, B, A)x2',
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
