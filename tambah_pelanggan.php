<?php
	include("config.php");
	include("include/Template.class.php");

	$header = new Template('view/template/head.html');
	$template = new Template('view/daftar_pelanggan.html');
	$footer = new Template('view/template/foot.html');

	$header->write();
	$template->write();
	$footer->write();

?>