<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['src', 'tests']);

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@PSR2' => true,
        'array_syntax' => array('syntax' => 'short'),
    ))
    ->setFinder($finder);