<?php
  $cv->init_cv($_SESSION['id_korisnika']);

  /* Array sa radnim iskustvom */
  $radno_iskustvo = array();
  $radno_iskustvo = $cv->get_radno_iskustvo();

  /* Array sa srednjom školom */
  $srednja_skola  = array();
  $srednja_skola  = $cv->get_srednja_skola();

  /* Array sa fakultetom */
  $fakultet       = array();
  $fakultet       = $cv->get_fakultet();

  /* Array sa dodatnom edukacijom */
  $additional_edu       = array();
  $additional_edu       = $cv->get_additional_edu();

  /* Array sa kategorijama vještina koje posjeduje */
  $kategorije           = array();
  $kategorije           = $cv->get_kategorije();

  /* Array sa vještinama koje posjeduje */
  $vjestine             = array();
  $vjestine             = $cv->get_vjestine();

  /* Maternji */
	$maternji 						= array();
	$maternji 						= $cv->get_maternji();

  /* Jezici */
  $jezici               = array();
  $jezici               = $cv->get_jezici();

  /* Grad */
  $grad       = array();
  $grad       = $cv->get_grad();

  /* Info o korisniku cv baze */
  $ime        = $cv->get_ime();
  $prezime    = $cv->get_prezime();
  $adresa     = $cv->get_adresa();
  $telefon    = $cv->get_telefon();
  $mail       = $cv->get_mail();
  $spol       = $cv->get_spol();
  $datum_rodj = $cv->get_datum_rodj();
  $vozacka    = $cv->get_vozacka();

  /* Info o vrsti zaposlenja koje trazi */
  $fulltime   = $cv->get_fulltime();
  $parttime   = $cv->get_parttime();
  $praksa     = $cv->get_praksa();
?>
