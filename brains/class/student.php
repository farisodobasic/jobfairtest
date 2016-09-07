<?php
	class Student {
		public $id = null;
		public $privilegije = null;
		public $username = null;

		public function login($user, $password){
			global $db;
			global $url_home;
			
			$user = $db->escape_string($user);
			$password = md5($password);

			$check = $db->query("SELECT COUNT(id) as num, id as id FROM jf_cv WHERE email = '{$user}' AND password = '{$password}'")->fetch_assoc() or die(mysqli_error($db));

			if($check['num'] == 1){
				$_SESSION['id_korisnika'] 	= $check['id'];
				$this->id 					= $check['id'];
				header('Location: '.$url_home.'user');
			}else{
				header('Location: '.$url_home.'user/login.php');
			}
		}

		public function register($user, $password){
			global $db;
			global $url_home;

			$user = $db->escape_string($user);
			$password = md5($password);

			$check = $db->query("SELECT COUNT(id) as num, id as id FROM jf_cv WHERE email = '{$user}'")->fetch_assoc() or die(mysqli_error($db));
			if($check['num'] > 0){
				return false;
			}else{
				$db->query("INSERT INTO jf_cv (id, email, password) VALUES ('null', '{$user}', '{$password}')");
				return true;
			}
		}

		public function logout(){
			global $url_home;

			if(isset($_SESSION['id_korisnika'])) session_destroy();
			header('Location: '.$url_home.'user');
		}


	}
?>
