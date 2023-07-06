$(function(){

	$('.menu-button').on('click',function(){
		$('.humbarger').toggleClass('humbarger-on');
		$('.header-nav').toggleClass('header-nav-open');
		$('.search-box').toggleClass('search-box-open');
		$(".header-nav-open").css('opacity','0')
		$(".header-nav-open").animate({'opacity': 1.0},500);
		$('.category-detail-menu').toggleClass('mobile-category-detail-menu');
		if($('.category-detail-menu').hasClass('mobile-category-detail-menu')){
			$('.category-detail-menu').css({display:'none',marginLeft:'-80%'});
		}
		if($('.humbarger').hasClass('humbarger-on')){
			$(".glay_layer").stop().fadeIn(500);
		}else{
			$(".glay_layer").stop().fadeOut(500);
		}
	});

	$('.glay_layer').click(function(){
		$('.humbarger').removeClass('humbarger-on');
		$('.header-nav').removeClass('header-nav-open');
		$('.search-box').removeClass('search-box-open');
		$('.category-detail-menu').css({display:'none',marginLeft:'-80%'});
		$('.category-detail-menu').removeClass('mobile-category-detail-menu');
		if($('.category-detail-menu li').hasClass('return_btn')){
			$('.return_btn').remove();
		}
		$(".glay_layer").fadeOut(500);
	});

	$(window).on('load resize', function(){
		if(window.innerWidth >= 960){
			if($('div').hasClass('humbarger-on')){
				$('.humbarger').removeClass('humbarger-on');
				$('.header-nav').removeClass('header-nav-open');
				$('.search-box').removeClass('search-box-open');
				$('.category-detail-menu').css({display:'none',marginLeft:'-80%'});
				$('.category-detail-menu').removeClass('mobile-category-detail-menu');
				if($('.category-detail-menu li').hasClass('return_btn')){
					$('.return_btn').remove();
				}
				$(".glay_layer").fadeOut(500);
			}
		}
	});

});