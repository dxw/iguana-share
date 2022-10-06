<?php
$config = \PhpCsFixer\Config::create()
->setFinder(
    PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('_vendor')
    ->in(__DIR__)
);
return $config;
