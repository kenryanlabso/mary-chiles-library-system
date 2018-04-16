<?php

require_once('class/BCGFontFile.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');

require_once('class/BCGcode128.barcode.php');

// The arguments are R, G, and B for color.
$colorFront = new BCGColor(0, 0, 0);
$colorBack = new BCGColor(255, 255, 255);

$code = new BCGDrawing(); // Or another class name from the manual
$code->setScale(2); // Resolution
$code->setThickness(30); // Thickness
$code->setForegroundColor($color_black); // Color of bars
$code->setBackgroundColor($color_white); // Color of spaces
$code->setFont($font); // Font (or 0)
$code->parse('HELLO'); // Text

$drawing = new BCGDrawing('', $colorfg);
$drawing->setBarcode($code);
$drawing->draw();

header('Content-Type: image/png');

$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

?>