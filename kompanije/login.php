<?php
	require_once('../brains/global.php');
	require_once('../brains/global_kompanije.php');
	//session_destroy();
	if(isset($_POST['login'])){

		$username 	= $db->escape_string($_POST['username']);
		$password 	= $db->escape_string($_POST['password']);
		$korisnik->login($username, $password);
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pretraga</title>

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body id="login-bg">
		<div class="login">
			<center>
				<div id="login-logo"><img src="<?=$url_home;?>img/logo/logo.png" alt="logo"></div>
			</center>
			<br />
			<form action="" method="post">
				E-mail:<br /><br />
				<input type="text" name="username" class="in input-login-u" size="35"> <br> <br>
				Password:<br /><br />
				<input type="password" name="password" class="in input-login-p" size="35"> <br> <br>
				<div class="sub-login">
					<button type="submit" name="login" class="login-btn">Prijava</button>


				</div>
			</form>
			<div style="clear:both;"></div>
				<br />
			Ukoliko ste zaboravili pristupne podatke, molimo Vas da kontaktirate it[at]eestec-sa.ba
		</div>
	</body>
</html>
