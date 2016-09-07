/* Globalne varijable */
var root_url = "http://www.jobfair.ba/";
var sortiraj_po_scoreu = false;

$(document).ready(function(){
	init_paginacija(0, 2);
	$.post('./action.php', {action: 'pretraga-update', page: 1}, function(res){
		$('#rezultati-pretrage').empty().append(res);
		var koliko = $('.cv-item').length;
		$('.koliko-value').val(koliko);
	});
});


/* Paginacija */
function init_paginacija(prethodna, next){
	$('.paginacija').empty();
	if(prethodna != 0)
		$('.paginacija').append('<a href="javascript:prethodna(' + prethodna + ');"><img style="margin:14px;" src="' + root_url +'icons/prev.png" /></a> ');
	//else
		//$('.paginacija').append('<a href="javascript:void();"><img style="margin:14px;" src="' + root_url +'icons/prev.png" /></a> ');

	if(next != 0)
		$('.paginacija').append('<a href="javascript:sljedeca(' + next + ');"><img style="margin:14px;" src="' + root_url +'icons/next.png" /></a>');
	//else
		//$('.paginacija').append('<a href="javascript:void();"><img style="margin:14px;" src="' + root_url +'icons/next.png" /></a>');
}

function update_pretraga(page){
	var vjestine 			= [];
	var fakulteti 			= [];
	var odabrane_godine 	= [];
	var gradovi				= [];
	var jezici				= [];
	var ime 				= [];
	var vrsta_posla			= [];
	var spol;
	var vozacka;

	var page = page || 1;

	if(page == 1) init_paginacija(0, 2);

	$(".filter-item-vjestina").each(function(){
		vjestine.push($(this).children('.selected-vjestina-id').val());
	});

	$(".filter-item-fakultet").each(function(){
		fakulteti.push($(this).children('.selected-fakultet-id').val());
	});

	$('.god_studija').each(function(){
		if($(this).is(':checked') && $(this).val() != "ukini-god-studija") odabrane_godine.push($(this).val());
	});

	$(".filter-item-grad").each(function(){
		gradovi.push($(this).children('.selected-grad-id').val());
	});

	$(".filter-item-jezik").each(function(){
		jezici.push($(this).children('.selected-jezik-id').val());
	});

	$(".filter-item-ime").each(function(){
		ime.push($(this).children('.selected-ime-ime').val());
	});

	$('.spol-filter').each(function(){
		if($(this).is(':checked')) spol = $(this).val();
	});

	$('.vozacka-filter').each(function(){
		if($(this).is(':checked')) vozacka = $(this).val();
	});

	$('.vrsta-posla-filter').each(function(){
		if($(this).is(':checked') && $(this).val() != 0) vrsta_posla.push($(this).val());
	});

	if(sortiraj_po_scoreu) var score = 1;
		else var score = 0;

	$.post('./action.php', {action: 'pretraga-update', score: score, page: page, vjestine: vjestine, fakulteti: fakulteti, odabrane_godine: odabrane_godine, gradovi: gradovi, jezici: jezici, ime: ime, spol: spol, vozacka: vozacka, vrsta_posla: vrsta_posla}, function(res){
		$('#rezultati-pretrage').empty().append(res);
		var koliko = $('.cv-item').length;
		$('.koliko-value').val(koliko);
	});
}

function update_pretraga_oglasi(page){
	var vjestine 			= [];

	var page = page || 1;

	if(page == 1) init_paginacija(0, 2);
	$(".filter-item-vjestina").each(function(){
		vjestine.push($(this).children('.selected-vjestina-id').val());
	});

	var naziv_oglasa = $('.naziv-oglasa').val();

	$.post('./action.php', {action: 'pretraga-update-oglasi', vjestine: vjestine, page: page, naziv_oglasa: naziv_oglasa}, function(res){
		$('#rezultati-pretrage-oglasa').empty().append(res);
		var koliko = $('.oglas-preview').length;
		$('.koliko-value').val(koliko);
	});
}
