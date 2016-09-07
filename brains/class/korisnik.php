<?php
	class Korisnik {
		public $id = null;
		public $privilegije = null;
		public $username = null;

		public function login($user, $password){
			global $db;
			global $url_home;

			$password = md5($password);

			$check = $db->query("SELECT COUNT(id) as num, id as id FROM jf_kompanije WHERE mail = '{$user}' AND password = '{$password}'")->fetch_assoc() or die(mysqli_error());

			if($check['num'] == 1){
				$_SESSION['id_kompanije'] 	= $check['id'];
				$this->id 					= $check['id'];
				header('Location: '.$url_home.'kompanije');
			}else{
				header('Location: '.$url_home.'kompanije/login.php');
			}
		}

		public function logout(){
			global $url_home;

			if(isset($_SESSION['id_kompanije'])) session_destroy();
			header('Location: '.$url_home.'kompanije');
		}

		public function korisnik_add($username, $password, $privilegije){
			global $db;

			$username		= $db->escape_string($username);
			$password 		= md5($db->escape_string($password));
			$privilegije 	= (int)$privilegije;

			$db->query("INSERT INTO jf_korisnici (id, username, password, privilegija) VALUES ('null', '{$username}', '{$password}', {$privilegije})");
		}

		public function admin_update($email, $privilegije, $password = 0){
			global $db;

			$email 			= $db->escape_string($email);
			$privilegije 	= (int)$privilegije;

			if($password != 0){
				$password = md5($db->escape_string($password));
				$db->query("UPDATE jf_admin SET email = '{$email}' AND password = '{$password}' AND privilegija = {$privilegije} WHERE id = {$this->id}");
				$db->error;
			}else{
				$db->query("UPDATE jf_admin SET email = '{$email}' AND privilegija = {$privilegije} WHERE id = {$this->id}");
				$db->error;
			}
		}


	}
?>
