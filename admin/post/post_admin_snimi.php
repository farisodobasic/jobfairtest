<?php
	
	/* Dodavanje novog administratora */
	if(isset($_POST['snimi_administrator']) && !isset($_GET['admin'])){
		$email 			= $_POST['a_mail'];
		$password 		= $_POST['a_password'];
		$privilegije	= $_POST['a_privilegije'];

		$admin->admin_add($email, $password, $privilegije);
	}

	/* Editovanje već postojećeg administratora */
	if(isset($_GET['admin'])){
		$editovan_admin = new Admin;
		$editovan_admin->id = (int)$_GET['admin'];
		$editovan_admin->user_info();

		if(isset($_POST['snimi_administrator'])){
			$email 			= $_POST['a_mail'];
			$password 		= $_POST['a_password'];
			$privilegije	= $_POST['a_privilegije'];
			
			if(strlen($password) == 0)
				$editovan_admin->admin_update($email, $privilegije);
			else
				$editovan_admin->admin_update($email, $privilegije, $password);
			
		}
	}
?>