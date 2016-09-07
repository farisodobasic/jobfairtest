<!doctype html>

<?php
    $url_home = 'http://www.jobfair.ba/';
	//$url_home = 'http://www.jobfair.ba/';

	$debug = true;

    if($debug) {
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);
    }

    /* 404 */
    if(!isset($_GET['id']) || is_nan($_GET['id']))
    	header('Location: '.$url_home.'404.html');

	/* Sending mail */
	if(isset($_POST['send'])){
		$ime 	= $_POST['name'];
		$email  = $_POST['email'];
		$poruka = $_POST['message'];

		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $primi = array(
                'mirza.ohranovic@gmail.com',
                'edita.milisic@gmail.com',
                'nejra.spahic@gmail.com'
            );

			$subject = '[JobFAIR] Kontakt forma';
			$eol = PHP_EOL;

			$message = '<html><body>';
			$message .= 'Od '.$ime.'<br />';
			$message .= 'Email: '.$email.'<br /><br />';
			$message .= $poruka;
			$message .= '</body></html>';

			$headers = 'From: JobFAIR.ba <noreply@jobfair.ba> ' . "\r\n" .
							'Reply-To: JobFAIR.ba <noreply@jobfair.ba>' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=\"UTF-8\"".$eol;
            $headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;

            foreach($primi as $to){
				mail($to, $subject, $message, $headers);
            }

            echo '<script>alert("Uspješno ste poslali mail!");</script>';
        }
	}

	function getData($siteRoot) {
    	$id = ctype_digit($_GET['id']) ? $_GET['id'] : 1;
    	$rawData = file_get_contents($siteRoot.'jfapi.php?stream=novost&id='.$id);
    	return json_decode($rawData);
	}

	$data = getData($url_home);
	if($data[0]->galerija == 0)
		$galerija = array();
	else
		$galerija = $data[0]->galerija_items;
?>
<html class="no-js" lang="" >
    <head>
	        <meta charset="utf-8">
	        <meta http-equiv="x-ua-compatible" content="ie=edge">
	        <title><?=htmlspecialchars($data[0]->naslov);?></title>
	        <meta name="description" content="<?=$data[0]->opis;?>">
	        <meta name="viewport" content="width=device-width, initial-scale=1">

	         	  <meta property="og:type" content="website">
				  <meta property="og:title" content="<?=$data[0]->naslov;?>" />
				  <meta property="og:description" content="<?=$data[0]->opis;?>" />
				  <meta property="og:image" content="<?=$data[0]->velika_slika;?>" />
				  <meta property="og:url" content="<?=$url_home;?>novost/<?=$_GET['id'];?>" />

	               <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	               <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	               <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.28//angular-route.min.js"></ script>-->
	        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>

	        <link rel="apple-touch-icon" href="apple-touch-icon.png">
	        <!-- Place favicon.ico in the root directory -->
	        <link rel="stylesheet" href="../css/main.css">
	        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
	        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.css">
	        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	        <link rel="shortcut icon" href="../favicon.ico?v=2">
	        <link rel="stylesheet" href="../css/normalize.css">
	        <link rel="stylesheet" href="../css/main-landing.css?v=4">
	        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>



         <!-- Add fancyBox -->
    <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

    <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-35242323-2','auto');ga('send','pageview');
        </script>


        <div id="screen">
        	<?php
            	include 'partials/menu-standalone.php';
				include 'partials/news-more.php';
				include 'partials/footer-standalone.php';
			?>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
              $(".fancybox").fancybox();
            });
        </script>

        <script src="../js/main-landing.js?v=2"></script>
        <script src="../js/plugins.js"></script>
        <script src="../js/angular/naslovna.js"></script>

        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>

    </body>
</html>
