<?php
  require_once('../brains/global.php');
	require_once('../brains/global_student.php');
	//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CV | JobFAIR.ba</title>
		<meta name="description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu!">
		<meta name="viewport" content="width=device-width, initial-scale=1">

				<meta property="og:type" content="website">
				<meta property="og:title" content="CV | JobFAIR.ba" />
				<meta property="og:description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu" />
				<meta property="og:image" content="http://www.jobfair.ba/media/naslovna/jfmedia.v_35.jpg" />
				<meta property="og:url" content="<?=$url_home;?>user" />
				<link rel="shortcut icon" href="<?=$url_home;?>favicon.ico?v=3">

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body>
    <div class="sidebar">
      <?php require_once('partials/sidebar.php'); ?>

    </div>


   	<nav class="header">
      <div class="header-centar">
        <a href="<?=$url_home;?>user"><img src="<?=$url_home;?>img/jflogo.jpg"  height="56"/></a>
      </div>
    </nav>

    <section class="main-holder">
      <!-- Pocetak lijeve kolone -->
      <div class="left-col">
        <div class="section" style="padding:0;width:350px;">
          <a href="<?=$url_home;?>user/cv.php" class="azuriraj">
            <div class="edit-icon" style="margin-bottom:-25px;"></div>
            Ažuriraj CV
          </a>
        </div>
        <div class="section" style="padding:0;width:350px;">
          <a href="<?=$url_home;?>user/moj-cv.php" class="azuriraj">
            <div class="overview-icon" style="margin-bottom:-25px;"></div>
            Moj CV
          </a>
        </div>
        <!--<div class="section">
          <div class="profile-img-holder">
          <?php
            if($cv->get_profilna() == 0){
              if($cv->get_spol() == 1) echo '<img style="width:120px;opacity:0.6;" src="'.$url_home.'kompanije/img/musko.png" />';
                else if($cv->get_spol() == 2) echo '<img style="width:120px;opacity:0.6;" src="'.$url_home.'kompanije/img/zensko.png" />';
            }else{
              echo '<img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xtf1/v/t1.0-9/11828697_10207716111890840_6605429353789010748_n.jpg?oh=c8a5efec44e1bb9620beba871121284a&oe=563DE542" />';
            }
          ?>
          </div>
        </div>-->
      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">
        <div class="section">
          <?php
            $json = file_get_contents('http://www.jobfair.ba/jfapi.php?stream=naslovna&strana=1');
            $obj = json_decode($json);
            foreach($obj as $item){
              /* HTML rendering */
              ?>
              <div class="novost">
                  <div class="img-holder">
                    <img src="<?=$item->naslovna_slika;?>" />
                  </div>
                  <div class="info">
                    <h1><?=$item->naslov;?></h1>
                    <span>
                      <?=$item->opis;?>
                    </span>
                      <br />
                    <a href="<?=$url_home;?>novost/<?=$item->id;?>">Pročitaj više</a>
                  </div>
              </div>
              <?php
            }
          ?>
        </div>

      </div>
      <!-- Kraj desnpog dijela -->
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
