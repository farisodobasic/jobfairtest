<?php
  /* Provjeri da li je student ulogovan */
  check_if_student_logged();

  // Klase
	include ('class/student.php');

  /* Basic cv caller */
  if(isset($_SESSION['id_korisnika'])){
    $cv = new CV;
    $cv->basic_init($_SESSION['id_korisnika']);

    if($cv->get_unesen_cv() == 0 && $current != "cv.php"){
      header('Location: '.$url_home.'user/cv.php');
      ob_flush();
    }
  }

	/* Class callers */
	$korisnik = new Student;
?>
