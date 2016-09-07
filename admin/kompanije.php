<?php
	require_once('../brains/global.php');
  require_once('../brains/global_admin.php');

  // Regulacija pagniacije 
  $page = "";
  if(isset($_GET['stranica'])){
    $page = "&stranica=".(int)$_GET['stranica'];
  }

  require_once('post/post_kompanije_snimi.php');
  //if(isset($edit_kompanija)) var_dump($edit_kompanija);

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
    <?php
      include "index.php";
    ?>

    <!--kompanije lista-->
    <div class="col-md-4">
      <ul class="nav nav-stacked">
        <li class="list-group-item list-group-item-info"><a href="<?=$url_home;?>admin/kompanije.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>

            <?php
              $iterator = 0;
              $devet = 9;
              $jedan = 1;
              $brojStranica = $db->query("SELECT id FROM jf_kompanije")->num_rows;
              $brojStranica = $brojStranica/$devet;
              if(isset($_GET['stranica']))
              {
                $stranica = ($_GET['stranica']*9) - 9;
                $kompanije = $db->query("SELECT * FROM jf_kompanije limit $stranica,9");
              }
              else
              {
                $kompanije = $db->query("SELECT * FROM jf_kompanije limit 0,9");
              }
              while($row = $kompanije->fetch_assoc()){
                ?>
                  <li class="list-group-item"><a href="<?=$url_home;?>admin/kompanije.php?kompanija=<?=$row['id'];?><?=$page;?>" id="<?=$row['id'];?>" name="k_kompanije[]"> <?=$row['naziv'];?> </a></li>
                <?php
              }
            ?>
      </ul>
      <br>
      <?php
        header(".../&")
      ?>
    <!-- Stranice kompanija -->
    <nav>
  <ul class="pagination" style="margin-left:45%;">
    <?php
      while($iterator <= $brojStranica)
      {
        $iterator++;
        ?>
        <li><a href="<?=$url_home;?>admin/kompanije.php?stranica=<?=$iterator;?>"> <?=$iterator; ?>  </a></li>
        <?php
      }
    ?>

  </ul>
</nav>
    <!-- End of stranice -->

    </div>
    <!-- End of kompanije lista -->

    <!-- detalji o kompaniji -->
    <form method="POST" action="" id="kforma">
      <div class="col-md-4">
        <div class="form-group col-sm-12">
          <label class="form-group-addon">Naziv kompanije</label>
          <input type="text" class="form-control"  id="k_naziv" name="k_naziv" minlength="2"
            value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->naziv; ?>" placeholder="Naziv kompanije" required>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Web stranica</label>
          <input type="url" class="form-control" id="k_web" name="k_web"
            value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->webstranica; ?>" placeholder="Web stranica kompanije" required>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Email</label>
          <input type="email" class="form-control" id="k_email" name="k_email" 
            value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->email ?>" placeholder="Email kompanije" required>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Kontakt telefon</label>
          <input type="text" class="form-control" id="k_telefon" name="k_telefon" 
            value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->telefon; ?>" placeholder="Kontakt telefon kompanije" required>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Adresa</label>
          <input type="text" class="form-control" id="k_adresa" name="k_adresa" 
            value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->adresa; ?>" placeholder="Adresa kompanije" required>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Logo kompanije original</label>
          <input type="text" class="form-control" id="k_logo1" name="k_logo1" 
            value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->logo1; ?>" placeholder="Putanja" >
        </div>
<!--
        <div class="form-group col-sm-12">
          <label class="form-group-addon">Logo kompanije modifikacija</label>
          <input type="text" class="form-control" id="k_logo2" name="k_logo2" value="<?php if(isset($edit_kompanija)) echo $edit_kompanija->logo2; ?>" placeholder="Putanja" >
        </div>
-->
        <div class="form-group col-sm-12">
          <label class="form-group-addon">Profil</label>

          <select class="form-control" id="k_profil" name="k_profil">
            <option value="1" <?php if(isset($edit_kompanija) && $edit_kompanija->imaLiProfil==1) echo "selected"; ?> >Postoji</option>
            <option value="0" <?php if(isset($edit_kompanija) && $edit_kompanija->imaLiProfil==0) echo "selected"; ?> >Ne postoji</option>
          </select>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Djelatnost kompanije</label>

          <?php
            /* Genericki ispis djelatnosti */
            $djelatnosti = $db->query("SELECT * FROM jf_djelatnost");
          ?>
          <select class="form-control" id="k_djelatnost" name="k_djelatnost">
            <?php
                while($row = $djelatnosti->fetch_assoc()){
                
                ?>
                <option value="<?=$row['id'];?>" <?php if(isset($edit_kompanija) && $edit_kompanija->djelatnost == $row['id']) echo "selected"; ?> name="<?=$row['id'];?>"><?=$row['naziv'];?></option> 
                <?php
              
                }
            ?>
          </select>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Broj zaposlenih</label>
          <select class="form-control" id="k_brzaposlenih" name="k_brzaposlenih">
            <option value="0" <?php if(isset($edit_kompanija) && $edit_kompanija->brZaposlenih==0) echo "selected"; ?> >1-9</option>
            <option value="1" <?php if(isset($edit_kompanija) && $edit_kompanija->brZaposlenih==1) echo "selected"; ?> >10-29</option>
            <option value="2" <?php if(isset($edit_kompanija) && $edit_kompanija->brZaposlenih==2) echo "selected"; ?> >30-69</option>
            <option value="3" <?php if(isset($edit_kompanija) && $edit_kompanija->brZaposlenih==3) echo "selected"; ?> >+70</option>
          </select>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Minimalna zahtijavana godina studija</label><br>
          <select class="form-control" id="k_studij" name="k_studij">
            <option <?php if(isset($edit_kompanija) && $edit_kompanija->minGodStudija==0) echo "selected"; ?> >Nije relevatno</option>
            <option <?php if(isset($edit_kompanija) && $edit_kompanija->minGodStudija==1) echo "selected"; ?> >I godina studija</option>
            <option <?php if(isset($edit_kompanija) && $edit_kompanija->minGodStudija==2) echo "selected"; ?> >II godina studija</option>
            <option <?php if(isset($edit_kompanija) && $edit_kompanija->minGodStudija==3) echo "selected"; ?> >III godina studija</option>
            <option <?php if(isset($edit_kompanija) && $edit_kompanija->minGodStudija==4) echo "selected"; ?> >IV godina studija</option>
            <option <?php if(isset($edit_kompanija) && $edit_kompanija->minGodStudija==5) echo "selected"; ?> >V godina studija</option>
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group col-sm-12">
          <label class="form-group-addon">Tržište</label><br>
            <?php
              $trziste = $db->query("SELECT * FROM jf_trziste");
              while($row = $trziste->fetch_assoc()){
                $c = "";
                if(isset($edit_kompanija) && in_array($row['id'], $edit_kompanija->trziste)) $c = "checked";
                ?>
                  <label class="checkbox-inline col-sm-2">
                    <input type="checkbox" value="<?=$row['id'];?>" name="k_trziste[]" <?=$c;?>> <?=$row['trziste'];?>
                  </label>
                <?php
              }
            ?>
        </div>
      
        <div class="form-group col-sm-12">
          <label class="form-group-addon">Potreban kadar</label><br>

            <?php
              $kadar = $db->query("SELECT * FROM jf_kadar");
              while($row = $kadar->fetch_assoc()){
                $c = "";
                if(isset($edit_kompanija) && in_array($row['id'], $edit_kompanija->kadar)) $c = "checked";
                ?>
                  <label class="checkbox-inline col-sm-2">
                    <input type="checkbox" value="<?=$row['id'];?>"  name="k_kadar[]" <?=$c;?>> <?=$row['kadar'];?>
                  </label>
                <?php
              }
            ?>
          <br>
        </div>      

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Strani jezik</label><br>
            <?php
              $jezik = $db->query("SELECT * FROM jf_jezici");
              while($row = $jezik->fetch_assoc()){
                $c = "";
                if(isset($edit_kompanija) && in_array($row['id'], $edit_kompanija->jezik)) $c = "checked";
                ?>
                  <label class="checkbox-inline col-sm-6">
                    <input type="checkbox" value="<?=$row['id'];?>" name="k_jezici[]" <?=$c;?>><?=$row['jezik'];?>
                  </label>
                <?php
              }
            ?>

        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Tehničke vještine</label><br>

            <?php
              $vjestina = $db->query("SELECT * FROM jf_vjestine");
              while($row = $vjestina->fetch_assoc()){
                $c = "";
                if(isset($edit_kompanija) && in_array($row['id'], $edit_kompanija->vjestine)) $c = "checked";
                ?>
                  <label class="checkbox-inline col-sm-2">
                    <input type="checkbox" value="<?=$row['id'];?>" name="k_vjestine[]" <?=$c;?>> <?=$row['naziv'];?>
                  </label>
                <?php
              }
            ?>
          <br>
          <label class="form-group-addon">Opis vještina</label>
          <textarea class="form-control" id="k_vjestine_opis" name="k_vjestine_opis" rows="4"></textarea>
        </div>

        <div class="form-group col-sm-12">
          <label class="form-group-addon">Iskustvo</label>
          <textarea class="form-control" id="k_iskustvo" name="k_iskustvo" rows="3"><?php if(isset($edit_kompanija)) echo $edit_kompanija->iskustvo;?></textarea>
        </div>

        <input type ="submit" class="btn btn-primary btn-lg" style="float:right; margin-right:30px" name="nova_k" value="Spasi promjene">
      </div>
    </form>
    <?php require_once('inc/html_foot.php'); ?>
    <script> 
      $(function(){

        $.validator.addMethod("validirajAdresu", function(value, element){
          return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Adresa može sadržavati samo slova, brojeve i crticu!");
        
        $("#kforma").validate({
          rules: {
              k_adresa: {
                validirajAdresu: true
              }
          }
        });
      });

      $(document).ready(function(){
        $('#kforma').validate({
          rules: {
            k_telefon: {
              pattern: /^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/
            },
            k_adresa: {
              validirajAdresu: true
            }
          },
          messages: {
            k_telefon: "Neispravan format telefona! Ispravni formati: (061)-123-345 ili 061-123-456 ili 061123456 !"
          } 
        });
      });
    </script>  
       <!-- End of podaci o kompanijama-->
  </body>
 </html>