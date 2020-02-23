<?php

require_once __DIR__.'/vendor/autoload.php';

$factory = new Roave\BetterReflection\BetterReflection();
$stubber = Roave\BetterReflection\SourceLocator\SourceStubber\PhpStormStubsSourceStubber::fromStubsDirectory($factory->phpParser(), __DIR__.'/vendor/jetbrains/phpstorm-stubs');

try {
    $stub = $stubber->generateFunctionStub('array_filter');
} catch (Roave\BetterReflection\SourceLocator\SourceStubber\Exception\CouldNotFindPhpStormStubs $e) {
    echo 'The PHP Storm stubs directory could not be located.  This should never happen.'.PHP_EOL;

    exit(1);
}

echo $stub->getStub();
