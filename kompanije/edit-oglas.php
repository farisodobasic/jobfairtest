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
    <title>Izmjena oglasa</title>
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
        <div class="section"><?php basic_info($_SESSION['id_kompanije']);?></div>
      </div>
      <div class="right-col">
        <div class="section">
          <div class="editor">
              <?php
                $nazivPozicije=$opisPozicije=$konkursBegin=$konkursEnd=$brojPozicija=$kategorija="";
                if($_GET){
                  $id = (int)$db->escape_string($_GET['id']);
                  $kveri = $db->query("SELECT * FROM jf_oglasi WHERE id = {$id}")->fetch_assoc();
                  $nazivPozicije  = $kveri['naziv_pozicije'];
                  $opisPozicije   = $kveri['opis_pozicije'];
                  $konkursBegin   = date("Y-m-d", strtotime($kveri['konkurs_begin']));
                  $konkursEnd     = date("Y-m-d", strtotime($kveri['konkurs_end']));
                  $brojPozicija   = $kveri['broj_pozicija'];
                  $kategorija     = $kveri['kategorija'];
                  //echo $nazivPozicije."<br>".$opisPozicije."<br>".$konkursBegin."<br>".$konkursEnd."<br>".$brojPozicija."<br>";
                }
              ?>
              <form id="editor-forma" action="" method="post">
    						<input type="hidden" name="idOglasa" value="<?=$id?>">
                <label for="nazivPozicije" class="input-label"><h1>Naziv pozicije:</h1></label>
                <input id="nazivPozicije" type="text" name="nazivPozicije" placeholder="Naziv pozicije" class="form-input input-oglas" value="<?= $nazivPozicije; ?>">
                <br><br>

								<label for="nazivPozicije" class="input-label"><h1>Potrebne vještine:</h1></label>
								<input type="text" class="form-input predict-vjestina" style="width:350px;" placeholder="Unesite vještinu..." />
			          <div class="predict-list predict-vjestina-list"></div>
			          <div class="selected-list selected-vjestina-list">
									<?php
										$vjestina_oglasa = $db->query("SELECT jf_vjestine.* FROM jf_vjestine
											LEFT JOIN jf_oglas_vjestina ON jf_oglas_vjestina.vjestina = jf_vjestine.id
											WHERE jf_oglas_vjestina.oglas = {$id}") or die(mysqli_error($db));

										while($row = $vjestina_oglasa->fetch_assoc()){
											echo '<div class="filter-item filter-item-vjestina">'.$row['naziv'];
											echo '<input type="hidden" class="selected-vjestina-id" value="'.$row['id'].'" />';
											echo '<a class="ukini-vjestina-filter" href="javascript:void(0);"> <img width="12" src="'.$url_home.'icons/delete.png" /></a></div>';
										}
									?>
			            <div style="clear:both;"></div>
			          </div>
									<br /><br />

                <label for="opisPozicije" class="input-label"><h1>Opis pozicije:</h1></label>
									<br />
                <textarea id="opisPozicije" name="area1" style="width: 670px; height: 250px;">
                  <?=$opisPozicije; ?>
                </textarea>
                <br><br>

                <div class="forma-ostali-podaci">
                  <label for="konkursBegin" class="input-label"><h1>Datum objave konkursa:</h1></label>
                  <input id="konkursBegin" type="date" name="konkursBegin" class="form-input input-oglas" value="<?=$konkursBegin; ?>">
                  <br><br>

                  <label for="konkursEnd" class="input-label"><h1>Datum isteka konkursa:</h1></label>
                  <input id="konkursEnd" type="date" name="konkursEnd" class="form-input input-oglas" value="<?=$konkursEnd; ?>">
                  <br><br>

                  <label for="brojPozicija" class="input-label"><h1>Broj pozicija:</h1></label>
                  <input id="brojPozicija" type="number" name="brojPozicija" class="form-input input-oglas" value="<?=$brojPozicija; ?>">
                  <br><br>
                </div>

                <div class="kategorije-checkbox">
                  <!--<label for="kategorija" style="float:left"><h1>Kategorija:</h1></label>
                  <!--<div style="float: right; padding-top:2px; width:350px;">
                    <?php
                      $djelatnost = $db->query("SELECT * FROM jf_djelatnost");
                      while($row = $djelatnost->fetch_assoc()){
                    ?>
                      <label class="form-checkbox">
                        <input class="messageCheckbox" type="radio" name="check_list[]"
                              value="<?=$row['id'];?>" <?php if($row['id'] == $kategorija) echo 'selected'; ?>>
                        <span style="border-radius:90px;"></span>
                        <h2><?=$row['naziv'];?></h2>
                      </label>
                    <?php
                      }
                    ?>
                    <div style="clear:both;"></div>

                    <!--<input class="messageCheckbox" type="radio" name="check_list[]"
                            value="Software development"> Software development <br>
                    <input class="messageCheckbox" type="radio" name="check_list[]" value="Mreže"> Mreže <br>
                    <input class="messageCheckbox" type="radio" name="check_list[]" value="Simulacije"> Simulacije <br>
                    <input class="messageCheckbox" type="radio" name="check_list[]"
                            value="Statistika"> Statistika, finansije i proračuni <br>
                    <input class="messageCheckbox" type="radio" name="check_list[]"
                            value="Dizajn"> Dizajn, arhitektura, građevina i modeliranje<br>
                    <input class="messageCheckbox" type="radio" name="check_list[]" value="Ostalo"> Ostalo<br>-->
                  <!--</div>
                  <div style="clear:both;"></div>-->
                </div>
                <br />


                <input id="posalji" name="dodaj" class="btn" style="float:right;" onclick="posaljiNaServer('false')" type="button" value="Objavite promjenu oglasa">
								<a class="btn" style="display:block;float:right;margin:0 10px 20px 0;" href="javascript:delete_oglas(<?=$id;?>);">Obrišite oglas</a>
                <div style="clear:both;"></div>
              </form>
          </div>
        </div>
      </div>

      <?php
        //if(isset())
      ?>

                <!--
                <div class="left-col">
                  <div class="section">

                  </div>
                </div>
                <div class="right-col">
                  <div class="section">
                    Sekcija za ne znam sta vec
                  </div>

                  <div class="section">
                    Sekcija za kategoriju oglasa
                  </div>
                </div>
                -->
    </section>
  </body>

  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
