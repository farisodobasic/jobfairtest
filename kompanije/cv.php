<?php
	require_once('../brains/global.php');
  require_once('../brains/global_kompanije.php');
	//session_destroy();

  /* Get your CV */
  $id = (int)$_GET['id'];
  $cv = new CV;
  $cv->init_cv($id);

	/* Array sa radnim iskustvom */
	$radno_iskustvo = array();
	$radno_iskustvo = $cv->get_radno_iskustvo();

	/* Array sa srednjom školom */
	$srednja_skola  = array();
	$srednja_skola  = $cv->get_srednja_skola();

	/* Array sa fakultetom */
	$fakultet       = array();
	$fakultet       = $cv->get_fakultet();

	/* Array sa dodatnom edukacijom */
	$additional_edu       = array();
	$additional_edu       = $cv->get_additional_edu();

	/* Array sa kategorijama vještina koje posjeduje */
	$kategorije           = array();
	$kategorije           = $cv->get_kategorije();

	/* Array sa vještinama koje posjeduje */
	$vjestine             = array();
	$vjestine             = $cv->get_vjestine();

	/* Maternji */
	$maternji 						= array();
	$maternji 						= $cv->get_maternji();

	/* Jezici */
	$jezici               = array();
	$jezici               = $cv->get_jezici();

	/* Grad */
	$grad       = array();
	$grad       = $cv->get_grad();

	/* Info o korisniku cv baze */
	$ime        = $cv->get_ime();
	$prezime    = $cv->get_prezime();
	$adresa     = $cv->get_adresa();
	$telefon    = $cv->get_telefon();
	$mail       = $cv->get_mail();
	$spol       = $cv->get_spol();
	$datum_rodj = $cv->get_datum_rodj();
	$vozacka    = $cv->get_vozacka();

	/* Info o vrsti zaposlenja koje trazi */
	$fulltime   = $cv->get_fulltime();
	$parttime   = $cv->get_parttime();
	$praksa     = $cv->get_praksa();

	/* Provjera da li je u favoritima */
	$favoriti = provjera_favorita($_SESSION['id_kompanije'], $id);
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
          <div class="student-avatar">
            <?php if($spol == 1): ?>
              <?php echo '<img style="width:90px;opacity:0.6;" src="'.$url_home.'kompanije/img/musko.png" />'; ?>
            <?php endif; ?>
            <?php if($spol == 2): ?>
              <?php echo '<img style="width:90px;opacity:0.6;" src="'.$url_home.'kompanije/img/zensko.png" />'; ?>
            <?php endif; ?>
          </div>
          <div class="student-info">
            <h3><?=$ime." ".$prezime;?></h3>
            <div class="info"><?php if(count($fakultet) > 0) echo $fakultet[0]['faks'];?></div>
          </div>
          <div style="clear:both;"></div>
        </div>

        <div class="section">
          <h1 class="red-up">Osnovne informacije</h1>
            <br />
          <h1 class="highlite">Telefon</h1>
          <h1 class="svetlo"><?=$telefon;?></h1>
            <br />
          <h1 class="highlite">E-mail</h1>
          <h1 class="svetlo"><?=$mail;?></h1>
            <br />
          <h1 class="highlite">Adresa</h1>
          <h1 class="svetlo"><?=$adresa;?></h1>
            <br />
          <h1 class="highlite">Grad</h1>
          <h1 class="svetlo"><?=$grad['naziv'];?></h1>

        </div>

				<?php
					if(!$favoriti):
				?>
				<div class="section" style="padding:0;width:350px;">
					<a href="javascript:favoriti(<?=$id;?>);" class="azuriraj">
						<div class="favourite-icon" style="margin-bottom:-25px;"></div>
						Dodaj u favorite
					</a>
				</div>
				<?php
					endif;
					if($favoriti):
				?>
				<div class="section" style="padding:0;width:350px;">
					<a href="javascript:ukini_favoriti(<?=$id;?>);" class="azuriraj">
						<div class="favourite-icon" style="margin-bottom:-25px;"></div>
						Ukini iz favorita
					</a>
				</div>
				<?php
					endif;
				?>
      </div>
      <!-- Kraj lijeve kolone -->


      <!-- Pocetak desno dijela -->
      <div class="right-col">
        <div class="section">
          <h1 class="red-up big-heading" style="margin-bottom:20px;">Biografija</h1>
							<table >
								<tr class="red-tabela">
									<td class="bio-col-left"><h1 class="red-up normal-transform">OSNOVNE INFORMACIJE</h1></td>
									<td class="bio-col-right"></td>
								</tr>
							</table>
							<table style="margin-bottom:20px;">

									<tr class="red-tabela">
										<td class="bio-col-left">Ime:</td>
										<td class="bio-col-right"><?=$ime;?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Prezime:</td>
										<td class="bio-col-right"><?=$prezime;?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Email:</td>
										<td class="bio-col-right"><?=$mail;?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Grad:</td>
										<td class="bio-col-right"><?=$grad['naziv'];?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Adresa:</td>
										<td class="bio-col-right"><?=$adresa;?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Maternji jezik:</td>
										<td class="bio-col-right"><?=$maternji['naziv'];?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Kontakt telefon:</td>
										<td class="bio-col-right"><?=$telefon;?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Datum rođenja:</td>
										<td class="bio-col-right"><?=date('d.m.Y', strtotime($datum_rodj));?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Spol:</td>
										<td class="bio-col-right"><?php if($spol == 1) echo "Muško"; else echo "Žensko"; ?></td>
									</tr>
									<tr class="red-tabela">
										<td class="bio-col-left">Vozačka:</td>
										<td class="bio-col-right">
											<?php
												if($vozacka == 0) echo "Ne posjeduje vozačku";
													else if($vozacka == 1) echo "A Kategorija";
														else if($vozacka == 2) echo "B Kategorija";
															else if($vozacka == 3) echo "C Kategorija";
																else echo "D Kategorija";
											?>
										</td>
									</tr>

						 </table>

						 <table >
							 <tr class="red-tabela">
								 <td class="bio-col-left"><h1 class="red-up normal-transform">RADNO VRIJEME</h1></td>
								 <td class="bio-col-right"></td>
							 </tr>
						 </table>
						 <table style="margin-bottom:20px;">

								 <tr class="red-tabela">
									 <td class="bio-col-left">Full time:</td>
									 <td class="bio-col-right"><?php if($fulltime == 1)echo "DA"; else echo "NE";?></td>
								 </tr>
								 <tr class="red-tabela">
									 <td class="bio-col-left">Part time:</td>
									 <td class="bio-col-right"><?php if($parttime == 1)echo "DA"; else echo "NE";?></td>
								 </tr>
								 <tr class="red-tabela">
									 <td class="bio-col-left">Praksa:</td>
									 <td class="bio-col-right"><?php if($praksa == 1) echo "DA"; else echo "NE";?></td>
								 </tr>
							</table>
              <!-- Radno iskustvo CV korisnika -->
              <?php
                if(count($radno_iskustvo) > 0){
                  ?>
                  <table >
                    <tr class="red-tabela">
                      <td class="bio-col-left"><h1 class="red-up normal-transform">Radno iskustvo</h1></td>
                      <td class="bio-col-right"></td>
                    </tr>
                  </table>
                    <?php

                    foreach($radno_iskustvo as $item){
                      ?>
                      <table style="margin-bottom:20px;">
                        <tr class="red-tabela">
                          <td class="bio-col-left">Period rada:</td>
													<?php
														if($item['aktivno'] == 0 && $item['kraj'] != "01.01.1970"){
													?>
                          	<td class="bio-col-right"><?=$item['pocetak'];?>. do <?=$item['kraj'];?>.</td>
													<?php
														}else {
													?>
														<td class="bio-col-right"><?=$item['pocetak'];?>. (Aktivno)</td>
													<?php
														}
													?>

                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Vrsta iskustva:</td>
                          <td class="bio-col-right"><?=$item['vrsta_posla'];?></td>
                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Pozicija:</td>
                          <td class="bio-col-right"><?=$item['pozicija'];?></td>
                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Vrsta aktivnosti:</td>
                          <td class="bio-col-right"><?=$item['aktivnosti'];?></td>
                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Naziv poslodavca:</td>
                          <td class="bio-col-right"><?=$item['poslodavac'];?></td>
                        </tr>
                        <tr class="red-tabela"></tr>
                      </table>
                      <?php
                    }
                }
              ?>
              <!-- Kraj radnog iskustva -->
							<!-- Vještine edukacija  -->
              <?php
                if(count($kategorije) > 0){
                  ?>
                  <table >
                    <tr class="red-tabela">
                      <td class="bio-col-left"><h1 class="red-up normal-transform">Vještine</h1></td>
                      <td class="bio-col-right"></td>
                    </tr>
                  </table>
                  <table style="margin-bottom:20px;">
                    <?php

										$ind = 0;
                    foreach($kategorije as $k){
                      ?>
                      <tr class="red-tabela">
                        <td class="bio-col-left"><?=$k['naziv'];?>:</td>
                        <td class="bio-col-right">
                      <?php
											$i = 1;
											$m = 0;
                      $duzina = count($vjestine[$k['id']]['naziv']);
                      foreach($vjestine[$k['id']]['naziv'] as $item){
                          if($i == $duzina) echo $item;
                            else echo $item.", ";
                            $i++;


                      }

                      ?></td></tr><?php
                    }
                  ?> </table><?php
                }
              ?>
							<!-- Radno iskustvo CV korisnika -->
              <?php
                if(count($jezici) > 0){
                  ?>
                  <table >
                    <tr class="red-tabela">
                      <td class="bio-col-left"><h1 class="red-up normal-transform">Strani jezici</h1></td>
                      <td class="bio-col-right"></td>
                    </tr>
                  </table>
                    <?php

                    foreach($jezici as $item){
                      ?>
                      <table style="margin-bottom:20px;">
                        <tr class="red-tabela">
                          <td class="bio-col-left">Jezik:</td>
                          <td class="bio-col-right"><?=$item['naziv'];?></td>
                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Nivo razumijevanja:</td>
                          <td class="bio-col-right"><?=$item['razumijevanje'];?></td>
                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Nivo govora:</td>
                          <td class="bio-col-right"><?=$item['govor'];?></td>
                        </tr>
                        <tr class="red-tabela">
                          <td class="bio-col-left">Nivo pisanja:</td>
                          <td class="bio-col-right"><?=$item['pisanje'];?></td>
                        </tr>

                        <tr class="red-tabela"></tr>
                      </table>
                      <?php
                    }
                }
              ?>
              <!-- Srednjoskolsko obrazovanje -->
              <?php
                if(count($srednja_skola) > 0){
                  ?>
                  <table >
                    <tr class="red-tabela">
                      <td class="bio-col-left"><h1 class="red-up normal-transform">Srednja škola</h1></td>
                      <td class="bio-col-right"></td>
                    </tr>
                  </table>
                    <?php

                    foreach($srednja_skola as $item){
                      if($item['zavrsetak'] != -1 && $item['naziv_srednje'] != ""){
                        ?>
                        <table style="margin-bottom:20px;">
                          <tr class="red-tabela">
                            <td class="bio-col-left">Naziv:</td>
                            <td class="bio-col-right"><?=$item['naziv_srednje'];?></td>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Grad:</td>
                            <td class="bio-col-right"><?=$item['grad_srednje'];?></td>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Smjer:</td>
                            <td class="bio-col-right"><?=$item['smjer'];?></td>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Godina završetka:</td>
                            <td class="bio-col-right"><?=$item['zavrsetak'];?>. godina</td>
                          </tr>

                        </table>
                        <?php
                      }
                    }
                }
              ?>
              <!-- Kraj srednjoskolskog obrazovanje -->
              <!-- Fakultetsko obrazovanje -->
              <?php
                if(count($fakultet) > 0){
                  ?>
                  <table >
                    <tr class="red-tabela">
                      <td class="bio-col-left"><h1 class="red-up normal-transform">Fakultetsko obrazovanje</h1></td>
                      <td class="bio-col-right"></td>
                    </tr>
                  </table>
                    <?php

                    foreach($fakultet as $item){

                        ?>
                        <table style="margin-bottom:20px;">
                          <tr class="red-tabela">
                            <td class="bio-col-left">Ime fakulteta:</td>
                            <td class="bio-col-right"><?=$item['faks'];?></td>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Smjer:</td>
                            <td class="bio-col-right"><?=$item['smjer'];?></td>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Godina studija:</td>
                            <td class="bio-col-right"><?=$godine_studija[$item['godina_studija']];?></td>
                          </tr>

                          <tr class="red-tabela">
                            <td class="bio-col-left">Godina upisa:</td>
                            <td class="bio-col-right"><?=date('Y.', strtotime($item['pocetak']));?> godina</td>
                          </tr>

													<?php
                            if($item['godina_studija'] == 8):
                          ?>
													<tr class="red-tabela">
                            <td class="bio-col-left">Godina završetka:</td>
                            <td class="bio-col-right"><?=date('Y.', strtotime($item['kraj']));?> godina</td>
                          </tr>
													<?php
														endif;
													?>

                          <?php
                            if(strtotime($item['kraj']) > 0):
                          ?>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Godina završetka:</td>
                            <td class="bio-col-right"><?=date('Y.', strtotime($item['kraj']));?> godina</td>
                          </tr>
                          <?php
                            endif;
                          ?>

                        </table>
                        <?php

                    }
                }
              ?>
              <!-- Kraj fakulteta -->
              <!-- Dodatna edukacija  -->
              <?php
                if(count($additional_edu) > 0){
                  ?>
                  <table >
                    <tr class="red-tabela">
                      <td class="bio-col-left"><h1 class="red-up normal-transform">Dodatna edukacija</h1></td>
                      <td class="bio-col-right"></td>
                    </tr>
                  </table>
                    <?php

                    foreach($additional_edu as $item){

                        ?>
                        <table style="margin-bottom:20px;">
                          <tr class="red-tabela">
                            <td class="bio-col-left">Vrsta:</td>
                            <td class="bio-col-right"><?=$item['vrsta'];?></td>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Period:</td>
														<?php
															if($item['aktivno'] == 0 && $item['kraj'] != "01.01.1970"){
														?>
	                          	<td class="bio-col-right"><?=$item['pocetak'];?>. do <?=$item['kraj'];?>.</td>
														<?php
															}else {
														?>
															<td class="bio-col-right"><?=$item['pocetak'];?>. (Aktivno)</td>
														<?php
															}
														?>
                          </tr>
                          <tr class="red-tabela">
                            <td class="bio-col-left">Opis aktivnosti:</td>
                            <td class="bio-col-right"><?=$item['opis'];?></td>
                          </tr>
                        </table>
                        <?php

                    }
                }
              ?>
              <!-- Kraj dodatne edukacije -->

              <!-- Kraj dodatne edukacije -->

        </div>

      </div>
      <!-- Kraj desnpog dijela -->
    </section>



  </body>
  <?php
  	require_once('inc/html_foot.php');
  ?>
 </html>
