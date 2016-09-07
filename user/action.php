<?php
	require_once('../brains/global.php');

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		switch ($_POST['action'])
		{
      case 'dodaj-novo-iskustvo':
        /* HTML rednering */
				$i = md5(time()."-".rand(1, 999)."-".rand(1, 1000000)."-".rand(1,99999));
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
		            <input type="radio" name="vrsta-iskustva-<?=$i;?>" class="filter-item  vrsta-iskustva" value="<?=$row['id'];?>"/>
		            <span style="border-color:#9d9d9d;border-radius:90px;"></span>
		            <h2 style="color:#5d5d5d;font-weight:bold;"><?=$row['vrsta'];?></h2>
		          </label>
		          <?php
		        }
		      ?>
		        <br />
		          <br />
		      <h1>Pozicija:</h1>
		      <input type="text" class="form-input ri-pozicija" />
		      <br />
		        <br />
		      <h1>Opis aktivnosti:</h1>
		      <textarea class="form-input ri-opis" style="height:60px;"></textarea>
		        <br />
		          <br />
		      <h1>Naziv poslodavca:</h1>
		      <input type="text" class="form-input ri-poslodavac" />
		        <br />
		          <br />
							<h1>Početak (od):</h1>
		              <br />
		            <div class="dropdown-select" style="width:100px;">
		              <select class="ri-od-d" style="width:100px;">
		                <option value="" disabled selected>Dan</option>

		                <?php
		                  for($i = 1; $i <= 31; $i++){
		                      $selected = "";

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

		                    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
		                  }
		                ?>
		              </select>
		            </div>

		            <!--<input type="text" class="form-input edu-od-d" style="width:40px;" placeholder="dd" value="<?=date('d', strtotime($item['pocetak']));?>" />
		            <input type="text" class="form-input edu-od-m" style="width:40px;"  placeholder="mm" value="<?=date('m', strtotime($item['pocetak']));?>"/>
		            <input type="text" class="form-input edu-od-g" style="width:100px;" placeholder="gggg" value="<?=date('Y', strtotime($item['pocetak']));?>" />-->

		            <br />

		              <div class="aktivni-addition">
		                <br /><br />
		                <h1>Završetak (do):</h1>
		                <br />
		                <div class="dropdown-select" style="width:100px;">
		                  <select class="ri-do-d" style="width:100px;">
		                    <option value="" disabled selected>Dan</option>

		                    <?php
		                      for($i = 1; $i <= 31; $i++){
		                          $selected = "";

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

		                        echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
		                      }
		                    ?>
		                  </select>
		                </div>

		              </div>

		        <label class="form-checkbox" style="display:inline-block;width:140px;margin-left:20px;">
		          <input type="checkbox" name="radno-iskustvo-aktivno-<?=$i;?>" class="filter-item ri-aktivno" value="aktivno"/>
		          <span style="border-color:#9d9d9d;"></span>
		          <h2 style="color:#5d5d5d;font-weight:bold;">Aktivno</h2>
		        </label>

						<input type="hidden" class="ri-edited" value="" />
		          <br />
		        <a href="javascript:void(0);"  style="float:right;" class="obrisi-ri btn">Obriši radno iskustvo</a>
		        <div style="clear:both;"></div>
		    </div>
        <?php
      break;

			case 'dodaj-novo-fakultetsko-obrazovanje':
				/* HTML rednering */
				$km = md5(time()."-".rand(1, 999)."-".rand(1, 1000000)."-".rand(1,99999));
				?>
				<div class="fakultetsko-obrazovanje" style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5;">
	        <h1>Naziv fakulteta:</h1>
					<br />
          <select class="fakultet-id hidden-fakultet edu-faks" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
            <option value="" disabled selected>Odaberite fakultet</option>
            <?php
              $gradovi = $db->query("SELECT id, naziv FROM jf_fakulteti ORDER BY naziv ASC");
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
	        <input type="text" class="form-input edu-faks-smjer"/>
	          <br />
	            <br />
	        <h1>Status:</h1>
	          <br />
	          <label class="form-checkbox" style="display:inline-block;width:160px;">
	            <input type="radio" name="student-diplomac-<?=$km;?>" class="filter-item edu-faks-status" value="1" checked/>
	            <span style="border-color:#9d9d9d;border-radius:90px;"></span>
	            <h2 style="color:#5d5d5d;font-weight:bold;">Student</h2>
	          </label>
	          <label class="form-checkbox" style="display:inline-block;width:160px;">
	            <input type="radio" name="student-diplomac-<?=$km;?>" class="filter-item  edu-faks-status" value="2"/>
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

	                  echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
	                }
	              ?>
	            </select>
	          </div>

	          <!--<input type="text" class="form-input edu-od-d" style="width:40px;" placeholder="dd" value="<?=date('d', strtotime($item['pocetak']));?>" />
	          <input type="text" class="form-input edu-od-m" style="width:40px;"  placeholder="mm" value="<?=date('m', strtotime($item['pocetak']));?>"/>
	          <input type="text" class="form-input edu-od-g" style="width:100px;" placeholder="gggg" value="<?=date('Y', strtotime($item['pocetak']));?>" />-->

	          <br />
	            <div class="diplomac-addition" style="display:none;" >
	              <br /><br />
	              <h1>Završetak studiranja (do):</h1>
	              <br />
	              <div class="dropdown-select" style="width:100px;">
	                <select class="edu-do-d" style="width:100px;">
	                  <option value="" disabled selected>Dan</option>

	                  <?php
	                    for($i = 1; $i <= 31; $i++){
	                        $selected = "";

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


	        <div class="student-addition">
	          <h1>Godina studija:</h1>
	            <br />

	          <?php
	            $g = 1;
	            $rimski = array("", "I", "II", "III", "IV");
	            for($i = 1; $i <= 4; $i++){
	              /* HTML rendering */
	              ?>
	              <label class="form-checkbox" style="display:inline-block;width:160px;">
	                <input type="radio" name="godina-studija-<?=$km;?>" class="filter-item edu-faks-godina" value="<?=$g;?>"/>
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
	                  <input type="radio" name="godina-studija-<?=$km;?>" class="filter-item edu-faks-godina" value="<?=$g;?>"/>
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
	        <input type="text" class="form-input edu-faks-prosjek" style="width:100px;" placeholder="Prosjek"/>
	              <br />
								<input type="hidden" class="edu-faks-edit" value="" />
				          <br />
				        <a href="javascript:void(0);"  style="float:right;" class="obrisi-fakultet btn">Obriši fakultetsko obrazovanje</a>
				        <div style="clear:both;"></div>
	      </div>
				<?php
			break;

			case 'dodatni-jezik':
				/* HTML rednering */
				$dod = md5(time()."-".rand(1, 999)."-".rand(1, 1000000)."-".rand(1,99999));
				?>
				<div class="dodatni-jezik" style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5;">
					<h1>Jezik:</h1>
						<br/>
					<select class="edu-jezici-id jezik-hidden" style="width:670px;padding:10px;background:#fff;border:1px solid #d5d5d5;">
						<option value="" disabled selected>Odaberite jezik</option>
						<?php
							$gradovi = $db->query("SELECT id, jezik FROM jf_jezici ORDER BY jezik ASC");
							while($row = $gradovi->fetch_assoc()){
								?>
								<option value="<?=$row['id'];?>"><?=$row['jezik'];?></option>
								<?php
							}
						?>
					</select>

						<br />
							<br />
					<h1>Razumijevanje:</h1>
						<br />
					<?php
							$nivoi = array("A1", "B1", "C1", "A2", "B2", "C2");

							$i = 0;
							foreach($nivoi as $item){
								/* HTML rednering */
								if($i == 3) echo "<br /><br />";
								?>
									<label class="form-checkbox" style="display:inline-block;width:160px;">
										<input type="radio" name="nivo-jezik-razumijevanje-<?=$dod;?>" class="filter-item edu-jezici-raz" value="<?=$item;?>"/>
										<span style="border-color:#9d9d9d;border-radius:90px;"></span>
										<h2 style="color:#5d5d5d;font-weight:bold;"><?=$item;?></h2>
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
								foreach($nivoi as $item){
									/* HTML rednering */
									if($i == 3) echo "<br /><br />";
									?>
										<label class="form-checkbox" style="display:inline-block;width:160px;">
											<input type="radio" name="nivo-jezik-govor-<?=$dod;?>" class="filter-item edu-jezici-govor" value="<?=$item;?>"/>
											<span style="border-color:#9d9d9d;border-radius:90px;"></span>
											<h2 style="color:#5d5d5d;font-weight:bold;"><?=$item;?></h2>
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
							foreach($nivoi as $item){
								/* HTML rednering */
								if($i == 3) echo "<br /><br />";
								?>
									<label class="form-checkbox" style="display:inline-block;width:160px;">
										<input type="radio" name="nivo-jezik-pisanje-<?=$dod;?>" class="filter-item edu-jezici-pis" value="<?=$item;?>"/>
										<span style="border-color:#9d9d9d;border-radius:90px;"></span>
										<h2 style="color:#5d5d5d;font-weight:bold;"><?=$item;?></h2>
									</label>
								<?php
								$i++;
							}
					?>
					<input type="hidden" class="edu-jezici-edit" value="" />
					<br />
					<a href="javascript:void(0);"  style="float:right;" class="obrisi-jezik btn">Obriši jezik</a>
					<div style="clear:both;"></div>
				</div>
				<?php
			break;

			case 'dodatna-edukacija':
				/* HTML rendering */
				?>
				<div class="dodatna-edukacija-item" style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #d5d5d5;">
		      <h1>Vrsta:</h1>
		      <input type="text" class="form-input dodedu-vrsta" />
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

		                  echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
		                }
		              ?>
		            </select>
		          </div>

		          <!--<input type="text" class="form-input edu-od-d" style="width:40px;" placeholder="dd" value="<?=date('d', strtotime($item['pocetak']));?>" />
		          <input type="text" class="form-input edu-od-m" style="width:40px;"  placeholder="mm" value="<?=date('m', strtotime($item['pocetak']));?>"/>
		          <input type="text" class="form-input edu-od-g" style="width:100px;" placeholder="gggg" value="<?=date('Y', strtotime($item['pocetak']));?>" />-->

		          <br />
		            <div class="dod-addition">
		              <br /><br />
		              <h1>Period (do):</h1>
		              <br />
		              <div class="dropdown-select" style="width:100px;">
		                <select class="dodedu-do-d" style="width:100px;">
		                  <option value="" disabled selected>Dan</option>

		                  <?php
		                    for($i = 1; $i <= 31; $i++){
		                        $selected = "";

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

		                      echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
		                    }
		                  ?>
		                </select>
		              </div>

		            </div>
		            <label class="form-checkbox" style="display:inline-block;width:140px;margin-left:20px;">
		              <input type="checkbox" name="dodatna-edukacija-aktivno-<?=$i;?>" class="filter-item dodedu-aktivno" value="aktivno"/>
		              <span style="border-color:#9d9d9d;"></span>
		              <h2 style="color:#5d5d5d;font-weight:bold;">Aktivno</h2>
		            </label>
		          <br /><br /><br />
							<div style="clear:both;"></div>
		      <h1>Opis aktivnosti:</h1>
		        <textarea class="form-input dodedu-opis" style="height:60px;"></textarea>
						<input type="hidden" class="dodedu-edit" value="" />
		          <br /><br />
		        <a href="javascript:void(0);"  style="float:right;" class="obrisi-dodedu btn">Obriši edukaciju</a>
		        <div style="clear:both;"></div>
		    </div>
				<?php
			break;

			/* Spremanej CV-ja */
			case 'spremi-oi':
				$cv = new CV;
	    	$cv->basic_init($_SESSION['id_korisnika']);

				$data = $_POST;
				$cv->update_osnovne_info($_POST);
			break;

			case 'spremi-ri':
					$cv = new CV;
					$cv->basic_init($_SESSION['id_korisnika']);

					$data = json_decode($_POST['data']);

				//foreach($data as $item){
					//var_dump($item);
					$cv->update_radno_iskustvo($data);
				//}
			break;

			case 'spremi-edu':
				$cv = new CV;
				$cv->basic_init($_SESSION['id_korisnika']);

				$data_faks 		= json_decode($_POST['data_faks']);
				$data_jezici	= json_decode($_POST['data_jezici']);

				$cv->update_srednja($_POST['srednja_naziv'], $_POST['srednja_smjer'], $_POST['srednja_grad'], $_POST['srednja_kraj'], $_POST['srednja_edit']);
				$cv->update_faks($data_faks);
				$cv->update_maternji($_POST['maternji']);
				$cv->update_jezici($data_jezici);
			break;

			case 'spremi-dod-edu':
				$cv = new CV;
				$cv->basic_init($_SESSION['id_korisnika']);

				$data = json_decode($_POST['data']);
				$cv->update_dodatna_edu($data);
			break;

			case 'spremi-vjestine':
				$cv = new CV;
				$cv->basic_init($_SESSION['id_korisnika']);

				if(!isset($_POST['vjestine']))
					$vj = array();
				else
					$vj = $_POST['vjestine'];

				$cv->update_vjestine($vj, $_POST['vozacka']);
			break;

			case 'spremljen_cv':
				$cv = new CV;
				$cv->basic_init($_SESSION['id_korisnika']);
				$cv->spremljen_cv();
			break;

			case 'obrisi_ri':
				$id = (int)$_POST['id'];
				if($db->query("DELETE FROM jf_posao WHERE id = {$id}")) echo 'k'; else echo 'k'; // die(mysqli_error($db));
			break;

			case 'obrisi_fakultet':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_edukacija WHERE id = {$id}") or die(mysqli_error($db));
			break;

			case 'obrisi_jezik':
				$id = (int)$_POST['id'];
				$db->query("DELETE FROM jf_cv_jezik WHERE id = {$id}") or die(mysqli_error($db));
			break;

			case 'obrisi_dodedu':
				$id = (int)$_POST['id'];
				echo "k";
				$db->query("DELETE FROM jf_edukacija_dodatna WHERE id = {$id}") or die(mysqli_error($db));
			break;
		}
	}
?>
