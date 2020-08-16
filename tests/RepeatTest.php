<?php

namespace CrochetRowPrinter;

use PHPUnit\Framework\TestCase;

final class RepeatTest extends TestCase
{
    /**
     * Test the input parser.
     *
     * @dataProvider inputProvider
     *
     * @param string $input
     * @param array  $expected
     */
    public function testRepeat(array $stitches, array $reduced, string $formatted): void
    {
        $repeat = new Repeat(1, $stitches);
        $repeat->reduce();
        $this->assertEquals($reduced, $repeat->reduced);
        $this->assertEquals($formatted, $repeat->formatted());
    }

    /**
     * Dataprovider for testRepeat.
     *
     * @return array
     */
    public function inputProvider(): array
    {
        return [
            [
                [ 'A' ],
                [ 'A' ],
                'A',
            ],
            [
                [ 'A', 'A' ],
                [ '2A' ],
                '2A',
            ],
            [
                [ 'A', 'B', 'B', 'C' ],
                [ 'A', '2B', 'C' ], 
                'A, 2B, C',
            ],
        ];
    }
}
