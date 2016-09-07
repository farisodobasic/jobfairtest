<?php
	class Novost {

		private $id;
		private $naslov;
		private $opis;
		private $sadrzaj;
		private $vrijeme;
		public $galerija;

		public function dodaj_novost($naslov, $opis, $sadrzaj){
			/* globalne */
			global $db;
			global $url_home;

			/* Novosti parametri */
			$naslov 	= $db->escape_string($naslov);
			$opis 		= $db->escape_string($opis);
			$sadrzaj 	= $db->escape_string(stripslashes($sadrzaj));
			$vrijeme	= time();

			/* Novosti unos u bazu */
			$db->query("INSERT INTO jf_novosti (id, naslov, opis, sadrzaj, vrijeme) VALUES ('null', '{$naslov}', '{$opis}', '{$sadrzaj}', {$vrijeme})");

			/* Get ID novosti i dodjeljivanje ID-a klasi */
			$get_id = $db->query("SELECT id FROM jf_novosti WHERE naslov = '{$naslov}' AND opis = '{$opis}' AND vrijeme = {$vrijeme} LIMIT 0,1");
			$get_id = $get_id->fetch_assoc() or die(mysqli_error($db));

			/* DOdijeli klasi */
			$this->id 		= $get_id['id'];
			$this->naslov 	= $naslov;
			$this->sadrzaj 	= $sadrzaj;
			$this->vrijeme	= $vrijeme;

			//header('Location: '.$url_home.'admin/novost.php?novost='.$this->id);
		}

		public function naslovna_slika($location){
			/* globalne */
			global $db;
			global $dimensions;

			global $media_path;
			global $media_url;

			global $n_velika;
			global $n_srednja;
			global $n_mala;

			// Provjera da li postoji taj fajl
			if(!file_exists($location)) { echo 'No such file ('.$location.')'; break; }
			// Preuzimanje dimenzija fajla
			list($width, $height) = getimagesize($location);
			// Kopiranje originala slike
			copy($location, $media_path.'naslovna/media.main_'.$this->id.'.jpg');

				$v_location = $n_velika.$this->id.'.jpg';
				$s_location = $n_srednja.$this->id.'.jpg';
				$k_location = $n_mala.$this->id.'.jpg';

				foreach($dimensions as $dim){
					if(file_exists($dim[2].$this->id.'.jpg')) unlink($dim[2].$this->id.'.jpg');
					crop_algorithm($location, $dim[2].$this->id.'.jpg', $dim[0], $dim[1]);
				}

				/*
					Update tabele nakon dodane slike.
					U suštini, svaka novost bi trebala da ima u bazi naslovna = 1.
					Obzirom da će neko nekada koristiti ovu bazu, možda mu budu trebale i vijesti bez slike, pa da može manipulisati.
				 */
				$db->query("UPDATE jf_novosti SET naslovna = 1 WHERE id = {$this->id}");

		}

		/* Uključi galeriju */
		private function gallery_on(){
			global $db;
			$db->query("UPDATE jf_novosti SET galerija = 1 WHERE id = {$this->id}");
		}

		/* Dodavanje slike u galeriju */
		public function galerija_add($location, $i){
			global $db;
			global $media_url;
			global $media_path;

			global $gal_path;
			global $gal_thumb;

			// Kopiranje originalne slike i snimanje thumbnaila
			gallery_save($location, $gal_path.$this->id.'.'.$i.'.jpg');
			crop_algorithm($location, $gal_thumb.$this->id.'.'.$i.'.jpg', 120, 120);

			if($i == 1) $this->gallery_on();

			// Upload galerije
			$db->query("INSERT INTO jf_galerije (id, post, broj) VALUES ('null', {$this->id}, {$i})");
		}

		/* Inicijalizacija sadržaja klase */
		public function initialize_novost($id){
				global $db;

				$this->id = $id;
				$get_novost = $db->query("SELECT * FROM jf_novosti WHERE id = {$this->id}")->fetch_assoc();

				/* Postavljanje sadržaja */
				$this->naslov 	= $get_novost['naslov'];
				$this->opis 	= $get_novost['opis'];
				$this->sadrzaj 	= $get_novost['sadrzaj'];

				/* Provjeravanje galerija */
				if($get_novost['galerija'] == 1) $this->galerija = true;
					else $this->galerija = false;
		}

		/* Snimanje editoane novosti */
		public function snimi($naslov, $opis, $sadrzaj){
			global $db;

			$naslov 	= $db->escape_string($naslov);
			$opis 		= $db->escape_string($opis);
			$sadrzaj 	= $db->escape_string($sadrzaj);

			$db->query("UPDATE jf_novosti SET naslov = '{$naslov}', opis = '{$opis}', sadrzaj = '{$sadrzaj}' WHERE id = {$this->id}");
		}


		/* Geters and seters */
		public function set_naslov($naslov)		{ $this->naslov = $naslov; }
		public function set_opis($opis)			{ $this->opis = $opis; }
		public function set_sadrzaj($sadrzaj)	{ $this->sadrzaj = $sadrzaj; }
		public function set_id($id)				{ $this->id = $id; }

		public function get_id()		{ return $this->id; }
		public function get_naslov() 	{ return $this->naslov; }
		public function get_opis() 		{ return $this->opis; }
		public function get_sadrzaj() 	{ return $this->sadrzaj; }
		public function get_gallery()	{ return $this->galerija; }

		public function update(){

		}
	}
?>
