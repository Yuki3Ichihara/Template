<?php get_header(); ?>

			<?php
				//現在表示中のカテゴリ・タグ・カスタムタクソノミー オブジェクトを取得
        $term = get_current_term();

        // 現在表示中のスラッグ名取得
        $term_name = $term->slug;

        //現在表示中の表示名
        $term_title = $term->name;
			?>

			<div class="main_side_content_wrap">
				<div class="underlayer_page_information_main_content">

					<div class="news_list">
						<h1 class="news_list_subhead"><span><?php echo esc_html($term_title);?>一覧</span></h1>

						<?php if (have_posts()) : ?>
            	<?php while (have_posts()) : the_post(); ?>

						<div class="news_wrap">
							<p class="date"><?php the_time('Y/m/d'); ?></p>
							<div class="news_title_content">

								<?php if(post_custom('cf_info_external_links')):?>
									<h2 class="news_title"><a href="<?php echo esc_attr(post_custom('cf_info_external_links'));?>" target="_blank"><?php the_title(); ?></a></h2>
								<?php else: ?>
									<h2 class="news_title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
								<?php endif; ?>

								<div class="news_excerpt"><?php the_excerpt(); ?></div>

							</div><!-- /.news_title_content -->
						</div><!-- /.news_wrap -->

							<?php endwhile; ?>

							<?php
	              if(class_exists('WP_SiteManager_page_navi')):
	              	WP_SiteManager_page_navi::page_navi(array('next_label'=>'次へ','prev_label'=>'前へ'));
	              endif;
            	?>

	          <?php else : ?>

             	<p>記事がありません</p>

          	<?php endif; ?>

					</div><!-- /.news_list -->

				</div><!-- /.underlayer_page_information_main_content -->


				<!-- サイドコンテンツ -->
				<?php get_sidebar('information'); ?>
				

			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>