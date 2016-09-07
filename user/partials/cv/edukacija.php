<?php
  /* HTML rednering */
?>
<div class="cv-inputs">
  <div class="edu-error" style="display:none;width:650px;padding:10px;margin-bottom:20px;color:#5d5d5d;background:#FFD9D4;"></div>
  <?php
    foreach($srednja_skola as $item){
  ?>
      <h1 style="color:#C0392B;">Srednja škola</h1>
        <br />
      <h1>Naziv:</h1>
      <input type="text" class="form-input edu-sr-naziv" value="<?=$item['naziv_srednje'];?>"/>
      <br />
        <br />
      <h1>Grad:</h1>
        <br />
      <select class="hidden-grad edu-sr-grad" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
        <option value="" disabled selected>Grad</option>
        <?php
          $gradovi = $db->query("SELECT id, naziv FROM jf_gradovi ORDER BY naziv ASC");
          while($row = $gradovi->fetch_assoc()){
            ?>
            <option value="<?=$row['id'];?>" <?php if($row['id'] == $item['grad_srednje_id']) echo "selected";?>><?=$row['naziv'];?></option>
            <?php
          }
        ?>
      </select>
      <!--<input type="text" class="form-input grad-naziv predict-grad-big" value="<?=$item['grad_srednje'];?>"/>
      <div class="predict-list predict-grad-list"></div>
      <input type="hidden" class="form-input hidden-grad edu-sr-grad" value="<?=$item['grad_srednje_id'];?>" />-->
        <br />
          <br />
      <h1>Smjer:</h1>
      <input type="text" class="form-input edu-sr-smjer" value="<?=$item['smjer'];?>"/>
          <br />
            <br />
      <h1>Godina završetka:</h1>
      <input type="text" class="form-input edu-sr-kraj" style="width:100px;" placeholder="gggg" value="<?=$item['zavrsetak'];?>" />
            <br />
              <br />
      <input type="hidden" class="edu-sr-edit" value="<?=$item['id'];?>" />
  <?php
    }

    /* Ukoliko još nije uneseno */
    if(count($srednja_skola) == 0){
  ?>
      <h1 style="color:#C0392B;">Srednja škola</h1>
        <br />
      <h1>Naziv:</h1>
      <input type="text" class="form-input edu-sr-naziv"/>
      <br />
        <br />
      <h1>Grad:</h1>
      <br />
      <select class="hidden-grad  edu-sr-grad" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
        <option value="" disabled selected>Grad</option>
        <?php
          $gradovi = $db->query("SELECT id, naziv FROM jf_gradovi ORDER BY naziv ASC");
          while($row = $gradovi->fetch_assoc()){
            ?>
            <option value="<?=$row['id'];?>"><?=$row['naziv'];?></option>
            <?php
          }
        ?>
      </select>
        <br />
          <br />
      <h1>Smjer:</h1>
      <input type="text" class="form-input edu-sr-smjer"/>
          <br />
            <br />
      <h1>Godina završetka:</h1>
      <input type="text" class="form-input edu-sr-kraj" style="width:100px;" placeholder="gggg"/>
            <br />
              <br />
      <input type="hidden" class="edu-sr-edit" value="0" />
  <?php
    }
  ?>
  <h1 style="color:#C0392B;">Fakultetsko obrazovanje</h1>
    <br />
  <div class="fakultetsko-lista">
  <?php
    foreach($fakultet as $item){
      ?>
      <div class="fakultetsko-obrazovanje" style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5;">
        <h1>Naziv fakulteta:</h1>
          <br />
          <select class="fakultet-id hidden-fakultet edu-faks" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
            <option value="" disabled selected>Grad</option>
            <?php
              $gradovi = $db->query("SELECT id, naziv FROM jf_fakulteti ORDER BY naziv ASC");
              while($row = $gradovi->fetch_assoc()){
                ?>
                <option value="<?=$row['id'];?>" <?php if($row['id'] == $item['faks_id']) echo "selected";?>><?=$row['naziv'];?></option>
                <?php
              }
            ?>
          </select>
        <!--<input type="text" class="form-input predict-fakultet-veliko fakultet-naziv" value="<?=$item['faks'];?>" />
        <div class="predict-list predict-fakultet-list"></div>
        <input type="hidden" class="fakultet-id hidden-fakultet edu-faks" value="<?=$item['faks_id'];?>"/>-->
        <br />
          <br />
        <h1>Smjer:</h1>
        <input type="text" class="form-input edu-faks-smjer" value="<?=$item['smjer'];?>"/>
          <br />
            <br />
        <h1>Status:</h1>
          <br />
          <label class="form-checkbox" style="display:inline-block;width:160px;">
            <input type="radio" name="student-diplomac-<?=$item['id'];?>" class="filter-item edu-faks-status" value="1" <?php if($item['godina_studija'] != 8) echo "checked"; ?>/>
            <span style="border-color:#9d9d9d;border-radius:90px;"></span>
            <h2 style="color:#5d5d5d;font-weight:bold;">Student</h2>
          </label>
          <label class="form-checkbox" style="display:inline-block;width:160px;">
            <input type="radio" name="student-diplomac-<?=$item['id'];?>" class="filter-item edu-faks-status" value="2" <?php if($item['godina_studija'] == 8) echo "checked"; ?>/>
            <span style="border-color:#9d9d9d;border-radius:90px;float:left;"></span>
            <h2 style="color:#5d5d5d;font-weight:bold;">Diplomac</h2>
          </label>
          <br />
        <br />
        <h1>Početak studiranja (od):</h1>
            <br />
          <div class="dropdown-select" style="width:100px;">
            <select class="edu-od-d" style="width:100px;">
              <option value="" disabled selected>Dan</option>

              <?php
                for($i = 1; $i <= 31; $i++){
                    $selected = "";
                    if(date('d', strtotime($item['pocetak'])) == $i) $selected = "selected";
                    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="dropdown-select" style="width:100px;">
            <select class="edu-od-m" style="width:100px;">
              <option value="" disabled selected>Mjesec</option>
              <?php
                for($i = 1; $i <= 12; $i++){
                  $selected = "";
                  if(date('m', strtotime($item['pocetak'])) == $i) $selected = "selected";
                  echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="dropdown-select" style="width:120px;">
            <select class="edu-od-g" style="width:120px;">
              <option value="" disabled selected>Godina</option>
              <?php
                for($i = 1950; $i <= 2015; $i++){
                  $selected = "";
                  if(date('Y', strtotime($item['pocetak'])) == $i) $selected = "selected";
                  echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                }
              ?>
            </select>
          </div>

          <!--<input type="text" class="form-input edu-od-d" style="width:40px;" placeholder="dd" value="<?=date('d', strtotime($item['pocetak']));?>" />
          <input type="text" class="form-input edu-od-m" style="width:40px;"  placeholder="mm" value="<?=date('m', strtotime($item['pocetak']));?>"/>
          <input type="text" class="form-input edu-od-g" style="width:100px;" placeholder="gggg" value="<?=date('Y', strtotime($item['pocetak']));?>" />-->

          <br />
            <div class="diplomac-addition" <?php if($item['godina_studija'] != 8) echo 'style="display:none;"'; ?>>
              <br /><br />
              <h1>Završetak studiranja (do):</h1>
              <br />
              <div class="dropdown-select" style="width:100px;">
                <select class="edu-do-d" style="width:100px;">
                  <option value="" disabled selected>Dan</option>

                  <?php
                    for($i = 1; $i <= 31; $i++){
                        $selected = "";
                        if(date('d', strtotime($item['kraj'])) == $i) $selected = "selected";
                        echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="dropdown-select" style="width:100px;">
                <select class="edu-do-m" style="width:100px;">
                  <option value="" disabled selected>Mjesec</option>
                  <?php
                    for($i = 1; $i <= 12; $i++){
                      $selected = "";
                      if(date('m', strtotime($item['kraj'])) == $i) $selected = "selected";
                      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="dropdown-select" style="width:120px;">
                <select class="edu-do-g" style="width:120px;">
                  <option value="" disabled selected>Godina</option>
                  <?php
                    for($i = 1950; $i <= 2015; $i++){
                      $selected = "";
                      if(date('Y', strtotime($item['kraj'])) == $i) $selected = "selected";
                      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>

            </div>
            <!--<input type="text" class="form-input edu-do-d" style="width:40px;" placeholder="dd" value="<?php if(strtotime($item['kraj']) && $item['godina_studija'] == 8) echo date('d', strtotime($item['kraj'])); ?>" <?php if($item['godina_studija'] != 8) echo 'disabled'; ?>/>
            <input type="text" class="form-input edu-do-m" style="width:40px;"  placeholder="mm" value="<?php if(strtotime($item['kraj'])  && $item['godina_studija'] == 8) echo date('m', strtotime($item['kraj'])); ?>" <?php if($item['godina_studija'] != 8) echo 'disabled'; ?>/>
            <input type="text" class="form-input edu-do-g" style="width:100px;" placeholder="gggg" value="<?php if(strtotime($item['kraj'])  && $item['godina_studija'] == 8) echo date('Y', strtotime($item['kraj'])); ?>" <?php if($item['godina_studija'] != 8) echo 'disabled'; ?>/>-->
            <br /><br />


        <div class="student-addition" <?php if($item['godina_studija'] == 8) echo 'style="display:none;"'; ?>>
          <h1>Godina studija:</h1>
            <br />

          <?php
            $g = 1;
            $rimski = array("", "I", "II", "III", "IV");
            for($i = 1; $i <= 4; $i++){
              /* HTML rendering */
              ?>
              <label class="form-checkbox" style="display:inline-block;width:160px;">
                <input type="radio" name="godina-studija-<?=$item['id'];?>" class="filter-item edu-faks-godina" value="<?=$g;?>" <?php if($item['godina_studija'] == $g) echo "checked"; ?>/>
                <span style="border-color:#9d9d9d;border-radius:90px;"></span>
                <h2 style="color:#5d5d5d;font-weight:bold;"><?=$rimski[$i];?> godina (BSC)</h2>
              </label>
              <?php
              $g++;
            }
          ?>
          <br />
            <br />
          <?php
              $prosao = false;

              $rimski = array("", "I", "II", "III", "IV");
              for($i = 1; $i <= 2; $i++){
                /* HTML rendering */
                ?>
                <label class="form-checkbox" style="display:inline-block;width:160px;">
                  <input type="radio" name="godina-studija-<?=$item['id'];?>" class="filter-item edu-faks-godina" value="<?=$g;?>" <?php if($item['godina_studija'] == $g) echo "checked"; ?>/>
                  <span style="border-color:#9d9d9d;border-radius:90px;"></span>
                  <h2 style="color:#5d5d5d;font-weight:bold;"><?=$rimski[$i];?> godina <?php if($prosao == true) echo "(V)"; else echo "(IV)"; ?> (MSC)</h2>
                </label>
                <?php
                if(!$prosao){
                  $i--;
                  $prosao = true;
                }
                $g++;
              }
            ?>
            <br/>
              <br />
        </div>
          <br />

        <h1>Prosjek:</h1>
        <input type="text" class="form-input edu-faks-prosjek" style="width:100px;" placeholder="Prosjek" value="<?php if($item['prosjek'] != 0) echo $item['prosjek'];?>"/>
              <br />
        <input type="hidden" class="edu-faks-edit" value="<?=$item['id'];?>" />
          <br />
        <a href="javascript:void(0);"  style="float:right;" class="obrisi-fakultet btn">Obriši fakultetsko obrazovanje</a>
        <div style="clear:both;"></div>
      </div>
      <?php
    }
  ?>
  </div>
  <a href="javascript:dodaj_fakultetsko_obrazovanje();" class="dodaj-iskustvo">
    <img src="<?=$url_home;?>icons/plus-white.png" style="margin-bottom:-7px;"/> Dodaj novo fakultetsko obrazovanje
  </a>
    <br />


  <div class="jezici">
    <h1>Maternji jezik:</h1>
    <br />
    <select class="maternji-id" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
      <option value="" disabled selected>Odaberite jezik</option>
      <?php
        $gradovi = $db->query("SELECT id, jezik FROM jf_jezici ORDER BY jezik ASC");
        while($row = $gradovi->fetch_assoc()){
          ?>
          <option value="<?=$row['id'];?>" <?php if($row['id'] == $maternji['id']) echo "selected";?>><?=$row['jezik'];?></option>
          <?php
        }
      ?>
    </select>
    <!--<input type="text" class="form-input maternji-naziv predict-maternji" value="<?php if($maternji['naziv'] != "") echo $maternji['naziv']; ?>" />
    <div class="predict-list predict-jezik-list"></div>
    <input type="hidden" class="maternji-id" value="<?php if($maternji['id'] != "") echo $maternji['id']; ?>" />-->
      <br />
        <br />
    <div class="lista-dodatnih-jezika">
        <?php
          foreach($jezici as $item){
        ?>
            <div class="dodatni-jezik" style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5;">
              <h1>Jezik:</h1>
                <br />
              <select class="edu-jezici-id jezik-hidden" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
                <option value="" disabled selected>Odaberite jezik</option>
                <?php
                  $gradovi = $db->query("SELECT id, jezik FROM jf_jezici ORDER BY jezik ASC");
                  while($row = $gradovi->fetch_assoc()){
                    ?>
                    <option value="<?=$row['id'];?>" <?php if($row['id'] == $item['id']) echo "selected";?>><?=$row['jezik'];?></option>
                    <?php
                  }
                ?>
              </select>
              <!--<input type="text" class="form-input jezik-naziv predict-jezici" value="<?=$item['naziv'];?>" />
              <div class="predict-list predict-jezik-list-sve"></div>
              <input type="hidden" class="edu-jezici-id jezik-hidden" value="<?=$item['id'];?>" />-->

                <br />
                  <br />
              <h1>Razumijevanje:</h1>
                <br />
              <?php
                  $nivoi = array("A1", "B1", "C1", "A2", "B2", "C2");

                  $i = 0;
                  foreach($nivoi as $p){
                    /* HTML rednering */
                    if($i == 3) echo "<br /><br />";
                    ?>
                      <label class="form-checkbox" style="display:inline-block;width:160px;">
                        <input type="radio" name="nivo-jezik-razumijevanje-<?=$item['id'];?>" class="filter-item edu-jezici-raz" value="<?=$p;?>" <?php if($p == $item['razumijevanje']) echo "checked"; ?>/>
                        <span style="border-color:#9d9d9d;border-radius:90px;"></span>
                        <h2 style="color:#5d5d5d;font-weight:bold;"><?=$p;?></h2>
                      </label>
                    <?php
                    $i++;
                  }
              ?>
                  <br />
                    <br />
                <h1>Govor:</h1>
                  <br />
                <?php
                    $nivoi = array("A1", "B1", "C1", "A2", "B2", "C2");

                    $i = 0;
                    foreach($nivoi as $p){
                      /* HTML rednering */
                      if($i == 3) echo "<br /><br />";
                      ?>
                        <label class="form-checkbox" style="display:inline-block;width:160px;">
                          <input type="radio" name="nivo-jezik-govor-<?=$item['id'];?>" class="filter-item edu-jezici-govor" value="<?=$p;?>" <?php if($p == $item['govor']) echo "checked"; ?>/>
                          <span style="border-color:#9d9d9d;border-radius:90px;"></span>
                          <h2 style="color:#5d5d5d;font-weight:bold;"><?=$p;?></h2>
                        </label>
                      <?php
                      $i++;
                    }
                ?>
                <br />
                  <br />
              <h1>Pisanje:</h1>
                <br />
              <?php
                  $nivoi = array("A1", "B1", "C1", "A2", "B2", "C2");

                  $i = 0;
                  foreach($nivoi as $p){
                    /* HTML rednering */
                    if($i == 3) echo "<br /><br />";
                    ?>
                      <label class="form-checkbox" style="display:inline-block;width:160px;">
                        <input type="radio" name="nivo-jezik-pisanje-<?=$item['id'];?>" class="filter-item edu-jezici-pis" value="<?=$p;?>" <?php if($p == $item['pisanje']) echo "checked"; ?>/>
                        <span style="border-color:#9d9d9d;border-radius:90px;"></span>
                        <h2 style="color:#5d5d5d;font-weight:bold;"><?=$p;?></h2>
                      </label>
                    <?php
                    $i++;
                  }
              ?>
              <input type="hidden" class="edu-jezici-edit" value="<?=$item['id_veza'];?>" />
                <br />
              <a href="javascript:void(0);"  style="float:right;" class="obrisi-jezik btn">Obriši jezik</a>
              <div style="clear:both;"></div>
            </div>

        <?php } ?>
    </div>
  </div>
  <a href="javascript:dodaj_novi_jezik();" class="dodaj-iskustvo">
    <img src="<?=$url_home;?>icons/plus-white.png" style="margin-bottom:-7px;"/> Dodaj novi jezik
  </a>
</div>
<br />
<a href="javascript:void(0);" class="btn ri-scroll" style="float:left;">Prethodni korak</a>
<a href="javascript:void(0);" class="btn ded-scroll" style="float:right;">Sljedeći korak</a>
