<?php
  /* HTML rednering */
?>
<div class="cv-inputs">
  <div class="dodedu-error" style="display:none;width:650px;padding:10px;margin-bottom:20px;color:#5d5d5d;background:#FFD9D4;"></div>
  <div class="dodatna-edukacija">
    <?php
      foreach($additional_edu as $item){
    ?>
    <div class="dodatna-edukacija-item" style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5;">
      <h1>Vrsta:</h1>
      <input type="text" class="form-input dodedu-vrsta" value="<?=$item['vrsta'];?>" />
      <br />
        <br />
        <h1>Period (od):</h1>
            <br />
          <div class="dropdown-select" style="width:100px;">
            <select class="dodedu-od-d" style="width:100px;">
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
            <select class="dodedu-od-m" style="width:100px;">
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
            <select class="dodedu-od-g" style="width:120px;">
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
            <div class="dod-addition" <?php if($item['aktivno'] == 1) echo 'style="display:none;"'; ?>>
              <br /><br />
              <h1>Period (do):</h1>
              <br />
              <div class="dropdown-select" style="width:100px;">
                <select class="dodedu-do-d" style="width:100px;">
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
                <select class="dodedu-do-m" style="width:100px;">
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
                <select class="dodedu-do-g" style="width:120px;">
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
            <label class="form-checkbox" style="display:inline-block;width:140px;margin-left:20px;">
              <input type="checkbox" name="dodatna-edukacija-aktivno-<?=$i;?>" class="filter-item dodedu-aktivno" value="aktivno" <?php if($item['aktivno'] == 1) echo "checked"; ?>/>
              <span style="border-color:#9d9d9d;"></span>
              <h2 style="color:#5d5d5d;font-weight:bold;">Aktivno</h2>
            </label>
            <br /><br /><br />
            <div style="clear:both;"></div>
      <h1>Opis aktivnosti:</h1>
        <textarea class="form-input dodedu-opis" style="height:60px;"><?=$item['opis'];?></textarea>
        <input type="hidden" class="dodedu-edit" value="<?=$item['id'];?>" />
          <br /><br />
        <a href="javascript:void(0);"  style="float:right;" class="obrisi-dodedu btn">Obriši edukaciju</a>
        <div style="clear:both;"></div>
    </div>

    <?php } ?>
  </div>
  <a href="javascript:dodatna_edukacija();" class="dodaj-iskustvo">
    <img src="<?=$url_home;?>icons/plus-white.png" style="margin-bottom:-7px;"/> Dodaj dodatnu edukaciju
  </a>
</div>
<br />
<a href="javascript:void(0);" class="btn ed-scroll" style="float:left;">Prethodni korak</a>
<a href="javascript:void(0);" class="btn vj-scroll" style="float:right;">Sljedeći korak</a>
