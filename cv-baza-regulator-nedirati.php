<?php
	require_once('brains/global.php');

	/* Šta u šta

		person => jf_cv							// DONE!!!!!!!!!!!!!!!!!!!!1
						idPreson => id
						ime => ime
						prezime => prezime
						grad => grad (staviti na broj, povezati sa tabelom gradovi)
						adresa => adresa
						emal => emal
						mobitel => mobitel
						datum_rodjenja => datum_rodjenja
						Spol_idSpol => spol
						drustvene_vjestine => ukinuti - uvrstiti ih pod ostalim vjetšinama, posebna kategorija,
												prilikom citanja iz baze regulistai
						organizacijske_vjestine => ista stvar kao i sa društvenim
						tehnicke_vjestine => to vec imamo
						ostale_vjestine => imamo
						vozacka_dozvola => vozacka_dozvola
						dodatne_informacije => dodatne_informacije
						maternji_jezik => maternji_jezik (staviti na broj, povezati sa tabelom jezici)
						part_time => part_time
						full_time => full_time
						praksa => praksa
						datum => azurirano (promijeniti na timestamp)
						odobren => odobren (promijeniti na bool)
						vrijeme_zaposlenja_idvrijeme_zaposlenja => vrijeme_zaposlenja
						score => score

		person_has_computerskill => jf_cv_vjestina // Done
						Person_idPerson => cv
						ComputerSkill_idComputerSkill => vjestina
						ocjena_skill => ukinuti

		spol => jf_spol // Done
				idSpol => id
				naziv => naziv

		vozacka_dozvola => jf_vozacka // Done
				idVozacka => id
				tip => tip

		vrijeme_zaposlenja => jf_vrijeme_zaposlenja // Done
				idVrijeme_zaposlenja => id
				vrsta => vrsta

		vrsta_posla => jf_vrsta_posla // Done
				idVrsta_posla => id
				Opis => vrsta

		language => jf_cv_jezik // Done
				idLanguage => id
				naziv => jezik (broj, id jezika)
				Person_idPerson => cv (broj)
				razumijevanje => razumijevanje
				govor => govor
				pisanje => pisanje

		napraviti: jf_jezici !napravljeno // DOne
				id, naziv

		job => jf_posao // Done
				idJob => id
				pozicija => pozicija
				aktivnosti => aktivnosti
				poslodavac => poslodavac
				Person_idPerson => cv
				start_date => start_date
				end_date => end_date
				Vrsta_posla_idVrsta_posla => vrsta_posla
				jos_traje => aktivno

		educationinstance => jf_edukacija // Done
				idEducaioninstance => id
				Person_idPerson => cv
				smjer => smjer
				godina_studija => godina_studija
				fakultet => fakultet (broj, povezati sa bazom jf_fakulteti) // Ima ih previse pa cemo napraviti alternativu
																				koja ce drzati ono sto su unosili, valjda cemo skontti
																				kako automatizovati prebacivanje
				start_Date => start_date
				end_date => end_date
				nazvi_srednje => naziv_srednje
				godina_upisa => godina_upisa
				godina_zavrsetka => godina_zavrsetka
				prosjek => prosjek
				grad_srednje => grad_srednje (broj, povezati sa jf_gradovi)
				smjer_srednje => smjer_srednje

		napraviti: jf_fakulteti // DOne
				id, naziv, grad

		napraviti: jf_gradovi // DOne
				id, naziv

		additional_education => jf_dodatna_edukacija  // Done
				id => id
				Person_idPerson => cv
				vrsta_edukacije => vrsta_edukacije
				start_date => start_date
				end_date => end_date
				opis_aktivnosti => opis_aktivnosti

	*/


	/*
	$get_person = $db_cv->query("SELECT person.*  FROM person
		LEFT JOIN language ON language.Person_idPerson = person.idPerson
	 LIMIT 0,1")->fetch_assoc();
	?><pre><?php
	var_dump($get_person);
	?></pre><?php*/

	/* završeno $comp_skills = $db_cv->query("SELECT * fROM computerskill");
	while($row = $comp_skills->fetch_assoc()){
		echo $row['opis']." ".$row['kategorija_idkategorija']." <br />";
		/*$db->query("INSERT INTO jf_vjestine (id, naziv, kategorija) VALUES ('null', '{$row['opis']}', {$row['kategorija_idkategorija']})");*/
	/* } */


	/* person to cv */
	//$get_all = $db_cv->query("SELECT * FROM person");
	$get_all = $db_cv->query("SELECT * fROM users");
	$i = 0;
	while($row = $get_all->fetch_assoc()){
/*		$db->query("UPDATE jf_cv SET password = '{$row['password']}' WHERE jf_cv.email = '{$row['username']}'");
		$i++; echo $i."<br />";*/

	//
		/*
		echo $row['id']."<br />".$row['fakultet_alternativa']."<br />";
		$faks = $row['fakultet_alternativa'];
		if($faks != ""){
			$get_id = $db->query("SELECT id FROM jf_fakulteti WHERE naziv = '{$faks}' LIMIT 0,1");
			$a = $get_id->fetch_assoc();
			$ajdi = $a['id'];
			echo $ajdi."<br />";
			if($ajdi > 0 && strlen($ajdi) > 0){
				echo "UPDATE jf_edukacija SET fakultet = {$ajdi} WHERE id = {$row['id']}"."<br />";
				$db->query("UPDATE jf_edukacija SET fakultet = {$ajdi} WHERE id = {$row['id']}") OR die(mysqli_error($db));
			}
		}

		/* Prebacivanje fakulteta */
		/*echo $row['fakultet']."<br />";
		if($row['fakultet'] != ""){
			$row['fakultet'] = str_replace("'", " ", $row['fakultet']);
			$row['fakultet'] = str_replace('"', " ", $row['fakultet']);

			$db->query("INSERT INTO jf_fakulteti (id, naziv) VALUES ('null', '{$row['fakultet']}')");
		}

		/*
			Prebacivanje dodatne edukacije
		foreach($row as $item) $item = $db->escape_string($item);
		echo $row['id']." <br />";
		$db->query("INSERT INTO jf_edukacija_dodatna (id, cv, vrsta_edukacije, start_date, end_date, opis_aktivnosti) VALUES
			({$row['id']}, {$row['Person_idPerson']}, '{$row['vrsta_edukacije']}', '{$row['start_date']}', '{$row['end_date']}',
				' {$row['opis_aktivnosti']} ')") or die(mysqli_error($db));
		*/

		/* Edukacija prebacivanje
		$grad_id;
		$get_grad_id = $db->query("SELECT id FROM jf_gradovi WHERE naziv = '{$row['grad_srednje']}'");
		if($get_grad_id->num_rows != 0){ $get_grad_id = $get_grad_id->fetch_assoc(); $grad_id = $get_grad_id['id']; }
			else $grad_id = 0;

		$godina_zavrsetka = date('Y', strtotime($row['godina_zavrsetka']));
		if($godina_zavrsetka < 0) $godina_zavrsetka == 0;

		$db->query("INSERT INTO jf_edukacija (id, cv, smjer, godina_studija, fakultet_alternativa, start_date, end_date,
			naziv_srednje, godina_upisa, godina_zavrsetka, prosjek, grad_srednje, smjer_srednje)
			VALUES
			({$row['idEducationInstance']}, {$row['Person_idPerson']}, '{$row['smjer']}', {$row['godina_studija']}, '{$row['fakultet']}',
				 '{$row['start_date']}', '{$row['end_date']}', '{$row['naziv_srednje']}', {$row['godina_upisa']},
				 {$godina_zavrsetka}, {$row['prosjek']}, {$grad_id}, '{$row['smjer_srednje']}')
		");

		*/
		/* Posao and stuff
		$db->query("INSERT INTO jf_posao (id, pozicija, aktivnosti, poslodavac, cv, start_date, end_date, vrsta_posla, aktivno)
			VALUES
			({$row['idJob']}, '{$row['pozicija']}', '{$row['aktivnosti']}', '{$row['poslodavac']}', {$row['Person_idPerson']}, '{$row['start_date']}',
				'{$row['end_date']}', {$row['Vrsta_posla_idVrsta_posla']}, {$row['jos_traje']})");
		*/

		/* Prebacivanje veze jezika i cv-jeva
		$jezik = (int)$row['naziv'];
		$db->query("INSERT INTO jf_cv_jezik (id, jezik, cv, razumijevanje, govor, pisanje) VALUES ({$row['idLanguage']}, {$jezik}, {$row['Person_idPerson']}, '{$row['razumijevanje']}', '{$row['govor']}', '{$row['pisanje']}')");
		*/

		/* Prebacivanje vještina
		$vjestina = $row['ComputerSkill_idComputerSkill'];
		$cv 		= $row['Person_idPerson'];
		$db->query("INSERT INTO jf_cv_vjestina (id, cv, vjestina) VALUES ('null', {$cv}, {$vjestina})");
		*/
	/*	echo $row['idPerson']."<br/>";

		$row['dodatne_informacije'] = str_replace("'", " ", $row['dodatne_informacije']);
		$row['dodatne_informacije'] = str_replace('"', " ", $row['dodatne_informacije']);

		//	kod za prebacivanje iz person u jf_cv
		$bosanski = array("Bosanski", "Bosanski jezik", "Bosanski/Hrvatski/Srpski",
			"bosanski,hrvatski,srpski", "Bosanski jezi", "Bosanski", "bosanski, hrvatski, srpski", "",
			"BHS", "Bosanski/hrvatski/srpski jezik", "Bosanski/Hrvatski", "BiH",
			"B-H-S jezik", "B-H-S", "bosansko, hrvatski, srpski jezik", "Bosnaki",
			"BHS jezik", "Bosansko, hrvatski i srpski jezik", "Bosansko, hrvatski i srpski",
			"Bosanski, Hrvatski", "Idemo", "aasds", "bosanski/srpski/hrvatski",
			"Bosansko - hrvatsko - srpski", "Bosansko, Srpsko,Hrvatski",
			"Bosanski / Srpski / Hrvatski", "Bosnian", "Bosansk", "boÅ¡njaÄki",
			"Bosanski, Srpski, Hrvatski", "Bosanski-hrvatski-srpski jezik",
			"Boanski", "Love", "Bos", "Bosnian language", "Bosanki",
			"Bosanksi", "BOSANSKI,HRVATSKI I SRPSKI JEZIK", "Bosnaski",
			"Bosnsnski", "Bosanki jezik", "Bosanski jezik", "Bosanski, NjemaÄki",
			"Bosanski i albanski", "Bosanski jezij", "Bosanaki", "BHS/Engleski",
			"Bosanaksi jezik", "Bosanski/Hrvatski/Srpski (BHS)", "bosanskii",
			"Bosanski, srpski i hrvatski jezak", "Bosanski,hrvatski, srpski jezik",
			"Bosansko Hercegovacki", "Bosanaski jezik", "B/H/S", "Bosanski, Srbski, Hrvatski",
			"Bosansko-hrvatski jezik", "Bosanski, hrvatski i srpski jezik", "Bosansko-hrvatsko-srpski",
			"jezici bivse Jugoslavije", "asdasd", "Bosanski,Hrtvatski,Srpski jezik i knjiÅ¾evnost",
			"abcd", "Biosanski", "Bosnaski jezik", "nulti", "test", "Crnogorski");
		$hrvatski = array("Hrvatski", "Hrvatski/Bosanski/Srpski", "Hrvatski, Bosanski", "Hrvatski/Srbski/Bosanski",
			"Hrvatski/Bosanski");
		$srpski = array("Srpski", "Srpskohrvatski, Bosanski, Hrvatski, Srpski", "Srpsko - Hrvatski", "Srpski jezik",
			"Srpski, Bosanski, Hrvatski");
		$njemacki = array("Njemacki");
		$turski = array("Turkish", "Turski");
		$arapski = array("Arabic");

		if(in_array($row['maternji_jezik'], $bosanski)) $id = 1;
			else if(in_array($row['maternji_jezik'], $hrvatski)) $id = 2;
				else if(in_array($row['maternji_jezik'], $srpski)) $id = 3;
					else if(in_array($row['maternji_jezik'], $njemacki)) $id = 5;
						else if(in_array($row['maternji_jezik'], $turski)) $id = 9;
							else if(in_array($row['maternji_jezik'], $arapski)) $id = 10;
								else $id = 11;

		$azurirano = time($row['datum']);

		if($row['odobren'] == "yes") $odobren = 1;
			else $odobren = 0;

		$get_grad = $db->query("SELECT id FROM jf_gradovi WHERE naziv = '{$row['grad']}'");
			if($get_grad->num_rows != 0){ $grad1 = $get_grad->fetch_assoc(); $grad = $grad1['id']; }
				else $grad = 128;

		$db->query("INSERT INTO jf_cv
			(id, ime, prezime, grad, adresa, email, mobitel, datum_rodjenja, spol, vozacka_dozvola, dodatne_informacije, maternji_jezik,
				part_time, full_time, praksa, azurirano, odobren, vrijeme_zaposlenja, score)

			VALUES

			({$row['idPerson']}, '{$row['ime']}', '{$row['prezime']}', {$grad}, '{$row['adresa']}', '{$row['email']}', '{$row['mobitel']}',
				'{$row['datum_rodjenja']}', {$row['Spol_idSpol']}, {$row['vozacka_dozvola']}, '{$row['dodatne_informacije']}', {$id}, {$row['part_time']},
				{$row['full_time']}, {$row['praksa']}, {$azurirano}, {$odobren},  {$row['vrijeme_zaposlenja_idvrijeme_zaposlenja']}, {$row['score']})
		") or die(mysqli_error($db));
*/



	}
?>
