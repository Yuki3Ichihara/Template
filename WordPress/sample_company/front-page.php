<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=980px,user-scalable=yes,maximum-scale=2">

	<?php if(is_404()): ?>
		<meta http-equiv="REFRESH" content="5;URL=<?php echo home_url('/'); ?>">
	<?php endif; ?>

	<!-- 添付ファイル個別ページは検索エンジンのインデックスから除外する -->
	<?php if(is_attachment()):?>
		<meta name="robots" content="noindex" />
	<?php endif; ?>
	
	<title><?php echo bloginfo('name'); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all">

	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css" type="text/css" media="all">
	<![endif]-->

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easyselectbox.min.js"></script>
	<script type="text/javascript">
		(function ($) {
		  $('.maker_search').easySelectBox();
		})(jQuery);
	</script>


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="top_page_header_whole">
			<div class="top_page_header_inside">

				<h1 class="top_page_logo"><a href="<?php echo home_url('/'); ?>"><img src="" alt=""></a></h1>

				<div id="top_page_global_nav">
					<?php wp_nav_menu( array('menu' => 'global_navigation', 'container' => '')); ?>
				</div><!-- /#top_page_global_nav -->

			</div><!-- /.top_page_header_inside -->

		<div class="image_switching">
			<div class="main_visual main_visual_01"></div>
			<div class="main_visual main_visual_02 not_first"></div>
			<div class="main_visual main_visual_03 not_first"></div>
		</div>

	</div><!-- /#top_page_header_whole -->

	<!-- メインビジュアルの切り換え -->
	<script>
		jQuery(function(){
    var setImg = '.image_switching';
    var fadeSpeed = 1000;
    var switchDelay = 5000;
 
    jQuery(setImg + ' div:first').stop().animate({opacity:'1',zIndex:'2'},fadeSpeed);
 
    setInterval(function(){
    jQuery(setImg + ' :first-child').fadeOut(fadeSpeed).next('div').fadeIn(fadeSpeed).end().appendTo(setImg);
    },switchDelay);
		});
	</script>

	<div id="top_page_content_whole">
		<div class="top_page_contents_inside">

			<div class="top_page_main_content_wrap">
				<div class="top_page_main_content">

					<div class="menu_gallery_wrap">

						<div class="menu_gallery">
							<a href="#" target="_blank"><img src="" alt=""></a>
						</div>

						<div class="menu_gallery line_blue">
							<a href="<?php
                	$page = get_page_by_path('about_business_template');
                	echo get_permalink($page->ID);
              	?>"><img src="<?php bloginfo('template_url'); ?>/images/" alt=""></a>
							<h2><a href="<?php
                	$page = get_page_by_path('about_our');
                	echo get_permalink($page->ID);
              	?>">株式会社サンプルとは</a></h2>
							<p>株式会社サンプルとは・・・</p>
						</div>

						<div class="menu_gallery line_blue menu_gallery_multiple_3">
							<a href="<?php
                	$page = get_page_by_path('mobile_phone_business');
                	echo get_permalink($page->ID);
              	?>"><img src="" alt=""></a>
							<h2><a href="<?php
                	$page = get_page_by_path('固定ページ名');
                	echo get_permalink($page->ID);
              	?>">メインメニュー２</a></h2>
							<p>メインメニュー２・・・</p>
						</div>

						<div class="menu_gallery">
							<a href="#" target="_blank"><img src="" alt=""></a>
							<h2><a href="#" target="_blank">メインメニュー3</a></h2>
							<p>メインメニュー3</p>
						</div>

						<div class="menu_gallery">
							<a href="" target="_blank"><img src="" alt=""></a>
							<h2><a href="#" target="_blank">メインメニュー4</a></h2>
							<p>メインメニュー4</p>
						</div>

						<div class="menu_gallery menu_gallery_multiple_3">
							<a href="<?php
                	$page = get_page_by_path('固定ページ名');
                	echo get_permalink($page->ID);
              	?>"><img src="" alt=""></a>
							<h2><a href="<?php
                	$page = get_page_by_path('固定ページ名');
                	echo get_permalink($page->ID);
              	?>">メインメニュー5</a></h2>
							<p>メインメニュー5</p>
						</div>

						<div class="menu_gallery line_blue">
							<a href="<?php
                	$page = get_page_by_path('固定ページ名');
                	echo get_permalink($page->ID);
              	?>">
                <img src="" alt="">
              </a>
							<h2><a href="<?php
                	$page = get_page_by_path('固定ページ名');
                	echo get_permalink($page->ID);
              	?>">メインメニュー6</a></h2>
							<p>メインメニュー6</p>
						</div>

						<div class="menu_gallery line_blue">
							<a href="<?php
                	$page = get_page_by_path('case_studies');
                	echo get_permalink($page->ID);
              	?>"><img src="" alt=""></a>
							<h2><a href="<?php
                	$page = get_page_by_path('case_studies');
                	echo get_permalink($page->ID);
              	?>">メインメニュー7</a></h2>
							<p>メインメニュー7</p>
						</div>

						<div class="menu_gallery line_blue menu_gallery_multiple_3">
							<a href="<?php
                	$page = get_page_by_path('introduced_in_applications');
                	echo get_permalink($page->ID);
              	?>">
              	<img src="" alt="">
              </a>
							<h2><a href="<?php
                	$page = get_page_by_path('introduced_in_applications');
                	echo get_permalink($page->ID);
              	?>">メインメニュー8</a></h2>
							<p>メインメニュー8</p>
						</div>

					</div><!-- /menu_gallery_wrap -->

					<div class="information_small_list">
						<h3>お知らせ</h3>

						<table>

							<?php
              	$args = array(
                  'post_type' => 'information_post',
                  'orderby' => 'DESC',
                  'posts_per_page' => 6
                );

              	$news_list = new WP_Query($args);
            	?>

							<?php if ($news_list->have_posts()) : ?>
	            	<?php while ($news_list->have_posts()) : $news_list->the_post(); ?>

								<tr>
									<td class="date"><?php the_time('Y年m月d日'); ?></td>
									<?php if(post_custom('cf_info_external_links')):?>
										<td class="information_small_title"><a href="<?php echo esc_attr(post_custom('cf_info_external_links'));?>" target="_blank"><?php the_title(); ?></a></td>
									<?php else: ?>
										<td class="information_small_title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></td>
									<?php endif; ?>
								</tr>

								<?php endwhile; ?>
		          <?php else : ?>

		          	<tr>
		          		<td>記事がありません</td>
		          	</tr>

	          	<?php endif; ?>

          	<?php wp_reset_query(); ?>

						</table>

						<p class="to_info_list"><a href="<?php echo get_post_type_archive_link('information_post'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/btn_to_info_list.jpg" alt="お知らせ一覧"></a></p>

					</div><!-- /information_small_list -->

				</div><!-- /.top_page_main_content -->
			</div><!-- /.top_page_main_content_wrap -->

		</div><!-- /.top_page_contents_inside -->
	</div><!-- /#top_page_content_whole -->

<?php get_footer(); ?>