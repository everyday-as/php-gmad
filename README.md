# PHP Garry's Mod Addon Library

PHP Garry's Mod Addon Library (php-gmad) is a PHP library for handling and manipulation of Garry's Mod addon files (.gmad).
These files provide a description of the addon and a filesystem of the addon, both can be managed using this library.

[![Latest Version](https://img.shields.io/packagist/v/gmodstore/php-gmad.svg)](https://packagist.org/packages/gmodstore/php-gmad)
[![Issues Open](https://img.shields.io/github/issues/gmodstore/php-gmad.svg)](https://github.com/gmodstore/php-gmad/issues)
[![License](https://img.shields.io/packagist/l/gmodstore/php-gmad.svg)](https://github.com/gmodstore/php-gmad/blob/master/LICENSE)

## Requirements

- PHP >=7.1 (64 bit)
- mdurrant/php-binary-reader

## Code Examples

```php
$gma_data = fopen(__DIR__ . '/gmas/test.gma', 'rb');

$reader = new AddonReader($gma_data);
$reader->parse(); // throws

$addon = $reader->getAddon();

echo $addon . PHP_EOL;
echo count($addon->getFileIndex()) . ' file(s): ' . PHP_EOL;

foreach ($addon->getFileIndex() as $file) {
    echo "\t" . $file->getFileNumber() . '. ' . $file->getPath() . ' @ ' . $file->getOffset() . ' : ' . $file->getSize() . ' bytes' . PHP_EOL;
}
```

## License

php-gmad is licensed under the [MIT License](LICENSE).

Copyright 2018 [Matt Stevens](http://handsomematt.co.uk/)