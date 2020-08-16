<?php

/* Example for projects not using composer. */

require_once('../src/CrochetRowPrinter.php');
require_once('../src/Repeat.php');

$crp = new CrochetRowPrinter\CrochetRowPrinter;

$stitches = 'A, A, B, C, D, C, C, D, C, C, D, C, C, D, C, E, C, A';
$pretty = $crp->pp($stitches);
print "verbose: $stitches\n";
print "concise: $pretty\n";
