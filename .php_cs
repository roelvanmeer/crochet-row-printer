<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'increment_style' => ['style' => 'post'],
        'yoda_style' => false,
    ])
    ->setLineEnding("\n")
    ->setFinder($finder)
;
