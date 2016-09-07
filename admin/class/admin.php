<?php
	class Admin {
		public $id = null;
		public $ime = null;
		public $prezime = null;
		public $privilegije = null;
		public $mail = null;

		public function login($email, $password){
			global $db;
			global $url_home;

			$password = md5($password);

			$check = $db->query("SELECT COUNT(id) as num, id as id, privilegija as privilegija FROM jf_admin WHERE email = '{$email}' AND password = '{$password}'")->fetch_assoc() or die(mysqli_error());

			if($check['num'] == 1){
				$_SESSION['admin'] = $check['id'];
				$this->privilegije = $check['privilegija'];
				header('Location: '.$url_home.'admin');
				ob_flush();
			}
		} 

		public function logout(){
			global $url_home;
			
			if(isset($_SESSION['admin'])) session_destroy(); 
			header('Location: '.$url_home.'admin');	
			ob_flush();
		} 

		public function user_info(){
			global $db;

			if($this->id != null){
				$uzmi = $db->query("SELECT * FROM jf_admin WHERE id = {$this->id}")->fetch_assoc();
				$this->mail 		= $uzmi['email'];
				$this->privilegije 	= $uzmi['privilegija'];
			}
		} 
 
		public function user_list(){
			global $db;

			if(isset($_SESSION['admin'])){
				$users = $db->query("SELECT * FROM jf_admin");
				return $users;	
			}
		} 

		public function admin_add($email, $password, $privilegije){
			global $db;

			$email 			= $db->escape_string($email);
			$password 		= md5($db->escape_string($password));
			$privilegije 	= (int)$privilegije;

			$db->query("INSERT INTO jf_admin (id, email, password, privilegija) VALUES ('null', '{$email}', '{$password}', {$privilegije})");
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
