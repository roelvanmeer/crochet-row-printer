<?php

final class Stitch
{
    private $name;
    private $repeats;

    private function __construct(string $name, int $repeats = 1)
    {
        $this->name = $name;
        $this->repeats = $repeats;
    }
}
