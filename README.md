# br-phar-repro

This repository reproduces an issue with locating the stubs directory in the
`PHPStormStubsSourceStubber` in the [Better Reflection](https://github.com/Roave/BetterReflection)
PHP library when packaged in a PHP Archive.

The problem occurs when BR tries to reflect on an identifier that requires a
stub from the `PHPStormStubsSourceStubber`.  In a PHAR that was built from an
iterator, the stubber is unable to locate the stubs directory and throws a
`CouldNotFindPhpStormStubs` exception.  `is_dir` is the function that causes
the change in behavior, as seen on [this line](https://github.com/Roave/BetterReflection/blob/3.5.0/src/SourceLocator/SourceStubber/PhpStormStubsSourceStubber.php#L296).

# Getting Started
There are three cases included in this repo:
* relative_path_with_directory (Successful case)
  * Phar is built with a directory
  * Uses relative paths to the stubs directory (default)
* relative_path_with_iterator (Failure case)
  * Phar is built with an iterator
  * Uses relative paths to the stubs directory (default)
* absolute_path_with_iterator (Failure case)
  * Phar is built with an iterator
  * Uses absolute paths to the stubs directory (new as of [#541](https://github.com/Roave/BetterReflection/pull/541/files))
```
composer install
php -d phar.readonly=0 cases/relative_path_with_directory.php
php -d phar.readonly=0 cases/absolute_path_with_iterator.php
php -d phar.readonly=0 cases/relative_path_with_iterator.php
php build/absolute_path_with_iterator.phar
php build/relative_path_with_iterator.phar
php build/relative_path_with_directory.phar
```
