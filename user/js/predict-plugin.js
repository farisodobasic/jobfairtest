var root_url = "http://www.jobfair.ba/";
/* Gradovi predict sistem */
$(document).on("keyup", ".predict-grad-big", function(){
	var key = $(this).val();
	var element = $(this);

	// Ukoliko pritisne enter
	if (event.keyCode == 13){
		// Ukoliko postoji item koji ima id
	 	if(!isNaN($('.selected-grad').children('.grad-id').val())){
	 		// Uzmi podatke, dodaj na listu odabranih i zatvori
	 		var id 			= $('.selected-grad').children('.grad-id').val();
	 		var naziv 	= $('.selected-grad').children('.grad-naziv').val();

	 		var ima = false;

	 		$(".filter-item-grad").each(function(){
	 			if($(this).children('.selected-grad-id').val() == id) ima = true;
	 		});

      element.siblings('.hidden-grad').val('');
      element.siblings('.grad-naziv').val('');

	 		if(!ima){
        element.siblings('.hidden-grad').val(id);
      	element.siblings('.grad-naziv').val(naziv);
	 		}

			element.siblings('.predict-grad-list').fadeOut();
			element.siblings('.predict-grad-list').empty();
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
			$.post(root_url + 'kompanije/action.php', {action: 'predict-grad', key: key}, function(res){
				element.siblings('.predict-grad-list').fadeIn();
				element.siblings('.predict-grad-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			element.siblings('.predict-grad-list').fadeOut();
			element.siblings('.predict-grad-list').empty();
		}
	 }
});

$(document).on("click", ".click-to-use-grad ", function(){
	var id 			= $(this).children('.grad-id').val();
	var naziv 		= $(this).children('.grad-naziv').val();
	var element = $(this);

	var ima = false;

	$(".filter-item-grad").each(function(){
	 	if($(this).children('.selected-grad-id').val() == id) ima = true;
	});

  element.parent().siblings('.hidden-grad').val('');
  element.parent().siblings('.grad-naziv').val('');

	if(!ima){
    element.parent().siblings('.hidden-grad').val(id);
    element.parent().siblings('.grad-naziv').val(naziv);
	}

	element.parent().siblings('.predict-grad-list').fadeOut();
	element.parent().siblings('.predict-grad-list').empty();
});

/* Fakultet predict sistem */
$(document).on("keyup", ".predict-fakultet-veliko", function(){
	var key = $(this).val();
	var element = $(this);

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

	 		element.siblings('.predict-fakultet-list').fadeOut();
			element.siblings('.predict-fakultet-list').empty();

      element.siblings('.hidden-fakultet').val('');
      element.siblings('.fakultet-naziv').val('');

	 		if(!ima){
        element.siblings('.hidden-fakultet').val(id);
        element.siblings('.fakultet-naziv').val(naziv);
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
			$.post(root_url + 'kompanije/action.php', {action: 'predict-fakultet', key: key}, function(res){
				element.siblings('.predict-fakultet-list').fadeIn();
				element.siblings('.predict-fakultet-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			element.siblings('.predict-fakultet-list').fadeOut();
			element.siblings('.predict-fakultet-list').empty();
		}
	 }
});

$(document).on("click", ".click-to-use-fakultet", function(){
	var id 			= $(this).children('.fakultet-id').val();
	var naziv 	= $(this).children('.fakultet-naziv').val();
	var element = $(this);

	var ima = false;

  element.siblings('.hidden-fakultet').val(id);
  element.siblings('.fakultet-naziv').val(naziv);

	if(!ima){
    element.parent().siblings('.hidden-fakultet').val(id);
    element.parent().siblings('.fakultet-naziv').val(naziv);

	}

	element.parent().siblings('.predict-fakultet-list').fadeOut();
	element.parent().siblings('.predict-fakultet-list').empty();
});

/* Predict jezik */
$(document).on("keyup", ".predict-maternji", function(){
	var key = $(this).val();
	var element = $(this);

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
      element.siblings('.maternji-naziv').val('');
			element.siblings('.maternji-id').val('');

	 		if(!ima){
        element.siblings('.maternji-naziv').val(naziv);
  			element.siblings('.maternji-id').val(id);
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
			$.post(root_url + 'kompanije/action.php', {action: 'predict-jezik-maternji', key: key}, function(res){
				element.siblings('.predict-jezik-list').fadeIn();
				element.siblings('.predict-jezik-list').empty().append(res);
			});
		}else{
			// Ukoliko je prazno
			element.siblings('.predict-jezik-list').fadeOut();
			element.siblings('.predict-jezik-list').empty();
		}
	 }
});

$(document).on("click", ".click-to-use-jezik-maternji", function(){
	var id 			= $(this).children('.jezik-id').val();
	var naziv 		= $(this).children('.jezik-naziv').val();
	var element = $(this);

//	alert(id + " " + naziv);
	var ima = false;

	$(".filter-item-jezik").each(function(){
	 	if($(this).children('.selected-jezik-id').val() == id) ima = true;
	});

	element.parent().siblings('.maternji-naziv').val('');
	element.parent().siblings('.maternji-id').val('');

	if(!ima){
		element.parent().siblings('.maternji-naziv').val(naziv);
		element.parent().siblings('.maternji-id').val(id);
	}

	$('.predict-jezik-list').fadeOut();
	$('.predict-jezik-list').empty();
});

$(document).on("keyup", ".predict-jezici", function(){
	var key = $(this).val();
	var element = $(this);

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

	 		$('.predict-jezik-list-sve').fadeOut();
			$('.predict-jezik-list-sve').empty();
      element.closest('.jezik-naziv').val('');
			element.siblings('.jezik-hidden').val('');

	 		if(!ima){
        element.closest('.jezik-naziv').val(naziv);
  			element.siblings('.jezik-hidden').val(id);
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
			$.post(root_url + 'kompanije/action.php', {action: 'predict-jezik', key: key}, function(res){
				$('.predict-list').empty().append(res);
			});
			element.siblings('.predict-list').fadeIn();
		}else{
			// Ukoliko je prazno
			element.closest('.predict-jezik-list-sve').fadeOut();
			element.closest('.predict-jezik-list-sve').empty();
		}
	 }
});

$(document).on("click", ".click-to-use-jezik", function(){
	var id 			= $(this).children('.jezik-id').val();
	var naziv 		= $(this).children('.jezik-naziv').val();
	var element = $(this);

	var ima = false;

	$(".filter-item-jezik").each(function(){
	 	if($(this).children('.selected-jezik-id').val() == id) ima = true;
	});

	element.parent().siblings('.predict-list').siblings('.jezik-naziv').val('');
	element.parent().siblings('.jezik-hidden').val('');

	if(!ima){
		element.parent().siblings('.jezik-naziv').val(naziv);
		element.parent().siblings('.jezik-hidden').val(id);
	}

	$('.predict-list').fadeOut();
	$('.predict-list').empty();
});
