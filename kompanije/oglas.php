<?php
	require_once('../brains/global.php');
	//session_destroy();
	if($_GET){
		$id_oglasa = (int)$_GET['id'];
		$oglas = $db->query("SELECT jf_oglasi.*, jf_kompanije.naziv as naziv_kompanije FROM jf_oglasi
				LEFT JOIN jf_kompanije ON jf_kompanije.id = jf_oglasi.id_kompanije
			WHERE jf_oglasi.id = {$id_oglasa}")->fetch_assoc() or die(mysqli_error($db));
	}else{
		header('Location: '.$url_home.'kompanije');
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$oglas['naziv_kompanije'];?> | <?=$oglas['naziv_pozicije'];?></title>

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
          <?php basic_info($oglas['id_kompanije']); ?>
        </div>
      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">
        <div class="section">
            <h2 style="color:#C0392B;"><?=$oglas['naziv_pozicije'];?></h2>
            <h3 style="color:#5d5d5d;"><?=$oglas['naziv_kompanije'];?></h3>
            <span class="opis-oglasa">
                Datum objave konkursa: <b><?=date('d.m.Y.', strtotime($oglas['konkurs_begin']));?> godine</b><br >
                Datum zatvaranja konkursa: <b><?=date('d.m.Y.', strtotime($oglas['konkurs_end']));?> godine</b><br ><br />

                <?=$oglas['opis_pozicije'];?><br /><br />
                <b>Potrebne vještine:</b>
                <ul class="vjestine">
                    <?php
                      $vjestine = $db->query("SELECT jf_vjestine.naziv FROM jf_vjestine
                        LEFT JOIN jf_oglas_vjestina ON jf_vjestine.id = jf_oglas_vjestina.vjestina
                        WHERE jf_oglas_vjestina.oglas = {$id_oglasa}") or die(mysqli_error($db));

                      if($vjestine->num_rows == 0) echo "<li>Nije navedeno</li>";

                      while($row = $vjestine->fetch_assoc())
                        echo "<li>".$row['naziv']."</li>";
                    ?>
                </ul>
            </span>
						<?php
							if(isset($_SESSION['id_kompanije'])){
								/* Ukoliko je korisnik ulogoan kao kompanija */
								if($oglas['id_kompanije'] == $_SESSION['id_kompanije']){
									?>
										<a class="btn" style="display:block;float:right;margin:10px 10px 0 0;" href="<?=$url_home;?>kompanije/pregled-aplikacija.php?id=<?=$row['id'];?>">Pregledaj aplikacije</a>
										<a class="btn" style="display:block;float:right;margin:10px 10px 0 0;" href="<?=$url_home;?>kompanije/edit-oglas.php?id=<?=$row['id'];?>">Izmijeni oglas</a>
										<a class="btn" style="display:block;float:right;margin:10px 10px 0 0;" href="javascript:delete_oglas(<?=$row['id']?>)">Obrišite oglas</a>
										<div style="clear:both;"></div>
									<?php
								}
							}else if(isset($_SESSION['id_korisnika'])){
								/* Chekiraj ako je korisnik ulogovan */
								$is_applied = $db->query("SELECT count(id) FROM jf_aplikacije								WHERE id_korisnika=1  AND
									id_kompanije={$kompanija_podaci['id']}")->fetch_assoc();

								if(count($is_applied)==0){
									?><a class="btn" style="float:right;" href="javascript:aplicirajNaOglas(<?=$row['id_kompanije'];?>, <?=$row['id'];?>)">Apliciraj</a><?php
								}else{
									echo "<br>Već ste prijavljeni na ovaj oglas!";
								}
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
