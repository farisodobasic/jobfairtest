<?php
	require_once('../brains/global.php');
	require_once('../brains/global_admin.php');


	if(isset($_POST['login'])){
		$mail 		= $db->escape_string($_POST['mail']);
		$password 	= $db->escape_string($_POST['password']);

 		$admin->login($mail, $password);
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>JF Admin panel</title>

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body>
  	<div style="width:400px;height:200px;margin:0 auto;margin-top:200px;">
  		<form action="" method="post">
		  	<div class="form-group">
			  <label for="mail">E-mail:</label>
			  <input type="text" class="form-control col-md-12 l_mail" name="mail" placeholder="E-mail">
			</div>
			<div class="form-group">
			  <label for="password">Password:</label>
			  <input type="password" class="form-control col-md-12 l_password" name="password" placeholder="Password">
			</div>
				<br />
			<div class="form-group" style="margin-top:10px;">
				<input type="submit" name="login" value="Log in" id="log_in" class="btn btn-primary col-md-4" />
			</div>
		</form>
	</div>
  </body>
</html>
