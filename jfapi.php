<?php
  require_once('brains/global.php');
  require_once('brains/class/api.php');

  if(isset($_GET['stream'])){
    if($_GET['stream'] == 'naslovna'){
      $api    = new Api;
      $strana = (int)$_GET['strana'];
      $pocetak = ($strana - 1) * 3;
      $api->generate_api_content(" ORDER BY id DESC LIMIT {$pocetak}, 3");
    }else if($_GET['stream'] == 'novost'){
      $id   = (int)$_GET['id'];
      $api  = new Api;
      $api->generate_api_content(" WHERE id = ".$id);
    }else if($_GET['stream'] == 'items'){
      $api = new Api;
      $api->get_number_of_items();
    }else if($_GET['stream'] == 'items_gal'){
      $api = new Api;
      $api->get_number_of_gal();
    }else if($_GET['stream'] == 'galerije'){
      $strana = (int)$_GET['strana'];
      $pocetak = ($strana - 1) * 3;
      $api  = new Api;
      $api->generate_api_content(" WHERE galerija = 1 ORDER BY id DESC LIMIT {$pocetak}, 3");
    }

  }else die("Nije postavljen stream.");

?>
