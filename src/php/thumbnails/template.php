<?php
$s = $_GET['s'];
//generic puppeteer stuff
require_once('../../vendor/autoload.php');

use Nesk\Puphpeteer\Puppeteer;

$puppeteer = new Puppeteer;
$browser = $puppeteer->launch();

$page = $browser->newPage();
$page->goto('http://localhost/php/thumbnails/generator.php?s=' . filter_var($s, FILTER_SANITIZE_NUMBER_INT));
//making sure ruffle gets loaded
sleep(20);
$page->screenshot(['path' => 'images/' . filter_var($s, FILTER_SANITIZE_NUMBER_INT) . '.png']);

$browser->close();

// Input and output file paths
$inputImagePath = 'images/' . filter_var($s, FILTER_SANITIZE_NUMBER_INT) . '.png';
$outputImagePath = 'images/' . filter_var($s, FILTER_SANITIZE_NUMBER_INT) . '.png'; // Different file name for the cropped and resized image

// Load the image
$image = imagecreatefrompng($inputImagePath);

// Get the image dimensions
$width = imagesx($image);
$height = imagesy($image);

// Define the amounts to crop from each side
$topCrop = 30;
$bottomCrop = 150;
$rightCrop = 270;
$leftCrop = 110;

// Calculate the new dimensions after cropping
$newWidth = $width - $leftCrop - $rightCrop;
$newHeight = $height - $topCrop - $bottomCrop;

// Create a new image with the cropped dimensions
$newImage = imagecreatetruecolor($newWidth, $newHeight);

// Copy the relevant part of the original image to the new image
imagecopy($newImage, $image, 0, 0, $leftCrop, $topCrop, $newWidth, $newHeight);

// Define the target dimensions for resizing
$targetWidth = 80;
$targetHeight = 80;

// Calculate the new dimensions while maintaining the aspect ratio
$newDimensions = calculateAspectRatioFit($newWidth, $newHeight, $targetWidth, $targetHeight);

// Create a new image with the resized dimensions
$resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);

// Resize the cropped image
imagecopyresampled($resizedImage, $newImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $newWidth, $newHeight);

// Save the cropped and resized image with a different file name
imagepng($resizedImage, $outputImagePath);

// Free up memory
imagedestroy($image);
imagedestroy($newImage);
imagedestroy($resizedImage);

/**
 * Calculate new dimensions to fit an image within a bounding box while maintaining aspect ratio.
 *
 * @param int $srcWidth
 * @param int $srcHeight
 * @param int $maxWidth
 * @param int $maxHeight
 * @return array ['width' => int, 'height' => int]
 */
function calculateAspectRatioFit($srcWidth, $srcHeight, $maxWidth, $maxHeight)
{
    $ratio = min($maxWidth / $srcWidth, $maxHeight / $srcHeight);

    return [
        'width' => $srcWidth * $ratio,
        'height' => $srcHeight * $ratio,
    ];
}