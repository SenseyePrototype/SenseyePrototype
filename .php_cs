<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(['src']);

return Symfony\CS\Config\Config::create()
    ->setUsingLinter(false)
    ->setUsingCache(true)
    ->fixers([
        'short_array_syntax'
    ])
    ->finder($finder);