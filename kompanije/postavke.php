<?php
	require_once('../brains/global.php');
	//session_destroy();
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
  <body>
    <div class="sidebar">
      <?php require_once('partials/sidebar.php'); ?>
    </div>

   	<nav class="header">
      <div class="header-centar">
        <img src="<?=$url_home;?>img/jflogo.jpg"  height="56"/>
      </div>
    </nav>

    <section class="main-holder">
      <!-- Pocetak lijeve kolone -->
      <div class="left-col">
        <div class="section">
          <h1>Heading tekst</h1>
          <input type="text" class="form-input" style="width:298px;" placeholder="Forma input" />


            <br />
            <br />
          <!-- End of faukltet part -->

          <!-- godina studija part -->
          <h1>Godina studija</h1>
            <br />
          <?php for($i = 0; $i < 5; $i++){ ?>
          <label class="form-checkbox">
            <input type="checkbox" name="test"/>
            <span></span>
            <h2>Opcija</h2>
          </label>
          <?php } ?>
            <br />
          <!-- End of godina studija part -->

          <!-- End of jezici part -->
        </div>
      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">
        <div class="section">

        </div>

        <div class="section">

        </div>
      </div>
      <!-- Kraj desnpog dijela -->
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
