$(function(){

	// 該当メニューへスクロール
	$('a[href^=#]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");

    // ハンバーガーメニューが開いてるときの対応
    if($(window).width() < 820 && $('div').hasClass('humbarger-on')){
      $('.humbarger').toggleClass('humbarger-on');
      $('.header-menu').toggleClass('header-menu-open');
      $(".gray_layer").fadeOut(500);
    }

    return false;
  });

	// トップへ戻る
  $('#pagetop').hide();
  var timer = false;
  $(window).scroll(function(){
    if ($(this).scrollTop() > 200) {
    	$('#pagetop').fadeIn();
    }
    else {
    	$('#pagetop').fadeOut();
    }
  });

  $('#pagetop').click(function(){
    $('html,body').animate({
        scrollTop: 0
    }, 3000);
    return false;
  });

});