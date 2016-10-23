<?php get_header(); ?>

			<div class="main_side_content_wrap">
				<div class="underlayer_page_information_main_content">

					<div class="news_single_title_content_wrap">

						<?php if(have_posts()): ?>
            	<?php while (have_posts()) : the_post(); ?>

            		<div class="news_single_title_date_wrap">
									<h1 class="news_single_title"><?php the_title(); ?></h1>
									<p class="date"><?php the_time('Y年m月d日'); ?></p>
								</div>

								<p class="return_info_list"><a href="javascript:history.back();">一覧へ戻る</a></p>

								<div class="news_single_content">
									<?php the_content(); ?>
								</div><!-- /.news_single_content -->

							<?php endwhile; ?>
	          <?php else : ?>

             	<p>記事がありません</p>

          	<?php endif; ?>

          	<p class="return_info_list"><a href="javascript:history.back();">一覧へ戻る</a></p>

					</div><!-- /.news_single_content_wrap -->

				</div><!-- /.underlayer_page_information_main_content -->


				<!-- サイドコンテンツ -->
				<?php get_sidebar('information'); ?>
				

			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>