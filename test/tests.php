<?php
require '../src/PaperSize.php';
use Ycdev\PaperSize;
define('PAPERSIZE_PERSO_A', [12, 12]);
//var_dump(get_defined_constants(true)['user']);
var_dump(PaperSize::allFormats());
$im = PaperSize::gdImage(PaperSize::A4);
//var_dump(PaperSize::px(PaperSize::A4));
