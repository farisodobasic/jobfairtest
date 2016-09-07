var root_url = "http://www.jobfair.ba/";

function dodaj_novo_iskustvo(){
  $.post('./action.php', {action: 'dodaj-novo-iskustvo'}, function(res){
    $('.iskustva').append(res);
  });
}

function dodaj_fakultetsko_obrazovanje(){
  $.post('./action.php', {action: 'dodaj-novo-fakultetsko-obrazovanje'}, function(res){
    $('.fakultetsko-lista').append(res);
  });
}

function dodaj_novi_jezik(){
  $.post('./action.php', {action: 'dodatni-jezik'}, function(res){
    $('.lista-dodatnih-jezika').append(res);
  });
}

function dodatna_edukacija(){
  $.post('./action.php', {action: 'dodatna-edukacija'}, function(res){
    $('.dodatna-edukacija').append(res);
  });
}

var oi_validacija = true;
var ri_validacija = true;
var edu_validacija = true;
var dod_edu_validacija = true;
var vje_validacija = true;

/* Osnovne informacije spremanje */
function spremi_oi(){
  var moze = validacija_oi();
  if(!moze){
    return false;
  }

  var ime       = $('.oi-ime').val();
  var prezime   = $('.oi-prezime').val();
  var mail      = $('.oi-mail').val();
  var grad      = $('.oi-grad').val();
  var adresa    = $('.oi-adresa').val();
  var telefon   = $('.oi-telefon').val();
  var datum_r   = $('.oi-g').val() + '-' + $('.oi-m').val() + '-' + $('.oi-d').val();
  var spol      = $('.spol-odabir:checked').val();

  if($('.oi-ft').is(':checked')) var full_time = 1; else var full_time = 0;
  if($('.oi-pt').is(':checked')) var part_time = 1; else var part_time = 0;
  if($('.oi-pr').is(':checked')) var praksa = 1; else var praksa = 0;

  //alert(ime + ", " + prezime + ", " + mail + ", " + grad + ", " + adresa + ", " + telefon + ", " + datum_r + ", " + spol);
  //alert(full_time + ", " + part_time + ", " + praksa);

  if(moze){
    $.post('./action.php', {action: 'spremi-oi', ime: ime, prezime: prezime, mail: mail, grad: grad, adresa: adresa, telefon: telefon, datum_r: datum_r, spol: spol, full_time: full_time, part_time: part_time, praksa: praksa}, function(res){
      console.log("Osnovne info: " + res);

    });
    return true;
  }
}

function validacija_oi(){
  oi_validacija = true;

  var ime       = $('.oi-ime').val();
  var prezime   = $('.oi-prezime').val();
  var mail      = $('.oi-mail').val();
  var grad      = $('.oi-grad').val();
  var adresa    = $('.oi-adresa').val();
  var telefon   = $('.oi-telefon').val();
  var datum_r   = $('.oi-g').val() + '-' + $('.oi-m').val() + '-' + $('.oi-d').val();
  var spol      = $('.spol-odabir').val();

  var append_oi = "";

  if(ime == "") $('.oi-ime').css('border-color', '#C0392B'); else $('.oi-ime').css('border-color', '#d5d5d5');
  if(prezime == "") $('.oi-prezime').css('border-color', '#C0392B'); else $('.oi-prezime').css('border-color', '#d5d5d5');
  if(mail == "") $('.oi-mail').css('border-color', '#C0392B'); else $('.oi-mail').css('border-color', '#d5d5d5');
  if(grad == "") $('.grad-naziv').css('border-color', '#C0392B'); else $('.grad-naziv').css('border-color', '#d5d5d5');
  if(adresa == "") $('.oi-adresa').css('border-color', '#C0392B'); else $('.oi-adresa').css('border-color', '#d5d5d5');
  if(telefon == "") $('.oi-telefon').css('border-color', '#C0392B'); else $('.oi-telefon').css('border-color', '#d5d5d5');
  if(adresa)

  if(ime == "" || prezime == "" || mail == "" || grad == "" || grad == 0 || adresa == "" || telefon == ""){
    append_oi += "Popunite sve potrebne podatke.<br />";
    oi_validacija = false;
  }

  if(spol == undefined){
    append_oi += "Odaberite spol.<br />";
    oi_validacija = false;
  }

  if($('.oi-g').val() == "" || $('.oi-g').val() == undefined || $('.oi-m').val() == "" || $('.oi-m').val() == undefined ||  $('.oi-d').val() == "" || $('.oi-d').val() == undefined){
    append_oi += "Unesite validan datum rođenja.<br />";
    $('.oi-g').parent().css('border-color', '#C0392B');
    $('.oi-m').parent().css('border-color', '#C0392B');
    $('.oi-d').parent().css('border-color', '#C0392B');
    oi_validacija = false;
  }else{
    $('.oi-g').parent().css('border-color', '#d5d5d5');
    $('.oi-m').parent().css('border-color', '#d5d5d5');
    $('.oi-d').parent().css('border-color', '#d5d5d5');
  }

  if(!oi_validacija){
    $('.kp-scroll').css('background', '#FFD9D4');
    $('.oi-error').empty().append(append_oi);
    $('.oi-error').show();
  }else{
    $('.kp-scroll').css('background', '#FFFFFF');
    $('.oi-error').empty();
    $('.oi-error').hide();
  }
  return oi_validacija;
}

/* Spremanje radnog iskustva */
function spremi_ri(){
  var moze = validacija_ri();
  if(!moze){
    return false;
  }

  var iskustva  = {};

      iskustva['vrsta']       = [];
      iskustva['pozicija']    = [];
      iskustva['opis']        = [];
      iskustva['poslodavac']  = [];
      iskustva['od']          = [];
      iskustva['do']          = [];
      iskustva['edited']      = [];
      iskustva['aktivno']     = [];


  $('.radno-iskustvo-block').each(function(){
      iskustva['vrsta'].push($(this).find(".vrsta-iskustva:checked").val());
      iskustva['pozicija'].push($(this).children('.ri-pozicija').val());
      iskustva['opis'].push($(this).children('.ri-opis').val());
      iskustva['poslodavac'].push($(this).children('.ri-poslodavac').val());
      iskustva['od'].push($(this).children('.dropdown-select').children('.ri-od-g').val() + '-' + $(this).children('.dropdown-select').children('.ri-od-m').val() + '-' + $(this).children('.dropdown-select').children('.ri-od-d').val());
      iskustva['do'].push($(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-g').val() + '-' + $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-m').val() + '-' + $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-d').val());
      iskustva['edited'].push($(this).children('.ri-edited').val());

      if($(this).children('.form-checkbox').children('.ri-aktivno').is(":checked")) iskustva['aktivno'].push(1); else iskustva['aktivno'].push(0);
  });

  var data = JSON.stringify(iskustva);

  if(moze){
    $.post('./action.php', {action: 'spremi-ri', data: data}, function(res){
      console.log("Radno iskustvo: " + res);

    });
    return true;
  }
}

function validacija_ri(){
  ri_validacija = true;

  var append_ri = "";

  $('.radno-iskustvo-block').each(function(){
      if(ri_validacija){
        if($(this).find(".vrsta-iskustva:checked").val() == undefined){ append_ri += "Odaberite vrstu isksutva.<br />"; ri_validacija = false; }

        if($(this).children('.ri-pozicija').val() == ""){
          append_ri += "Ispunite poziciju.<br />";
          $(this).children('.ri-pozicija').css('border-color', '#C0392B');
          ri_validacija = false;
        }else{
          $(this).children('.ri-pozicija').css('border-color', '#d5d5d5');
        }

        if($(this).children('.ri-opis').val() == ""){
          append_ri += "Unesite opis radnog iskustva.<br />";
          $(this).children('.ri-opis').css('border-color', '#C0392B');
          ri_validacija = false;
        }else{
          $(this).children('.ri-opis').css('border-color', '#d5d5d5');
        }

        if($(this).children('.ri-poslodavac').val() == ""){
          append_ri += "Unesite naziv poslodavca.<br />";
          $(this).children('.ri-poslodavac').css('border-color', '#C0392B');
          ri_validacija = false;
        }else{
          $(this).children('.ri-poslodavac').css('border-color', '#d5d5d5');
        }

        if(!$(this).children('.ri-aktivno').is(":checked")){
          var od_d = $(this).children('.dropdown-select').children('.ri-od-g').val() + '-' + $(this).children('.dropdown-select').children('.ri-od-m').val() + '-' + $(this).children('.dropdown-select').children('.ri-od-d').val();
          var do_d = $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-g').val() + '-' + $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-m').val() + '-' + $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-d').val();

          dA1 = od_d.split('-'),
          ts1 = new Date(dA1[1] + "-" + dA1[0] + "-" + dA1[2]).getTime();

          dA2 = do_d.split('-'),
          ts2 = new Date(dA2[1] + "-" + dA2[0] + "-" + dA2[2]).getTime();

          if(dA2 - dA1 < 0){
            append_ri += "Unesite validan vremenski period.<br />";
            ri_validacija = false;
          }
        }

        if($(this).children('.dropdown-select').children('.ri-od-g').val() == "" || $(this).children('.dropdown-select').children('.ri-od-g').val() == undefined || $(this).children('.dropdown-select').children('.ri-od-m').val() == "" || $(this).children('.dropdown-select').children('.ri-od-m').val() == undefined ||  $(this).children('.dropdown-select').children('.ri-od-d').val() == "" || $(this).children('.dropdown-select').children('.ri-od-d').val() == undefined){
          append_ri += "Unesite validan datum početka.<br />";
          $(this).children('.dropdown-select').children('.ri-od-g').css('border-color', '#C0392B');
          $(this).children('.dropdown-select').children('.ri-od-m').css('border-color', '#C0392B');
          $(this).children('.dropdown-select').children('.ri-od-d').parent().css('border-color', '#C0392B');
          ri_validacija = false;
        }else{
          $(this).children('.dropdown-select').children('.ri-od-g').css('border-color', '#d5d5d5');
          $(this).children('.dropdown-select').children('.ri-od-m').parent().css('border-color', '#d5d5d5');
          $(this).children('.dropdown-select').children('.ri-od-d').parent().css('border-color', '#d5d5d5');
        }

        if(!$(this).children('.form-checkbox').children('.ri-aktivno').is(":checked")){
          if($(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-g').val() == "" || $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-g').val() == undefined || $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-m').val() == "" || $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-m').val() == undefined ||  $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-d').val() == "" || $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-d').val() == undefined){
            append_ri += "Unesite validan datum kraja.<br />";
            $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-g').css('border-color', '#C0392B');
            $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-m').css('border-color', '#C0392B');
            $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-d').parent().css('border-color', '#C0392B');
            ri_validacija = false;
          }else{
            $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-g').css('border-color', '#d5d5d5');
            $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-m').parent().css('border-color', '#d5d5d5');
            $(this).children('.aktivni-addition').children('.dropdown-select').children('.ri-do-d').parent().css('border-color', '#d5d5d5');
          }
        }
      }
  });

  if(!ri_validacija){
    $('.ri-scroll').css('background', '#FFD9D4');
    $('.ri-error').empty().append(append_ri);
    $('.ri-error').show();
  }else{
    $('.ri-scroll').css('background', '#FFFFFF');
    $('.ri-error').empty();
    $('.ri-error').hide();
  }
  return ri_validacija;
}

function spremi_edu(){
    var moze = validacija_edu();
    if(!moze){
      return false;
    }
    var srednja_naziv   = $('.edu-sr-naziv').val();
    var srednja_grad    = $('.edu-sr-grad').val();
    var srednja_smjer   = $('.edu-sr-smjer').val();
    var srednja_kraj    = $('.edu-sr-kraj').val();
    var srednja_edit    = $('.edu-sr-edit').val();

    var faks = {};

        faks['edit'] = [];
        faks['faks'] = [];
        faks['smjer'] = [];
        faks['godina'] = [];
        faks['prosjek'] = [];
        faks['pocetak'] = [];
        faks['kraj'] = [];


    $('.fakultetsko-obrazovanje').each(function(){
        faks['faks'].push($(this).children('.edu-faks').val());
        faks['smjer'].push($(this).children('.edu-faks-smjer').val());

        if($(this).children('.form-checkbox').children('.edu-faks-status:checked').val() == 2)
          faks['godina'].push(8);
        else {
          faks['godina'].push($(this).children('.student-addition').children('.form-checkbox').children('.edu-faks-godina:checked').val());
        }

        faks['prosjek'].push($(this).children('.edu-faks-prosjek').val());
        faks['edit'].push($(this).children('.edu-faks-edit').val());

        faks['pocetak'].push($(this).children('.dropdown-select').children('.edu-od-g').val() + '-' + $(this).children('.dropdown-select').children('.edu-od-m').val() + '-' + $(this).children('.dropdown-select').children('.edu-od-d').val());
        faks['kraj'].push($(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-g').val() + '-' + $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-m').val() + '-' + $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-d').val());

    });

    var data_faks = JSON.stringify(faks);

    var maternji = $('.maternji-id').val();

    var jezici = {};
        jezici['edit'] = [];
        jezici['jezik'] = [];
        jezici['raz'] = [];
        jezici['govor'] = [];
        jezici['pisanje'] = [];

    $('.dodatni-jezik').each(function(){

        jezici['jezik'].push($(this).children('.edu-jezici-id').val());
        jezici['raz'].push($(this).children('.form-checkbox').children('.edu-jezici-raz:checked').val());
        jezici['govor'].push($(this).children('.form-checkbox').children('.edu-jezici-govor:checked').val());
        jezici['pisanje'].push($(this).children('.form-checkbox').children('.edu-jezici-pis:checked').val());
        jezici['edit'].push($(this).children('.edu-jezici-edit').val());
    });

    var data_jezici = JSON.stringify(jezici);
    console.log(data_jezici);

    /*console.log(srednja_naziv + ", " + srednja_grad + ", " + srednja_kraj + ", " + srednja_edit + ", " + srednja_smjer);
    console.log(data_faks);
    console.log(data_jezici);*/

    if(moze){
      $.post('./action.php', {action: 'spremi-edu', srednja_edit: srednja_edit, srednja_naziv: srednja_naziv, srednja_smjer: srednja_smjer, srednja_grad: srednja_grad, srednja_kraj: srednja_kraj, data_faks: data_faks, maternji: maternji, data_jezici: data_jezici}, function(res){
        console.log("Edukacija: " + res);

      });
      return true;
    }
}

function validacija_edu(){
  edu_validacija = true;

  var srednja_naziv   = $('.edu-sr-naziv').val();
  var srednja_grad    = $('.edu-sr-grad').val();
  var srednja_smjer   = $('.edu-sr-smjer').val();
  var srednja_kraj    = $('.edu-sr-kraj').val();
  var srednja_edit    = $('.edu-sr-edit').val();

  var append_edu = ""

  if(srednja_naziv == "") $('.edu-sr-naziv').css('border-color', '#C0392B'); else $('.edu-sr-naziv').css('border-color', '#d5d5d5');
  if(srednja_smjer == "") $('.edu-sr-smjer').css('border-color', '#C0392B'); else $('.edu-sr-smjer').css('border-color', '#d5d5d5');
  if(srednja_kraj == "") $('.edu-sr-kraj').css('border-color', '#C0392B'); else $('.edu-sr-kraj').css('border-color', '#d5d5d5');

  if(srednja_kraj > 2015 || srednja_kraj < 1900 || isNaN(srednja_kraj)){
    append_edu += "Oblik godine završetka srednje nije validan.<br />";
    edu_validacija = false;
    $('.edu-sr-kraj').css('border-color', '#C0392B');
  } else $('.edu-sr-kraj').css('border-color', '#d5d5d5');

  if(srednja_naziv == "" || srednja_smjer == ""){
    append_edu += "Popunite polja za srednju školu.<br />";
    edu_validacija = false;
  }

  if(srednja_grad == "" || srednja_grad == 0){
    append_edu += "Odaberite grad.<br />";
    edu_validacija = false;
  }


  var faks = [];

      faks['edit'] = [];
      faks['faks'] = [];
      faks['smjer'] = [];
      faks['godina'] = [];
      faks['prosjek'] = [];
      faks['pocetak'] = [];
      faks['kraj'] = [];

  $('.fakultetsko-obrazovanje').each(function(){
    if(edu_validacija){

      if($(this).children('.edu-faks').val() == 0){
        $(this).children('.fakultet-naziv').css('border-color', '#C0392B');
        append_edu += "Odaberite fakultet.<br />";
        edu_validacija = false;
      }else{
        $(this).children('.fakultet-naziv').css('border-color', '#d5d5d5');
      }

      if($(this).children('.edu-faks-smjer').val() == ""){
        $(this).children('.edu-faks-smjer').css('border-color', '#C0392B');
        append_edu += "Upišite smjer.<br />";
        edu_validacija = false;
      }else{
        $(this).children('.edu-faks-smjer').css('border-color', '#d5d5d5');
      }


      if($(this).find('.edu-faks-status:checked').val() == 2){
        faks['godina'].push(8);
      } else {
        if($(this).find('.edu-faks-godina:checked').val() == undefined){
          append_edu += "Odaberite godinu studija.<br />";
          edu_validacija = false;
        }
      }


      faks['edit'].push($(this).children('.edu-faks-edit').val());

      faks['pocetak'].push($(this).children('.edu-od-g').val() + '-' + $(this).children('.edu-od-m').val() + '-' + $(this).children('.edu-od-d').val());
      faks['kraj'].push($(this).children('.edu-do-g').val() + '-' + $(this).children('.edu-do-m').val() + '-' + $(this).children('.edu-do-d').val());

      var od_d = $(this).children('.dropdown-select').children('.edu-od-g').val() + '-' + $(this).children('.dropdown-select').children('.edu-od-m').val() + '-' + $(this).children('.dropdown-select').children('.edu-od-d').val();
      var do_d = $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-g').val() + '-' + $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-m').val() + '-' + $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-d').val();

      if($(this).find('.edu-faks-status:checked').val() == 2){
        dA1 = od_d.split('-'),
        ts1 = new Date(dA1[1] + "-" + dA1[0] + "-" + dA1[2]).getTime();

        dA2 = do_d.split('-'),
        ts2 = new Date(dA2[1] + "-" + dA2[0] + "-" + dA2[2]).getTime();

        if(dA2 - dA1 < 0){
          append_edu += "Unesite validan vremenski period.<br />";
          edu_validacija = false;
        }
      }

      if($(this).children('.dropdown-select').children('.edu-od-g').val() == "" || $(this).children('.dropdown-select').children('.edu-od-g').val() == undefined || $(this).children('.dropdown-select').children('.edu-od-m').val() == "" || $(this).children('.dropdown-select').children('.edu-od-m').val() == undefined ||  $(this).children('.dropdown-select').children('.edu-od-d').val() == "" || $(this).children('.dropdown-select').children('.edu-od-d').val() == undefined){
        append_edu += "Unesite validan datum početka.<br />";
        $(this).children('.dropdown-select').css('border-color', '#C0392B');
        $(this).children('.dropdown-select').css('border-color', '#C0392B');
        $(this).children('.dropdown-select').css('border-color', '#C0392B');
        edu_validacija = false;
      }else{
        $(this).children('.dropdown-select').css('border-color', '#d5d5d5');
        $(this).children('.dropdown-select').css('border-color', '#d5d5d5');
        $(this).children('.dropdown-select').css('border-color', '#d5d5d5');
      }

      if($(this).find('.edu-faks-status:checked').val() == 2){
        if($(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-g').val() == "" || $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-g').val() == undefined || $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-m').val() == "" || $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-m').val() == undefined ||  $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-d').val() == "" || $(this).children('.diplomac-addition').children('.dropdown-select').children('.edu-do-d').val() == undefined){
          append_edu += "Unesite validan datum kraja.<br />";
          $(this).children('.diplomac-addition').css('border-color', '#C0392B');
          $(this).children('.diplomac-addition').css('border-color', '#C0392B');
          $(this).children('.diplomac-addition').css('border-color', '#C0392B');
          edu_validacija = false;
        }else{
          $(this).children('.diplomac-addition').css('border-color', '#d5d5d5');
          $(this).children('.diplomac-addition').css('border-color', '#d5d5d5');
          $(this).children('.diplomac-addition').css('border-color', '#d5d5d5');
        }
      }

    }

  });

  var maternji = $('.maternji-id').val();
  if(maternji == "" || maternji == 0 || maternji == undefined){
    $('.maternji-naziv').css('border-color', '#C0392B');
    append_edu += "Unesite validan maternji jezik.<br />";
    edu_validacija = false;
  }else{
    $('.maternji-naziv').css('border-color', '#d5d5d5');
  }

  var jezici = [];
      jezici['edit'] = [];
      jezici['jezik'] = [];
      jezici['raz'] = [];
      jezici['govor'] = [];
      jezici['pisanje'] = [];

  $('.dodatni-jezik').each(function(){
    if(edu_validacija){
      jezici['jezik'].push($(this).children('.edu-jezici-id').val());
      jezici['raz'].push($(this).children('.edu-jezici-raz:checked').val());
      jezici['govor'].push($(this).children('.edu-jezici-govor:checked').val());
      jezici['pisanje'].push($(this).children('.edu-jezici-pis:checked').val());
      jezici['edit'].push($(this).children('.edu-jezici-edit').val());

      if(jezici['jezik'] == "" || jezici['jezik'] == 0){
        $(this).children('.jezik-naziv').css('border-color', '#C0392B');
        append_edu += "Odaberite jezik koji govorite.<br />";
        edu_validacija = false;
      }else{
        $(this).children('.jezik-naziv').css('border-color', '#d5d5d5');
      }

      if(jezici['raz'] == undefined || jezici['govor'] == undefined || jezici['pisanje'] == undefined){
        append_edu += "Pravilno popunite poznavanje jezika.<br />";
        edu_validacija = false;
      }
    }
  });

  if(!edu_validacija){
    $('.ed-scroll').css('background', '#FFD9D4');
    $('.edu-error').empty().append(append_edu);
    $('.edu-error').show();
  }else{
    $('.ed-scroll').css('background', '#FFFFFF');
    $('.edu-error').empty();
    $('.edu-error').hide();
  }
  return edu_validacija;
}

function spremi_dod_edu(){
  var moze = validacija_dod_edu();
  if(!moze){
    return false;
  }

  var dodatna = {};
      dodatna['vrsta'] = [];
      dodatna['od'] = [];
      dodatna['do'] = [];
      dodatna['opis'] = [];
      dodatna['aktivno'] = [];
      dodatna['edit'] = [];

  $('.dodatna-edukacija-item').each(function(){
      dodatna['vrsta'].push($(this).children('.dodedu-vrsta').val());
      dodatna['opis'].push($(this).children('.dodedu-opis').val());
      dodatna['edit'].push($(this).children('.dodedu-edit').val());

      dodatna['od'].push($(this).children('.dropdown-select').children('.dodedu-od-g').val() + '-' + $(this).children('.dropdown-select').children('.dodedu-od-m').val() + '-' + $(this).children('.dropdown-select').children('.dodedu-od-d').val());
      dodatna['do'].push($(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-g').val() + '-' + $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-m').val() + '-' + $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-d').val());

      if($(this).children('.form-checkbox').children('.dodedu-aktivno').is(':checked')) dodatna['aktivno'].push(1); else dodatna['aktivno'].push(0);
  });

  var data = JSON.stringify(dodatna);

  if(moze){
    $.post('./action.php', {action: 'spremi-dod-edu', data: data}, function(res){
      console.log("Dodatna edukacija: " + res);

    });
    return true;
  }
}

function validacija_dod_edu(){
  dod_edu_validacija = true;
  var append_dod = "";

  var dodatna = [];
      dodatna['vrsta'] = [];
      dodatna['od'] = [];
      dodatna['do'] = [];
      dodatna['opis'] = [];
      dodatna['edit'] = [];

  $('.dodatna-edukacija-item').each(function(){
    if(dod_edu_validacija){
        if($(this).children('.dodedu-vrsta').val() == ""){
          append_dod += "Upišite vrstu edukacije.<br />";
          dod_edu_validacija = false;
          $(this).children('.dodedu-vrsta').css('border-color', '#C0392B');
        }else{
          $(this).children('.dodedu-vrsta').css('border-color', '#d5d5d5');
        }

        if($(this).children('.dodedu-opis').val() == ""){
          append_dod += "Unesite opis.<br />";
          dod_edu_validacija = false;
          $(this).children('.dodedu-opis').css('border-color', '#C0392B');
        }else{
          $(this).children('.dodedu-opis').css('border-color', '#d5d5d5');
        }


        if($(this).children('.dropdown-select').children('.dodedu-od-g').val() == "" || $(this).children('.dropdown-select').children('.dodedu-od-g').val() == undefined || $(this).children('.dropdown-select').children('.dodedu-od-m').val() == "" || $(this).children('.dropdown-select').children('.dodedu-od-m').val() == undefined ||  $(this).children('.dropdown-select').children('.dodedu-od-d').val() == "" || $(this).children('.dropdown-select').children('.dodedu-od-d').val() == undefined){
          append_dod += "Unesite validan datum početka.<br />";
          $(this).children('.dropdown-select').css('border-color', '#C0392B');
          $(this).children('.dropdown-select').css('border-color', '#C0392B');
          $(this).children('.dropdown-select').css('border-color', '#C0392B');
          dod_edu_validacija = false;
        }else{
          $(this).children('.dropdown-select').css('border-color', '#d5d5d5');
          $(this).children('.dropdown-select').css('border-color', '#d5d5d5');
          $(this).children('.dropdown-select').css('border-color', '#d5d5d5');
        }

        if(!$(this).children('.form-checkbox').children('.dodedu-aktivno').is(':checked')){
          if($(this).children('.dodedu-addition').children('.dropdown-select').children('.dodedu-do-g').val() == "" || $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-g').val() == undefined || $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-m').val() == "" || $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-m').val() == undefined ||  $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-d').val() == "" || $(this).children('.dod-addition').children('.dropdown-select').children('.dodedu-do-d').val() == undefined){
            append_dod += "Unesite validan datum kraja.<br />";
            $(this).children('.dod-addition').children('.dropdown-select').css('border-color', '#C0392B');
            $(this).children('.dod-addition').children('.dropdown-select').css('border-color', '#C0392B');
            $(this).children('.dod-addition').children('.dropdown-select').css('border-color', '#C0392B');
            dod_edu_validacija = false;
          }else{
            $(this).children('.dod-addition').children('.dropdown-select').css('border-color', '#d5d5d5');
            $(this).children('.dod-addition').children('.dropdown-select').css('border-color', '#d5d5d5');
            $(this).children('.dod-addition').children('.dropdown-select').css('border-color', '#d5d5d5');
          }
        }

      }
  });

  if(!dod_edu_validacija){
    $('.ded-scroll').css('background', '#FFD9D4');
    $('.dodedu-error').empty().append(append_dod);
    $('.dodedu-error').show();
  }else{
    $('.ded-scroll').css('background', '#FFFFFF');
    $('.dodedu-error').empty();
    $('.dodedu-error').hide();
  }
  return dod_edu_validacija;
}

function spremi_vjestine(){
  var moze = validacija_vje();
  if(!moze){
    //return false;
  }
  var vjestine = [];
  var vozacka;

  $(".filter-item-vjestina").each(function(){
		vjestine.push($(this).children('.selected-vjestina-id').val());
	});

  vozacka = $('.vozacka:checked').val();

  /*console.log(vozacka);
  console.log(JSON.stringify(vjestine));*/
  if(moze){
  $.post('./action.php', {action: 'spremi-vjestine', vjestine: vjestine, vozacka: vozacka}, function(res){
    console.log("Vjestine: " + res);

  });
  return true;
  }
}

function validacija_vje(){
  vje_validacija = true;

  var vje_append = "";

  vozacka = $('.vozacka:checked').val();
  if(vozacka == undefined){
    vje_append += "Označite da li imate vozačku dozvolu.";
    vje_validacija = false;
  }

  if(!vje_validacija){
    $('.vj-scroll').css('background', '#FFD9D4');
    $('.vj-error').empty().append(vje_append);
    $('.vj-error').show();
  }else{
    $('.vj-scroll').css('background', '#FFFFFF');
    $('.vj-error').empty();
    $('.vj-error').hide();
  }
  return vje_validacija;
}

function spremljen_cv(){
  $.post('./action.php', {action: 'spremljen_cv'}, function(){

  });
  return true;
}

/* Spremanje CV-ja */
function spremi_cv(){
  var oi = spremi_oi();
  var ri = spremi_ri();
  var edu = spremi_edu();
  var dod = spremi_dod_edu();
  var vje = spremi_vjestine();
  var cv = spremljen_cv();

  //console.log(oi + " " + ri + " " + edu + " " + dod + " " + vje + " " + cv);
  if(oi && ri && edu && dod && vje && cv){ setTimeout(function(){ window.location = root_url + 'user/moj-cv.php?refresh=true'; }, 700); }
}

/* Imrpovments */
$(document).on('change', '.ri-aktivno', function(){
  if($(this).is(':checked')){
    $(this).parent().siblings('.aktivni-addition').fadeOut();
  }else{
    $(this).parent().siblings('.aktivni-addition').fadeIn();
  }
});

$(document).on('change', '.dodedu-aktivno', function(){
  if($(this).is(':checked')){
    $(this).parent().siblings('.dod-addition').fadeOut();
  }else{
    $(this).parent().siblings('.dod-addition').fadeIn();
  }
});

$(document).on('change', '.edu-faks-status', function(){
  if($(this).is(':checked') && $(this).val() == 2){
    $(this).parent().siblings('.diplomac-addition').fadeIn();
    $(this).parent().siblings('.student-addition').fadeOut();
  }else{
    $(this).parent().siblings('.diplomac-addition').fadeOut();
    $(this).parent().siblings('.student-addition').fadeIn();
  }
});

/* Brisanja instanci */
$(document).on('click', '.obrisi-fakultet', function(){
  var id = $(this).siblings('.edu-faks-edit').val();
  if(id != 0 && id != ""){
    if(confirm("Da li ste sigurni da želite obrisati ovo fakultetsko obrazovanje?")){
      $.post('./action.php', {action: 'obrisi_fakultet', id: id}, function(res){
        console.log(res);
      });
      $(this).parent().remove();
    }
  }else{
    $(this).parent().remove();
  }
});

$(document).on('click', '.obrisi-ri', function(){
  var id = $(this).siblings('.ri-edited').val();
  if(id != 0 && id != ""){
    if(confirm("Da li ste sigurni da želite obrisati ovo radno iskustvo?")){
      $.post('./action.php', {action: 'obrisi_ri', id: id}, function(res){
        console.log(res);
      });
      $(this).parent().remove();
    }
  }else{
    $(this).parent().remove();
  }
});

$(document).on('click', '.obrisi-jezik', function(){
  var id = $(this).siblings('.edu-jezici-edit').val();
  if(id != 0 && id != ""){
    if(confirm("Da li ste sigurni da želite obrisati ovaj jezik?")){
      $.post('./action.php', {action: 'obrisi_jezik', id: id}, function(res){
        console.log(res);
      });
      $(this).parent().remove();
    }
  }else{
    $(this).parent().remove();
  }
});

$(document).on('click', '.obrisi-dodedu', function(){
  var id = $(this).siblings('.dodedu-edit').val();
  console.log(id);
  if(id != 0 && id != ""){
    if(confirm("Da li ste sigurni da želite obrisati ovu edukaciju?")){
      $.post('./action.php', {action: 'obrisi_dodedu', id: id}, function(res){
        console.log(res);
      });
      $(this).parent().remove();
    }
  }else{
    $(this).parent().remove();
  }
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$(document).on('click', '.register-it', function(){
  var email = $('.in-email').val();
  var pass  = $('.in-password').val();

  if(!isEmail(email)){
    alert('Pogrešan format e-maila.');
    event.preventDefault();
  }

  if(pass == null || pass == "" || pass.length < 8 || pass.length > 16){
    alert('Unesite password između 8 i 16 karaktera.');
    event.preventDefault();
  }
});
