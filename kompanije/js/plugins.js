/* Moji oglasi long scroller */
$(document).on('click', '.neaktivni-olgasi-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.long-scroller').animate({
      marginLeft: '-=711px'
    }, 750, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    if(!$(this).hasClass('btn')) $(this).addClass('aktivan-whole');
  }
});

$(document).on('click', '.aktivni-olgasi-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.long-scroller').animate({
      marginLeft: '+=711px'
    }, 750, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    if(!$(this).hasClass('btn')) $(this).addClass('aktivan-whole');
  }
});

/* CV long scroller */
$(document).on('click', '.kp-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.cv-scroller').animate({
      marginLeft: '0px'
    }, 1100, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    $('.m1').addClass('aktivan-whole');
  }
});

$(document).on('click', '.ri-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.cv-scroller').animate({
      marginLeft: '-710px'
    }, 1100, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    $('.m2').addClass('aktivan-whole');
  }
});

$(document).on('click', '.ed-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.cv-scroller').animate({
      marginLeft: '-1420px'
    }, 1100, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    $('.m3').addClass('aktivan-whole');
  }
});

$(document).on('click', '.ded-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.cv-scroller').animate({
      marginLeft: '-2130px'
    }, 1100, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    $('.m4').addClass('aktivan-whole');
  }
});

$(document).on('click', '.vj-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.cv-scroller').animate({
      marginLeft: '-2840px'
    }, 1100, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    $('.m5').addClass('aktivan-whole');
  }
});

$(document).on('click', '.spremi-scroll', function(){
  if(!$(this).hasClass('aktivan-whole')){
    $('.cv-scroller').animate({
      marginLeft: '-3550px'
    }, 1100, function() {});
    $('html, body').animate({
        scrollTop: 0}, 500);
    $('.whole-btn').each(function(){ $(this).removeClass('aktivan-whole'); });
    $('.m6').addClass('aktivan-whole');
  }
});
