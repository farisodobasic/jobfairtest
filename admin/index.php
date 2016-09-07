<?php
	require_once('../brains/global.php');
	require_once('../brains/global_admin.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	<title>JF Admin panel</title>
    	<link rel="stylesheet" type="text/css" href="../css/main.css"> 
    	<?php 
    	require_once('inc/html_head.php'); 
    	?>
	</head>

	<body>
        
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
<!--	  	<div id="dash">-->
	  		<!-- Ovdje idu kockice za podatke -->
<!--	  		<div id="subdash-kockice">
				<div class="step-h1"></div>
	  			<div id="gornji-red">
			  		<div class="dash-kockice" id="crvena">
			  			<div class="dash-subkockice" style="background-color: #FF5757; border-bottom-right-radius:4%;">
			  				<span class="glyphicon glyphicon-duplicate strelica"></span>
			  			</div>
		  				<label class="dash-podaci"> 3540 </label>
		  				<label class="dash-labele"> unesenih CV-eva </label>
			  		</div>
			  		<div class="dash-kockice" id="zuta">
			  			<div class="dash-subkockice" style="background-color: #FFE981; border-bottom-right-radius:4%;">
			  				<span class="glyphicon glyphicon-comment strelica"></span>
			  			</div>
		  				<label class="dash-podaci"> 89 </label>
		  				<label class="dash-labele"> oglasa za zapošljavanje </label>
			  		</div>
				</div>
				<div class="step-h2"></div>
				<div id="donji-red">
			  		<div class="dash-kockice" id="zelena">
			  			<div class="dash-subkockice" style="background-color: #73E373; border-bottom-right-radius:4%;">
			  				<span class="glyphicon glyphicon-eye-open strelica"></span>
			  			</div>
		  				<label class="dash-podaci"> 19041 </label>
		  				<label class="dash-labele"> pregleda JobFAIR stranice </label>
			  		</div> 
			  		
			  		<div class="dash-kockice" id="plava">
			  			<div class="dash-subkockice" style="background-color: #6A50BF; border-bottom-right-radius:4%;">
			  				<span class="glyphicon glyphicon-user strelica"></span>
			  			</div>
		  				<label class="dash-podaci"> 7246 </label>
		  				<label class="dash-labele"> jedinstvenih pregleda </label>
			  		</div>
		  		</div>
	  		</div>
	  		<div id="subdash-red"> -->
		  		<!-- Kockica sa nekim istaknutim podacima Google analytics-->
<!--	  				<div id="cv-dash-naslov-okvir">
		  				<label> Stranica u brojevima</label>
	  				</div>
	  			<div id="istaknuta-kockica">-->
	  				<!-- to do -->
<!--	  				<div class="dash-cv-podaci" id="vrh">
	  					<div class="dash-cv-box" style="background-color: #FF5757; float:left">
	  						<span class="glyphicon glyphicon-user"></span>
	  					</div>
	  					<p class="dash-cv-label">
	  						<strong>16</strong><br>unesenih CV-a danas
  						</p>
	  				</div>
	  				<div class="dash-cv-podaci">
	  					<div class="dash-cv-box" style="background-color: #FFE981">
	  						<span class="glyphicon glyphicon-user"></span>
	  					</div>
	  					<p class="dash-cv-label">
	  						<strong>218</strong><br>unesenih CV-a ove godine
  						</p>
	  				</div>
	  				<div class="dash-cv-podaci">
	  					<div class="dash-cv-box" style="background-color: #73E373">
	  						<span class="glyphicon glyphicon-edit"></span>
	  					</div>
	  				</div>
	  				<div class="dash-cv-podaci">
	  					<div class="dash-cv-box" style="background-color: #6A50BF">
	  						<span class="glyphicon glyphicon-search"></span>
	  					</div>
					</div>
	  				<div class="dash-cv-podaci">
	  					<div class="dash-cv-box" style="background-color: #FF5757">
	  						<span class="glyphicon glyphicon-education"></span>
	  					</div>
	  				</div>
	  				<div class="dash-cv-podaci">
	  					<div class="dash-cv-box" style="background-color: #FFE981">
	  						<span class="glyphicon glyphicon-tasks"></span>
	  					</div>
	  				</div>
	  				<div class="dash-cv-podaci">
	  					<div class="dash-cv-box" style="background-color: #73E373">
	  						<span class="glyphicon glyphicon-briefcase"></span>
	  					</div>
	  				</div>
	  				<div class="dash-cv-podaci" id="dno">
	  					<div class="dash-cv-box" style="background-color: #6A50BF">
	  						<span class="glyphicon glyphicon-thumbs-up"></span>
	  					</div>
					</div>
	  			</div>
	  		</div>
	--> <!-- 	</div>-->
	</body>