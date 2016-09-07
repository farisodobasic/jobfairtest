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
    <title>Pretraga</title>

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body>
    <div class="sidebar">
      <div class="profile-image">
        <div class="img-holder">
          <img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xtf1/v/t1.0-9/11828697_10207716111890840_6605429353789010748_n.jpg?oh=c8a5efec44e1bb9620beba871121284a&oe=563DE542" />
        </div>
      </div>
      <a href="#" class="sidebar-element">  <i class="icon home-icon"></i> <p class="hidden-info">Home</p>  <div style="clear:both;"></div></a>
      <a href="#" class="sidebar-element">  <i class="icon favourite-icon"></i> <p class="hidden-info">Favoriti</p> <div style="clear:both;"></div></a>
      <a href="#" class="sidebar-element">  <i class="icon plus-icon"></i> <p class="hidden-info">Dodaj oglas</p> <div style="clear:both;"></div></a>
      <a href="#" class="sidebar-element">  <i class="icon settings-icon"></i> <p class="hidden-info">Postavke</p> <div style="clear:both;"></div> </a>

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
