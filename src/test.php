<?php

require "../vendor/autoload.php";

use HandsomeMatt\GMad\AddonReader;

$gma_data = fopen(__DIR__ . '/test.gma', 'rb');

$reader = new AddonReader($gma_data);
$reader->parse();
$addon = $reader->getAddon();

echo $addon->getName() . ' by: ' . $addon->getAuthor() . PHP_EOL;
echo count($addon->getFileIndex()) . ' file(s): ' . PHP_EOL;

foreach($addon->getFileIndex() as $file)
{
    echo "\t" . $file->getFileNumber() . '. ' . $file->getPath() . ' @ ' . $file->getOffset() . ' : ' . $file->getSize() . ' bytes' . PHP_EOL;
}