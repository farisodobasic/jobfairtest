<?php
	require_once('../brains/global.php');
	require_once('../brains/global_student.php');
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
    <title>CV Login | JobFAIR.ba</title>
		<meta name="description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu!">
		<meta name="viewport" content="width=device-width, initial-scale=1">

				<meta property="og:type" content="website">
				<meta property="og:title" content="CV Login | JobFAIR.ba" />
				<meta property="og:description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu" />
				<meta property="og:image" content="http://www.jobfair.ba/media/naslovna/jfmedia.v_35.jpg" />
				<meta property="og:url" content="<?=$url_home;?>user" />
				<link rel="shortcut icon" href="<?=$url_home;?>favicon.ico?v=3">

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
					<a href="<?=$url_home;?>user/reset.php" class="login-btn">Zaboravljena šifra</a>

				</div>
			</form>
			<div style="clear:both;"></div>
			<br />
			Ukoliko još uvijek niste ostavili Vaš CV, registrujte se <a href="<?=$url_home;?>user/register.php">ovdje.</a>
		</div>
	</body>
</html>
