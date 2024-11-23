<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$data = explode("-", $_GET['c']);
$type = $data[0];
$skins = $data[2];
$mouths = $data[3];
$noses = $data[5];
$eyes = $data[7];
$hairs = $data[9];
$extrasch = $data[11];
$skinc = $data[1];
$eyec = $data[8];
$hairc = $data[10];
$extrasco = $data[12];

$avatarPrefix = $type == 'classic' ? 'avatar_0' : 'avatar_0.1';
$avatarFiles = [
    'skins' => "{$avatarPrefix}1_96.png",
    'mouths' => "{$avatarPrefix}2_96.png",
    'noses' => "{$avatarPrefix}3_96.png",
    'eyes' => "{$avatarPrefix}4_96.png",
    'hairs' => "{$avatarPrefix}5_96.png",
    'extras' => "{$avatarPrefix}6_96.png",
    'default' => "{$avatarPrefix}7_96.png"
];

$width = 96;
$height = 96;

$allParts = [];

foreach ($avatarFiles as $part => $file) {
    $image = imagecreatefrompng($file);
    $source_width = imagesx($image);
    $source_height = imagesy($image);

    for ($col = 0; $col < $source_width / $width; $col++) {
        for ($row = 0; $row < $source_height / $height; $row++) {
            $allParts[$part][$col][$row] = imagecreatetruecolor($width, $height);
            imagesavealpha($allParts[$part][$col][$row], true);
            $color = imagecolorallocatealpha($allParts[$part][$col][$row], 0, 0, 0, 127);
            imagefill($allParts[$part][$col][$row], 0, 0, $color);
            imagecopyresized(
                $allParts[$part][$col][$row],
                $image,
                0,
                0,
                $col * $width,
                $row * $height,
                $width,
                $height,
                $width,
                $height
            );
        }
    }
}

$avatarParts = ['default', 'mouths', 'noses', 'eyes', 'hairs', 'extras'];
$avatarIndices = [0, $mouths, $noses, $eyes, $hairs, $extrasch];
$avatarColors = [0, 0, 0, $eyec, $hairc, $extrasco];

for ($i = 0; $i < count($avatarParts); $i++) {
    imagecopy($allParts['skins'][$skinc][$skins], $allParts[$avatarParts[$i]][$avatarIndices[$i]][$avatarColors[$i]], 0, 0, 0, 0, 96, 96);
}

$finalimage = imagepng($allParts['skins'][$skinc][$skins], 'a/' . $_SESSION["username"] . '.png');