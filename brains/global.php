<?php
	/* Global PHP file */
	include ('config.php');
	include ('functions.php');

	ob_start();
	/* Klase */
	$db 	= new mysqli($db_host, $db_user, $db_pass, $db_name);
	$db->set_charset("utf8");

	

	/* Class callers */
	include ('class/cv.php');

	/* Global vars */
	$current = basename($_SERVER['PHP_SELF']);

	/* Godine studija */
	$godine_studija = array(
		"",
		"I godina studija (BSC)",
		"II godina studija (BSC)",
		"III godina studija (BSC)",
		"IV godina studija (BSC)",
		"I godina studija (IV) (MSC)",
		"I godina studija (V) (MSC)",
		"II godina studija (V) (MSC)",
		"Završen studiji"
	);
?>
