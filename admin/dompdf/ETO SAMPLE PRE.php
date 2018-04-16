<?php
require "autoload.inc.php";
use Dompdf\Dompdf;
$KenBoyTae = new Dompdf();

$KenBoyTae->loadHtml("ETO SAMPLE PRE OKAY NA BA?");
$KenBoyTae->setPaper("A4","portrait");
$KenBoyTae->render();
$KenBoyTae->stream("ETO SAMPLE PRE",array("Attachment"=>0))


?>