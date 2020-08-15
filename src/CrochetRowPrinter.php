<?php

namespace CrochetRowPrinter;

class CrochetRowPrinter
{
    private $stitches = [];
    private $repeats = [];

    protected function output(string $row): string
    {
        $this->parse($row);
        $this->compress($row_data);
        $compressed_row = $this->format($compressed_data);

        return $compressed_row;
    }

    public function getStitches(): array
    {
        return $this->stitches;
    }

    public function setStitches(array $stitched): void
    {
        $this->stitches = $stitches;
    }

    public function getRepeats(): array
    {
        return $this->repeats;
    }

    public function parse(string $row): void
    {
        $this->stitches = preg_split('/[ ,]+/', $row);
    }

    private function format(array $data): string
    {
    }

    public function compress(): ?array
    {
        $n_stitches = count($this->stitches);
        $max_offset = floor($n_stitches / 3);
        $max_length = floor($n_stitches / 2);
        for ($offset = 0; $offset <= $max_offset; $offset++) {
            for ($length = 1; $length <= $max_length; $length++) {
                $repeats = [];
                $last = null;
                $work = array_slice($this->stitches, $offset);
                $chunks = array_chunk($work, $length);
                // If the last chunk is shorter than our selected length, or
                // if it differs from the first chunk, make it a seperate
                // repeat.
                if (count(end($chunks)) < $length || end($chunks) !== $chunks[0]) {
                    $last = new Repeat(1, end($chunks));
                    array_pop($chunks);
                }
                $n_chunks = count($chunks);
                if ($n_chunks < 2) {
                    // The number of chunks is too low.
                    continue;
                }
                for ($n = 1; $n < $n_chunks; $n++) {
                    if ($chunks[$n] !== $chunks[0]) {
                        // The chunks aren't equal.
                        continue 2;
                    }
                }
                if ($offset > 0) {
                    $repeats[] = new Repeat(1, array_slice($this->stitches, 0, $offset));
                }
                $repeats[] = new Repeat($n_chunks, $chunks[0]);
                if ($last) {
                    $repeats[] = $last;
                }

                $this->repeats = $repeats;

                return $this->repeats;
            }
        }
    }
}
