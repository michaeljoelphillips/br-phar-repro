#!/usr/bin/env php
<?php

define('ROOT_PATH', __DIR__.'/..');
define('EXECUTABLE', 'relative_path.php');
define('VENDOR_PATH', dirname(__DIR__).'/vendor');
define('BUILD_PATH', __DIR__.'/../build/relative_path_with_directory.phar');

if (file_exists(BUILD_PATH)) {
    unlink(BUILD_PATH);
}

$builder = new Phar(BUILD_PATH);

$builder->buildFromDirectory(ROOT_PATH);

$builder->addFile(EXECUTABLE);
$builder->setStub($builder->createDefaultStub(EXECUTABLE));
