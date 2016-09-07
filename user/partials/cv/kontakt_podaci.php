<?php
  /* Kontakt podaci HTML rednering */
?>
<div class="cv-inputs">
  <div class="oi-error" style="display:none;width:650px;padding:10px;margin-bottom:20px;color:#5d5d5d;background:#FFD9D4;">

  </div>
  <h1>Ime: </h1>
  <input type="text" class="form-input oi-ime" value="<?php if($ime != "") echo $ime; ?>" />
  <br />
    <br />
  <h1>Prezime: </h1>
  <input type="text" class="form-input oi-prezime" value="<?php if($prezime != "") echo $prezime; ?>"/>
  <br />
    <br />
  <h1>E-mail: </h1>
  <input type="text" class="form-input oi-mail" value="<?php if($mail != "") echo $mail; ?>"/>
    <br />
      <br />
  <h1>Grad: </h1>
  <br />
  <select class="hidden-grad oi-grad" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
    <option value="" disabled selected>Grad</option>
    <?php
      $gradovi = $db->query("SELECT id, naziv FROM jf_gradovi ORDER BY naziv ASC");
      while($row = $gradovi->fetch_assoc()){
        ?>
        <option value="<?=$row['id'];?>" <?php if($row['id'] == $grad['id']) echo "selected";?>><?=$row['naziv'];?></option>
        <?php
      }
    ?>
  </select>
  <!--<input type="text" class="form-input grad-naziv predict-grad-big" value="<?php if(count($grad) > 0 && $grad['naziv'] != "") echo $grad['naziv']; ?>" />
  <input type="hidden" class="hidden-grad oi-grad" value="<?php if(count($grad) > 0 && $grad['id'] != "") echo $grad['id']; ?>"/>
  <div class="predict-list predict-grad-list"></div>-->

  <br />
    <br />
  <h1>Adresa: </h1>
  <input type="text" class="form-input oi-adresa" value="<?php if($adresa != "") echo $adresa; ?>"/>
  <br />
    <br />
  <h1>Kontakt telefon: </h1>
    <input type="text" class="form-input oi-telefon" value="<?php if($telefon != "") echo $telefon; ?>"/>
    <br />
      <br />
  <h1>Datum rođenja: </h1>
    <!--<input type="text" class="form-input oi-d" style="width:40px;" placeholder="dd" value="<?php if($datum_rodj != "0000-00-00") echo date('d', strtotime($datum_rodj)); ?>" />
    <input type="text" class="form-input oi-m" style="width:40px;"  placeholder="mm" value="<?php if($datum_rodj != "0000-00-00") echo date('m', strtotime($datum_rodj)); ?>"/>
    <input type="text" class="form-input oi-g" style="width:100px;" placeholder="gggg"  value="<?php if($datum_rodj != "0000-00-00") echo date('Y', strtotime($datum_rodj)); ?>"/> -->
        <br />
      <div class="dropdown-select" style="width:100px;">
        <select class="oi-d" style="width:100px;">
          <option value="" disabled selected>Dan</option>

          <?php
            for($i = 1; $i <= 31; $i++){
                $selected = "";
                if(date('d', strtotime($datum_rodj)) == $i) $selected = "selected";
                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
            }
          ?>
        </select>
      </div>
      <div class="dropdown-select" style="width:100px;">
        <select class="oi-m" style="width:100px;">
          <option value="" disabled selected>Mjesec</option>
          <?php
            for($i = 1; $i <= 12; $i++){
              $selected = "";
              if(date('m', strtotime($datum_rodj)) == $i) $selected = "selected";
              echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
            }
          ?>
        </select>
      </div>
      <div class="dropdown-select" style="width:120px;">
        <select class="oi-g" style="width:120px;">
          <option value="" disabled selected>Godina</option>
          <?php
            for($i = 1950; $i <= 2015; $i++){
              $selected = "";
              if(date('Y', strtotime($datum_rodj)) == $i) $selected = "selected";
              echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
            }
          ?>
        </select>
      </div>
        <br />
          <br />
            <br />
  <h1>Spol: </h1>
    <br />
  <label class="form-checkbox" style="display:inline-block;width:160px;">
    <input type="radio" name="spol-odabir" class="filter-item spol-odabir" value="1" <?php if($spol == 1) echo "checked"; ?>/>
    <span style="border-color:#9d9d9d;border-radius:90px;"></span>
    <h2 style="color:#5d5d5d;font-weight:bold;">Muško</h2>
  </label>
  <label class="form-checkbox" style="display:inline-block;width:160px;">
    <input type="radio" name="spol-odabir" class="filter-item spol-odabir" value="2" <?php if($spol == 2) echo "checked"; ?>/>
    <span style="border-color:#9d9d9d;border-radius:90px;float:left;"></span>
    <h2 style="color:#5d5d5d;font-weight:bold;">Žensko</h2>
  </label>
    <br />
    <br />
  <h1>Radno vrijeme:</h1>
    <br />
  <label class="form-checkbox" style="display:inline-block;width:160px;">
    <input type="checkbox" name="radno-vrijeme" class="filter-item oi-ft" value="full-time" <?php if($fulltime == 1) echo "checked"; ?>/>
    <span style="border-color:#9d9d9d;"></span>
    <h2 style="color:#5d5d5d;font-weight:bold;">Full time posao</h2>
  </label>
  <label class="form-checkbox" style="display:inline-block;width:160px;">
    <input type="checkbox" name="radno-vrijeme" class="filter-item oi-pt" value="part-time" <?php if($parttime == 1) echo "checked"; ?>/>
    <span style="border-color:#9d9d9d;"></span>
    <h2 style="color:#5d5d5d;font-weight:bold;">Part time posao</h2>
  </label>
  <label class="form-checkbox" style="display:inline-block;width:160px;">
    <input type="checkbox" name="radno-vrijeme" class="filter-item oi-pr" value="praksa" <?php if($praksa == 1) echo "checked"; ?>/>
    <span style="border-color:#9d9d9d;"></span>
    <h2 style="color:#5d5d5d;font-weight:bold;">Praksa</h2>
  </label>
</div>
  <br />
<a href="javascript:void(0);" class="btn ri-scroll" style="float:right;">Sljedeći korak</a>
