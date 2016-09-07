<?php
  /* HTML rendering radnog iskustva */
?>
<div class="cv-inputs">
  <div class="ri-error" style="display:none;width:650px;padding:10px;margin-bottom:20px;color:#5d5d5d;background:#FFD9D4;"></div>
  <div class="iskustva">
  <?php
    $i = 0;
    foreach($radno_iskustvo as $item){
      ?>
      <div class="radno-iskustvo-block" style="border-bottom:1px solid #d5d5d5;padding-bottom:20px;margin-bottom:20px;">
        <h1>Vrsta iskustva: </h1>
          <br />
        <?php
          $vrsta_iskustva = $db->query("SELECT * FROM jf_vrsta_posla");
          while($row = $vrsta_iskustva->fetch_assoc()){
              /* HTML rednering */
            ?>
            <label class="form-checkbox" style="display:inline-block;width:140px;">
              <input type="radio" name="vrsta-iskustva-<?=$item['id'];?>" class="filter-item vrsta-iskustva" value="<?=$row['id'];?>" <?php if($row['vrsta'] == $item['vrsta_posla'] || $row['id'] == $item['vrsta_posla']) echo "checked"; ?>/>
              <span style="border-color:#9d9d9d;border-radius:90px;"></span>
              <h2 style="color:#5d5d5d;font-weight:bold;"><?=$row['vrsta'];?></h2>
            </label>
            <?php
          }
        ?>
          <br />
            <br />
        <h1>Pozicija:</h1>
        <input type="text" class="form-input ri-pozicija" value="<?php if($item['pozicija'] !="" ) echo $item['pozicija']; ?>" />
        <br />
          <br />
        <h1>Opis aktivnosti:</h1>
        <textarea class="form-input ri-opis" style="height:60px;"><?php if($item['aktivnosti'] !="" ) echo $item['aktivnosti']; ?></textarea>
          <br />
            <br />
        <h1>Naziv poslodavca:</h1>
        <input type="text" class="form-input ri-poslodavac" value="<?php if($item['aktivnosti'] !="" ) echo $item['poslodavac']; ?>"/>
          <br />
            <br />
        <!--<h1>Period rada (od):</h1>
          <input type="text" class="form-input ri-od-d" style="width:40px;" placeholder="dd" value="<?=date('d', strtotime($item['pocetak']));?>" />
          <input type="text" class="form-input ri-od-m" style="width:40px;"  placeholder="mm" value="<?=date('m', strtotime($item['pocetak']));?>"/>
          <input type="text" class="form-input ri-od-g" style="width:100px;" placeholder="gggg" value="<?=date('Y', strtotime($item['pocetak']));?>" />

          <br /><br />
        <h1>Period rada (do):</h1>
          <input type="text" class="form-input ri-do-d" style="width:40px;" placeholder="dd" value="<?php if($item['aktivno'] == 0) echo date('d', strtotime($item['kraj'])); ?>" />
          <input type="text" class="form-input ri-do-m" style="width:40px;"  placeholder="mm" value="<?php if($item['aktivno'] == 0) echo date('m', strtotime($item['kraj'])); ?>"/>
          <input type="text" class="form-input ri-d o-g" style="width:100px;" placeholder="gggg" value="<?php if($item['aktivno'] == 0) echo date('Y', strtotime($item['kraj'])); ?>"/>-->
          <h1>Početak (od):</h1>
              <br />
            <div class="dropdown-select" style="width:100px;">
              <select class="ri-od-d" style="width:100px;">
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
              <select class="ri-od-m" style="width:100px;">
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
              <select class="ri-od-g" style="width:120px;">
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

              <div class="aktivni-addition" <?php if($item['aktivno'] == 1) echo 'style="display:none;"'; ?>>
                <br /><br />
                <h1>Završetak (do):</h1>
                <br />
                <div class="dropdown-select" style="width:100px;">
                  <select class="ri-do-d" style="width:100px;">
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
                  <select class="ri-do-m" style="width:100px;">
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
                  <select class="ri-do-g" style="width:120px;">
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
            <input type="checkbox" name="radno-iskustvo-aktivno-<?=$i;?>" class="filter-item ri-aktivno" value="aktivno" <?php if($item['aktivno'] == 1) echo "checked"; ?>/>
            <span style="border-color:#9d9d9d;"></span>
            <h2 style="color:#5d5d5d;font-weight:bold;">Aktivno</h2>
          </label>

        <input type="hidden" class="ri-edited" value="<?=$item['id'];?>" />
          <br />
        <a href="javascript:void(0);"  style="float:right;" class="obrisi-ri btn">Obriši radno iskustvo</a>
        <div style="clear:both;"></div>
        <?php $i++; ?>
      </div>
      <?php
    }

  ?>
  </div>
  <a href="javascript:dodaj_novo_iskustvo();" class="dodaj-iskustvo">
    <img src="<?=$url_home;?>icons/plus-white.png" style="margin-bottom:-7px;"/> Dodaj novo radno iskustvo
  </a>
</div>
<br />
<a href="javascript:void(0);" class="btn kp-scroll" style="float:left;">Prethodni korak</a>
<a href="javascript:void(0);" class="btn ed-scroll" style="float:right;">Sljedeći korak</a>
