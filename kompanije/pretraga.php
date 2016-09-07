<?php
	require_once('../brains/global.php');
  require_once('../brains/global_kompanije.php');
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

        <div style="float:right;">

          <div class="paginacija" style="float:right;">

          </div>
          <div class="rang-po-score" style="float:right;opacity:0.5;">
            <a href="javascript:soritraj_score_toggle();"><img height="32" style="margin:14px;" src="<?=$url_home;?>icons/score.png" /></a>
          </div>
        </div>
      </div>
    </nav>

    <section class="main-holder">
      <!-- Pocetak lijeve kolone -->
      <div class="left-col">
        <div class="section">
          <h1>Vještine</h1>
          <input type="text" class="form-input predict-vjestina" style="width:298px;" placeholder="Unesite vještinu..." />
          <div class="predict-list predict-vjestina-list"></div>
          <div class="selected-list selected-vjestina-list">


            <div style="clear:both;"></div>
          </div>
        </div>

        <div class="section">
          <!-- Fakultet part -->
          <h1>Fakultet</h1>
          <input type="text" class="form-input predict-fakultet" style="width:298px;" placeholder="Unesite naziv fakulteta..." />
          <div class="predict-list predict-fakultet-list"></div>
          <div class="selected-list selected-fakultet-list">


            <div style="clear:both;"></div>
          </div>
            <br />
            <br />
          <!-- End of faukltet part -->

          <!-- godina studija part -->
          <h1>Godina studija</h1>
            <br />
          <label class="form-checkbox">
            <input type="checkbox" name="god_studija" class="filter-item god_studija ukini-god-studija" value="ukini-god-studija" checked/>
            <span></span>
            <h2>Nije relevantno</h2>
          </label>
          <?php
            $rimski = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII");
            for($i = 1; $i < 6; $i++){
          ?>
          <label class="form-checkbox">
            <input type="checkbox" name="god_studija" class="filter-item god_studija" value="<?=$i;?>"/>
            <span></span>
            <h2><?=$rimski[$i];?> godina studija</h2>
          </label>
          <?php } ?>
            <br />
          <!-- End of godina studija part -->
        </div>

        <div class="section">
            <!-- Spol part -->
            <h1>Spol</h1>
              <br />
              <label class="form-checkbox">
                <input type="checkbox" name="spol-filter" class="filter-item spol-filter" value="0" checked/>
                <span></span>
                <h2>Nije relevantno</h2>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="spol-filter" class="filter-item spol-filter" value="1"/>
                <span></span>
                <h2>Muško</h2>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="spol-filter" class="filter-item spol-filter" value="2"/>
                <span></span>
                <h2>Žensko</h2>
              </label>
              <br />
            <!-- End of spol part -->


            <h1>Grad</h1>
            <input type="text" class="form-input predict-grad" style="width:298px;" placeholder="Unesite naziv grada..." />
            <div class="predict-list predict-grad-list"></div>
            <div class="selected-list selected-grad-list">


              <div style="clear:both;"></div>
            </div>
              <br />
            <h1>Jezik</h1>
            <input type="text" class="form-input predict-jezik" style="width:298px;" placeholder="Unesite naziv jezika..." />
            <div class="predict-list predict-jezik-list"></div>
            <div class="selected-list selected-jezik-list">


              <div style="clear:both;"></div>
            </div>
              <br />
            <h1>Ime i prezime</h1>
            <input type="text" class="form-input predict-ime" style="width:298px;" placeholder="Unesite ime osobe.." />
            <div class="predict-list predict-ime-list"></div>
            <div class="selected-list selected-ime-list">


              <div style="clear:both;"></div>
            </div>
              <br />

            <!-- Vozacka dozvola part -->
            <h1>Vozačka dozvola</h1>
              <br />
              <label class="form-checkbox">
                <input type="checkbox" name="vozacka-filter" class="filter-item vozacka-filter" value="0" checked/>
                <span></span>
                <h2>Nije relevantno</h2>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="vozacka-filter" class="filter-item vozacka-filter" value="1"/>
                <span></span>
                <h2>Posjeduje vozačku dozvolu</h2>
              </label>
              <br />
            <!-- End of vozacka dozvola part -->

            <!-- Vrsta posal part -->
            <h1>Vrsta posla</h1>
              <br />
              <label class="form-checkbox">
                <input type="checkbox" name="vrsta-posla-filter" class="filter-item vrsta-posla-filter ukini-filter-vrsta-posla" value="0" checked/>
                <span></span>
                <h2>Nije relevantno</h2>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="vrsta-posla-filter" class="filter-item vrsta-posla-filter" value="full-time"/>
                <span></span>
                <h2>Full time posao</h2>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="vrsta-posla-filter" class="filter-item vrsta-posla-filter" value="part-time"/>
                <span></span>
                <h2>Part time posao</h2>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="vrsta-posla-filter" class="filter-item vrsta-posla-filter" value="praksa"/>
                <span></span>
                <h2>Praksa</h2>
              </label>
              <br />
            <!-- End of vrsta posla part -->

              <input type="hidden" class="koliko-value" />
              <div style="clear:both;"></div>
            </div>
        </div>
      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">
        <div id="rezultati-pretrage" class="section">


        </div>

      </div>
      <!-- Kraj desnpog dijela -->
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
