$(function(){

	$(window).on('load resize', function(){

		if(window.innerWidth < 960){
			// 画面サイズ960px未満は検索BOXをハンバーガーメニューで表示
			$('.search-box').prependTo('.header-nav');

			// 画面サイズ960px未満は詳細メニューをハンバーガーメニューで表示
			$('.category-head').appendTo('.header-nav');
			$('.side-menu').appendTo('.header-nav');

			//PCサイズ以外でホバーが発動しないようにする
			$('.category').off('mouseenter mouseleave');

			// 画面サイズ960px未満は詳細メニューをタップで切り替え
			$('.category > a').on('click',function(){
				$(this).next('ul').css('display','block').stop().animate({marginLeft: 0},300);
				// 『戻る』ボタン削除
				if($('.mobile-category-detail-menu li').hasClass('return_btn')){
					$('.return_btn').remove();
				}
				// 『戻る』ボタン生成
				$(this).next('ul').prepend('<li class="return_btn"><button>戻る</button></li>');
			});

			// 動的に生成された『戻る』ボタン押下
			$(document).on('click','.return_btn button',function(){
				$(this).parents('.mobile-category-detail-menu').stop().animate({marginLeft: '-80%'},300,function(){
					$(this).parents('.mobile-category-detail-menu').css('display','none');
					$('.return_btn').remove();
				});
			});

		}else{
			// 画面サイズ960px以上は検索BOXを通常位置で表示
			$('.search-box').insertAfter('.header-nav');

			// 画面サイズ960px以上は詳細メニューをサイドバーで表示
			$('.category-head').prependTo('.side-bar');
			$('.side-menu').appendTo('.side-nav');

			//PCサイズでカテゴリー詳細クリック時のイベントが発動しないようにする
			$('.category > a').off('click');

			// ブラウザサイズ切り換え時に『戻る』ボタンが残ってる場合に削除する
			if($('.category-detail-menu li').hasClass('return_btn')){
				$('.return_btn').remove();
			}

			// 画面サイズ960px以上は詳細メニューをマウスON、OFFで切り替え
			$('.category').hover(function(){
				$(this).children('ul').css('display','block');
			},
			function(){
				$(this).children('ul').css('display','none');
			});
		}

	});
	
});







	// $('.menu-button').click(function(){
	// 	$('.humbarger').toggleClass('humbarger-on');
	// 	$('.header-menu').toggleClass('header-menu-open');
	// 	$(".header-menu-open").css('opacity','0')
	// 	$(".header-menu-open").animate({'opacity': 1.0},500);
	// 	if($('.humbarger').hasClass('humbarger-on')){
	// 		$(".glay_layer").fadeIn(500);
	// 	}else{
	// 		$(".glay_layer").fadeOut(500);
	// 	}
	// });

	// $('.glay_layer').click(function(){
	// 	$('.humbarger').toggleClass('humbarger-on');
	// 	$('.header-menu').toggleClass('header-menu-open');
	// 	$(".glay_layer").fadeOut(500);
	// });

	// $(window).on('load resize', function(){
	// 	if($(window).width() >= 820){
	// 		if($('div').hasClass('humbarger-on')){
	// 			$('.humbarger').removeClass('humbarger-on');
	// 			$('.header-menu').removeClass('header-menu-open');
	// 			$(".glay_layer").fadeOut(500);
	// 		}
	// 	}
	// });