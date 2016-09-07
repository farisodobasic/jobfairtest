<?php
	require_once('../brains/global.php');
	require_once('../brains/global_student.php');
	require_once('brains/cv_data_render.php');
	//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>CV Edit | JobFAIR.ba</title>
		<meta name="description" content="JobFAIR.ba - Ostavite svoj životopis u našu bazu!">
		<meta name="viewport" content="width=device-width, initial-scale=1">

				<link rel="shortcut icon" href="<?=$url_home;?>favicon.ico?v=3">

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body>
    <div class="sidebar">
      <?php require_once('partials/sidebar.php');?>
    </div>


   	<nav class="header">
      <div class="header-centar">
        <a href="<?=$url_home;?>user"><img src="<?=$url_home;?>img/jflogo.jpg"  height="56"/></a>
      </div>
    </nav>

    <section class="main-holder">
      <!-- Pocetak lijeve kolone -->
      <div class="left-col">
          <!-- Sidebar menu -->
          <div class="section" style="padding:0;width:350px;border-bottom:0;">
            <a href="javascript:void(0);" class="m1 whole-btn kp-scroll aktivan-whole"><img style="margin-bottom:-10px;margin-right:10px;" src="<?=$url_home;?>icons/info.png" /> Osnovne informacije</a>
            <a href="javascript:void(0);" class="m2 whole-btn ri-scroll"><img style="margin-bottom:-10px;margin-right:10px;" src="<?=$url_home;?>icons/s.png" /> Radno iskustvo</a>
            <a href="javascript:void(0);" class="m3 whole-btn ed-scroll"><img style="margin-bottom:-10px;margin-right:10px;" src="<?=$url_home;?>icons/edukacija.png" /> Edukacija</a>
            <a href="javascript:void(0);" class="m4 whole-btn ded-scroll"><img style="margin-bottom:-10px;margin-right:10px;" src="<?=$url_home;?>icons/dodatna.png" /> Dodatna edukacija</a>
						<a href="javascript:void(0);" class="m5 whole-btn vj-scroll"><img style="margin-bottom:-10px;margin-right:10px;" src="<?=$url_home;?>icons/skills.png" /> Vještine</a>
            <a href="javascript:void(0);" class="m6 whole-btn spremi-scroll"><img style="margin-bottom:-10px;margin-right:10px;" src="<?=$url_home;?>icons/save.png" /> Spremi</a>

            <div style="clear:both;"></div>
          </div>

      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">
        <div class="section">
          <div class="cv-scroller">
            <div class="section-holder">
                <?php include('partials/cv/kontakt_podaci.php'); ?>
            </div>
            <div class="section-holder">
                <?php include('partials/cv/radno_iskustvo.php'); ?>
            </div>
            <div class="section-holder">
                <?php include('partials/cv/edukacija.php'); ?>
            </div>
            <div class="section-holder">
                <?php include('partials/cv/dodatna_edukacija.php'); ?>
            </div>
            <div class="section-holder">
								<?php include('partials/cv/vjestine.php'); ?>
            </div>
						<div class="section-holder">
								<?php include('partials/cv/spremi.php'); ?>
            </div>
          </div>
        </div>


      </div>
      <!-- Kraj desnpog dijela -->
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
