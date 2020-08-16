<?php

namespace CrochetRowPrinter;

/**
 * Repeat class; describes a possibly repeating series of stitches.
 */
final class Repeat
{
    public $repeat = 0;
    public $stitches = [];
    public $reduced = [];

    public function __construct(int $repeat, array $stitches)
    {
        $this->repeat = $repeat;
        $this->stitches = $stitches;
    }

    public function reduce(): void
    {
        if (count($this->stitches) == 1) {
            $this->reduced = $this->stitches;
            return;
        }
        $this->reduced = [];
        $repeat = null;
        for ($i = 0; $i < count($this->stitches); $i++) {
            $stitch = $this->stitches[$i];
            if ($repeat) {
                if ($stitch === $repeat->stitches[0]) {
                    $repeat->repeat++;
                    continue;
                }
                $reduced[] = $repeat;
                $repeat = null;
            }
            if (!$repeat) {
                $repeat = new Repeat(1, [$stitch]);
            }
        }
        if ($repeat) {
            $reduced[] = $repeat;
        }
        $this->reduced = array_map(function ($repeat) {
            return $repeat->formatted();
        }, $reduced);
    }

    /**
     * Return a string describing a possibly repeating series of stitches.
     *
     * @return string
     */
    public function formatted(): string
    {
        $this->reduce();
        $n_stitches = count($this->reduced);
        $str = implode(', ', $this->reduced);
        if ($this->repeat > 1) {
            if ($n_stitches == 1) {
                $str = sprintf('%d%s', $this->repeat, $str);
            } else {
                $str = sprintf('(%s)x%d', $str, $this->repeat);
            }
        }

        return $str;
    }
}
