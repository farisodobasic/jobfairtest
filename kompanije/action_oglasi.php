<?php
	require_once('../brains/global.php');
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		if($_POST){
			switch($_POST['action']){

				/*Dodavanje oglasa*/
				case 'dodaj-oglas':
					$nazivPozicije = $db->escape_string($_POST['nazivPozicije']);
					$opisPozicije = $db->escape_string($_POST['opisPozicije']);
					$konkursBegin = $db->escape_string($_POST['konkursBegin']);
					$konkursEnd = $db->escape_string($_POST['konkursEnd']);
					$brojPozicija = $db->escape_string($_POST['brojPozicija']);
					$kategorija = $db->escape_string($_POST['kategorija']);

					$vjestine 	= $_POST['vjestine'];
					var_dump($_POST['vjestine']);

					$kveri = $db->query("INSERT INTO jf_oglasi (id, naziv_pozicije, opis_pozicije, konkurs_begin,
													   konkurs_end, broj_pozicija, kategorija, id_kompanije, status)
						VALUES ('null', '{$nazivPozicije}', '{$opisPozicije}', '{$konkursBegin}',
								'{$konkursEnd}', '{$brojPozicija}', '{$kategorija}', {$_SESSION['id_kompanije']}, 1)");

					if ($kveri){
						echo "uspjelo";

						/* Vezanje vještina za oglas */
						if(isset($_POST['vjestine']) && count($_POST['vjestine']) > 0){
							$oglas = $db->insert_id;
							foreach($_POST['vjestine'] as $vjes){
								$db->query("INSERT INTO jf_oglas_vjestina (id, oglas, vjestina) VALUES ('null', {$oglas}, {$vjes})") or die(mysqli_error($db));
								echo "Ubacio sam jednom.";
							}
						}else{
							echo "nema";
						}
					}
					else {
						echo "neuspjelo\r\n";
						echo mysqli_error($db);
					}


				break;

				/*Izmjena (update) oglasa*/
				case 'izmijeni-oglas':
					$idOglasa = $db->escape_string($_POST['id_oglasa']);
					$nazivPozicije = $db->escape_string($_POST['nazivPozicije']);
					$opisPozicije = $db->escape_string($_POST['opisPozicije']);
					$konkursBegin = $db->escape_string($_POST['konkursBegin']);
					$konkursEnd = $db->escape_string($_POST['konkursEnd']);
					$brojPozicija = $db->escape_string($_POST['brojPozicija']);
					$kategorija = $db->escape_string($_POST['kategorija']);
					$kveri = $db->query("UPDATE jf_oglasi SET naziv_pozicije = '{$nazivPozicije}',
													 opis_pozicije = '{$opisPozicije}',
													 konkurs_begin = '{$konkursBegin}',
													 konkurs_end = '{$konkursEnd}',
													 broj_pozicija = '{$brojPozicija}',
													 kategorija = '{$kategorija}'
												 WHERE id = {$idOglasa}");
				 if ($kveri){
 						echo "uspjelo";

						/* Brisanje veza sa oglasima */
						$db->query("DELETE FROM jf_oglas_vjestina WHERE oglas = {$idOglasa}");

						/* Vezanje vještina za oglas */
						if(isset($_POST['vjestine']) && count($_POST['vjestine']) > 0){
							foreach($_POST['vjestine'] as $vjes)
								if($db->query("INSERT INTO jf_oglas_vjestina (id, oglas, vjestina) VALUES ('null', {$idOglasa}, {$vjes})"));
						}
 					}
 					else {
 						echo "neuspjelo\r\n";
 						echo mysqli_error($db);
 					}

				break;

				case 'obrisi-oglas':
					$id_oglasa = $db->escape_string($_POST['id']);
					$db->query("UPDATE jf_oglasi SET status=0 WHERE id={$id_oglasa}") or die(mysqli_error($db));

				break;

				case 'apliciraj':
					$id_oglasa 		= (int)$db->escape_string($_POST['oglas_id']);
					$id_korisnika = (int)$db->escape_string($_POST['id_korisnika']);

					$db->query("INSERT INTO jf_aplikacije (id_oglasa, id_korisnika)
											VALUES ({$id_oglasa},{$id_korisnika})");
				break;
			}
		}
		else {
			switch($_GET['action']){
				case 'pokupi-oglase':
					$id_oglasa = (int)$db->escape_string($_GET['id_oglasa']);
					$kveri = $db->query("SELECT * FROM jf_oglasi WHERE id={$id_oglasa}")->fetch_assoc();
					echo json_encode($kveri);
				break;
			}
		}
	}
?>
