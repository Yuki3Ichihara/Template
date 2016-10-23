<?php get_header(); ?>

			<div class="main_side_content_wrap">
				<div class="underlayer_page_main_content">

					<?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
              <div class="page">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <div class="page">
              <h2>ページが見つかりません</h2>
              <p>ページがありません</p>
            </div>
          <?php endif; ?>

				</div><!-- /.underlayer_page_main_content -->

				<!-- サイドコンテンツ -->
				<?php get_sidebar('company'); ?>
				

			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>