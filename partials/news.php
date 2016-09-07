<?php
  $items = json_decode(file_get_contents('http://www.jobfair.ba/jfapi.php?stream=naslovna&strana=1'));
?>
<div id="ns" ng-controller="naslovnaControler">
    <div class="novosti" ng-repeat="novosti in ns">
      <?php foreach($items as $item){ ?>
	  	<div class="row-news">
        <div class="img-block">
          <img class="img-novost" src="<?=$item->naslovna_slika;?>" alt="">
        </div>
        <div class="novost-tekst">
          <div class="novost-naslov"><?=$item->naslov;?></div>
          <p>
            <?=$item->opis;?>
          </p>
        </div>
        <div class="btn-box">
          <a class="btn btn-default" href="<?=$url_home;?>novost/<?=$item->id;?>" role="button">Opširnije</a>
        </div>
	  	</div>
	  	<hr class="border-novost">
      <?php } ?>
  	</div>

    <div class="btn-div">
      <input class="btn-show-more" type="button" value="Učitaj više" ng-class="nextPageDisabledClass()"
          ng-click="loadMore()">
    </div>
</div>


<!--
    <div class = "novosti">
      <div class="row-news">
        <div class="img-block">
          <img class="img-novost" src="img/logo/logo.png" alt="">
        </div>
        <div class="novost-tekst">
          <div class="novost-naslov">Naslov</div>
          <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
          </p>
        </div>
        <div class="btn-box">
          <a class="btn btn-default" href="#" role="button" >Opširnije</a>
        </div>
      </div>
      <hr class="border-novost">
    </div>
    <div class = "novosti">
      <div class="row-news">
        <div class="img-block">
            <img class="img-novost" src="img/galerija/2.JPG" alt=""/>
        </div>
        <div class="novost-tekst">
          <div class="novost-naslov"> JobFAIR '15 zvanično otvoren</div>
          <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
          </p>
        </div>
        <div class="btn-box">
          <a class="btn btn-default" href="#" onclick="poziv('partials/news-full.php')" role="button">Opširnije</a>
        </div>
      </div>
      <hr class="border-novost">
    </div>
  -->
