<!-- Add fancyBox -->
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

    <!--NOVO-->
    <link rel="stylesheet" href="css/galerija.css">



    <div class="header cover-header cover-header-galerije">
        <div class="text">Galerija</div>
    </div>
    <div id="gal" ng-controller="galerijaControler">
        <div class="novosti" ng-repeat="novosti in gal">
            <div class="row-news-galerija">

              <!--IZLISTAVANJE SLIKA begin-->
                <?php 
                  $dirname = "img/images/";
                  $images = glob($dirname."*.jpg");
                  foreach($images as $image) 
                  {
                    echo '<img class = "imidz" id = "myImg" src="'.$image.'" width = "300" height = "200">';
                  }
                ?>
                <!--IZLISTAVANJE SLIKA end-->

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- The Close Button -->
                    <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

                    <!-- Modal Content (The Image) -->
                    <img class="modal-content" id="img01">

                    <!-- Modal Caption (Image Text) -->
                    <div id="caption"></div>
                </div>

                <script src="js/myscripts.js"></script> 

              <!--<div class="novost-tekst">
                <div class="novost-naslov">{{ novosti.naslov }}</div>
                <p>
                  {{ novosti.opis }}
                </p>
              </div>-->
              <!--<div class="btn-box">
                <div class="btn btn-default" style="position:relative;" href="javascript:void(0);" role="button">
                   <a class="grouped-elements" rel="gal2" ng-repeat="link in novosti.galerija_items" style="position:absolute;top:0;left:0;right:0;bottom:0;" href="{{ link }}"></a>
                      Pregledaj
                </div>
              </div>-->

            </div>
            <hr class="border-novost">
        </div>

        <!--<div class="btn-div">
          <input class="btn-show-more" type="button" value="Učitaj više" ng-class="nextPageDisabledClass()"
              ng-click="loadMore()">
        </div>-->
    </div>
<!--
	<!--<div class="gallery-all" >
         <?php
            $dirname = "../img/gallery";
            $files = scandir($dirname);
            $out = array_shift($files);
            $out = array_shift($files);
            $imenagalerija= array($files[0] => "Day 1",$files[1] => "neki tekst",$files[2] => "neki malo duzi tekst",$files[3] => "nei malo duziiiii tekstinjovic maliii ali duzi tekst",$files[4] => "zzZZzzzz pcelica",$files[5] => "zomg");

        ?>
       <?php $i = 0; foreach($files as $directoryname):?>
        <div class="gallery-part">
            <div onclick="opengallery(<?php echo $i; ?>)" onmouseover="galleryhover(<?php echo $i;?>)"  onmouseout="gallerynohover(<?php echo $i;?>)" id="gallery-pic" class="<?php echo 'gallery-pic'.$i; ?>">
                <div  class="<?php echo 'overlay'.$i; ?>">
                   <div class="gallery-text"><?php echo $imenagalerija[$directoryname]; ?></div>
                   <div class="gallery-text-line"></div>
                </div>
                <a href="javascript:;">
                <img src="<?php echo 'img/gallery/'.$files[$i]."/tab.JPG"; ?>" class="<?php echo "gallery".$i;?>"  alt="">
                </a>
                <div>&nbsp;&nbsp;&nbsp;</div>
            </div>
        </div>
        <div style="height:180px; width:20px; float:left;" >
            &nbsp;&nbsp;
        </div>
    <?php $i = $i+1; endforeach;?>

	</div> -->
