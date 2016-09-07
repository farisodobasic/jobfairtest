/* Administrator postavke - funkcije */
function admin_deaktiviraj(id){
	$.post('./action.php', {action: 'admin_deaktiviraj', id: id}, function(res){
		location.reload();
	});
}

function admin_aktiviraj(id){
	$.post('./action.php', {action: 'admin_aktiviraj', id: id}, function(res){
		location.reload();
	});
}

function admin_delete(id){
	if(confirm("Da li ste sigurni da želite obrisati ovog administratora?")){
		$.post('./action.php', {action: 'admin_delete', id: id}, function(res){
			location.reload();
		});
	}
}

/* DJelatnosti postavke - funkcije */
function delete_djelatnost(id){
	if(confirm("Da li ste sigurni da želite obrisati ovu djelatnost?")){
		$.post('./action.php', {action: 'delete_djelatnost', id: id}, function(res){
			location.reload();
		});
	}
}

$(document).on('click', "#dodaj_djelatnost", function(){
	var djelatnost = $('#ak_djelatnost').val();
	$.post('./action.php', {action: 'dodaj_djelatnost', djelatnost: djelatnost}, function(res){
		$('.djelatnost-tab').append('<tr><td class="col-md-10 col-sm-10">' + djelatnost + '</td><td class="col-md-2 col-sm-2" style="text-align:right;"><a href="javascript:delete_djelatnost(' + res + ');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
	});
});

/* Kadar špstavle - funkcije */
function delete_kadar(id){
	if(confirm("Da li ste sigurni da želite obrisati ovaj kadar?")){
		$.post('./action.php', {action: 'delete_kadar', id: id}, function(res){
			location.reload();
		});
	}
}

$(document).on('click', "#dodaj_kadar", function(){
	var kadar = $('#ak_kadar').val();
	$.post('./action.php', {action: 'dodaj_kadar', kadar: kadar}, function(res){
		$('.kadar-tab').append('<tr><td class="col-md-10 col-sm-10">' + kadar + '</td><td class="col-md-2 col-sm-2" style="text-align:right;"><a href="javascript:delete_kadar(' + res + ');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
	});
});

/* Trziste postavke - funkcije */
function delete_trziste(id){
	if(confirm("Da li ste sigurni da želite obrisati ovo tržište?")){
		$.post('./action.php', {action: 'delete_trziste', id: id}, function(res){
			location.reload();
		});
	}
}

$(document).on('click', "#dodaj_trziste", function(){
	var trziste = $('#ak_trziste').val();
	$.post('./action.php', {action: 'dodaj_trziste', trziste: trziste}, function(res){
		$('.trziste-tab').append('<tr><td class="col-md-10 col-sm-10">' + trziste + '</td><td class="col-md-2 col-sm-2" style="text-align:right;"><a href="javascript:delete_(' + res + ');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
	});
});

/* Kategorije postavke - funkcije */
function delete_kategorija(id){
	if(confirm("Da li ste sigurni da želite obrisati ovu kategoriju?")){
		$.post('./action.php', {action: 'delete_kategorija', id: id}, function(res){
			location.reload();
		});
	}
}

$(document).on('click', "#dodaj_kategoriju", function(){
	var kategorija = $('#v_kategorija').val();
	$.post('./action.php', {action: 'dodaj_kategoriju', kategorija: kategorija}, function(res){
		$('.kategorije-tab').append('<tr><td class="col-md-10 col-sm-10">' + kategorija + '</td><td class="col-md-2 col-sm-2" style="text-align:right;"><a href="javascript:delete_kategorija(' + res + ');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
	});
});

/* Vjestine postavke - funckije */
$(document).on('click', '#snimi_vjestinu', function(){
	var vjestina 	= $('#vj_naziv').val();
	var kategorija 	= $('#vj_kategorija').val();
	var kat_naslov 	= $('#vj_kategorija:selected').html();
	$.post('./action.php', {action: 'snimi_vjestinu', vjestina: vjestina, kategorija: kategorija}, function(res){
		$('.vjestine-tab').append('<tr><td class="col-md-5 col-sm-5">' + vjestina + '</td><td class="col-md-5 col-sm-5">' + kat_naslov + '</td><td class="col-md-2 col-sm-2" style="text-align:right;"><a href="javascript:delete_vjestina(' + res + ');" class="btn btn-danger btn-xs"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
	});
});

$(document).on('change', '#naslovna_slika', function(){
	$('#nova_naslovna').val(1);
});

function delete_vjestina(id){
	if(confirm("Da li ste sigurni da želite obrisati ovu vještinu?")){
		$.post('./action.php', {action: 'delete_vjestina', id: id}, function(res){
			location.reload();
		});
	}
}

/* Paginacija kod vještina */
function ucitaj_vjestine(page){
	var filter = $('.filter_check').val();
	$.post('./action.php', {action: 'ucitaj_vjestine', page: page, filter: filter}, function(res){
		$('.refresh_area').empty().append(res);
	});
}

/* Filtriranje */
$(document).on('click', '.filterpostavke', function(){
	var filter = $(this).val();
	if(filter == "snimi_vjestinu")
		window.location = "postavke.php#vjestine";
	else
		window.location = "postavke.php?filter="+filter+"#vjestine";
});