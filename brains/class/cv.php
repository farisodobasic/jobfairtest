<?php
	class CV{
		private $id;
		private $ime;
		private $prezime;
		private $adresa;
		private $email;
		private $telefon;
		private $grad = array();
		private $spol;
		private $unesen_cv = false;
		private $datum_rodj;
		private $maternji = array();
		private $profilna;
		private $vozacka;

		private $full_time;
		private $part_time;
		private $praksa;

		private $radno_iskustvo = array();
		private $srednja_skola 	= array();
		private $fakultet		= array();

		private $additional_edu = array();

		private $vjestine 		= array();
		private $kategorije		= array();
		private $jezici				= array();

		/* Set functions */
		public function set_ime($val)	{ 	$this->ime 		= $val; }
		public function set_prezime($val){ 	$this->prezime 	= $val; }
		public function set_adresa($val){ 	$this->adresa 	= $val; }
		public function set_email($val)	{ 	$this->email 	= $val; }
		public function set_telefon($val){ 	$this->telefon 	= $val; }

		private function set_radno_iskustvo(){
			global $db;

			$get_radno = $db->query("SELECT jf_posao.id, jf_posao.pozicija, jf_posao.aktivnosti, jf_posao.poslodavac,
				jf_vrsta_posla.vrsta as vrsta_posla, jf_posao.start_date, jf_posao.end_date, jf_posao.aktivno
				FROM jf_posao LEFT JOIN jf_vrsta_posla ON jf_vrsta_posla.id = jf_posao.vrsta_posla WHERE jf_posao.cv = {$this->id}") or die(mysqli_error($db));
			$i = 0;
			while($row = $get_radno->fetch_assoc()){
				$this->radno_iskustvo[$i]['id'] 					= $row['id'];
				$this->radno_iskustvo[$i]['pozicija'] 		= $row['pozicija'];
				$this->radno_iskustvo[$i]['aktivnosti']		= $row['aktivnosti'];
				$this->radno_iskustvo[$i]['poslodavac']		= $row['poslodavac'];
				$this->radno_iskustvo[$i]['vrsta_posla']	= $row['vrsta_posla'];
				$this->radno_iskustvo[$i]['pocetak']			= date("d.m.Y", strtotime($row['start_date']));
				$this->radno_iskustvo[$i]['kraj']					= date("d.m.Y", strtotime($row['end_date']));
				$this->radno_iskustvo[$i]['aktivno'] 			= $row['aktivno'];
				$i++;
			}
		}

		public function set_education(){
			global $db;

			$i = 0; $k = 0;
			$get_edu = $db->query("SELECT jf_edukacija.*, g1.naziv as grad_srednje_naziv, g1.id as grad_srednje, f.naziv as faks, f.id as faks_id FROM jf_edukacija
				LEFT JOIN jf_gradovi as g1 ON g1.id = jf_edukacija.grad_srednje
				LEFT JOIN jf_fakulteti as f ON f.id = jf_edukacija.fakultet
				WHERE jf_edukacija.cv = {$this->id}");
			while($row = $get_edu->fetch_assoc()){
				if($row['naziv_srednje'] != "" && $row['godina_zavrsetka'] != -1){
					if($i == 0){
						$this->srednja_skola[$i]['id']			= $row['id'];
						$this->srednja_skola[$i]['naziv_srednje'] 	= $row['naziv_srednje'];
						$this->srednja_skola[$i]['grad_srednje']	= $row['grad_srednje_naziv'];
						$this->srednja_skola[$i]['grad_srednje_id']	= $row['grad_srednje'];
						$this->srednja_skola[$i]['smjer']			= $row['smjer_srednje'];
						$this->srednja_skola[$i]['zavrsetak']		= $row['godina_zavrsetka'];
					}
					$i++;
				}

				if($row['fakultet'] != 0){
					$this->fakultet[$k]['id']						= $row['id'];
					$this->fakultet[$k]['faks']					= $row['faks'];
					$this->fakultet[$k]['faks_id']					= $row['faks_id'];
					$this->fakultet[$k]['smjer']				= $row['smjer'];
					$this->fakultet[$k]['godina_studija']		= $row['godina_studija'];
					$this->fakultet[$k]['prosjek']			= $row['prosjek'];
					$this->fakultet[$k]['pocetak']				= date('d.m.Y', strtotime($row['start_date']));
					$this->fakultet[$k]['kraj']					= date('d.m.Y', strtotime($row['end_date']));
					$k++;
				}
			}
		}

		public function set_additional_edu(){
			global $db;

			$i = 0;
			$get_add_edu = $db->query("SELECT * FROM jf_edukacija_dodatna WHERE cv = {$this->id}");
			while($row = $get_add_edu->fetch_assoc()){
				$this->additional_edu[$i]['id']		= $row['id'];
				$this->additional_edu[$i]['vrsta'] 		= ucfirst($row['vrsta_edukacije']);
				$this->additional_edu[$i]['pocetak']	= date('d.m.Y', strtotime($row['start_date']));
				$this->additional_edu[$i]['kraj']		= date('d.m.Y', strtotime($row['end_date']));
				$this->additional_edu[$i]['opis']		= $row['opis_aktivnosti'];
				$this->additional_edu[$i]['aktivno']		= $row['aktivno'];
				$i++;
			}
		}

		public function set_vjestine(){
			global $db;

			$get_vjestine = $db->query("SELECT jf_vjestine.naziv, jf_vjestine.id, k.kategorija, k.id as id_kategorija FROM jf_vjestine
				LEFT JOIN jf_vjestine_kategorija k ON k.id = jf_vjestine.kategorija
				LEFT JOIN jf_cv_vjestina v ON jf_vjestine.id = v.vjestina
				WHERE v.cv = {$this->id}") or die(mysqli_error($db));


			$i = 0;
			$bilo = array();
			while($row = $get_vjestine->fetch_assoc()){
				if(!in_array($row['id_kategorija'], $bilo)){
					$this->kategorije[$i]['id']							= $row['id_kategorija'];
					$this->kategorije[$i]['naziv']					= $row['kategorija'];
					$bilo[] = $row['id_kategorija'];
				}

				$this->vjestine[$row['id_kategorija']]['naziv'][] 			= $row['naziv'];
				$this->vjestine[$row['id_kategorija']]['id'][] 					= $row['id'];
				$i++;
			}
		}

		public function set_maternji(){
			global $db;

			$jezik = $db->query("SELECT jf_jezici.id, jf_jezici.jezik as naziv FROM jf_jezici
															LEFT JOIN jf_cv ON jf_jezici.id = jf_cv.maternji_jezik
															WHERE jf_cv.id = {$this->id}") or die(mysqli_error($db));
			$arr = $jezik->fetch_assoc();

			$this->maternji['id'] = $arr['id'];
			$this->maternji['naziv'] = $arr['naziv'];
		}

		public function set_jezici(){
			global $db;

			$jezici = $db->query("SELECT jf_cv_jezik.*, jf_jezici.jezik as naziv, jf_jezici.id as id_jezika FROM jf_cv_jezik
															LEFT JOIN jf_jezici ON jf_jezici.id = jf_cv_jezik.jezik
															WHERE jf_cv_jezik.cv = {$this->id}");

			$i = 0;
			while($row = $jezici->fetch_assoc()){
				$this->jezici[$i]['naziv'] 					= $row['naziv'];
				$this->jezici[$i]['id']							= $row['id_jezika'];
				$this->jezici[$i]['id_veza']				= $row['id'];
				$this->jezici[$i]['razumijevanje'] 	= $row['razumijevanje'];
				$this->jezici[$i]['govor']					= $row['govor'];
				$this->jezici[$i]['pisanje']				= $row['pisanje'];
				$i++;
			}
		}

		/* Get functions */
		public function get_ime(){ return $this->ime; }
		public function get_prezime(){ return $this->prezime; }
		public function get_adresa(){ return $this->adresa; }
		public function get_telefon(){ return $this->telefon; }
		public function get_mail(){ return $this->email; }
		public function get_grad(){ return $this->grad; }
		public function get_spol(){ return $this->spol; }
		public function get_maternji(){ return $this->maternji; }
		public function get_unesen_cv(){ return $this->unesen_cv; }
		public function get_vozacka(){ return $this->vozacka; }
		public function get_profilna(){ return $this->profilna; }

		public function get_radno_iskustvo(){ return $this->radno_iskustvo; }
		public function get_srednja_skola(){ return $this->srednja_skola; }
		public function get_fakultet(){ return $this->fakultet; }
		public function get_additional_edu(){ return $this->additional_edu; }
		public function get_vjestine(){ return $this->vjestine; }
		public function get_kategorije(){ return $this->kategorije; }
		public function get_datum_rodj(){ return $this->datum_rodj; }
		public function get_jezici(){ return $this->jezici; }

		public function get_fulltime(){ return $this->full_time; }
		public function get_parttime(){ return $this->part_time; }
		public function get_praksa(){ return $this->praksa; }

		/* Basic initializae */
		public function basic_init($id){
			global $db;

			$this->id = $id;

			$get_basic_data = $db->query("SELECT jf_cv.ime, jf_cv.prezime, jf_cv.unesen_cv, jf_cv.profilna, jf_cv.email, jf_cv.adresa, jf_cv.spol FROM jf_cv WHERE id = {$this->id}") or die(mysqli_error($db));
			$gbd_array			= $get_basic_data->fetch_assoc();

			$this->ime 				= $gbd_array['ime'];
			$this->prezime 		= $gbd_array['prezime'];
			$this->unesen_cv	= $gbd_array['unesen_cv'];
			$this->spol  					= $gbd_array['spol'];
			$this->adresa 				= $gbd_array['adresa'];
			$this->email 					= $gbd_array['email'];
			$this->profilna				= $gbd_array['profilna'];
		}


		/* Initialize */
		public function init_cv($id){
			// Global vars
			global $db;

			// Set id
			$this->id = $id;

			// Get the data
			$get_data 		= $db->query("SELECT jf_cv.*, jf_gradovi.naziv as grad_naziv FROM jf_cv
										LEFT JOIN jf_gradovi ON jf_gradovi.id = jf_cv.grad
			 							WHERE jf_cv.id = {$this->id}");
			$get_data_array = $get_data->fetch_assoc();

			// Setup data
			$this->ime 						= $get_data_array['ime'];
			$this->prezime 				= $get_data_array['prezime'];
			$this->adresa 				= $get_data_array['adresa'];
			$this->email 					= $get_data_array['email'];
			$this->telefon 				= $get_data_array['mobitel'];
			$this->grad['naziv'] 	= $get_data_array['grad_naziv'];
			$this->grad['id']			= $get_data_array['grad'];
			$this->spol  					= $get_data_array['spol'];
			$this->unesen_cv			= $get_data_array['unesen_cv'];
			$this->datum_rodj 		= $get_data_array['datum_rodjenja'];
			$this->vozacka 				= $get_data_array['vozacka_dozvola'];

			$this->praksa 				= $get_data_array['praksa'];
			$this->full_time  		= $get_data_array['full_time'];
			$this->part_time  		= $get_data_array['part_time'];

			self::set_radno_iskustvo();
			self::set_education();
			self::set_additional_edu();
			self::set_vjestine();
			self::set_maternji();
			self::set_jezici();
		}

		/* CV update funkcije */
		public function update_osnovne_info($array){
				global $db;

				$db->query("UPDATE jf_cv SET
							ime = '{$array['ime']}',
							prezime = '{$array['prezime']}',
							email = '{$array['mail']}',
							grad = {$array['grad']},
							adresa = '{$array['adresa']}',
							mobitel = '{$array['telefon']}',
							datum_rodjenja = '{$array['datum_r']}',
							spol = {$array['spol']},
							full_time = {$array['full_time']},
							part_time = {$array['part_time']},
							praksa = {$array['praksa']}
					WHERE id = {$this->id}") or die(mysqli_error($db));
		}

		public function update_radno_iskustvo($item){
			global $db;

			for($i = 0; $i < count($item->pozicija); $i++){
				$item->pozicija[$i] 		= $db->escape_string($item->pozicija[$i]);
				$item->vrsta[$i] 				= $db->escape_string($item->vrsta[$i]);
				$item->opis[$i] 				= $db->escape_string($item->opis[$i]);
				$item->poslodavac[$i] 	= $db->escape_string($item->poslodavac[$i]);
				$item->od[$i] 					= $db->escape_string($item->od[$i]);
				$item->do[$i] 					= $db->escape_string($item->do[$i]);
				$item->edited[$i] = (int)$item->edited[$i];
				$item->aktivno[$i]	= (int)$item->aktivno[$i];

				if($item->aktivno[$i] == 1) $item->do[$i] = "1970-01-01";

				if($item->edited[$i] == 0)
					$db->query("INSERT INTO jf_posao (id, pozicija, aktivnosti, poslodavac, cv, start_date, end_date, vrsta_posla, aktivno)
						VALUES ('null', '{$item->pozicija[$i]}', '{$item->opis[$i]}', '{$item->poslodavac[$i]}',
							{$this->id}, '{$item->od[$i]}', '{$item->do[$i]}', {$item->vrsta[$i]}, {$item->aktivno[$i]})")
						or die(mysli_error($db));
				else {

					$db->query("UPDATE jf_posao SET
						pozicija = '{$item->pozicija[$i]}',
						aktivnosti = '{$item->opis[$i]}',
						poslodavac = '{$item->poslodavac[$i]}',
						start_date = '{$item->od[$i]}',
						end_date = '{$item->do[$i]}',
						vrsta_posla = {$item->vrsta[$i]},
						aktivno = {$item->aktivno[$i]}
						WHERE id = {$item->edited[$i]}") or die(mysqli_error($db));
				}
			}
		}

		public function update_srednja($naziv, $smjer, $grad, $kraj, $edit_id){
			global $db;

			$naziv = $db->escape_string($naziv);
			$smjer = $db->escape_string($smjer);
			$grad = $db->escape_string($grad);
			$kraj = $db->escape_string($kraj);

			$edit_id = (int)$edit_id;

			if($edit_id == 0){
				$db->query("INSERT INTO jf_edukacija (id, naziv_srednje, smjer_srednje, grad_srednje, godina_zavrsetka, cv) VALUES
												('null', '{$naziv}', '{$smjer}', {$grad}, {$kraj}, {$this->id})") or die(mysqli_error($db));
			}else{

				$db->query("UPDATE jf_edukacija SET
						naziv_srednje = '{$naziv}',
						smjer_srednje = '{$smjer}',
						grad_srednje = {$grad},
						godina_zavrsetka = {$kraj}
					WHERE cv = {$edit_id}") or die(mysqli_error($db));
			}
		}

		public function update_maternji($maternji){
			global $db;

			$maternji = (int)$maternji;
			$db->query("UPDATE jf_cv SET maternji_jezik = {$maternji} WHERE jf_cv.id = {$this->id}") or die(mysqli_error($db));
		}

		public function update_faks($item){
			global $db;

			for($i = 0; $i < count($item->faks); $i++){
				$item->faks[$i] 						= $db->escape_string($item->faks[$i]);
				$item->smjer[$i] 						= $db->escape_string($item->smjer[$i]);
				$item->godina[$i] 					= $db->escape_string($item->godina[$i]);
				$item->prosjek[$i] 					= $db->escape_string($item->prosjek[$i]);
				$item->edit[$i] = (int)$item->edit[$i];

				$item->prosjek[$i] = str_replace(',', '.', $item->prosjek[$i]);

				if($item->prosjek[$i] == "" || $item->prosjek[$i] == null) $item->prosjek[$i] = 0;

				if($item->godina[$i] == 8) $item->kraj[$i] = "0000-00-00";

				if($item->edit[$i] == 0){
					/*echo "INSERT INTO jf_edukacija (id, fakultet, smjer, godina_studija, prosjek, cv, start_date, end_date)
						VALUES ('null', '{$item->faks[$i]}', '{$item->smjer[$i]}', {$item->godina[$i]},
							{$item->prosjek[$i]}, {$this->id}, '{$item->pocetak[$i]}', '{$item->kraj[$i]}')";*/

					$db->query("INSERT INTO jf_edukacija (id, fakultet, smjer, godina_studija, prosjek, cv, start_date, end_date)
						VALUES ('null', '{$item->faks[$i]}', '{$item->smjer[$i]}', {$item->godina[$i]},
							'{$item->prosjek[$i]}', {$this->id}, '{$item->pocetak[$i]}', '{$item->kraj[$i]}')")
						or die(mysqli_error($db));
				} else {
				/*	echo "UPDATE jf_edukacija SET
							fakultet = {$item->faks[$i]},
							smjer = '{$item->smjer[$i]}',
							godina_studija = {$item->godina[$i]},
							prosjek = '{$item->prosjek[$i]}',
							start_date = '{$item->pocetak[$i]}',
							end_date = '{$item->kraj[$i]}'
						WHERE id = {$item->edit[$i]}"; */
					$db->query("UPDATE jf_edukacija SET
							fakultet = {$item->faks[$i]},
							smjer = '{$item->smjer[$i]}',
							godina_studija = {$item->godina[$i]},
							prosjek = '{$item->prosjek[$i]}',
							start_date = '{$item->pocetak[$i]}',
							end_date = '{$item->kraj[$i]}'
						WHERE id = {$item->edit[$i]}") or die(mysqli_error($db));
				}
			}
		}

		public function update_jezici($item){
			global $db;

			for($i = 0; $i < count($item->jezik); $i++){
				$item->jezik[$i] 						= $db->escape_string($item->jezik[$i]);
				$item->raz[$i] 						= $db->escape_string($item->raz[$i]);
				$item->govor[$i] 					= $db->escape_string($item->govor[$i]);
				$item->pisanje[$i] 					= $db->escape_string($item->pisanje[$i]);
				$item->edit[$i] = (int)$item->edit[$i];


				if($item->edit[$i] == 0){
					$db->query("INSERT INTO jf_cv_jezik (id, jezik, cv, razumijevanje, govor, pisanje)
						VALUES ('null', {$item->jezik[$i]}, {$this->id}, '{$item->raz[$i]}', '{$item->govor[$i]}',
							'{$item->pisanje[$i]}')")
						or die(mysli_error($db));

				} else {
					var_dump($item->jezik);
					$db->query("UPDATE jf_cv_jezik SET
							jezik = {$item->jezik[$i]},
							cv = {$this->id},
							razumijevanje = '{$item->raz[$i]}',
							govor = '{$item->govor[$i]}',
							pisanje = '{$item->pisanje[$i]}'
						WHERE id = {$item->edit[$i]}") or die(mysqli_error($db));
				}
			}
		}

		public function update_dodatna_edu($item){
			global $db;

			for($i = 0; $i < count($item->vrsta); $i++){
				$item->vrsta[$i] 				= $db->escape_string($item->vrsta[$i]);
				$item->opis[$i] 				= $db->escape_string($item->opis[$i]);
				$item->od[$i] 					= $db->escape_string($item->od[$i]);
				$item->do[$i] 					= $db->escape_string($item->do[$i]);
				$item->aktivno[$i]			= (int)$item->aktivno[$i];
					$item->edit[$i] = (int)$item->edit[$i];
					echo $item->edit[$i];

				if($item->aktivno[$i] == 1) $item->do[$i] = "1970-01-01";

				if($item->edit[$i] == 0){
					echo "dodao";
					$db->query("INSERT INTO jf_edukacija_dodatna (id, vrsta_edukacije, start_date, end_date, cv, opis_aktivnosti, aktivno)
						VALUES ('null', '{$item->vrsta[$i]}', '{$item->od[$i]}', '{$item->do[$i]}',
							{$this->id}, '{$item->opis[$i]}', {$item->aktivno[$i]})")
						or die(mysqli_error($db));
					}else {

					$db->query("UPDATE jf_edukacija_dodatna SET
							vrsta_edukacije = '{$item->vrsta[$i]}',
							start_date = '{$item->od[$i]}',
							end_date = '{$item->do[$i]}',
							cv = {$this->id},
							opis_aktivnosti = '{$item->opis[$i]}',
							aktivno = {$item->aktivno[$i]}
						WHERE id = {$item->edit[$i]}") or die(mysqli_error($db));
				}
			}
		}

		public function update_vjestine($vjestine, $vozacka){
			global $db;

			$vozacka = (int)$vozacka;
			$db->query("UPDATE jf_cv SET vozacka_dozvola = {$vozacka} WHERE id = {$this->id}");

			$db->query("DELETE FROM jf_cv_vjestina WHERE cv = {$this->id}") or die(mysqli_error($db));

			var_dump($vjestine);
			foreach($vjestine as $item)
				$db->query("INSERT INTO jf_cv_vjestina (id, cv, vjestina) VALUES ('null', {$this->id}, $item)") or die(mysqli_error($db));
		}

		public function spremljen_cv(){
			global $db;
			$db->query("UPDATE jf_cv SET unesen_cv = 1, odobren = 0 WHERE id = {$this->id}");
		}
	}
?>
