<?php get_header(); ?>

			<div class="main_side_content_wrap">
				
				<div class="underlayer_page_product_taxonomy_main_content">

					<div class="catalog_taxonomy_heading">

						<!-- 表示中の商品カテゴリーによりコンテンツヘッダ画像を切り替える -->
						<?php
            $args = array(
              'post_type'      => 'attachment',
              'numberposts'    => -1,
              'post_status'    => null,
              'post_mime_type' => 'image'
            );

            $attachments = get_posts( $args );

            //現在表示中のカテゴリ・タグ・カスタムタクソノミー オブジェクトを取得
            $term = get_current_term();

            // 現在表示中のスラッグ名取得
            $term_name = $term->slug;

            //現在表示中の表示名と説明文を取得
            $term_title = $term->name;
            $description = $term->description;
            if ( $attachments ) {
              foreach ( $attachments as $attachment ) :
                if ( 1 === preg_match( "/^$term_name$/u" , $attachment->post_title ) ) {
                  echo '<img src="' . wp_get_attachment_url( $attachment->ID ) . '" width=620 alt='."$term_title".'>';
                }
              endforeach;
            }

            wp_reset_postdata();
        
          ?>
						
						<h1 class="taxonomy_head"><?php echo esc_html($term_title); ?></h1>
						<p><?php echo nl2br(esc_html($description)); ?></p>
					</div><!-- /catalog_taxonomy_heading -->

					<script>
						jQuery(function(){
					    /* div要素を4つずつの組に分ける */
					    var sets = [], temp = [];
					    jQuery('.product_thumbnail_box').each(function(i) {
					        temp.push(this);
					        if (i % 4 == 3) {
					            sets.push(temp);
					            temp = [];
					        }
					    });
					    if (temp.length) sets.push(temp);

					    /* 各組ごとに高さ揃え */
					    $.each(sets, function() {
					        jQuery(this).flatHeights();
					    });
						});
					</script>

					<!-- おすすめ商品の表示は１ページ目のみ -->
					<?php if(!is_paged()): ?>
						<div class="recommended_products">
							<h2 class="catalog_subhead"><span>おすすめ商品</span></h2>

							<div class="cancel_thumbnail_margin">

								<?php
		              $args = array(
		                'post_type' => 'product',
		                'tax_query' =>array(
		                  array(
		                    'taxonomy' => $term->taxonomy,
		                    'terms' => $term_name,
		                    'field' => 'slug'
		                  )
		                ),
		                'orderby' => 'DESC',
		                'posts_per_page' => -1,
		                'meta_key' =>'cf_recommended',
		                'meta_value' => 'はい'
		              );

		              $recommended = new WP_Query($args);

		              if($recommended->have_posts()):
		                while($recommended->have_posts()): $recommended->the_post();
	              ?>

								<div class="product_thumbnail_box">

									<?php $image = get_post_meta($post->ID, 'cf_product_image', true); ?>
									
	                <?php if($image): ?>
										<a href="<?php the_permalink(); ?>">
	                    <?php echo wp_get_attachment_image($image, 'thumbnail'); ?>
	                  </a>
									<?php endif; ?>

									<p class="thumbnail_maker_name">
										<?php
		                  $maker_names = get_the_terms($post->ID, 'maker');
		                  if(is_array($maker_names)){
		                    foreach($maker_names as $maker_name){
		                      echo esc_html($maker_name->name);
		                    }
		                  }
		                ?>
									</p>
									<h3 class="thumbnail_product_name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									
								</div><!-- /.product_thumbnail_box -->

								<?php endwhile;?>
		                
								<?php else:?>
		            <p>該当する商品がありません</p>

		            <?php endif;?>
		            <?php wp_reset_postdata();?>

							</div><!-- /.cancel_thumbnail_margin -->

						</div><!-- /.recommended_products -->
					<?php endif;?>

					<div class="taxonomy_products">
						<h2 class="catalog_taxonomy_subhead"><span>検索結果</span></h2>

						<script>
								jQuery(function(){
							    /* div要素を2つずつの組に分ける */
							    var sets = [], temp = [];
							    jQuery('.product_taxonomy_thumbnail_box').each(function(i) {
							        temp.push(this);
							        if (i % 2 == 1) {
							            sets.push(temp);
							            temp = [];
							        }
							    });
							    if (temp.length) sets.push(temp);

							    /* 各組ごとに高さ揃え */
							    $.each(sets, function() {
							        jQuery(this).flatHeights();
							    });
							});
							</script>

						<?php if (have_posts()):?>

						<div class="cancel_thumbnail_margin">

							<?php while (have_posts()):?>
								<?php the_post();?>

								<div class="product_taxonomy_thumbnail_box">
									<?php $image = get_post_meta($post->ID, 'cf_product_image', true); ?>

                	<?php if($image): ?>
										<a href="<?php the_permalink(); ?>">
                    	<?php echo wp_get_attachment_image($image, 'thumbnail'); ?>
                  	</a>
									<?php endif; ?>
									
									<div class="product_taxonomy_thumbnail_detail">
										<p class="thumbnail_maker_name">
											<?php
                        $maker_names = get_the_terms($post->ID, 'maker');
                        if(is_array($maker_names)){
	                        foreach($maker_names as $maker_name){
	                          echo esc_html($maker_name->name);
	                        }
	                      }
                      ?>
										</p>

										<dl>
											<dt class="thumbnail_product_taxonomy_name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>

											<!-- 商品の簡易説明 -->
                      <?php if(post_custom('cf_quick_instruction')): ?>
												<dd class="thumbnail_product_taxonomy_summary"><?php echo nl2br( esc_html(post_custom('cf_quick_instruction')) ); ?></dd>
											<?php endif; ?>
										</dl>

									</div><!-- /.product_taxonomy_thumbnail_detail -->
								</div><!-- /.product_taxonomy_thumbnail_box -->

							<?php endwhile; ?>

						</div><!-- /.cancel_thumbnail_margin -->

						<?php
              if(class_exists('WP_SiteManager_page_navi')):
              	WP_SiteManager_page_navi::page_navi(array('next_label'=>'次へ','prev_label'=>'前へ'));
              endif;
            ?>

						<?php else: ?>

							<p>該当する商品がありません</p>

						<?php endif; ?>

					</div><!-- /.taxonomy_products -->

				</div><!-- /.underlayer_page_product_taxonomy_main_content -->

				<!-- サイドコンテンツ -->
				<?php get_sidebar('product_catalog'); ?>
				

			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>