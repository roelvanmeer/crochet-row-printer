<?php

final class Repeat
{
    public $repeat = 0;
    public $stitches = [];

    public function __construct(int $repeat, array $stitches)
    {
        $this->repeat = $repeat;
        $this->stitches = $stitches;
    }
}
