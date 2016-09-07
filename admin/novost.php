<?php
	require_once('../brains/global.php');
	require_once('../brains/global_admin.php');
	//session_destroy();

	// Inicijaliziraj klasu novosti
	$novost = new Novost;

	/* Snimanje vijesti */
	require_once('post/post_novost_snimi.php');
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>JF Admin panel</title>

    <?php require_once('inc/html_head.php'); ?>
  </head>
  <body>
  	<!-- Header -->

<nav class="navbar navbar-default">
	  	<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="index.php">Jobinator</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
<!--		        <li><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>-->
		        <li class="active"><a href="novost.php">Nova novost</a></li>
		        <li><a href="postavke.php">Postavke</a></li>
		        <li><a href="kompanije.php">Kompanije</a></li>
<!--		        <li><a href="#">CV</a></li>-->
		      </ul>
		      
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">Log out</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
	</nav>

	<!-- End of header -------------------------------------------------------->

	<div class="col-md-4 col-sm-4">
		<table class="table table-bordered">
			<tr class="info">
				<td class="col-md-12 col-sm-12"><i class="glyphicon glyphicon-file"></i> Posljednje novosti</td>
				<td></td>
			</tr>
			<tr class="active">
				<td class="col-md-9 col-sm-9">Naslov novosti</td>
				<td class="col-md-3 col-sm-3" style="text-align:right;">Datum</td>
			</tr>
			<?php
				/* Izlistavanje novosti u lijevoj koloni */
				$lista_novosti = $db->query("SELECT id, naslov, vrijeme FROM jf_novosti ORDER BY vrijeme DESC LIMIT 0,20");
				while($row = $lista_novosti->fetch_assoc()){
			?>
	  			<tr>
	  				<td class="col-md-9 col-sm-9"><a href="<?=$url_home;?>admin/novost.php?novost=<?=$row['id'];?>"><?=$row['naslov'];?></a></td>
	  				<td class="col-md-3 col-sm-3" style="text-align:right;"><?=date('d.m.Y', $row['vrijeme']);?></td>
	  			</tr>
  			<?php
  				}
  			?>
		</table>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="col-md-4 col-sm-4">
			<div class="form-group col-sm-12">
	        	<label class="form-group-addon">Naslov</label>
	        	<input type="text" class="form-control" placeholder="Naslov" id="n_naslov" name="n_naslov" value="<?php if(isset($editovana_novost)) echo $editovana_novost->get_naslov(); ?>">
	      	</div>
	      	<div class="form-group col-sm-12">
	        	<label class="form-group-addon">Opis</label>
	        	<textarea type="text" class="form-control" placeholder="Opis novosti" id="n_opis" name="n_opis"><?php if(isset($editovana_novost)) echo $editovana_novost->get_opis(); ?></textarea>
	      	</div>
	      	<div class="form-group col-sm-12">
	        	<label class="form-group-addon">Sadrzaj</label>
	        	<textarea type="text" class="form-control" placeholder="Opis novosti" id="n_opis" style="height:320px;" name="n_sadrzaj"><?php if(isset($editovana_novost)) echo $editovana_novost->get_sadrzaj(); ?></textarea>
	      	</div>
	      	<input class="btn btn-primary pull-right col-sm-3" style="margin-right:15px;" type="submit" name="snimi" value="Snimi" />
		</div>
		<div class="col-md-4 col-sm-4">
			<div class="form-group">
			    <label for="naslovna_slika">Naslovna slika</label>
			    <input type="file" id="naslovna_slika" name="naslovna_slika">
			    <p class="help-block">Odaberite naslovnu sliku.</p>
			    <input type="hidden" id="nova_naslovna" name="nova_naslovna" value="0" />
			</div>
			
			<?php if(isset($editovana_novost)): ?>
			<div class="form-group naslovna-preview">
				<img height="180" src="<?php if(isset($editovana_novost)) echo $url_srednja.$editovana_novost->get_id();?>.jpg" />
			</div>
			<?php endif; ?>

			<div class="form-group">
			    <label for="naslovna_slika">Galerija</label>
			    <input type="file" class="galerija" name="galerija[]" multiple />
			    <p class="help-block">Odaberite slike za galeriju.</p>
			</div>

			<?php if(isset($editovana_novost) && $editovana_novost->galerija == true): ?>
			<div class="form-group galerija-preview">
				<?php
					$novost = $editovana_novost->get_id();
					$slike_galerija = $db->query("SELECT broj FROM jf_galerije WHERE id = {$editovana_novost}");
					while($row = $slike_galerija->fetch_assoc()){
						?>
							<img src="<?=$url_gal_thumb;?><?=$editovana_novost->get_id();?>.<?=$row['id'];?>.jpg" width="100"/>
						<?php
					}
				?>
			</div>
			<?php endif; ?>
		</div>
	</form>
  </body>
 </html>
