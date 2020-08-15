<?php

namespace CrochetRowPrinter;

final class Repeat
{
    public $repeat = 0;
    public $stitches = [];

    public function __construct(int $repeat, array $stitches)
    {
        $this->repeat = $repeat;
        $this->stitches = $stitches;
    }

    public function formatted(): string
    {
        $str = implode(', ', $this->stitches);
        if ($this->repeat > 1) {
            $str = sprintf('(%s)x%d', $str, $this->repeat);
        }

        return $str;
    }
}
