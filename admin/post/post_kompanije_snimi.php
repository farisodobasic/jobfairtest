<?php
    if(isset($_POST['nova_k']) && !isset($_GET['kompanija'])){
        $naziv             = $db_jf->escape_string($_POST['k_naziv']);
        $webstranica       = $db_jf->escape_string($_POST['k_web']);
        $email             = $db_jf->escape_string($_POST['k_email']);
        $adresa            = $db_jf->escape_string($_POST['k_adresa']);
        $telefon           = $db_jf->escape_string($_POST['k_telefon']);
        $logo1             = $db_jf->escape_string($_POST['k_logo1']);
    //    $logo2             = $db_jf->escape_string($_POST['k_logo2']);
        $imaLiProfil       = $db_jf->escape_string($_POST['k_profil']);
        $brZaposlenih      = $db_jf->escape_string($_POST['k_brzaposlenih']);
        $minGodStudija     = $db_jf->escape_string($_POST['k_studij']);
        $iskustvo          = $db_jf->escape_string($_POST['k_iskustvo']);
        $djelatnost        = $db_jf->escape_string($_POST['k_djelatnost']);

        $trziste = $kadar = $jezik = $vjestine = array();

        if(isset($_POST['k_trziste']))  $trziste           = $_POST['k_trziste'];
        if(isset($_POST['k_kadar']))    $kadar             = $_POST['k_kadar'];
        if(isset($_POST['k_jezici']))   $jezik             = $_POST['k_jezici'];
        if(isset($_POST['k_vjestine'])) $vjestine          = $_POST['k_vjestine'];
        

        $kompanija = new Kompanija;
        $kompanija->dodaj($naziv, $webstranica, $email, $adresa, $telefon, $kadar, $logo1, /*$logo2,*/ $imaLiProfil, $djelatnost, $brZaposlenih, $trziste, $minGodStudija, $vjestine, $jezik, $iskustvo);
    }

    if(isset($_GET['kompanija'])){
        $edit_kompanija = new Kompanija;
        $edit_kompanija->id = (int)$_GET['kompanija'];
        $edit_kompanija->izlistaj();

        if(isset($_POST['nova_k'])){
            $naziv             = $db_jf->escape_string($_POST['k_naziv']);
            $webstranica       = $db_jf->escape_string($_POST['k_web']);
            $email             = $db_jf->escape_string($_POST['k_email']);
            $adresa            = $db_jf->escape_string($_POST['k_adresa']);
            $telefon           = $db_jf->escape_string($_POST['k_telefon']);
            $logo1             = $db_jf->escape_string($_POST['k_logo1']);
        //    $logo2             = $db_jf->escape_string($_POST['k_logo2']);
            $imaLiProfil       = $db_jf->escape_string($_POST['k_profil']);
            $brZaposlenih      = $db_jf->escape_string($_POST['k_brzaposlenih']);
            $minGodStudija     = $db_jf->escape_string($_POST['k_studij']);
            $iskustvo          = $db_jf->escape_string($_POST['k_iskustvo']);
            $djelatnost        = $db_jf->escape_string($_POST['k_djelatnost']);

            $trziste = $kadar = $jezik = $vjestine = array();

            if(isset($_POST['k_trziste']))  $trziste           = $_POST['k_trziste'];
            if(isset($_POST['k_kadar']))    $kadar             = $_POST['k_kadar'];
            if(isset($_POST['k_jezici']))   $jezik             = $_POST['k_jezici'];
            if(isset($_POST['k_vjestine'])) $vjestine          = $_POST['k_vjestine'];
        

            if (true){ //validiraj()
                $edit_kompanija->izmijeni($naziv, $webstranica, $email, $adresa, $telefon, $kadar, $logo1, /*$logo2,*/ $imaLiProfil, $djelatnost, $brZaposlenih, $trziste, $minGodStudija, $vjestine, $jezik, $iskustvo);
                header('Location: '.$_SERVER['PHP_SELF'].'?kompanija='.$edit_kompanija->id.$page);
            }
        }
    }
?>