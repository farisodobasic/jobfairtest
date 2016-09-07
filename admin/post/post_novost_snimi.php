<?php
		if(isset($_POST['snimi']) && !isset($_GET['novost'])){
			/* Ukoliko se prvi put snima vijest / ukoliikko je nova vijest */
			$naslov 	= $_POST['n_naslov'];
			$opis 		= $_POST['n_opis'];
			$sadrzaj 	= $_POST['n_sadrzaj'];

			/*
				Validacija, odnosno uslov za snimanje novosti:
					> Potrebno da su ispunjeni naslov, opis i sadrzaj
					> Potrebno da je odabrana naslovna slika
			*/

			$validacija = false;

			if(strlen($naslov) > 0 && strlen($opis) > 0 && strlen($sadrzaj)) 	// Provjerava ispunjenost
				if(!empty($_FILES['naslovna_slika']['tmp_name'])) 				// Provjerava da li je doabrano
					$validacija = true;

			if($validacija){
				/* Napravimo novost u bazi */
				$novost->dodaj_novost($naslov, $opis, $sadrzaj);

				/* Dodjelimo joj naslovnu sliku */
		       	$location = $_FILES['naslovna_slika']['tmp_name'];
		       	$novost->naslovna_slika($location);

		       	/* Provjeravanje glerije i upload iste */
		       	if(!empty($_FILES['galerija'])){

			        // Redni broj slike, ako vec postoje uzmi za jedan veci od tog, ako ne uzmi 1
			        $id_novosti = $novost->get_id();
			        $get_i = $db->query("SELECT broj FROM jf_galerije WHERE post = {$id_novosti} ORDER BY broj DESC LIMIT 0,1")->fetch_assoc();
			        if($get_i['broj'] == null || $get_i['broj'] == '') $i = 1;
			          else $i = $get_i['broj'] + 1;

			        // Dodaj u galerije svaku sliku poedinacno
			        foreach($_FILES['galerija']['tmp_name'] as $location){
			          if(!empty($location)){
			            $novost->galerija_add($location, $i);
			            $i++;
			          }
			        }
      			}
		    }
		}

		if(isset($_GET['novost'])){
			/* Ukoliko se snima editovana vijest */
			$editovana_novost = new Novost;
			$editovana_novost->initialize_novost((int)$_GET['novost']);

			if(isset($_POST['snimi'])){
				$naslov 	= $_POST['n_naslov'];
				$opis 		= $_POST['n_opis'];
				$sadrzaj 	= $_POST['n_sadrzaj'];

				$validacija = false;

				if(strlen($naslov) > 0 && strlen($opis) > 0 && strlen($sadrzaj)) 	// Provjerava ispunjenost
					$validacija = true;

				if($validacija)
					$editovana_novost->snimi($naslov, $opis, $sadrzaj);

				if($_POST['nova_naslovna'] == 1){
					/* Dodjelimo joj naslovnu sliku */
			       	$location = $_FILES['naslovna_slika']['tmp_name'];
			       	$editovana_novost->naslovna_slika($location);
				}

				/* Provjeravanje glerije i upload iste */
		       	if(!empty($_FILES['galerija'])){

			        // Redni broj slike, ako vec postoje uzmi za jedan veci od tog, ako ne uzmi 1
			        $id_novosti = $editovana_novost->get_id();
			        $get_i = $db->query("SELECT broj FROM jf_galerije WHERE post = {$id_novosti} ORDER BY broj DESC LIMIT 0,1")->fetch_assoc();
			        if($get_i['broj'] == null || $get_i['broj'] == '') $i = 1;
			          else $i = $get_i['broj'] + 1;

			        // Dodaj u galerije svaku sliku poedinacno
			        foreach($_FILES['galerija']['tmp_name'] as $location){
			          if(!empty($location)){
			            $editovana_novost->galerija_add($location, $i);
			            $i++;
			          }
			        }
      			}
			}

			
		}
?>
