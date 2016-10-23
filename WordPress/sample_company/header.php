<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=2.0">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- 添付ファイル個別ページは検索エンジンのインデックスから除外する -->
	<?php if(is_attachment()):?>
		<meta name="robots" content="noindex,nofollow" />
	<?php endif; ?>
	
	<?php if(is_404()): ?>
		<meta http-equiv="REFRESH" content="5;URL=<?php echo home_url('/'); ?>">
	<?php endif; ?>

	<title>
      <?php if(is_home()): echo bloginfo('name'); ?>
        <?php elseif(is_page()): echo the_title().' | 株式会社サンプル' ; ?>
        <?php elseif(is_archive()): echo single_cat_title().' | 株式会社サンプル' ; ?>
        <?php elseif(is_single()): echo the_title().' | 株式会社サンプル' ; ?>
        <?php elseif(is_search()): $s = $_GET['s'];
          echo htmlspecialchars($s).'の検索結果 | 株式会社サンプル' ; ?>
      <?php endif;?>
    </title>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all">

	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css" type="text/css" media="all">
	<![endif]-->

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easyselectbox.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.flatheights.js"></script>
	<script type="text/javascript">
		(function ($) {
		  $('.maker_search').easySelectBox();
		  $('.tag_search').easySelectBox();
		})(jQuery);
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="header_whole">
			<div class="header_inside">

				<p class="logo"><a href="<?php echo home_url('/'); ?>"><img src="" alt=""></a></p>

				<div class="telephone_contact">
					<p class="phone_number"><img src="" alt=""></p>
				</div>

				<div id="global_nav">
					<?php wp_nav_menu( array('menu' => 'global_navigation', 'container' => '')); ?>
				</div><!-- /#global_nav -->

			</div><!-- /.header_inside -->
		</div><!-- /#header_whole -->

		<div id="underlayer_page_content_whole">
			<div class="underlayer_page_contents_inside">
				
				<!-- パンくずリスト -->
				<div class="breadcrumb">
					<?php if(!is_front_page()): ?>
	          
	          <?php
	            if(class_exists('WP_SiteManager_bread_crumb')):
	              WP_SiteManager_bread_crumb::bread_crumb('home_label=ホーム');
	            endif;
	          ?>
	          
	        <?php endif; ?>
				</div><!-- /.breadcrumb -->