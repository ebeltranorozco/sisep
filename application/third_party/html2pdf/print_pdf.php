<?php
	require __DIR__.'./vendor/autoload.php';
	//use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Html2Pdf;
	$html2pdf = new Html2Pdf();
	$html2pdf->writeHTML( '<h1>prueba de algo impreso</h1>');
	$html2pdf->output();

?>

