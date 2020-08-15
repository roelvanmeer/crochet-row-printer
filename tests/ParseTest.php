<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ParseTest extends TestCase
{
    /**
     * Test the input parser.
     *
     * @dataProvider inputProvider
     *
     * @param string $input
     * @param array  $expected
     */
    public function testParse(string $input, array $expected): void
    {
        $crp = new CrochetRowPrinter();
        $crp->parse($input);
        $this->assertEquals($expected, $crp->getStitches());
    }

    /**
     * Dataprovider for testRangeAttribute.
     *
     * @return array
     */
    public function inputProvider(): array
    {
        return [
            ['A,A,B', ['A', 'A', 'B']],
            ['A, A, B', ['A', 'A', 'B']],
        ];
    }
}
