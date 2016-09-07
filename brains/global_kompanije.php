<?php
	// Check if admin logged
	check_if_korisnik_logged();

	// Klase
	include ('class/korisnik.php');

	/* Class callers */
	$korisnik = new Korisnik;
?>
