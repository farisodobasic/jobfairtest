-<?php
	class Kompanija {
		public $id = null;
		public $naziv = null;
		public $webstranica = null;
		public $email = null;
		public $adresa = null;
		public $telefon = null;
		public $logo1 = null;
//		public $logo2 = null;
		public $imaLiProfil = null;
		public $brZaposlenih = null;
		public $minGodStudija = null;
		public $iskustvo = null;

		public $djelatnost = null;
		public $trziste = array();
		public $vjestine = array();
		public $kadar = array();
		public $jezik = array();

		public function dodaj($naziv, $webstranica, $email, $adresa, $telefon, $kadar, $logo1,/* $logo2,*/ $imaLiProfil, $djelatnost, $brZaposlenih, $trziste, $minGodStudija, $vjestine, $jezik, $iskustvo){
			global $db;
			global $url_home;

			// OSNOVNI ATRIBUTI -- FALI LOGO2
			$check = $db->query("INSERT INTO jf_kompanije (id, naziv, web, mail, telefon, adresa, logo, profil, broj_zaposlenih, godina_studija, iskustvo) values('null', '{$naziv}','{$webstranica}','{$email}','{$telefon}','{$adresa}','{$logo1}','{$imaLiProfil}','{$brZaposlenih}','{$minGodStudija}','{$iskustvo}')");

			$getKompanija = $db->insert_id;

			$check = $db->query("INSERT into jf_kompanije_djelatnost (id, kompanija, djelatnost) values ('null', '{$getKompanija}','{$djelatnost}')");		

			foreach ($trziste as $t) {
				$check = $db->query("INSERT into jf_kompanije_trziste (id, kompanija, trziste) values ('null', '{$getKompanija}','{$t}')");
			}

			foreach ($vjestine as $v) {
				$check = $db->query("INSERT into jf_kompanije_vjestina (id, kompanija, vjestina) values ('null', '{$getKompanija}','{$v}')");
			}

			foreach ($kadar as $k) {
				$check = $db->query("INSERT into jf_kompanije_kadar (id, kompanija, kadar) values ('null', '{$getKompanija}','{$k}')");
			}

			foreach ($jezik as $j) {
				$check = $db->query("INSERT into jf_kompanije_jezik (id, kompanija, jezik) values ('null', '{$getKompanija}','{$j}')");
			}
		} 

		public function izmijeni($naziv, $webstranica, $email, $adresa, $telefon, $kadar, $logo1, $logo2, $imaLiProfil, $djelatnost, $brZaposlenih, $trziste, $minGodStudija, $vjestine, $jezik, $iskustvo){
			global $db;
//FALI LOGO2
			$check = $db->query("UPDATE jf_kompanije SET 
				naziv='{$naziv}', 
				web='{$webstranica}', 
				mail='{$email}', 
				telefon='{$telefon}', 
				adresa='{$adresa}', 
				logo='{$logo1}', 
				profil='{$imaLiProfil}', 
				broj_zaposlenih={$brZaposlenih}, 
				godina_studija='{$minGodStudija}', 
				iskustvo='{$iskustvo}' 
					WHERE id =  {$this->id}");

			/* Updateovanje djeltnosti */
			$db->query("UPDATE jf_kompanije_djelatnost SET djelatnost = {$djelatnost} WHERE kompanija = $this->id");			

			/* Updateovanje tržišta */
			$check = $db->query("DELETE from jf_kompanije_trziste where kompanija = $this->id");
			foreach ($trziste as $t) {
				$check = $db->query("INSERT into jf_kompanije_trziste (id, kompanija, trziste) values ('null', '{$this->id}','{$t}')");
			}

			/* Updateovanje vještina */
			$check = $db->query("DELETE from jf_kompanije_vjestina where kompanija = $this->id");
			foreach ($vjestine as $v) {
				$check = $db->query("INSERT into jf_kompanije_vjestina (id, kompanija, vjestina) values ('null', '{$this->id}','{$v}')");
			}

			/* Updatevoanje kadra */
			$check = $db->query("DELETE from jf_kompanije_kadar where kompanija = $this->id");
			foreach ($kadar as $k) {
				$check = $db->query("INSERT into jf_kompanije_kadar (id, kompanija, kadar) values ('null', '{$this->id}','{$k}')");
			}

			/* Updateovanje jezika */
			$check = $db->query("DELETE from jf_kompanije_jezik where $this->id = kompanija");
			foreach ($jezik as $j) {
				$check = $db->query("INSERT into jf_kompanije_jezik (id, kompanija, jezik) values ('null', '{$this->id}','{$j}')");
			}
		} 

		public function izlistaj(){
				global $db;
				//fali logo2
				$check = $db->query("SELECT naziv, web, mail, telefon, adresa, 
					logo, profil, broj_zaposlenih, 
					godina_studija, iskustvo, jf_kompanije_djelatnost.djelatnost as djelatnost_id FROM jf_kompanije 
					LEFT JOIN jf_kompanije_djelatnost ON jf_kompanije_djelatnost.kompanija = jf_kompanije.id
					WHERE jf_kompanije.id='$this->id'")->fetch_assoc() or die(mysqli_error());

				$this->naziv 			= $check['naziv'];
				$this->webstranica 		= $check['web'];
				$this->email 			= $check['mail'];
				$this->telefon 			= $check['telefon'];
				$this->adresa 			= $check['adresa'];
				$this->logo1 			= $check['logo'];
			//	$this->logo2 			= $check['logo2'];
				$this->imaLiProfil 		= $check['profil'];
				$this->brZaposlenih 	= $check['broj_zaposlenih'];
				$this->minGodStudija	= $check['godina_studija'];
				$this->iskustvo 		= $check['iskustvo'];
				$this->djelatnost 		= $check['djelatnost_id'];

				/* Dobjianje trzista koje cemo ubaciti u array trzista */
				$get_trziste 	= $db->query("SELECT trziste from jf_kompanije_trziste WHERE kompanija = $this->id");
				while($row = $get_trziste->fetch_assoc()) $this->trziste[] = $row['trziste'];

				/* Dobijanje vjestina koje ćemo ubaciti u array vjestina */
				$get_vjestine  	= $db->query("SELECT vjestina from jf_kompanije_vjestina WHERE kompanija = $this->id");
				while($row = $get_vjestine->fetch_assoc()) $this->vjestine[] = $row['vjestina'];

				/* DObijanje kadra koji ćemo ubaciti u array sa kadrovima */
				$get_kadar 		= $db->query("SELECT kadar from jf_kompanije_kadar WHERE kompanija = $this->id");
				while($row = $get_kadar->fetch_assoc()) $this->kadar[]	= $row['kadar'];

				/* Dobijanje jezika koje ćemo ubaciti u array sa jezicima */
				$get_jezik		= $db->query("SELECT jezik from jf_kompanije_jezik WHERE kompanija = $this->id");
				while($row = $get_jezik->fetch_assoc())	$this->jezik[] = $row['jezik'];
		} 
	} 
?>
