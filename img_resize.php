<?php
/**
 The MIT License

 Copyright (c) 2007 <Tsung-Hao>

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 *
 * Usage:
 *  php img_resize.php filename.png > xxx.png
 *  php img_resize.php filenmae.jpg > xxx.jpg
 *  php img_resize.php filenmae.gif > xxx.gif
 *
 * Author: Tsung
 * URL: http://plog.longwin.com.tw/
 */
$percent = 0.5;

// get filename
$filename = "Aaptosyax_grypus_Mekong-giant-salmon-carp-specimen-close-up-of-head.jpg";
// get sub filename, ex: jpg,jpeg,png,gif
$sub_name = trim( substr($filename, -4), '.' );

if( $sub_name == 'jpg' ) { // jpg use jpeg header & function
    $sub_name='jpeg';
}

// Content type, ex: header('Content-type: image/jpeg');
header('Content-type: image/'.$sub_name);

// Get new dimensions
list($width, $height) = getimagesize($filename);
$new_width = $width * $percent;
$new_height = $height * $percent;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);

// $function_name: set function name
// imagecreatefromjpeg, imagecreatefrompng, imagecreatefromgif
$function_name = imagecreatefrom . $sub_name; 

$image = $function_name($filename); //$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
imagejpeg($image_p, null, 100);
?>