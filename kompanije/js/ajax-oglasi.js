editor = new nicEditor().panelInstance('opisPozicije');
var root_url = "http://www.jobfair.ba/";

function posaljiNaServer(promjena){

	//editor = new nicEditor().panelInstance('opisPozicije');
	var forma = document.getElementById("editor-forma");
	var content = editor.instanceById('opisPozicije').getContent();

	var checkedValue = null;
	var inputElements = document.getElementsByClassName('messageCheckbox');
	for(var i=0; inputElements[i]; ++i){
	      if(inputElements[i].checked){
	           checkedValue = inputElements[i].value;
	           break;
	      }
	}
	if(promjena) var id_oglasa = forma.idOglasa.value;
	var nazivPozicije = forma.nazivPozicije.value;
	var opisPozicije = content;
	var datumObjave = forma.konkursBegin.value;
	var datumIsteka = forma.konkursEnd.value;
	var brojPozicija = forma.brojPozicija.value;
	var kategorija = checkedValue;

	var vjestine = [];

	$(".filter-item-vjestina").each(function(){
		vjestine.push($(this).children('.selected-vjestina-id').val());
	});

	if(promjena){
		$.post('./action_oglasi.php', {action: 'izmijeni-oglas', id_oglasa: id_oglasa, nazivPozicije: nazivPozicije, opisPozicije: opisPozicije, brojPozicija: brojPozicija, kategorija: kategorija, konkursBegin: datumObjave, konkursEnd: datumIsteka, vjestine: vjestine}, function(res){
			//console.log(res);
			window.location = root_url + 'kompanije/moji-oglasi.php';
		});
	}
	else{
		$.post('./action_oglasi.php', {action: 'dodaj-oglas', nazivPozicije: nazivPozicije, opisPozicije: opisPozicije, brojPozicija: brojPozicija, kategorija: kategorija, konkursBegin: datumObjave, konkursEnd: datumIsteka, vjestine: vjestine}, function(res){
			//console.log(res);
			window.location = root_url + 'kompanije/moji-oglasi.php';
		});
	}
}

function aplicirajNaOglas(oglas_id, korisnik_id){

 	var oglas_id 			= oglas_id;
	var id_korisnika 	= korisnik_id;

	if(confirm("Da li ste sigurni da želite aplicirati na ovaj oglas?")){
		$.post('./action_oglasi.php', {action: 'apliciraj', oglas_id: oglas_id, id_korisnika: id_korisnika}, function(res){
			alert(res);
		});
	}
}

function delete_oglas(id){
	if(confirm("Da li ste sigurni da želite obrisati ovaj oglas?")){
		$.post('./action_oglasi.php', {action: 'obrisi-oglas', id: id}, function(res){
			window.location = "moji-oglasi.php";
		});
	}
}

function pregledaj(id_oglasa){
	//$.post('./action_oglasi.php', {action: 'pokupi-oglase', id_oglasa: id_oglasa}, function(res){});

	/*$.get('./action_oglasi.php', {action: 'pokupi-oglase', id_oglasa: id_oglasa}, function(data, status, xhr){
		console.log($.parseJSON(data));
	});*/


	/*var xhr;
  var xmlhttp;
	if (window.XMLHttpRequest) {
	 xmlhttp=new XMLHttpRequest();
	 xhr=new XMLHttpRequest();
	}
	else {
	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	 xhr=new ActiveXObject("Microsoft.XMLHTTP");
	}

	var parametri = "id="+id_oglasa.toString();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  xhr.onreadystatechange=function(){
		    if(xhr.readyState==4 && xhr.status==200){
					editor = new nicEditor().panelInstance('opisPozicije');
					var content = editor.instanceById('opisPozicije').getContent();
		      var data = JSON.parse(xhr.responseText);
		      console.log(data.length);
					var forma = document.getElementById("editor-forma");

					forma.nazivPozicije.value = data.naziv_pozicije;
					content = data.opisPozicije;
					forma.konkursBegin.value = data.konkurs_begin;
					forma.konkursEnd.value = data.konkurs_end;
					forma.brojPozicija.value = data.broj_pozicija;
					checkedValue = data.kategorija;
		    }
		  }
		  xhr.open("GET", "action_oglasi.php?action=pokupi-oglase&"+parametri, true);
		  xhr.send();
		}
	}
	xmlhttp.open("GET","dodaj-oglas.php",true);
	xmlhttp.send();*/
}
