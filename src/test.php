<?php

require "../vendor/autoload.php";

use PhpBinaryReader\BinaryReader;

function readNullString($br)
{
	$str = '';
        
	while(true)
	{
		if(!$br->canReadBytes(1))
			break;
            
		$char = $br->readInt8();

		if($char == "\0")
			break;
            
		$str = $str . chr($char);
	}
        
	return $str;
}

$gma_data = fopen(__DIR__ . '/test.gma', 'rb');
$br = new BinaryReader($gma_data);

$header = $br->readString(4);

if ($header !== "GMAD")
	return;

$file_format_version = $br->readInt8();
$steam_id = $br->readUInt64();
$time_stamp = $br->readUInt64();

if ($file_format_version > 1)
{
	$content = readNullString($br);
            
	while($content !== '')
		$content = readNullString($br);
}

$addon_name = readNullString($br);
$addon_desc = readNullString($br);
$addon_auth = readNullString($br);
$addon_type = '';
$addon_tags = '';
$addon_version = $br->readInt32();

$json = json_decode($addon_desc, true);

if ($json)
{
	$addon_desc = $json['description'];
	$addon_type = $json['type'];
	$addon_tags = $json['tags'];
}

$addon_file_index = [];
$offset = 0;
$file_number = 1;

while($br->readUInt32())
{
	$file = [
		'name' => readNullString($br),
		'size' => $br->readInt64(),
		'crc' => $br->readUInt32(),
		'offset' => $offset,
		'fileNumber' => $file_number
	];
            
	$addon_file_index[$file_number] = $file;
            
	$offset += $file['size'];
	$file_number++;
}
        
$addon_file_block = $br->getPosition();

print("FormatVersion: " . $file_format_version . PHP_EOL);
print("SteamID: " . $steam_id . PHP_EOL);
print("Timestamp: " . $time_stamp . PHP_EOL);
print("Addon Name: " . $addon_name . PHP_EOL);
print("Addon Desc: " . substr($addon_desc, 0, 100) . '...' . PHP_EOL);
print("Addon Type: " . $addon_type . PHP_EOL);
print("Addon Tags: " . join(',', $addon_tags) . PHP_EOL);
print("Addon Auth: " . $addon_auth . PHP_EOL);
print("Addon Version: " . $addon_version . PHP_EOL);

print("Addon Files: " . count($addon_file_index));

foreach($addon_file_index as $file)
{
	print($file['name'] . PHP_EOL);
}

