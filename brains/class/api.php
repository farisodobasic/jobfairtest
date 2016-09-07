<?php
	class Api{
		/*
			* Developed by Mirza Ohranovic (mirza.ohranovic@gmail.com)
			* In order to properly use your Api class you have to define some initial values
			* * * * * * * * * * * * * * * * * *
			* $api_name 	-> everything has to have a name, a name is your Api's ID
			* $amount  		-> number of items that your api will generate
			* $itdc 		-> short for ID, Title, Description and Content; it allows your api to show the basic post things
							-> it's set to TRUE by default
			* $galleries 	-> will your api show galleris
							-> by default FALSE

 		*/
		private $api_name 	= null;
		private $amount 		= null;

		private $id 			= true;
		private $title 		= true;
		private $description = true;
		private $content 	= true;
		private $date 		= true;
		private $label 		= true;
		private $tags 		= false;
		private $order_show 	= false;

		private $time_written 	= true;
		private $time_published 	= true;

		private $published 	= true;
		private $main_image 	= true;

		private $galleries	= true;

		public function get_number_of_items(){
			global $db;
			$get_num = $db->query("SELECT id FROM jf_novosti")->num_rows;
			echo $get_num;
		}

		public function get_number_of_gal(){
			global $db;
			$get_num = $db->query("SELECT id FROM jf_novosti WHERE galerija = 1")->num_rows;
			echo $get_num;
		}

		public function generate_api_content($query = false){
			global $db;
			global $url_gal;
			global $url_gal_thumb;
			global $media_url;

			/* Order of the elements */
			if($this->order_show) $order = 1;

			$api = array();
			$b = 0;

			if(!$query) $posts = $db->query("SELECT * FROM jf_novosti ORDER BY id DESC");
				else 	$posts = $db->query("SELECT * FROM jf_novosti ".$query);


			while($row = $posts->fetch_assoc()){
					if($this->id)				$api[$b]['id']			= $row['id'];
					if($this->title) 		$api[$b]['naslov'] 	= stripslashes($row['naslov']);
					if($this->description) 	$api[$b]['opis']	= nl2br($row['opis']);
					if($this->content)		$api[$b]['sadrzaj']	= nl2br(str_replace('<br />', PHP_EOL, $row['sadrzaj']));
					if($this->date)			$api[$b]['vrijeme']	= date('d.m.Y.', strtotime($row['vrijeme']));

					if($this->main_image)	$api[$b]['naslovna_slika'] = $media_url.'naslovna/jfmedia.s_'.$row['id'].'.jpg';
					if($this->main_image)	$api[$b]['velika_slika'] = $media_url.'naslovna/jfmedia.v_'.$row['id'].'.jpg';

					if($this->galleries){
						if($row['galerija'] == 1){

							$api[$b]['galerija'] = 1;

							$i = 0;
							$gle = $db->query("SELECT broj FROM jf_galerije WHERE post = {$row['id']}");

							while($wor = $gle->fetch_assoc()){
								$api[$b]['galerija_items'][$i] 		= stripslashes($url_gal.$row['id'].'.'.$wor['broj'].'.jpg');
								$api[$b]['galerija_items_th'][$i]	= stripslashes($url_gal_thumb.$row['id'].'.'.$wor['broj'].'.jpg');
								$i++;
							}
						}else{ $api[$b]['galerija'] = 0; }
					}

					$b++;
			}

			print_r(json_encode($api, JSON_PRETTY_PRINT));

		}

	}
?>
