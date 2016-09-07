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
    <title>Pregled oglasa</title>
    <?php require_once('inc/html_head.php'); ?>
    <script type="text/javascript" src="nicEdit/nicEdit.js"></script>
    <script type="text/javascript"> bkLib.onDomLoaded(function() { nicEditors.allTextAreas() }); </script>

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
			<div class="left-col">
					<div class="section">
							<h1>Naziv oglasa</h1>
							<input type="text" class="form-input naziv-oglasa" style="width:298px;" placeholder="Unesite naziv oglasa..." />
							<br />
							<br />

		          <h1>Vještine</h1>
		          <input type="text" class="form-input predict-vjestina-oglasi" style="width:298px;" placeholder="Unesite vještinu..." />
		          <div class="predict-list predict-vjestina-list"></div>
		          <div class="selected-list selected-vjestina-list">


		            <div style="clear:both;"></div>
		          </div>
								<br />

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
		      </div>
					<div class="section">
						<h1>Filter oglasa</h1>

					</div>

		        <input type="hidden" class="koliko-value" />
			</div>
			<div class="right-col">
				<div id="rezultati-pretrage-oglasa" class="section">
      <?php
          // UBACITI DIO KODA KOJI PROVJERAVA DA LI JE USPOSTAVLJENA SESIJA KOMPANIJE, AKO JESTE PRIKAZATI DUGME ZA EDIT!!!
          // if (isset($_SESSION['id_kompanije'])){
          //      echo "<form id="edit-oglas" action='edit-oglas.php' method='post'>
					//							<input type='text' name='id_oglasa' vale='$row['id']' style='display:hidden'>
          //              <input type='button'  value='Izmijeni oglas'>
          //            </form>";
          //}
          //$id=(int)$_GET['id'];

					/* Postavljanje statusa oglasa na neaktivan */
        	provjeri_oglase();
			?>

				</div>
			</div>
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
  <script>$(document).ready(function(){ update_pretraga_oglasi(); });</script>
 </html>
