<?php
	/* Provjera logiranosti u admin panel */
	function check_if_admin_logged(){
		global $url_home;
		global $current;
		if(!isset($_SESSION['admin']) && $current != "login.php") header('Location: '.$url_home.'admin/login.php');
		else if(isset($_SESSION['admin']) && $current == "login.php") header('Location: '.$url_home.'admin');
	}

	/* Provjera logiranosti za kompanije */
	function check_if_korisnik_logged(){
		global $url_home;
		global $current;
		if(!isset($_SESSION['id_kompanije']) && $current != "login.php") header('Location: '.$url_home.'kompanije/login.php');
		else if(isset($_SESSION['id_kompanije']) && $current == "login.php") header('Location: '.$url_home.'kompanije');
	}

	/* Provjerava ogiranost studenta */
	/* Provjera logiranosti za kompanije */
	function check_if_student_logged(){
		global $url_home;
		global $current;
		if(!isset($_SESSION['id_korisnika']) && $current != "login.php" && $current != "register.php" && $current != "reset.php") header('Location: '.$url_home.'user/login.php');
		else if(isset($_SESSION['id_korisnika']) && ($current == "login.php" || $current == "reset.php" || $current == "register.php")) header('Location: '.$url_home.'user');
	}

	/* Postavljanje statusa oglasa na neaktivan ukoliko je istekao */
	function provjeri_oglase(){
		global $db;
		$oglasi = $db->query("SELECT * FROM jf_oglasi WHERE status=1");
		while($podatak = $oglasi->fetch_assoc()){
			if (date("d-m-Y", strtotime($podatak['konkurs_end'])) < date("d-m-Y")){
				$db->query("UPDATE jf_oglasi SET status=0 WHERE id={$podatak['id']}");
			}
		}
	}

	/*
		Algoritam za kropovanje centra slike, bez resize-a. Pisan za jedan drugi projekat.
		Koristi imagick klasu za obradu slika
	*/

	function crop_algorithm($location, $save_to, $set_width, $set_height){
	// Algoritam developed by Mirza Ohranovic | mirza.ohranovic@gmail.com
	// Coded by Mirza Ohranovic
	// October 2014.

	$image = new Imagick;
	$image->readImage($location);

	// Get size
	list($width, $height) = getimagesize($location);

		$hratio 	= $set_height / $height;
		$wratio		= $set_width / $width;

		if($wratio < 1 && $hratio < 1){
			$odabran = min($hratio, $wratio);

			if($odabran == $hratio){
				$nova = $width * $wratio;
				$image->scaleImage($nova, 0);
			}elseif($odabran == $wratio){
				$nova = $height * $hratio;
				$image->scaleImage(0, $nova);
			}
		}elseif($wratio < 1 && $hratio >= 1){
			$nova = $height * $hratio;
			$image->scaleImage(0, $nova);
		}elseif($wratio >= 1 && $hratio < 1){
			$nova = $width * $wratio;
			$image->scaleImage($nova, 0);
		}else{
			$image->scaleImage($set_width, 0);
		}

		$v = $image->getImageGeometry();
			$w = $v['width'];
			$h = $v['height'];

		$x = floor(($w - $set_width) / 2);
		$y = floor(($h - $set_height) / 2);

		if($x <= 1) $x = 0;
		if($y <= 1) $y = 0;

		$image->cropImage($set_width, $set_height, $x, $y);
		$image->writeImage($save_to);
		$image->clear();
		$image->destroy();
	}

	/* Spašavanje galerije */
	function gallery_save($location, $to){

		list($width, $height) = getimagesize($location);

		if($width > 1024){

			$image = new Imagick;
			$image->readImage($location);
			$image->scaleImage(960, 0);
			$image->writeImage($to);

			$image->clear();
			$image->destroy();

		}elseif($height > 1024){

			$image = new Imagick;
			$image->readImage($location);
			$image->scaleImage(0, 960);
			$image->writeImage($to);

			$image->clear();
			$image->destroy();

		}else{
			copy($location, $to);
		}
	}

	/* Paginacija */
	function pagination($page, $range, $total){

	$pages = ceil($total / $range);

	?><nav>
  		<ul class="pagination">
  	<?php
		if($pages < 8){
			for($i = 1; $i <= $pages; $i++){
				if($i == $page){
					?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);" disabled><?=$i;?></a></li><?php
				}else{
					?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);"><?=$i;?></a></li><?php
				}
			}
		}else{
			$drugi = $pages - 3;
			if(($page >= 1 && $page <= 3) || ($page >= $pages - 4)){
				for($i = 1; $i <= 4; $i++){
					if($i == $page){
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);" disabled><?=$i;?></a></li><?php
					}else{
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);"><?=$i;?></a></li><?php
					}
				}

				?><li><a href="javascript:void(0);" disabled>...</a></li><?php

				for($i = $drugi; $i <= $pages; $i++){
					if($i == $page){
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);" disabled><?=$i;?></a></li><?php
					}else{
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);"><?=$i;?></a></li><?php
					}
				}
			}else{
				?><li><a href="<?=$url;?><?=$addition;?>" class="kockica">1</a></li><?php
				?><li><a href="javascript:void(0);" disabled>...</a></li><?php

				for($i = $page - 1; $i <= $page + 3; $i++){
					if($i == $page){
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);" disabled><?=$i;?></a></li><?php
					}else{
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);"><?=$i;?></a></li><?php
					}
				}

				?><li><a href="javascript:void(0);" disabled>...</a></li><?php

				for($i = $drugi; $i <= $pages; $i++){
					if($i == $page){
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);" disabled><?=$i;?></a></li><?php
					}else{
						?><li><a href="javascript:ucitaj_vjestine(<?=$i;?>);"><?=$i;?></a></li><?php
					}
				}
			}
		}
		?>
			</ul>
		</nav>
		<?php
	}

	/* Prikaži oglase */
	function prikazi_cv($query, $vjestine_filter){
			global $db;
			global $url_home;
			global $godine_studija;

			//$rimski = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII");
			$rimski = $godine_studija;

			while($row = $query->fetch_assoc()){
							if(!is_numeric($row['godina_studija'])) $row['godina_studija'] = 1;

							/* Query za vještine */
							$vjestine = $db->query("SELECT jf_vjestine.id, jf_vjestine.naziv FROM jf_vjestine
								LEFT JOIN jf_cv_vjestina ON jf_cv_vjestina.vjestina = jf_vjestine.id
								WHERE jf_cv_vjestina.cv = {$row['cv_id']}");
					?>

					<div class="cv-item <?php if(8 == 9) echo "last-cv"; ?>">
						<div class="image-part">
							<div class="image-holder">
								<?php
									if($row['profilna'] == 0){
										if($row['spol'] == 1) echo '<img style="width:120px;opacity:0.6;" src="'.$url_home.'kompanije/img/musko.png" />';
											else if($row['spol'] == 2) echo '<img style="width:120px;opacity:0.6;" src="'.$url_home.'kompanije/img/zensko.png" />';
									}else{
										echo '<img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xtf1/v/t1.0-9/11828697_10207716111890840_6605429353789010748_n.jpg?oh=c8a5efec44e1bb9620beba871121284a&oe=563DE542" />';
									}
								?>
							</div>
						</div>

						<?php
							$faks = (isset($row['faks'])) ? $row['faks'] : $row['fakultet_alternativa'];
						?>

						<div class="main-info-part">
							<p class="ime-prezime"><?=$row['ime']." ".$row['prezime'];?></p>
							<p class="loc-faks"><img src="<?=$url_home;?>icons/faks.png" height="14" /> <?=$faks;?> </p>
							<p class="loc-faks"><img src="<?=$url_home;?>icons/place.png" height="14" /> <?=$row['naziv_grada'];?>, Bosna i Hercegovina</p>
							<p class="loc-faks"><img src="<?=$url_home;?>icons/student.png" height="14" /> <?=$rimski[$row['godina_studija']];?></p>
							<a href="<?=$url_home;?>kompanije/cv.php?id=<?=$row['cv_id'];?>" class="pogledaj-cv">Pogledaj CV</a>
						</div>

						<div class="skill-info-part">
							<div class="heading">
								<img src="<?=$url_home;?>icons/skill.png" height="16" /> Vještine
							</div>

							<div class="skills">
								<?php
									if($vjestine->num_rows > 0){
										$prva = true;
										while($vjestina = $vjestine->fetch_assoc()){
											if(!$prva) echo ", ";

											// Boldiraj ako je tražena osobina
											if(isset($_POST['vjestine'])){
												if(in_array($vjestina['id'], $vjestine_filter)) echo '<b>'.$vjestina['naziv'].'</b>';
													else echo $vjestina['naziv'];
											}else
												echo $vjestina['naziv'];

											$prva = false;
										}
									}else echo "N/I";
								?>
							</div>
						</div>

						<div style="clear:both;"></div>
					</div>
					<?php }
	}

	/* Basic info */
	function basic_info($id){
		global $db;
		global $url_home;
		$id = (int)$id;

		$info = $db->query("SELECT * FROM jf_kompanije WHERE id = {$id}")->fetch_assoc();

		/* HTML rendering */
		?>
		<div style="color:#292929;">
			<!--	<img src="<?=$url_home;?><?=$info['logo'];?>" style="width:310px;" /> -->
			<img src="<?=$url_home;?><?=$info['logo'];?>" style="width:310px;margin-bottom:20px;" />
				<br />
			<div>
				<img height="16" src="<?=$url_home;?>icons/place.png" /> <h1 style="margin-left:10px;display:inline-block;color:#5d5d5d;font-size:14px;">Adresa</h1>
				<h1 style="font-size:14px;margin-top:5px;margin-left:33px;"><?=$info['adresa'];?></h1>
			</div>
			<div style="margin-top:6px;">
				<img height="16" src="<?=$url_home;?>icons/email.png" style="margin-bottom:-2px;" /> <h1 style="margin-left:10px;display:inline-block;color:#5d5d5d;font-size:14px;">Kontakt e-mail</h1>
				<h1 style="font-size:14px;margin-top:5px;margin-left:33px;"><?=$info['mail'];?></h1>
			</div>
			<div style="margin-top:6px;">
				<img height="16" src="<?=$url_home;?>icons/telefon.png" style="margin-bottom:-2px;" /> <h1 style="margin-left:10px;display:inline-block;color:#5d5d5d;font-size:14px;">Telefon</h1>
				<h1 style="font-size:14px;margin-top:5px;margin-left:33px;"><?=$info['telefon'];?></h1>
			</div>
			<div style="margin-top:6px;">
				<img height="16" src="<?=$url_home;?>icons/link.png" style="margin-bottom:-2px;" /> <h1 style="margin-left:10px;display:inline-block;color:#5d5d5d;font-size:14px;">Web stranica</h1>
				<h1 style="font-size:14px;margin-top:5px;margin-left:33px;"><a href="http://<?=$info['web'];?>"><?=$info['web'];?></a></h1>
			</div>
		</div>

		<?php
		/* End og html rendering */
	}

	function render_oglasi($query, $poruka = "Nema oglasa."){
		global $db;
		global $url_home;

		/* HTML rendering */
		while($row = $query->fetch_assoc()){
			?>
			<div class="oglas-preview">
				<div class="image-part">
									<div class="image-holder">
										<img src="https://scontent-mxp1-1.xx.fbcdn.net/hphotos-xfa1/v/t1.0-9/48082_10152033762144849_2139929755_n.png?oh=4a6145f0c697fe184533c914d5923b61&oe=569A445E" />
									</div>
							</div>

							<div class="main-info-part">
								<h1><?=$row['naziv_pozicije'];?></h1>
								<h2><?=$row['naziv_kompanije'];?></h2>
								Kategorija: <?=$row['kat'];?><br />
								Vještine: HTML/CSS, PHP, WordPress<br />
								Deadline: <b><?=date('d.m.Y', strtotime($row['konkurs_end']));?></b><br />
								<a target="_blank" href="<?=$url_home;?>kompanije/oglas.php?id=<?=$row['id'];?>">Pročitaj detaljno</a>

							</div>
							<div style="clear:both;"></div>
							<?php
								$is_applied = false;
								if(isset($_SESSION['id_korisnika'])){
									/* Chekiraj ako je korisnik ulogovan */
									$is_applied = $db->query("SELECT count(id) FROM jf_aplikacije								WHERE id_korisnika=1  AND
										id_kompanije={$kompanija_podaci['id']}")->fetch_assoc();

									if(count($is_applied)==0){
										?><a class="btn" href="javascript:aplicirajNaOglas(<?=$row['id_kompanije'];?>, <?=$row['id'];?>)">Apliciraj</a><?php
									}else{
										echo "<br>Već ste prijavljeni na ovaj oglas!";
									}
								}else if(isset($_SESSION['id_kompanije'])){
									/* Ukoliko je korisnik ulogoan kao kompanija */
									if($row['profil_kompanije'] == $_SESSION['id_kompanije']){
										?>
											<a class="btn" style="display:block;float:left;margin:0 10px 20px 0;" href="<?=$url_home;?>kompanije/pregled-aplikacija.php?id=<?=$row['id'];?>">Pregledaj aplikacije</a>
											<a class="btn" style="display:block;float:left;margin:0 10px 20px 0;" href="<?=$url_home;?>kompanije/edit-oglas.php?id=<?=$row['id'];?>">Izmijeni oglas</a>

											<div style="clear:both;"></div>
										<?php
									}
								}
							?>
			</div>
			<div style="clear:both;"></div>
			<?php
		}

		if($query->num_rows == 0) echo $poruka;
		/* End of HTML rendering */
	}

	/* Provjera favorita */
	function provjera_favorita($id_kompanije, $id_korisnika){
		global $db;

		$ima = $db->query("SELECT COUNT(id) as num FROM jf_cv_favorit WHERE cv = {$id_korisnika} AND kompanija = {$id_kompanije}")->fetch_assoc();
		if($ima['num'] == 0)
			return false;
		else
			return true;
	}

?>
