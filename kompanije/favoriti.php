<?php
	require_once('../brains/global.php');
	require_once('../brains/global_kompanije.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>JobFAIR | Favoriti</title>

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
          <?php basic_info($_SESSION['id_kompanije']);?>


        </div>
      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">

				<div class="section">
					<?php
          $get_favoriti = $db->query("SELECT cv FROM jf_cv_favorit WHERE kompanija = {$_SESSION['id_kompanije']}");
          $match = array();
          while($row = $get_favoriti->fetch_assoc()){
            $match[] = $row['cv'];
          }

          $m = join(',',$match);

					if(count($match) > 0){
						$random_cv = $db->query("SELECT jf_cv.id AS cv_id, jf_cv.ime, jf_cv.prezime, jf_cv.spol, jf_cv.profilna, jf_gradovi.naziv AS naziv_grada,
														jf_edukacija.godina_studija, jf_edukacija.fakultet_alternativa, jf_fakulteti.naziv as faks
													FROM jf_cv
														LEFT JOIN jf_gradovi ON jf_cv.grad = jf_gradovi.id
														LEFT JOIN jf_edukacija ON jf_cv.id = jf_edukacija.cv
														LEFT JOIN jf_fakulteti ON  jf_fakulteti.id = jf_edukacija.fakultet
												WHERE 1 = 1
											  AND jf_edukacija.fakultet != 0
												AND jf_cv.id IN ($m)

												GROUP BY jf_edukacija.cv
												ORDER BY jf_cv.id DESC
											LIMIT 0, 5") or die(mysqli_error($db));
							$ar = array();
							prikazi_cv($random_cv, $ar);
						}else echo "Nemate trenutno favorita.";
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
