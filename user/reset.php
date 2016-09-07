<?php
	//$url_home = 'http://www.jobfair.ba/';
  require_once('../brains/global.php');
	/* Sending mail */
	if(isset($_POST['reset'])){
    $pass = md5(time() + "koka");
    $pass = substr($pass, 8);

    $to = $db->escape_string($_POST['username']);

    $md5  = md5($pass);

    $postoji = $db->query("SELECT id FROM jf_cv WHERE email = '{$to}'")->num_rows;
    if($postoji == 0){
      echo '<div class="error-msg">Korisnik ne postoji!</div>';
    }else{

        $db->query("UPDATE jf_cv SET password = '{$md5}' WHERE email = '{$to}'");

    		if(filter_var($to, FILTER_VALIDATE_EMAIL)) {

    			$subject = '[JobFAIR] Novi password';
    			$eol = PHP_EOL;


    			$message = '<html><body>';
    			$message .= 'Email: '.$to.'<br /><br />';
    			$message .= 'Novi password: <b>'.$pass."</b>";
    			$message .= '</body></html>';

    			$headers = 'From: JobFAIR.ba <noreply@jobfair.ba> ' . "\r\n" .
    							'Reply-To: JobFAIR.ba <noreply@jobfair.ba>' . "\r\n" .
    							'X-Mailer: PHP/' . phpversion();
    			$headers .= "MIME-Version: 1.0\r\n";
    			$headers .= "Content-Type: text/html; charset=\"UTF-8\"".$eol;
                $headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;


    				mail($to, $subject, $message, $headers);


                echo '<script>alert("Uspješno ste resetovali šifru!");</script>';
                header('Location: '.$url_home."user/login.php");
            }
      }
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CV Reset Password | JobFAIR.ba</title>
		<meta name="description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu!">
		<meta name="viewport" content="width=device-width, initial-scale=1">

				<meta property="og:type" content="website">
				<meta property="og:title" content="CV Reset Password | JobFAIR.ba" />
				<meta property="og:description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu" />
				<meta property="og:image" content="http://www.jobfair.ba/media/naslovna/jfmedia.v_35.jpg" />
				<meta property="og:url" content="<?=$url_home;?>user/reset.php" />
				<link rel="shortcut icon" href="<?=$url_home;?>favicon.ico?v=3">

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body id="login-bg">
		<div class="login">
      <center>
				<div id="login-logo"><img src="<?=$url_home;?>img/logo/logo.png" alt="logo"></div>
			</center>
			<form action="" method="post">
        E-mail:<br /><br />
        <input type="text" name="username" class="in input-login-u" size="35"> <br> <br>
				<div class="sub-login">
					<button type="submit" name="reset" class="login-btn">Reset password</button>
				</div>
			</form>
		</div>
	</body>
</html>
