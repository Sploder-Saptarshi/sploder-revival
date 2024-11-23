<?php
//header ('Content-Type: image/png'); 
//ini_set('display_errors', '1');ini_set('display_startup_errors', '1');error_reporting(E_ALL);
$data = explode("-", $_POST['ac']);
print_r($data);
$type = $_GET['type'];
$skins = $_GET['skins'];
$mouths = $_GET['mouths'];
$noses = $_GET['noses'];
$eyes = $_GET['eyes'];
$hairs = $_GET['hairs'];
$extrasch = $_GET['extrasch'];
$skinc = $_GET['skinc'];
$eyec = $_GET['eyec'];
$hairc = $_GET['hairc'];
$extrasco = $_GET['extrasco'];
if ($type == 'classic') {
    $avt1 = 'avatar_01_96.png';
    $avt2 = 'avatar_02_96.png';
    $avt3 = 'avatar_03_96.png';
    $avt4 = 'avatar_04_96.png';
    $avt5 = 'avatar_05_96.png';
    $avt6 = 'avatar_06_96.png';
    $avt7 = 'avatar_07_96.png';
} else {
    $avt1 = 'avatar_01_96.png.1';
    $avt2 = 'avatar_02_96.png.1';
    $avt3 = 'avatar_03_96.png.1';
    $avt4 = 'avatar_04_96.png.1';
    $avt5 = 'avatar_05_96.png.1';
    $avt6 = 'avatar_06_96.png.1';
    $avt7 = 'avatar_07_96.png.1';
}
$im1 = imagecreatefrompng($avt1);
$width = 96;
$height = 96;
$source_width = imagesx($im1);
$source_height = imagesy($im1);

for ($col = 0; $col < $source_width / $width; $col++) {
    for ($row = 0; $row < $source_height / $height; $row++) {


        $allskins[$col][$row] = @imagecreatetruecolor($width, $height);
        imagesavealpha($allskins[$col][$row], true);
        $color = imagecolorallocatealpha($allskins[$col][$row], 0, 0, 0, 127);
        imagefill($allskins[$col][$row], 0, 0, $color);
        imagecopyresized(
            $allskins[$col][$row],
            $im1,
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
//echo(imagepng($allskins[$skinc][$skins]));
$im2 = imagecreatefrompng($avt2);
$source_width = imagesx($im2);
$source_height = imagesy($im2);

for ($col = 0; $col < $source_width / $width; $col++) {
    for ($row = 0; $row < $source_height / $height; $row++) {


        $allmouths[$col][$row] = @imagecreatetruecolor($width, $height);

        imagesavealpha($allmouths[$col][$row], true);
        $color = imagecolorallocatealpha($allmouths[$col][$row], 0, 0, 0, 127);
        imagefill($allmouths[$col][$row], 0, 0, $color);
        imagecopyresized(
            $allmouths[$col][$row],
            $im2,
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

$im3 = imagecreatefrompng($avt3);
$source_width = imagesx($im3);
$source_height = imagesy($im3);

for ($col = 0; $col < $source_width / $width; $col++) {
    for ($row = 0; $row < $source_height / $height; $row++) {


        $allnoses[$col][$row] = @imagecreatetruecolor($width, $height);

        imagesavealpha($allnoses[$col][$row], true);
        $color = imagecolorallocatealpha($allmouths[$col][$row], 0, 0, 0, 127);
        imagefill($allnoses[$col][$row], 0, 0, $color);
        imagecopyresized(
            $allnoses[$col][$row],
            $im3,
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

$im4 = imagecreatefrompng($avt4);
$source_width = imagesx($im4);
$source_height = imagesy($im4);

for ($col = 0; $col < $source_width / $width; $col++) {
    for ($row = 0; $row < $source_height / $height; $row++) {


        $alleyes[$col][$row] = @imagecreatetruecolor($width, $height);

        imagesavealpha($alleyes[$col][$row], true);
        $color = imagecolorallocatealpha($alleyes[$col][$row], 0, 0, 0, 127);
        imagefill($alleyes[$col][$row], 0, 0, $color);
        imagecopyresized(
            $alleyes[$col][$row],
            $im4,
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

$im5 = imagecreatefrompng($avt5);
$source_width = imagesx($im5);
$source_height = imagesy($im5);

for ($col = 0; $col < $source_width / $width; $col++) {
    for ($row = 0; $row < $source_height / $height; $row++) {


        $allhairs[$col][$row] = @imagecreatetruecolor($width, $height);

        imagesavealpha($allhairs[$col][$row], true);
        $color = imagecolorallocatealpha($allhairs[$col][$row], 0, 0, 0, 127);
        imagefill($allhairs[$col][$row], 0, 0, $color);
        imagecopyresized(
            $allhairs[$col][$row],
            $im5,
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

$im6 = imagecreatefrompng($avt6);
$source_width = imagesx($im6);
$source_height = imagesy($im6);

for ($col = 0; $col < $source_width / $width; $col++) {
    for ($row = 0; $row < $source_height / $height; $row++) {


        $allextras[$col][$row] = @imagecreatetruecolor($width, $height);

        imagesavealpha($allextras[$col][$row], true);
        $color = imagecolorallocatealpha($allextras[$col][$row], 0, 0, 0, 127);
        imagefill($allextras[$col][$row], 0, 0, $color);
        imagecopyresized(
            $allextras[$col][$row],
            $im6,
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
//print_r(imagepng($allmouths[$mouths][0]));
imagecopy($allskins[$skinc][$skins], $allmouths[$mouths][0], 0, 0, 0, 0, 96, 96);
imagecopy($allskins[$skinc][$skins], $allnoses[$noses][0], 0, 0, 0, 0, 96, 96);
imagecopy($allskins[$skinc][$skins], $alleyes[$eyec][$eyes], 0, 0, 0, 0, 96, 96);
imagecopy($allskins[$skinc][$skins], $allhairs[$hairc][$hairs], 0, 0, 0, 0, 96, 96);
imagecopy($allskins[$skinc][$skins], $allextras[$extrasch][$extrasco], 0, 0, 0, 0, 96, 96);

imagepng($allskins[$skinc][$skins]);