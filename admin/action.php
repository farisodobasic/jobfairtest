<?php
	require_once('../brains/global.php');
	require_once('../brains/global_admin.php');

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		switch ($_POST['action'])
		{
			/* Deaktiviranje administratorski ovlasti */
			case 'admin_deaktiviraj':
				$id = (int)$_POST['id'];
				$db->query("UPDATE jf_admin SET aktivnost = 0 WHERE id = {$id}");
			break;

			/* Aktiviranje administratorskih ovlasti */
			case 'admin_aktiviraj':
				$id = (int)$_POST['id'];
				$db->query("UPDATE jf_admin SET aktivnost = 1 WHERE id = {$id}");
			break;

			/* Brisanje administratora */
			case 'admin_delete':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_admin WHERE id = {$id}");
			break;

			/* Dodavanje djelatnosti */
			case 'dodaj_djelatnost':
				$djelatnost = $db->escape_string($_POST['djelatnost']);
				$db->query("INSERT INTO jf_djelatnost (id, naziv) VALUES ('null', '{$djelatnost}')");
				echo $db->insert_id;
			break;

			/* Brisanje djelatnosti */
			case 'delete_djelatnost':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_djelatnost WHERE id = {$id}");
			break;

			/* Dodavanje kadra */
			case 'dodaj_kadar':
				$kadar = $db->escape_string($_POST['kadar']);
				$db->query("INSERT INTO jf_kadar (id, kadar) VALUES ('null', '{$kadar}')");
				echo $db->insert_id;
			break;

			/* Brisanje kadra */
			case 'delete_kadar':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_kadar WHERE id = {$id}");
			break;

			/* Dodavanje trzista */
			case 'dodaj_trziste':
				$trziste = $db->escape_string($_POST['trziste']);
				$db->query("INSERT INTO jf_trziste (id, trziste) VALUES ('null', '{$trziste}')");
				echo $db->insert_id;
			break;

			/* Brisanje trzista */
			case 'delete_trziste':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_trziste WHERE id = {$id}");
			break;

			/* Dodavanje kategorije */
			case 'dodaj_kategoriju':
				$kategorija = $db->escape_string($_POST['kategorija']);
				$db->query("INSERT INTO jf_vjestine_kategorija (id, kategorija) VALUES ('null', '{$kategorija}')");
				echo $db->insert_id;
			break;

			/* Brisanje kategorije */
			case 'delete_kategorija':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_vjestine_kategorija WHERE id = {$id}");
			break;

			/* Dodavanje vjestine */
			case 'snimi_vjestinu':
				$vjestina 	= $db->escape_string($_POST['vjestina']);
				$kategorija = (int)$_POST['kategorija'];
				$db->query("INSERT INTO jf_vjestine (id, naziv, kategorija) VALUES ('null', '{$vjestina}', {$kategorija})");
				echo $db->insert_id;
			break;

			/* Brisanje vještine */
			case 'delete_vjestina':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_vjestine WHERE id = {$id}");
			break;

			/* Ucitavanje vjestina - paginacija */
			case 'ucitaj_vjestine':
				$page	= (int)$_POST['page'];
				$filter	= (int)$_POST['filter'];

				$pocetak = ($page - 1) * 10;

				$query_add = "";
				if($filter != null)
					$query_add = ' WHERE jf_vjestine.kategorija = '.$filter." ";

				$vjestine = $db->query("SELECT jf_vjestine.naziv, jf_vjestine.id, jf_vjestine_kategorija.kategorija 
					FROM jf_vjestine LEFT JOIN jf_vjestine_kategorija ON jf_vjestine.kategorija = jf_vjestine_kategorija.id 
					".$query_add." ORDER BY id DESC LIMIT {$pocetak}, 10");

				?>
				<table class="table table-bordered vjestine-tab">
					<tr class="danger">
		                <td class="col-md-5 col-sm-5"><i class="glyphicon glyphicon-screenshot"></i> Vještine</td>
		                <td class="col-md-5 col-sm-5"></td>
		                <td class="col-md-2 col-sm-2"></td>
		            </tr>
		            <tr class="active">
		                <td class="col-md-5 col-sm-5">Naziv</td>
		                <td class="col-md-5 col-sm-5">Kategorija</td>
		                <td class="col-md-2 col-sm-2" style="text-align:right;">Akcija</td>
		            </tr>
				<?php

				while($row = $vjestine->fetch_assoc()){
	                  ?>
	                  <tr>
	                    <td class="col-md-5"><?=$row['naziv'];?></td>
	                    <td class="col-md-5"><?=$row['kategorija'];?></td>
	                    <td class="col-md-2" style="text-align:right;">
	                      <a href="javascript:delete_vjestina(<?=$row['id'];?>);" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
	                    </td>
	                  </tr>
	                  <?php
                }
                ?></table><?php

			break;

		}
	}
?>