var root_url = "http://www.jobfair.ba/";

$(document).on("click", ".click-to-use-vjestina ", function(){
	var id 			= $(this).children('.vjestina-id').val();
	var naziv 		= $(this).children('.vjestina-naziv').val();

	var ima = false;

	$(".filter-item-vjestina").each(function(){
	 	if($(this).children('.selected-vjestina-id').val() == id) ima = true;
	});

	$('.predict-vjestina-list').fadeOut();
	$('.predict-vjestina-list').empty();
	$('.predict-vjestina').val('');
	$('.predict-vjestina-oglasi').val('');

	if(!ima){
	 	$('.selected-vjestina-list').append('<div class="filter-item filter-item-vjestina">' + naziv + '  <input type="hidden" class="selected-vjestina-id" value="'+id+'" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 	update_pretraga();
	 	update_pretraga_oglasi();
	}
});

$(document).on("click", ".click-to-use-grad ", function(){
	var id 			= $(this).children('.grad-id').val();
	var naziv 		= $(this).children('.grad-naziv').val();

	var ima = false;

	$(".filter-item-grad").each(function(){
	 	if($(this).children('.selected-grad-id').val() == id) ima = true;
	});

	$('.predict-grad-list').fadeOut();
	$('.predict-grad-list').empty();
	$('.predict-grad').val('');

	if(!ima){
	 	$('.selected-grad-list').append('<div class="filter-item filter-item-grad">' + naziv + '  <input type="hidden" class="selected-grad-id" value="'+id+'" /><a class="ukini-grad-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 	update_pretraga();
	}
});

$(document).on("click", ".click-to-use-jezik ", function(){
	var id 			= $(this).children('.jezik-id').val();
	var naziv 		= $(this).children('.jezik-naziv').val();

	var ima = false;

	$(".filter-item-jezik").each(function(){
	 	if($(this).children('.selected-jezik-id').val() == id) ima = true;
	});

	$('.predict-jezik-list').fadeOut();
	$('.predict-jezik-list').empty();
	$('.predict-jezik').val('');

	if(!ima){
	 	$('.selected-jezik-list').append('<div class="filter-item filter-item-jezik">' + naziv + '  <input type="hidden" class="selected-jezik-id" value="'+id+'" /><a class="ukini-jezik-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 	update_pretraga();
	}
});

$(document).on("click", ".click-to-use-fakultet ", function(){
	var id 			= $(this).children('.fakultet-id').val();
	var naziv 		= $(this).children('.fakultet-naziv').val();

	var ima = false;

	$(".filter-item-fakultet").each(function(){
	 	if($(this).children('.selected-fakultet-id').val() == id) ima = true;
	});

	$('.predict-fakultet-list').fadeOut();
	$('.predict-fakultet-list').empty();
	$('.predict-fakultet').val('');

	if(!ima){
	 	$('.selected-fakultet-list').append('<div class="filter-item filter-item-fakultet">' + naziv + '  <input type="hidden" class="selected-fakultet-id" value="'+id+'" /><a class="ukini-fakultet-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 	update_pretraga();
	}
});

$(document).on("click", ".click-to-use-ime ", function(){
	// Uzmi podatke, dodaj na listu odabranih i zatvori
	var ime 			= $('.selected-ime').children('.ime-ime').val();
	var prezime 		= $('.selected-ime').children('.ime-prezime').val();

	var ima = false;

	$(".filter-item-ime").each(function(){
		var uporedi = ime + " " + prezime;
	 	if($(this).children('.selected-ime-ime').val() == uporedi) ima = true;
	});

	$('.predict-ime-list').fadeOut();
	$('.predict-ime-list').empty();
	$('.predict-ime').val('');

	if(!ima){
	 	$('.selected-ime-list').append('<div class="filter-item filter-item-ime">' + ime + ' '+prezime+' <input type="hidden" class="selected-ime-ime" value="'+ime+' '+prezime+'" /><a class="ukini-ime-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 	update_pretraga();
	}
});

/* Pretraga studenata */
$(document).on("click", ".ukini-vjestina-filter", function(){
	$(this).parent().remove();
	update_pretraga();
	update_pretraga_oglasi();
});

$(document).on("click", ".ukini-fakultet-filter", function(){
	$(this).parent().remove();
	update_pretraga();
});

$(document).on("click", ".ukini-fakultet-filter", function(){
	$(this).parent().remove();
	update_pretraga();
});

$(document).on("click", ".ukini-grad-filter", function(){
	$(this).parent().remove();
	update_pretraga();
});

$(document).on("click", ".ukini-jezik-filter", function(){
	$(this).parent().remove();
	update_pretraga();
});

$(document).on("click", ".ukini-ime-filter", function(){
	$(this).parent().remove();
	update_pretraga();
});

$(document).on("focusout", ".predict-vjestina", function(){
	$('.predict-vjestina-list').fadeOut();
	$('.predict-vjestina-list').empty();
	$('.predict-vjestina').val('');
});

$(document).on("focusout", ".predict-vjestina-oglasi", function(){
	$('.predict-vjestina-list').fadeOut();
	$('.predict-vjestina-list').empty();
	$('.predict-vjestina-oglasi').val('');
});


/* Predviđanje vještine */
$(document).on("keyup", ".predict-vjestina", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-vjestina').children('.vjestina-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-vjestina').children('.vjestina-id').val();
	 		var naziv 		= $('.selected-vjestina').children('.vjestina-naziv').val();

	 		var ima = false;

	 		$(".filter-item-vjestina").each(function(){
	 			if($(this).children('.selected-vjestina-id').val() == id) ima = true;
	 		});

	 		$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
			$('.predict-vjestina').val('');

	 		if(!ima){
	 			$('.selected-vjestina-list').append('<div class="filter-item filter-item-vjestina">' + naziv + '  <input type="hidden" class="selected-vjestina-id" value="'+id+'" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').next().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').prev().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').prev().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').next().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post(root_url + 'kompanije/action.php', {action: 'predict-vjestina', key: key}, function(res){
				$('.predict-vjestina-list').fadeIn();
				$('.predict-vjestina-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
		}
	 }
});


/* Predviđanje vještine */
$(document).on("keyup", ".predict-vjestina-oglasi", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-vjestina').children('.vjestina-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-vjestina').children('.vjestina-id').val();
	 		var naziv 		= $('.selected-vjestina').children('.vjestina-naziv').val();

	 		var ima = false;

	 		$(".filter-item-vjestina").each(function(){
	 			if($(this).children('.selected-vjestina-id').val() == id) ima = true;
	 		});

	 		$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
			$('.predict-vjestina-oglasi').val('');

	 		if(!ima){
	 			$('.selected-vjestina-list').append('<div class="filter-item filter-item-vjestina">' + naziv + '  <input type="hidden" class="selected-vjestina-id" value="'+id+'" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga_oglasi();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').next().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').prev().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').prev().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').next().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-vjestina', key: key}, function(res){
				$('.predict-vjestina-list').fadeIn();
				$('.predict-vjestina-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
		}
	 }
});

/* Predviđanje vještine */
$(document).on("keyup", ".predict-vjestina-tehnicke", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-vjestina').children('.vjestina-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-vjestina').children('.vjestina-id').val();
	 		var naziv 		= $('.selected-vjestina').children('.vjestina-naziv').val();

	 		var ima = false;

	 		$(".filter-item-vjestina").each(function(){
	 			if($(this).children('.selected-vjestina-id').val() == id) ima = true;
	 		});

	 		$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
			$('.predict-vjestina-oglasi').val('');

	 		if(!ima){
	 			$('.selected-vjestina-list').append('<div class="filter-item filter-item-vjestina">' + naziv + '  <input type="hidden" class="selected-vjestina-id" value="'+id+'" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga_oglasi();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').next().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').prev().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').prev().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').next().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-vjestina-tehnicke', key: key}, function(res){
				$('.predict-vjestina-list').fadeIn();
				$('.predict-vjestina-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
		}
	 }
});

/* Predviđanje vještine */
$(document).on("keyup", ".predict-vjestina-drustvene", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-vjestina').children('.vjestina-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-vjestina').children('.vjestina-id').val();
	 		var naziv 		= $('.selected-vjestina').children('.vjestina-naziv').val();

	 		var ima = false;

	 		$(".filter-item-vjestina").each(function(){
	 			if($(this).children('.selected-vjestina-id').val() == id) ima = true;
	 		});

	 		$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
			$('.predict-vjestina-oglasi').val('');

	 		if(!ima){
	 			$('.selected-vjestina-list').append('<div class="filter-item filter-item-vjestina">' + naziv + '  <input type="hidden" class="selected-vjestina-id" value="'+id+'" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga_oglasi();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').next().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').prev().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').prev().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').next().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-vjestina-drustvene', key: key}, function(res){
				$('.predict-vjestina-list').fadeIn();
				$('.predict-vjestina-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
		}
	 }
});

/* Predviđanje vještine */
$(document).on("keyup", ".predict-vjestina-ostale", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-vjestina').children('.vjestina-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-vjestina').children('.vjestina-id').val();
	 		var naziv 		= $('.selected-vjestina').children('.vjestina-naziv').val();

	 		var ima = false;

	 		$(".filter-item-vjestina").each(function(){
	 			if($(this).children('.selected-vjestina-id').val() == id) ima = true;
	 		});

	 		$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
			$('.predict-vjestina-oglasi').val('');

	 		if(!ima){
	 			$('.selected-vjestina-list').append('<div class="filter-item filter-item-vjestina">' + naziv + '  <input type="hidden" class="selected-vjestina-id" value="'+id+'" /><a class="ukini-vjestina-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga_oglasi();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').next().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').prev().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-vjestina').prev().addClass('selected-vjestina').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').next().removeClass('selected-vjestina').removeClass('ukini-prethodni');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-vjestina-drustvene-ostale', key: key}, function(res){
				$('.predict-vjestina-list').fadeIn();
				$('.predict-vjestina-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-vjestina-list').fadeOut();
			$('.predict-vjestina-list').empty();
		}
	 }
});


/* Predviđanje fakulteti */
$(document).on("keyup", ".predict-fakultet", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-fakultet').children('.fakultet-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-fakultet').children('.fakultet-id').val();
	 		var naziv 		= $('.selected-fakultet').children('.fakultet-naziv').val();

	 		var ima = false;

	 		$(".filter-item-fakultet").each(function(){
	 			if($(this).children('.selected-fakultet-id').val() == id) ima = true;
	 		});

	 		$('.predict-fakultet-list').fadeOut();
			$('.predict-fakultet-list').empty();
			$('.predict-fakultet').val('');

	 		if(!ima){
	 			$('.selected-fakultet-list').append('<div class="filter-item filter-item-fakultet">' + naziv + '  <input type="hidden" class="selected-fakultet-id" value="'+id+'" /><a class="ukini-fakultet-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-fakultet').next().addClass('selected-fakultet').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').prev().removeClass('selected-fakultet').removeClass('ukini-prethodni');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-fakultet').prev().addClass('selected-fakultet').addClass('ukini-prethodni');
	 	$('.ukini-prethodni').next().removeClass('selected-fakultet').removeClass('ukini-prethodni');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-fakultet', key: key}, function(res){
				$('.predict-fakultet-list').fadeIn();
				$('.predict-fakultet-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-fakultet-list').fadeOut();
			$('.predict-fakultet-list').empty();
		}
	 }
});

/* Gradovi predict sistem */
$(document).on("keyup", ".predict-grad", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-grad').children('.grad-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-grad').children('.grad-id').val();
	 		var naziv 		= $('.selected-grad').children('.grad-naziv').val();

	 		var ima = false;

	 		$(".filter-item-grad").each(function(){
	 			if($(this).children('.selected-grad-id').val() == id) ima = true;
	 		});

	 		$('.predict-grad-list').fadeOut();
			$('.predict-grad-list').empty();
			$('.predict-grad').val('');

	 		if(!ima){
	 			$('.selected-grad-list').append('<div class="filter-item filter-item-grad">' + naziv + '  <input type="hidden" class="selected-grad-id" value="'+id+'" /><a class="ukini-grad-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-grad').next().addClass('selected-grad').addClass('ukini-prethodni-grad');
	 	$('.ukini-prethodni-grad').prev().removeClass('selected-grad').removeClass('ukini-prethodni-grad');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-grad').prev().addClass('selected-grad').addClass('ukini-prethodni-grad');
	 	$('.ukini-prethodni-grad').next().removeClass('selected-grad').removeClass('ukini-prethodni-grad');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-grad', key: key}, function(res){
				$('.predict-grad-list').fadeIn();
				$('.predict-grad-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-grad-list').fadeOut();
			$('.predict-grad-list').empty();
		}
	 }
});

/* Jezik predict sistem */
$(document).on("keyup", ".predict-jezik", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-jezik').children('.jezik-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-jezik').children('.jezik-id').val();
	 		var naziv 		= $('.selected-jezik').children('.jezik-naziv').val();

	 		var ima = false;

	 		$(".filter-item-jezik").each(function(){
	 			if($(this).children('.selected-jezik-id').val() == id) ima = true;
	 		});

	 		$('.predict-jezik-list').fadeOut();
			$('.predict-jezik-list').empty();
			$('.predict-jezik').val('');

	 		if(!ima){
	 			$('.selected-jezik-list').append('<div class="filter-item filter-item-jezik">' + naziv + '  <input type="hidden" class="selected-jezik-id" value="'+id+'" /><a class="ukini-jezik-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-jezik').next().addClass('selected-jezik').addClass('ukini-prethodni-jezik');
	 	$('.ukini-prethodni-jezik').prev().removeClass('selected-jezik').removeClass('ukini-prethodni-jezik');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-jezik').prev().addClass('selected-jezik').addClass('ukini-prethodni-jezik');
	 	$('.ukini-prethodni-jezik').next().removeClass('selected-jezik').removeClass('ukini-prethodni-jezik');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-jezik', key: key}, function(res){
				$('.predict-jezik-list').fadeIn();
				$('.predict-jezik-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-jezik-list').fadeOut();
			$('.predict-jezik-list').empty();
		}
	 }
});

/* Jezik predict ime */
$(document).on("keyup", ".predict-ime", function(){
	var key = $(this).val();

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if($('.selected-ime').children('.ime-ime').val().length > 0){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var ime 			= $('.selected-ime').children('.ime-ime').val();
	 		var prezime 		= $('.selected-ime').children('.ime-prezime').val();

	 		var ima = false;

	 		$(".filter-item-ime").each(function(){
				var uporedi = ime + " " + prezime;
			 	if($(this).children('.selected-ime-ime').val() == uporedi) ima = true;
			});

	 		$('.predict-ime-list').fadeOut();
			$('.predict-ime-list').empty();
			$('.predict-ime').val('');

	 		if(!ima){
	 			$('.selected-ime-list').append('<div class="filter-item filter-item-ime">' + ime + ' '+prezime+' <input type="hidden" class="selected-ime-ime" value="'+ime+' '+prezime+'" /><a class="ukini-ime-filter" href="javascript:void(0);"><img width="12" src="'+root_url+'icons/delete.png" /></a></div>');
	 			update_pretraga();
	 		}
	 	}else{
	 		// Ništa
	 	}
	 }else if(event.keyCode == 40){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-ime').next().addClass('selected-ime').addClass('ukini-prethodni-ime');
	 	$('.ukini-prethodni-ime').prev().removeClass('selected-ime').removeClass('ukini-prethodni-ime');
	 }else if(event.keyCode == 38){
	 	//$('.selected-vjestina').removeClass('selected-vjestina');
	 	$('.selected-ime').prev().addClass('selected-ime').addClass('ukini-prethodni-ime');
	 	$('.ukini-prethodni-ime').next().removeClass('selected-ime').removeClass('ukini-prethodni-ime');
	 }else{
	 	if(key != ""){
	 		// Ako je uneseno neko slovo, pojam, riječ
			$.post('./action.php', {action: 'predict-ime', key: key}, function(res){
				$('.predict-ime-list').fadeIn();
				$('.predict-ime-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			$('.predict-ime-list').fadeOut();
			$('.predict-ime-list').empty();
		}
	 }
});

/* Naziv oglasa on change */
$(document).on('keyup', '.naziv-oglasa', function(){
	update_pretraga_oglasi();
});

/* Godina studija */
$(document).on("change", ".god_studija", function(){
	var key = $(this).val();
	if(key != "ukini-god-studija"){
		var odabrane_godine = [];
		$('.ukini-god-studija').prop('checked', false);
		update_pretraga();
	}else{
		$('.god_studija').each(function(){
			$(this).prop('checked', false);
		});
		$(this).prop('checked', true);
		update_pretraga();
	}
});

/* Spol filter */
$(document).on("change", ".spol-filter", function(){
	if($(this).is(':checked')){
		$('.spol-filter').each(function(){
			$(this).prop('checked', false);
		});
		$(this).prop('checked', true);
		update_pretraga();
	}else{
		$('.spol-filter').each(function(){
			if($(this).val() != 0) $(this).prop('checked', false);
				else $(this).prop('checked', true);
		});
		update_pretraga();
	}
});

/* VOzacka filter */
$(document).on("change", ".vozacka-filter", function(){
	if($(this).is(':checked')){
		$('.vozacka-filter').each(function(){
			$(this).prop('checked', false);
		});
		$(this).prop('checked', true);
		update_pretraga();
	}else{
		$('.vozacka-filter').each(function(){
			if($(this).val() != 0) $(this).prop('checked', false);
				else $(this).prop('checked', true);
		});
		update_pretraga();
	}
});

/* Vrta posal filter */
$(document).on("change", ".vrsta-posla-filter", function(){
	var key = $(this).val();
	if(key != 0){
		var odabrane_godine = [];
		$('.ukini-filter-vrsta-posla').prop('checked', false);
		update_pretraga();
	}else{
		$('.vrsta-posla-filter').each(function(){
			$(this).prop('checked', false);
		});
		$(this).prop('checked', true);
		update_pretraga();
	}
});

/* Nema dalje */
var nema_dalje = false;
function sljedeca(strana){
	var koliko = $('.koliko-value').val();
	if(nema_dalje){
		nema_dalje = false;
		var prethodna = strana - 1;
		init_paginacija(prethodna, 0);
		return false;
	}
	else{
		update_pretraga(strana);

		if(koliko < 10){
			var prethodna = strana - 1;
			init_paginacija(prethodna, 0);
		}else if(koliko == 0){
			nema_dalje = true;
			update_pretraga(strana - 1);
		}else{
			var next = strana + 1;
			var prethodna = strana - 1;
			init_paginacija(prethodna, next);
		}
	}

	$('html, body').animate({scrollTop : 0},800);
}

function prethodna(strana){
	if(strana == 1){
		update_pretraga(strana);
		init_paginacija(0, 2);
	}
	else{
		update_pretraga(strana);
		init_paginacija(strana - 1, strana + 1);
	}

	$('html, body').animate({scrollTop : 0},800);
}

/* Ukljici - iskljuci soritranje po score-u */
function soritraj_score_toggle(){
	if(sortiraj_po_scoreu) sortiraj_po_scoreu = false;
		else sortiraj_po_scoreu = true;
	update_pretraga();
}

$(document).on("click", ".rang-po-score", function(){
	if(sortiraj_po_scoreu) $(this).css('opacity', '0.5');
		else $(this).css('opacity', '1');
});

function favoriti(id){
	$.post('./action.php', {action: 'dodaj_u_favorite', id: id}, function(res){
		if(res == "") location.reload();
	});
}

function ukini_favoriti(id){
	$.post('./action.php', {action: 'ukini_iz_favorita', id: id}, function(res){
		if(res == "") location.reload();
	});
}
