$(function(){

	$('.menu-button').click(function(){
		$('.humbarger').toggleClass('humbarger-on');
		$('.header-menu').toggleClass('header-menu-open');
		$(".header-menu-open").css('opacity','0')
		$(".header-menu-open").animate({'opacity': 1.0},500);
		if($('.humbarger').hasClass('humbarger-on')){
			$(".glay_layer").stop().fadeIn(500);
		}else{
			$(".glay_layer").stop().fadeOut(500);
		}
	});

	$('.glay_layer').click(function(){
		$('.humbarger').toggleClass('humbarger-on');
		$('.header-menu').toggleClass('header-menu-open');
		$(".glay_layer").fadeOut(500);
	});

	$(window).on('load resize', function(){
		if($(window).width() >= 820){
			if($('div').hasClass('humbarger-on')){
				$('.humbarger').removeClass('humbarger-on');
				$('.header-menu').removeClass('header-menu-open');
				$(".glay_layer").fadeOut(500);
			}
		}
	});

});