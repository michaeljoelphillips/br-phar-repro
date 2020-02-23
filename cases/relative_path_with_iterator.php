#!/usr/bin/env php
<?php

define('ROOT_PATH', __DIR__.'/..');
define('EXECUTABLE', 'relative_path.php');
define('VENDOR_PATH', __DIR__.'/../vendor');
define('BUILD_PATH', __DIR__.'/../build/relative_path_with_iterator.phar');

if (file_exists(BUILD_PATH)) {
    unlink(BUILD_PATH);
}

$builder = new Phar(BUILD_PATH);

$builder->buildFromIterator(
    new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(VENDOR_PATH)
    ),
    ROOT_PATH
);

$builder->addFile(EXECUTABLE);
$builder->setStub($builder->createDefaultStub(EXECUTABLE));
