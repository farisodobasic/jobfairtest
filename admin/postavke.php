<?php
  require_once('../brains/global.php');
  require_once('../brains/global_admin.php');

  /* Post akcije koje koristimo */
  require_once('post/post_admin_snimi.php');

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
  <!-- End of header -------------------------------------------------------->

    <!-- Postavke navigation -->
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

      
    <div class="col-md-12">
      <ul id="nav-postavke" class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#korisnici" aria-controls="korisnici" role="tab" data-toggle="tab">Korisnici</a></li>
        <li role="presentation"><a href="#kompanije" aria-controls="kompanije" role="tab" data-toggle="tab">Kompanije</a></li>
        <li role="presentation"><a href="#kategorije" aria-controls="kategorije" role="tab" data-toggle="tab">Kategorije</a></li>
        <li role="presentation"><a href="#vjestine" aria-controls="studenti" role="tab" data-toggle="tab">Vještine</a></li>
      </ul>

      <div class="tab-content" style="border:1px solid #d5d5d5;border-top:0px;">
        <!-- Administratori postavke -->
        <div role="tabpanel" class="tab-pane active" id="korisnici" style="padding-top:20px;">
          <!-- Tabela administratora -->
          <div class="col-md-4 col-sm-4">
            <table class="table table-bordered">
              <tr class="info">
                <td class="col-md-7 col-sm-7"><i class="glyphicon glyphicon-sunglasses"></i> Aktivni administratori</td>
                <td class="col-md-2 col-sm-2"></td>
                <td class="col-md-3 col-sm-3"></td>
              </tr>

              <tr class="active">
                <td class="col-md-7 col-sm-7">E-mail</td>
                <td class="col-md-2 col-sm-2">Vrsta</td>
                <td class="col-md-3 col-sm-3" style="text-align:right;">Akcija</td>
              </tr>

              <?php
                /* Ispis aktivnih administratora */
                $aktivni = $db->query("SELECT * FROM jf_admin WHERE aktivnost = 1");
                if($aktivni->num_rows == 0){
                  ?>
                    <tr>
                      <td class="col-md-7 col-sm-7">Nema aktivnih administratora</td>
                      <td class="col-md-2 col-sm-2"></td>
                      <td class="col-md-3 col-sm-3"></td>
                    </tr>
                  <?php
                }else{
                  while($row = $aktivni->fetch_assoc()){
                    ?>
                    <tr>
                      <td class="col-md-7 col-sm-7"><?=$row['email'];?></td>
                      <td class="col-md-2 col-sm-2"><?=$row['privilegija'];?></td>
                      <td class="col-md-3 col-sm-3" style="text-align:right;">
                          <a href="<?=$url_home;?>admin/postavke.php?admin=<?=$row['id'];?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        <?php
                          if($_SESSION['admin'] != $row['id']):
                        ?>
                          <a href="javascript:admin_deaktiviraj(<?=$row['id'];?>)" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Deaktiviraj"><i class="glyphicon glyphicon-remove"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>
            </table>

            <table class="table table-bordered">
              <tr class="danger">
                <td class="col-md-7 col-sm-7"><i class="glyphicon glyphicon-sunglasses"></i> Nektivni administratori</td>
                <td class="col-md-2 col-sm-2"></td>
                <td class="col-md-3 col-sm-3"></td>
              </tr>

              <tr class="active">
                <td class="col-md-7 col-sm-7">E-mail</td>
                <td class="col-md-2 col-sm-2">Vrsta</td>
                <td class="col-md-3 col-sm-3" style="text-align:right;">Akcija</td>
              </tr>

              <?php
                /* Ispis neaktivnih administratora */
                $neaktivni = $db->query("SELECT * FROM jf_admin WHERE aktivnost = 0");
                if($neaktivni->num_rows == 0){
                  ?>
                    <tr>
                      <td class="col-md-7 col-sm-7">Nema neaktivnih administratora</td>
                      <td class="col-md-2 col-sm-2"></td>
                      <td class="col-md-3 col-sm-3"></td>
                    </tr>
                  <?php
                }else{
                  while($row = $neaktivni->fetch_assoc()){
                    ?>
                    <tr>
                      <td class="col-md-7 col-sm-7"><?=$row['email'];?></td>
                      <td class="col-md-2 col-sm-2"><?=$row['privilegija'];?></td>
                      <td class="col-md-3 col-sm-3" style="text-align:right;">
                        <a href="<?=$url_home;?>admin/postavke.php?admin=<?=$row['id'];?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        <?php
                          if($_SESSION['admin'] != $row['id']):
                        ?>
                          <a href="javascript:admin_aktiviraj(<?=$row['id'];?>)" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Aktiviraj"><i class="glyphicon glyphicon-check"></i></a>
                        <?php endif; ?>
                        <a href="javascript:admin_delete(<?=$row['id'];?>);" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>
            </table>

          </div>

          <!-- Forma dodavanja i editovanja adminisrtratora -->
          <div class="col-md-4 col-sm-4" >
            <form action="" method="post">
              <div class="form-group col-sm-12">
                <label class="form-group-addon">E-mail</label>
                <input type="text" class="form-control" placeholder="E-mail" id="a_mail" name="a_mail" value="<?php if(isset($editovan_admin)) echo $editovan_admin->mail; ?>">
              </div>

              <div class="form-group col-sm-12">
                <label class="form-group-addon">Novi password</label>
                <input type="password" class="form-control" placeholder="Password" id="a_password" name="a_password">
              </div>

              <div class="form-group col-sm-12">
                <label class="form-group-addon">Ponovi password</label>
                <input type="password" class="form-control" placeholder="Ponovi password" id="a_password_pon" name="a_password_pon">
              </div>

              <div class="form-group col-sm-12">
                <label class="form-group-addon">Privilegije</label>
                <select class="form-control" id="a_privilegija" name="a_privilegije">
                  <option value="1" <?php if(isset($editovan_admin) && $editovan_admin->privilegije == 1) echo "selected";?>>Global admin</option>
                  <option value="2" <?php if(isset($editovan_admin) && $editovan_admin->privilegije == 2) echo "selected";?>>FR admin</option>
                  <option value="3" <?php if(isset($editovan_admin) && $editovan_admin->privilegije == 3) echo "selected";?>>PR admin</option>
                </select>
              </div>

              <input type="submit" value="Snimi" class="btn btn-primary pull-right" style="margin-right:20px;" name="snimi_administrator" />
            </form>

          </div>
          <div class="col-md-4 col-sm-4">
            <h4>F.A.Q. <small>Administracija</small></h4>
            <p>
              <b>Šta su administratorske ovlasti?</b><br />
                  Administratorske ovlasti predstavljaju ovlasti uređivanja sadržaja JobFair.ba stranice i aplikacije. 
              <br /><br />
              <b>Šta je global admin?</b><br />
                  Globalni administrator ima ovlasti da uređuje i kreira sadržaj vezan za sve oblasti JobFair.ba, kao ida dodaje ili deaktivira postojeće administratore.
              <br /><br />
              <b>Šta je FR admin?</b><br />
                  FR administrator ima ovlasti da uređuje i kreira sadržaj vezan za kompanije, djelatnosti itd. 
              <br /><br />
              <b>Šta je PR admin?</b><br />
                  PR administrator ima ovlasti da dodaje nove novosti, edituje već postojeće, dodaje galerije i briše novosti.
            </p>
              <br/><br> 

          </div>
          <div style="clear:both;"></div>
        </div>


        <!-- Kompanije postavke -->
        <div role="tabpanel" class="tab-pane" id="kompanije" style="padding-top:20px;">
          <!-- Dodavanj djelatnosti -->
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <label class="form-group-addon">Dodaj djelatnost</label>
              <input type="text" class="form-control" placeholder="Naziv djelatnosti" id="ak_djelatnost" name="ak_djelatnost">
            </div>
            <button id="dodaj_djelatnost" class="btn btn-primary pull-right">Dodaj</button> 
            <div style="clear:both;"></div>

            <table class="table table-bordered djelatnost-tab" style="margin-top:20px;">
              <tr class="danger">
                <td class="col-md-9 col-sm-9"><i class="glyphicon glyphicon-briefcase"></i> Djelatnosti</td>
                <td class="col-md-3 col-sm-3"></td>
              </tr>

              <tr class="active">
                <td class="col-md-10 col-sm-10">Naziv</td>
                <td class="col-md-2 col-sm-2" style="text-align:right;">Akcija</td>
              </tr>

              <?php
                $djelatnosti = $db->query("SELECT * FROM jf_djelatnost");
                while($row = $djelatnosti->fetch_assoc()){
                  ?>
                  <tr>
                    <td class="col-md-10 col-sm-10"><?=$row['naziv'];?></td>
                    <td class="col-md-2 col-sm-2" style="text-align:right;">
                      <a href="javascript:delete_djelatnost(<?=$row['id'];?>);" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
            </table>
          </div>

          <!-- Dodavanje kadra -->
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <label class="form-group-addon">Dodaj kadar</label>
              <input type="text" class="form-control" placeholder="Kadar" id="ak_kadar" name="ak_kadar">
            </div>
            <button id="dodaj_kadar" class="btn btn-primary pull-right">Dodaj</button> 
            <div style="clear:both;"></div>

            <table class="table table-bordered kadar-tab" style="margin-top:20px;">
              <tr class="danger">
                <td class="col-md-9 col-sm-9"><i class="glyphicon glyphicon-education"></i> Kadar</td>
                <td class="col-md-3 col-sm-3"></td>
              </tr>

              <tr class="active">
                <td class="col-md-10 col-sm-10">Naziv</td>
                <td class="col-md-2 col-sm-2" style="text-align:right;">Akcija</td>
              </tr>

              <?php
                $kadar = $db->query("SELECT * FROM jf_kadar");
                while($row = $kadar->fetch_assoc()){
                  ?>
                  <tr>
                    <td class="col-md-10 col-sm-10"><?=$row['kadar'];?></td>
                    <td class="col-md-2 col-sm-2" style="text-align:right;">
                      <a href="javascript:delete_kadar(<?=$row['id'];?>);" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
            </table>
          </div>

          <!-- Trziste postavke -->
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <label class="form-group-addon">Dodaj tržište</label>
              <input type="text" class="form-control" placeholder="Kadar" id="ak_trziste" name="ak_trziste">
            </div>
            <button id="dodaj_trziste" class="btn btn-primary pull-right">Dodaj</button> 
            <div style="clear:both;"></div>

            <table class="table table-bordered trziste-tab" style="margin-top:20px;">
              <tr class="danger">
                <td class="col-md-9 col-sm-9"><i class="glyphicon glyphicon-globe"></i> Tržište</td>
                <td class="col-md-3 col-sm-3"></td>
              </tr>

              <tr class="active">
                <td class="col-md-10 col-sm-10">Naziv</td>
                <td class="col-md-2 col-sm-2" style="text-align:right;">Akcija</td>
              </tr>

              <?php
                $trziste = $db->query("SELECT * FROM jf_trziste");
                while($row = $trziste->fetch_assoc()){
                  ?>
                  <tr>
                    <td class="col-md-10 col-sm-10"><?=$row['trziste'];?></td>
                    <td class="col-md-2 col-sm-2" style="text-align:right;">
                      <a href="javascript:delete_trziste(<?=$row['id'];?>);" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
            </table>
          </div>
          <div style="clear:both;"></div>
        </div>

        <!-- Kategorije postavke -->
        <div role="tabpanel" class="tab-pane" id="kategorije">
          <div class="kategorije">
            <div class="col-md-8 col-sm-8">
              <table class="table table-bordered kategorije-tab" style="margin-top:20px;">
                <tr class="danger">
                  <td class="col-md-9 col-sm-9"><i class="glyphicon glyphicon-tag"></i> Kategorija</td>
                  <td class="col-md-3 col-sm-3"></td>
                </tr>
                <tr class="active">
                  <td class="col-md-10 col-sm-10">Naziv</td>
                  <td class="col-md-2 col-sm-2" style="text-align:right;">Akcija</td>
                </tr>
                <?php
                  $kategorije = $db->query("SELECT * FROM jf_vjestine_kategorija");
                  while($row = $kategorije->fetch_assoc()){
                    ?>
                    <tr>
                      <td class="col-md-10 col-sm-10"><?=$row['kategorija'];?></td>
                      <td class="col-md-2 col-sm-2" style="text-align:right;">
                        <a href="javascript:delete_kategorija(<?=$row['id'];?>);" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                  }
                ?>
              </table>
            </div> 
            <div class="col-md-4 col-sm-4" style="margin-top:20px;">
              <div class="form-group">
                <label class="form-group-addon">Naziv kategorije</label><br />
                <input type="text" class="form-control" id="v_kategorija" />
              </div>
              <button id="dodaj_kategoriju" class="btn btn-primary pull-right">Dodaj</button> 
              <div style="clear:both;"></div>
              <h4>F.A.Q. <small>Vještine i kategorije</small></h4>
                <p>
                  <b>Kategorija</b><br />
                      Kategorija je nadskup vještina, odnosno jednoj kategoriji može pripadati više različitih vještina iz iste ili slične oblasti.
                  <br /><br />
                  <b>Vještina</b><br />
                      Vještina je usko vezana za studente i kompanije, predstavlja određenu vještinu koju je student stekao kroz studiji ili neformalni oblik obrazovanja.
                  <br /><br />
                </p>
              <br/><br> 

            </div>
            <div style="clear:both;"></div>
          </div>
        </div>

        <!-- Vještine postavke -->
        <div role="tabpanel" class="tab-pane" id="vjestine" style="padding-top:20px;">

          <div class="col-md-3 col-sm-3">
            <div class="form-group">
              <label class="form-group-addon">Naziv vještine</label>
              <input type="text" class="form-control" id="vj_naziv" placeholder="Naziv vještine" />
            </div>
            <div class="form-group">
              <label class="form-group-addon">Kategorija</label>
              <select name="kategorija" class="form-control" id="vj_kategorija">
                <?php
                  $kategorije = $db->query("SELECT * FROM jf_vjestine_kategorija");
                  while($row = $kategorije->fetch_assoc()){
                    ?>
                      <option value="<?=$row['id'];?>"><?=$row['kategorija'];?></option>
                    <?php
                  } 
                ?>
              </select>
            </div>
            <input type="hidden" value="<?=$_GET['filter'];?>" class="filter_check" />
            <button id="snimi_vjestinu" class="btn btn-primary pull-right">Snimi</button>
          </div>

          <div class="col-md-6 col-sm-6">
            <div class="refresh_area">
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
                  $query_add = '';
                  if(isset($_GET['filter']))
                    $query_add = ' WHERE jf_vjestine.kategorija = '.(int)$_GET['filter']." ";

                  $vjestine = $db->query("SELECT jf_vjestine.naziv, jf_vjestine.id, jf_vjestine_kategorija.kategorija FROM jf_vjestine LEFT JOIN jf_vjestine_kategorija ON jf_vjestine.kategorija = jf_vjestine_kategorija.id ".$query_add." ORDER BY id DESC LIMIT 0, 10");
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

                ?>
              </table>
            </div>
              <?php
                /* Izbroji vještine */
                $br_vjestina  = $db->query("SELECT count(id) as num FROM jf_vjestine".$query_add)->fetch_assoc();
                $broj         = $br_vjestina['num'];

                pagination(1, 10, $broj);
              ?>

          </div>
          <div class="col-md-3 col-sm-3">
            <strong>Filter</strong><br />
            <div class="radio">
              <label>
                  <input type="radio" name="filter_postavke" class="filterpostavke" value="sve" <?php if(!isset($_GET['filter'])) echo 'checked'; ?>>
                  Sve
              </label>
              <br />

              <?php
                $kategorije = $db->query("SELECT * FROM jf_vjestine_kategorija");
                while($row = $kategorije->fetch_assoc()){
                  ?>
                    <label>
                      <input type="radio" name="filter_postavke" class="filterpostavke" value="<?=$row['id'];?>" <?php if(isset($_GET['filter']) && $_GET['filter'] == $row['id']) echo 'checked';?>>
                      <?=$row['kategorija'];?>
                    </label>
                    <br />
                  <?php
                } 
              ?>
            </div>
          </div>

          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
    
  </body>

    <?php require_once('inc/html_foot.php'); ?>

  <script>
    $('#nav-postavke a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    
    $(document).ready(function(){
      var hash = document.location.hash;
       $('.nav-tabs a[href="' + hash + '"]').tab('show');

       $('.loader-background').fadeOut();
    });
  </script>
 </html>