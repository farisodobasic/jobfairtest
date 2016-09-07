<?php
  /* HTML rednering */
?>
<div class="cv-inputs">
  <div style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5">
    <h1>Vještine:</h1>
    <input type="text" class="form-input predict-vjestina" />
    <div class="predict-list predict-vjestina-list"></div>
    <div class="selected-list cv-lista-vjestina-drustvene selected-vjestina-list">
        <?php
          foreach($kategorije as $kategorija){
              $i = 0;
              foreach($vjestine[$kategorija['id']]['naziv'] as $item){
                ?>
                  <div class="filter-item filter-item-vjestina"><?=$item;?> <input type="hidden" class="selected-vjestina-id" value="<?=$vjestine[$kategorija['id']]['id'][$i];?>" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="<?=$url_home;?>icons/delete.png" /></a></div>
                <?php
                $i++;
              }
          }
        ?>
        <div style="clear:both;"></div>
    </div>
  </div>

  <span style="color:#5d5d5d;line-height:24px;">
    Unesite Vaše tehničke i društvene vještine. Nakon što pronađete vještinu koju želite, pritiskom tipke enter odabirete vještinu. Vještine mogu biti tehničke (primjer: html/css, php, autocad), društvene i slično.
    <br /><br />
    <b>Napomena:</b> Filter putem vještina je filter koji predstavnici kompanija najviše koriste. Kako bi Vas što lakše pronašli u našoj bazi, molimo Vas da unesete vještine koje posjedujete.
  </span>
    <br /><br />

  <div style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5">
    <h1>Vozačka dozvola:</h1>
    <br />
    <?php
      $kat = array(1,2,3,4);
    ?>
    <label class="form-checkbox" style="display:inline-block;width:260px;">
      <input type="radio" name="vozacka" class="filter-item vozacka" value="0" <?php if(!in_array($vozacka, $kat)) echo "checked"; ?>/>
      <span style="border-color:#9d9d9d;border-radius:90px;"></span>
      <h2 style="color:#5d5d5d;font-weight:bold;">Ne posjedujem vozačku dozvolu</h2>
    </label>
    <br />
      <br />
    <?php
      $kategorije = $db->query("SELECT * FROM jf_vozacka");

      while($row = $kategorije->fetch_assoc()){
        /* HTML rendering */
        ?>
        <label class="form-checkbox" style="display:inline-block;width:140px;">
          <input type="radio" name="vozacka" class="filter-item vozacka" value="<?=$row['id'];?>" <?php if($row['id'] == $vozacka) echo "checked"; ?>/>
          <span style="border-color:#9d9d9d;border-radius:90px;"></span>
          <h2 style="color:#5d5d5d;font-weight:bold;"><?=$row['tip'];?></h2>
        </label>
        <?php
      }
    ?>

  </div>
</div>
<br />
<a href="javascript:void(0);" class="btn ded-scroll" style="float:left;">Prethodni korak</a>
<a href="javascript:void(0);" class="btn spremi-scroll" style="float:right;">Sljedeći korak</a>
