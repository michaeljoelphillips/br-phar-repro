<?php

require_once __DIR__.'/vendor/autoload.php';

$factory = new Roave\BetterReflection\BetterReflection();
$stubber = new Roave\BetterReflection\SourceLocator\SourceStubber\PhpStormStubsSourceStubber($factory->phpParser());

try {
    $stub = $stubber->generateFunctionStub('array_filter');
} catch (Roave\BetterReflection\SourceLocator\SourceStubber\Exception\CouldNotFindPhpStormStubs $e) {
    echo 'The PHP Storm stubs directory could not be located.  This should never happen.'.PHP_EOL;

    exit(1);
}

echo $stub->getStub();
