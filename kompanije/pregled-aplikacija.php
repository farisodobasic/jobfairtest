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
    <title>Pregled aplikacija</title>
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
      <?php
					// $id_kompanije = $_SESSION['id_kompanije']
					// $kveri = $db->query(SELECT kandidate FROM kandidati, aplikacije WHERE kandidat.id = aplikacija.id);
					/*while ($row = $kveri -> fetch_assoc()){
							Prikazi podatke o studentu kao u pretrazivacu...

					} */

					if($_GET){
						$id_oglasa = (int)$_GET['id'];
						$oglas = $db->query("SELECT * FROM jf_oglasi WHERE id = {$id_oglasa}")->fetch_assoc();
					}else{
						header('Location: '.$url_home.'kompanije');
					}
				?>

				<div class="left-col">
					<div class="section">
						<h1><?=$oglas['naziv_pozicije'];?></h1><br />
						<h1>Trajanje: <?=date("d.m.Y.", strtotime($oglas['konkurs_begin']));?> do <?=date("d.m.Y.", strtotime($oglas['konkurs_end']));?></h1><br />
						<h1><?=$oglas['broj_pozicija'];?> pozicija/e</h1><br />
						<h1>Opis pozicije:</h1>
							<br />
						<span style="display:block;width:310px;padding:0 20px;font-size:13px;"><?=$oglas['opis_pozicije'];?></span>

					</div>
				</div>

				<div class="right-col">
					<div class="section">
						<?php
							/* Pregled aplikacija */
							$ko = array();
							$aplikacije = $db->query("SELECT id_korisnika FROM jf_aplikacije WHERE id_oglasa = {$id_oglasa}");
							while($row = $aplikacije->fetch_assoc())
								$ko[] = $row['id_korisnika'];

							$ids = join(',',$ko);
							$aplicirali = $db->query("SELECT jf_cv.id AS cv_id, jf_cv.ime, jf_cv.prezime, jf_cv.spol, jf_cv.profilna, jf_gradovi.naziv AS naziv_grada,
															jf_edukacija.godina_studija, jf_edukacija.fakultet_alternativa
									FROM jf_cv
										LEFT JOIN jf_gradovi ON jf_cv.grad = jf_gradovi.id
										LEFT JOIN jf_edukacija ON jf_cv.id = jf_edukacija.cv
								WHERE 1 = 1
								AND jf_cv.id IN ($ids)");

								prikazi_cv($aplicirali);

						?>
					</div>
				</div>
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
