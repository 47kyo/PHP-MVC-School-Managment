<?php
// Create GD Image
$img = imagecreatetruecolor(400, 350);

// Assign some
$black = imagecolorallocate($img, 0, 0, 0);
$white = imagecolorallocate($img, 255, 255, 255);
$red = imagecolorallocate($img, 255, 153, 153);

// Set background colour to white
imagefill($img, 0, 0, $white);

// Cats: 6
imagefilledrectangle($img, 40, 320, 90, 320-(6*35), $red);
imagerectangle($img, 40, 320, 90, 320-(6*35), $black);



// Draw x-axis
imageline($img, 20, 320, 320, 320, $black);

// Draw y-axis
imageline($img, 20, 320, 20, 320-(8*35)-20, $black);

// Define output header
header('Content-Type: image/png');

// Output the png image
imagepng($img);


?>
