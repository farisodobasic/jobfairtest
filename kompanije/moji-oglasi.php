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
    <title>Moji oglasi</title>
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
          <div class="section" style="padding:0;width:350px;border-bottom:0;">
            <a href="javascript:void(0);" class="whole-btn aktivni-olgasi-scroll aktivan-whole"><img style="margin-bottom:-6px;margin-right:10px;" src="<?=$url_home;?>icons/novo.png" /> Aktuelni oglasi</a>
            <a href="javascript:void(0);" class="whole-btn neaktivni-olgasi-scroll"><img style="margin-bottom:-6px;margin-right:10px;" src="<?=$url_home;?>icons/quit.png" /> Istekli oglasi</a>

            <div style="clear:both;"></div>
          </div>
					<div class="section">
						<?php basic_info($_SESSION['id_kompanije']);?>
		      </div>

		        <input type="hidden" class="koliko-value" />
			</div>
			<div class="right-col">
				<div class="section">

        <?php
					/* Postavljanje statusa oglasa na neaktivan */
        	provjeri_oglase();

          /* ID komapnije */
          $kompanija = $_SESSION['id_kompanije'];

          /* Kveri koji vadi sve oglase ove kompanije */
          $oglasi = $db->query("SELECT jf_oglasi.*, jf_kompanije.naziv as naziv_kompanije, jf_kompanije.id as id_kompanije, jf_djelatnost.naziv as kat, jf_kompanije.profil as profil_kompanije FROM jf_oglasi
            LEFT JOIN jf_kompanije ON jf_oglasi.id_kompanije = jf_kompanije.id
            LEFT JOIN jf_djelatnost ON jf_djelatnost.id = jf_oglasi.kategorija
            WHERE jf_oglasi.id_kompanije = {$kompanija} AND jf_oglasi.konkurs_end > NOW()") or die(mysqli_error($db));

          $oglasi_istekli = $db->query("SELECT jf_oglasi.*, jf_kompanije.naziv as naziv_kompanije, jf_kompanije.id as id_kompanije, jf_djelatnost.naziv as kat, jf_kompanije.profil as profil_kompanije FROM jf_oglasi
              LEFT JOIN jf_kompanije ON jf_oglasi.id_kompanije = jf_kompanije.id
              LEFT JOIN jf_djelatnost ON jf_djelatnost.id = jf_oglasi.kategorija
              WHERE jf_oglasi.id_kompanije = {$kompanija} AND jf_oglasi.konkurs_end < NOW()") or die(mysqli_error($db));

          /* Renderuj oglase */
        ?>
        <div class="long-scroller">
          <div class="section-holder">
            <?php
              render_oglasi($oglasi, "Nema aktivnih oglasa.");
            ?>
          </div>
          <div class="section-holder">
            <?php
              render_oglasi($oglasi_istekli, "Nema neaktivnih oglasa.");
            ?>
          </div>
        </div>
				</div>
			</div>
    </section>
  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
  <script>$(document).ready(function(){ update_pretraga_oglasi(); });</script>
 </html>
