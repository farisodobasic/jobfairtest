<?php
	// Check if admin logged
	check_if_admin_logged();

	// Klase
	include ('../admin/class/admin.php');
	include ('../admin/class/novost.php');
	include ('../admin/class/kompanija.php');

	/* Class callers */
	$admin = new Admin;
?>