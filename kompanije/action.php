<?php
	require_once('../brains/global.php');

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		switch ($_POST['action'])
		{
			/* Predict vještine */
			case 'predict-vjestina':
				$key = $db->escape_string($_POST['key']);

				$query 		= $db->query("SELECT id, naziv FROM jf_vjestine WHERE UPPER(naziv) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-vjestina";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-vjestina item <?=$active;?>">
							<?=$row['naziv'];?>
							<input type="hidden" class="vjestina-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="vjestina-naziv" value="<?=$row['naziv'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-vjestina">Nema rezultata</a>';
			break;

			/* Predict vještine */
			case 'predict-vjestina-tehnicke':
				$key = $db->escape_string($_POST['key']);

				$query 		= $db->query("SELECT jf_vjestine.id, jf_vjestine.naziv FROM jf_vjestine
					LEFT JOIN jf_vjestine_kategorija ON jf_vjestine_kategorija.vjestina = jf_vjestine.id
					WHERE jf_vjestine_kategorija.kategorija != 9 AND jf_vjestine_kategorija.kategorija != 10
					AND
					UPPER(naziv) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-vjestina";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-vjestina item <?=$active;?>">
							<?=$row['naziv'];?>
							<input type="hidden" class="vjestina-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="vjestina-naziv" value="<?=$row['naziv'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-vjestina">Nema rezultata</a>';
			break;

			/* Predict vještine */
			case 'predict-vjestina-drustvene':
				$key = $db->escape_string($_POST['key']);

				$query 		= $db->query("SELECT jf_vjestine.id, jf_vjestine.naziv FROM jf_vjestine
					LEFT JOIN jf_vjestine_kategorija ON jf_vjestine_kategorija.vjestina = jf_vjestine.id
					WHERE jf_vjestine_kategorija.kategorija = 9
					AND
					UPPER(naziv) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-vjestina";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-vjestina item <?=$active;?>">
							<?=$row['naziv'];?>
							<input type="hidden" class="vjestina-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="vjestina-naziv" value="<?=$row['naziv'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-vjestina">Nema rezultata</a>';
			break;

			/* Predict vještine */
			case 'predict-vjestina-drustvene':
				$key = $db->escape_string($_POST['key']);

				$query 		= $db->query("SELECT jf_vjestine.id, jf_vjestine.naziv FROM jf_vjestine
					LEFT JOIN jf_vjestine_kategorija ON jf_vjestine_kategorija.vjestina = jf_vjestine.id
					WHERE jf_vjestine_kategorija.kategorija = 10
					AND
					UPPER(naziv) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-vjestina";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-vjestina item <?=$active;?>">
							<?=$row['naziv'];?>
							<input type="hidden" class="vjestina-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="vjestina-naziv" value="<?=$row['naziv'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-vjestina">Nema rezultata</a>';
			break;

			/* Predvidi fakultet */
			case 'predict-fakultet':
				$key = $db->escape_string($_POST['key']);

				$query 		= $db->query("SELECT id, naziv FROM jf_fakulteti WHERE UPPER(naziv) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-fakultet";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-fakultet item <?=$active;?>">
							<?=$row['naziv'];?>
							<input type="hidden" class="fakultet-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="fakultet-naziv" value="<?=$row['naziv'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-fakultet">Nema rezultata</a>';
			break;

			/* Predict grada */
			case 'predict-grad':
				$key = $db->escape_string($_POST['key']);

				$query  	= $db->query("SELECT id, naziv FROM jf_gradovi WHERE UPPER(naziv) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-grad";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-grad item <?=$active;?>">
							<?=$row['naziv'];?>
							<input type="hidden" class="grad-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="grad-naziv" value="<?=$row['naziv'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-grad">Nema rezultata</a>';
			break;

			/* Predict jezika */
			case 'predict-jezik':
				$key = $db->escape_string($_POST['key']);

				$query 	= $db->query("SELECT id, jezik FROM jf_jezici WHERE UPPER(jezik) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-jezik";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-jezik item <?=$active;?>">
							<?=$row['jezik'];?>
							<input type="hidden" class="jezik-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="jezik-naziv" value="<?=$row['jezik'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-jezik">Nema rezultata</a>';
			break;

			/* Predict jezika */
			case 'predict-jezik-maternji':
				$key = $db->escape_string($_POST['key']);

				$query 	= $db->query("SELECT id, jezik FROM jf_jezici WHERE UPPER(jezik) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-jezik";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-jezik-maternji item <?=$active;?>">
							<?=$row['jezik'];?>
							<input type="hidden" class="jezik-id" value="<?=$row['id'];?>" />
							<input type="hidden" class="jezik-naziv" value="<?=$row['jezik'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-jezik">Nema rezultata</a>';
			break;

			/* Predict ime i prezime */
			case 'predict-ime':
				$key = $db->escape_string($_POST['key']);

				$query  	= $db->query("SELECT ime, prezime FROM jf_cv WHERE UPPER(CONCAT(ime, ' ', prezime)) LIKE UPPER('{$key}%') OR UPPER(ime) LIKE UPPER('{$key}%') OR UPPER(prezime) LIKE UPPER('{$key}%') LIMIT 0,5");
				$active 	= "selected-ime";

				while($row = $query->fetch_assoc()){
					?>
						<a href="javascript:void(0);" class="click-to-use-ime item <?=$active;?>">
							<?=$row['ime'];?> <?=$row['prezime'];?>
							<input type="hidden" class="ime-ime" value="<?=$row['ime'];?>" />
							<input type="hidden" class="ime-prezime" value="<?=$row['prezime'];?>" />
						</a>
					<?php
					$active = "";
				}

				if($query->num_rows == 0) echo '<a href="javascript:void(0);" class="item selected-ime">Nema rezultata</a>';
			break;

			/* Main filter update */
			case 'pretraga-update':
				  /* Array sa rimskim godinama studija */
                /* paginacija */
                $page = (int)$_POST['page'];
                $pocetak = ($page - 1) * 10;

                /* Nema rezultata je netacnoinicijalno */
                $nema_rezultata = false;

                /* Sortiranje po score-u */
                $sortiraj = " ORDER BY azurirano DESC ";
                if(isset($_POST['score']) && $_POST['score'] == 1)
                	$sortiraj = " ORDER BY score DESC ";

                /* Filteri vještine */
                $filter_vjestine_jezici = "";
                if(isset($_POST['vjestine']) && count($_POST['vjestine']) > 0){
               		$vjestine_filter	= $_POST['vjestine'];
               		$vjestine_filter 	= array_map('intval', $vjestine_filter);

	               	$ids = join(',',$vjestine_filter);
	               	$apply_filter = $db->query("SELECT jf_cv_vjestina.cv, jf_cv_vjestina.vjestina FROM jf_cv_vjestina WHERE jf_cv_vjestina.vjestina IN ($ids)");

	               	$cvs = array();
	               	$koji = array();
	               	$match_v = array();

               		while($row = $apply_filter->fetch_assoc()){
               			$cvs[$row['cv']][] = $row['vjestina'];
               			$koji[] = $row['cv'];
               		}

               		foreach($koji as $item){
               			$zadovoljava = false;
               			if(count($cvs[$item]) == count($vjestine_filter)) $zadovoljava = true;
               			if($zadovoljava) $match_v[] = $item;
               		}

					if(count($match_v) > 0){
               			$ids = join(',',$match_v);
	               		$filter_vjestine_jezici .= " AND jf_cv.id IN ($ids) ";
	               	}else $nema_rezultata = true;
               	}

               	/* Filter godina studija */
               	$filter_godine = "";
               	if(isset($_POST['odabrane_godine']) && count($_POST['odabrane_godine']) > 0){
               		$filter_godine .= " AND";
               		$prva = true;
               		foreach($_POST['odabrane_godine'] as $item){
               			if($prva) $filter_godine .= " (";
               				else $filter_godine .= " OR";
	               			$filter_godine .= " jf_edukacija.godina_studija = ".$item;
	               			$prva = false;
               		}
               		$filter_godine .= ")";
               	}

               	/* Filter grad */
               	$filter_gradovi = "";
                if(isset($_POST['gradovi']) && count($_POST['gradovi']) > 0){
               		$filter_gradovi .= " AND";
               		$prva = true;
               		foreach($_POST['gradovi'] as $item){
               			if($prva) $filter_gradovi .= " (";
               				else $filter_gradovi .= " OR";
	               			$filter_gradovi .= " jf_cv.grad = ".$item;
	               			$prva = false;
               		}
               		$filter_gradovi .= ")";
               	}

               	$filter_fakulteti = "";
               	/* Filter fakulteti */
               	if(isset($_POST['fakulteti']) && count($_POST['fakulteti']) > 0){
               		$filter_fakulteti .= " AND";
               		$prva = true;
               		foreach($_POST['fakulteti'] as $item){
               			if($prva) $filter_fakulteti .= " (";
               				else $filter_fakulteti .= " OR";
	               			$filter_fakulteti .= " jf_edukacija.fakultet = ".$item;
	               			$prva = false;
               		}
               		$filter_fakulteti .= ")";

					/*
               		$fakulteti		= $_POST['fakulteti'];
               		$fakulteti 	= array_map('intval', $fakulteti);

	               	$ids = join(',',$fakulteti);
	               	$apply_filter = $db->query("SELECT jf_edukacija.cv, jf_edukacija.fakultet FROM jf_edukacija WHERE jf_edukacija.fakultet IN ($ids)");

	               	$cvs = array();
	               	$koji = array();
	               	$match_f = array();

               		while($row = $apply_filter->fetch_assoc()){
               			$cvs[$row['cv']][] = $row['fakultet'];
               			$koji[] = $row['cv'];
               		}

               		foreach($koji as $item){
               			$zadovoljava = false;
               			if(count($cvs[$item]) == count($fakulteti)) $zadovoljava = true;
               			if($zadovoljava) $match_f[] = $item;
               		}

               		if($filter_vjestine_jezici == ""){
						if(count($match_f) > 0){
	               			$ids = join(',',$match_f);
		               		$filter_vjestine_jezici .= " AND jf_cv.id IN ($ids) ";
		               	}else $nema_rezultata = true;
		            }else{
		            	$final_match = array();
		            	foreach($match_v as $item){
		            		foreach($match_f as $l)
		            			if($item == $l) $final_match[] = $item;
		            	}
		            	$final_match = array_unique($final_match);
		            	$ids = join(',',$final_match);
		               	$filter_vjestine_jezici = " AND jf_cv.id IN ($ids) ";

		               	if(count($final_match) == 0) $nema_rezultata = true;
		            }
		            */
               	}

               	/* Filter jezici */
               	if(isset($_POST['jezici']) && count($_POST['jezici']) > 0){
               		$jezici		= $_POST['jezici'];
               		$jezici 	= array_map('intval', $jezici);

	               	$ids = join(',',$jezici);
	               	$apply_filter = $db->query("SELECT jf_cv_jezik.cv, jf_cv_jezik.jezik FROM jf_cv_jezik WHERE jf_cv_jezik.jezik IN ($ids)");

	               	$cvs = array();
	               	$koji = array();
	               	$match_j = array();

               		while($row = $apply_filter->fetch_assoc()){
               			$cvs[$row['cv']][] = $row['jezik'];
               			$koji[] = $row['cv'];
               		}

               		foreach($koji as $item){
               			$zadovoljava = false;
               			if(count($cvs[$item]) == count($jezici)) $zadovoljava = true;
               			if($zadovoljava) $match_j[] = $item;
               		}

               		if($filter_vjestine_jezici == ""){
						if(count($match_j) > 0){
	               			$ids = join(',',$match_j);
		               		$filter_vjestine_jezici .= " AND jf_cv.id IN ($ids) ";
		               	}else $nema_rezultata = true;
		            }else{
		            	$medju_final = array();
		            	foreach($match_vv as $item){
		            		foreach($match_j as $l)
		            			if($item == $l) $medju_final[] = $item;
		            	}
		            	$medju_final = array_unique($medju_final);
		            	$ids = join(',',$medju_final);
		               	$filter_vjestine_jezici = " AND jf_cv.id IN ($ids) ";

		               	if(count($medju_final) == 0) $nema_rezultata = true;
		            }
               	}

               	/* FIlter ime */
               	$filter_ime = "";
               	if(isset($_POST['ime']) && count($_POST['ime']) > 0){
               		$filter_ime .= " AND";
               		$prva = true;
               		foreach($_POST['ime'] as $item){
               			$item = $db->escape_string($item);
               			if($prva) $filter_ime .= " (";
               				else $filter_ime .= " OR";
	               			$filter_ime .= " UPPER(CONCAT(jf_cv.ime, ' ', jf_cv.prezime)) = UPPER('".$item."')";
	               			$prva = false;
               		}
               		$filter_ime .= ")";
               	}

               	/* Filter spol */
               	$filter_spol = "";
               	if(isset($_POST['spol']) && $_POST['spol'] != 0){
               		$filter_spol = " AND jf_cv.spol = ".(int)$_POST['spol'];
               	}

               	/* Filter vozacka */
               	$filter_vozacka = "";
               	if(isset($_POST['vozacka']) && $_POST['vozacka'] != 0){
               		$filter_vozacka = " AND jf_cv.vozacka_dozvola = ".(int)$_POST['vozacka'];
               	}

               	/* Filter vrsta posla */
               	$filter_vrsta_posla = "";
               	if(isset($_POST['vrsta_posla']) && count($_POST['vrsta_posla']) > 0){
               		$filter_vrsta_posla .= " AND";
               		$prva = true;
               		foreach($_POST['vrsta_posla'] as $item){
               			if($prva) $filter_vrsta_posla .= " (";
               				else $filter_vrsta_posla .= " OR";
	               			if($item == "full-time") $filter_vrsta_posla .= " jf_cv.full_time = 1";
	               			if($item == "part-time") $filter_vrsta_posla .= " jf_cv.part_time = 1";
	               			if($item == "praksa") $filter_vrsta_posla .= " jf_cv.praksa = 1";

	               			$prva = false;
               		}
               		$filter_vrsta_posla .= ")";
               	}

               	if(!$nema_rezultata){
	                $random_cv = $db->query("SELECT jf_cv.id AS cv_id, jf_cv.ime, jf_cv.prezime, jf_cv.spol, jf_cv.profilna, jf_gradovi.naziv AS naziv_grada,
	                								jf_edukacija.godina_studija, jf_edukacija.fakultet_alternativa, jf_fakulteti.naziv as faks
								FROM jf_cv
									LEFT JOIN jf_gradovi ON jf_cv.grad = jf_gradovi.id
									LEFT JOIN jf_edukacija ON jf_cv.id = jf_edukacija.cv
									LEFT JOIN jf_fakulteti ON  jf_fakulteti.id = jf_edukacija.fakultet
							WHERE 1 = 1
							AND jf_edukacija.fakultet != 0
							".$filter_ime."
							".$filter_vjestine_jezici."
							".$filter_godine."
							".$filter_gradovi."
							".$filter_spol."
							".$filter_vozacka."
							".$filter_vrsta_posla."
							".$filter_fakulteti."
							GROUP BY jf_edukacija.cv
							".$sortiraj."
						LIMIT {$pocetak}, 10");

	                if($random_cv->num_rows == 0) echo "Nema rezultata.";
	            }else{
	            	echo "Nema rezultata.";
	            	die();
	            }

						if(isset($_POST['vjestine']))
							prikazi_cv($random_cv, $vjestine_filter);
						else{
							$ar = array();
							prikazi_cv($random_cv, $ar);
						}
			break;

			case 'pretraga-update-oglasi':
				/* paginacija */
                $page = (int)$_POST['page'];
                $pocetak = ($page - 1) * 10;

                /* Nema rezultata je netacnoinicijalno */
                $nema_rezultata = false;

								/* Filter naziv oglasa */
								$filter_naziv_oglasa = "";
								if(isset($_POST['naziv_oglasa']) && strlen($_POST['naziv_oglasa']) > 0){
									$naziv 								= $db->escape_string($_POST['naziv_oglasa']);
									$filter_naziv_oglasa 	.= " AND jf_oglasi.naziv_pozicije LIKE '{$naziv}%'";
								}

                /* Filteri vještine */
                $filter_vjestine = "";
                if(isset($_POST['vjestine']) && count($_POST['vjestine']) > 0){
               		$vjestine_filter	= $_POST['vjestine'];
               		$vjestine_filter 	= array_map('intval', $vjestine_filter);

	               	$ids = join(',',$vjestine_filter);
	               	$apply_filter = $db->query("SELECT jf_oglas_vjestina.oglas, jf_oglas_vjestina.vjestina FROM jf_oglas_vjestina WHERE jf_oglas_vjestina.vjestina IN ($ids)");

	               	$oglasi 	= array();
	               	$koji 		= array();
	               	$match_v 	= array();

               		while($row = $apply_filter->fetch_assoc()){
               			$oglasi[$row['oglas']][] = $row['vjestina'];
               			$koji[] = $row['oglas'];
               		}

               		foreach($koji as $item){
               			$zadovoljava = false;
               			if(count($oglasi[$item]) == count($vjestine_filter)) $zadovoljava = true;
               			if($zadovoljava) $match_v[] = $item;
               		}

									if(count($match_v) > 0){
               			$ids = join(',',$match_v);
	               		$filter_vjestine .= " AND jf_oglasi.id IN ($ids) ";
	               	}else $nema_rezultata = true;
               	}

               	$oglasi = $db->query("SELECT jf_oglasi.*, jf_kompanije.naziv as naziv_kompanije, jf_kompanije.id as id_kompanije, jf_djelatnost.naziv as kat, jf_kompanije.profil as profil_kompanije FROM jf_oglasi

									LEFT JOIN jf_kompanije ON jf_oglasi.id_kompanije = jf_kompanije.id
									LEFT JOIN jf_djelatnost ON jf_djelatnost.id = jf_oglasi.kategorija
									WHERE status = 1
									".$filter_naziv_oglasa."
									".$filter_vjestine."
										LIMIT {$pocetak}, 10") or die(mysqli_error($db));

									if($oglasi->num_rows == 0) $nema_rezultata = true;

               	if(!$nema_rezultata){
		        			render_oglasi($oglasi);
								}else{
									echo "Nema rezultata.";
								}
			break;

			case 'dodaj_u_favorite':
				$id = $db->escape_string($_POST['id']);
				$db->query("INSERT INTO jf_cv_favorit (id, cv, kompanija) VALUES ('null', {$id}, {$_SESSION['id_kompanije']})");
			break;

			case 'ukini_iz_favorita':
				$id = $db->escape_string($_POST['id']);
				$db->query("DELETE FROM jf_cv_favorit WHERE cv = {$id} AND kompanija = {$_SESSION['id_kompanije']}");
			break;
		}
	}
?>
