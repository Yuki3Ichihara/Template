<?php get_header(); ?>

			<div class="main_side_content_wrap">
				<div class="underlayer_page_single_product_main_content">

					<?php if (have_posts()) : ?>
          	<?php while (have_posts()) : the_post(); ?>

          <p class="return_from_product"><a href="javascript:history.back();">前のページに戻る</a></p>

					<div class="catalog_single_product_heading">
						<!-- 商品カテゴリー名 -->
						<p class="taxonomy_name">
							<?php
	              $cat_names = get_the_terms($post->ID, 'product_category');
	              if(is_array($cat_names)){
		              foreach($cat_names as $cat_name){
		                echo esc_html($cat_name->name."　　");
		              }
	              }
              ?>
						</p>
						<!-- メーカー名 -->
						<p class="single_product_maker_name">
							<?php
	              $maker_names = get_the_terms($post->ID, 'maker');
	              if(is_array($maker_names)){
		              foreach($maker_names as $maker_name){
		                echo esc_html($maker_name->name);
		              }
	              }
              ?>
						</p>
						<!-- 商品名 -->
						<h1 class="single_product_head"><?php the_title(); ?></h1>

						<!-- 商品のキャッチコピー -->
						<?php if(post_custom('cf_catch_copy')): ?>
							<h2 class="single_product_catch_copy"><?php echo nl2br(esc_html(post_custom('cf_catch_copy')) ); ?></h2>
						<?php endif; ?>

						<!-- 商品画像 -->
						<?php
					    $attachment_id = get_field('cf_product_image');
					    $size = "medium"; // (thumbnail, medium, large, full or custom size)
					    $image = wp_get_attachment_image_src( $attachment_id, $size );
					    $attachment = get_post( get_field('cf_product_image') );
					    $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
						?>
            <?php if($image || post_custom('cf_pdf_upload')): ?>
						<div class="single_product_image_pdf_wrap">
							<?php if($image): ?>
								<div class="single_product_image">
									<img class="product_photo" src="<?php echo $image[0]; ?>" alt="<?php echo $alt; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>">
								</div>
							<?php endif; ?>

							<!-- /PDFアップロード -->
							<?php if(post_custom('cf_pdf_upload')): ?>
								<?php $pdf_url = wp_get_attachment_url(post_custom('cf_pdf_upload')); ?>
								<p class="pdf"><a href="<?php echo esc_url($pdf_url); ?>" class="pdf_icon" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/pdf_icon.png" alt="PDFダウンロード"></a><a href="<?php echo esc_url($pdf_url); ?>" class="pdf_text" target="_blank">PDFダウンロード</a></p>
							<?php endif; ?>

						</div><!-- /single_product_image_pdf_wrap -->
						<?php endif; ?>

						<!-- /メーカーページリンク -->
						<?php if(post_custom('cf_maker_url')): ?>
							<p class="maker_link"><a href="<?php echo esc_url(post_custom('cf_maker_url')); ?>" target="_blank">メーカーページへリンク</a></p>
						<?php endif; ?>
						
					</div><!-- /catalog_single_product_heading -->

					<!-- /商品の詳細全体 -->
					<div class="single_product_detail">

						<?php if(post_custom('cf_product_heading_1') || post_custom('cf_product_feature_1_content') || post_custom('cf_product_feature_2_content') || post_custom('cf_product_feature_3_content')): ?>
							<div class="single_product_detail_category">
							<?php if(post_custom('cf_product_heading_1')):?>
								<h3 class="single_product_detail_category_title">
									<span>
									<?php echo esc_html(post_custom('cf_product_heading_1'));?>
									</span>
								</h3>
							<?php endif;?>

								<?php for($i = 1; $i <= 3; $i++): ?>
									<?php if(post_custom("cf_product_heading_1_subhead_${i}") || post_custom("cf_product_feature_${i}_content")):?>

										<div class="single_product_description">
											<h4 class="product_heading_subhead"><?php echo esc_html(post_custom("cf_product_heading_1_subhead_${i}")); ?></h4>
											<div class="description_wrap">
												<?php echo wpautop(post_custom("cf_product_feature_${i}_content"));?>
											</div>
										</div><!-- /.single_product_description -->

									<?php endif; ?>
								<?php endfor; ?>

							</div><!-- /.single_product_detail_category -->
						<?php endif; ?>

						<!-- 事例紹介 -->
						<?php if(post_custom('cf_product_heading_2') || post_custom('cf_case_study_details')): ?>
							<div class="single_product_detail_category">
							<?php if(post_custom('cf_product_heading_2')):?>
								<h3 class="single_product_detail_category_title">
									<span>
									<?php echo esc_html(post_custom('cf_product_heading_2'));?>
									</span>
								</h3>
							<?php endif;?>
								<div class="single_product_case_study_details_wrap">
									<p class="single_product_case_study_details"><?php echo esc_html(post_custom('cf_case_study_details'));?></p>
									<?php if(post_custom('cf_case_study_url')): ?>
										<p class="single_product_case_study_url"><a href="<?php echo esc_url(post_custom('cf_case_study_url'));?>">詳細はこちら</a></p>
									<?php endif; ?>
								</div>
							</div><!-- /.single_product_detail_category -->
						<?php endif; ?>

						<!-- 仕様 -->
						<?php if(post_custom('cf_product_heading_3') || get_field('cf_specification_table')): ?>
							<div class="single_product_detail_category">
							<?php if(post_custom('cf_product_heading_3')):?>
								<h3 class="single_product_detail_category_title">
									<span>
										<?php echo esc_html(post_custom('cf_product_heading_3'));?>
									</span>
								</h3>
							<?php endif; ?>
								
								<div class="specification">
									<table>
										<?php while(the_repeater_field('cf_specification_table')): ?>
											<tr>
												<th><?php echo esc_html(the_sub_field('cf_specification_title')); ?></th><td><?php echo nl2br(esc_html(the_sub_field('cf_specification_description')) ); ?></td>
											</tr>
										<?php endwhile;?>
									</table>
									
									<!-- 仕様補足 -->
									<?php if(post_custom('cf_specification_supplement')):?>
										<p class="specification_supplement"><?php echo nl2br(esc_html(post_custom('cf_specification_supplement')) );?></p>
									<?php endif; ?>

								</div><!-- /.specification -->
							</div><!--  /.single_product_detail_category  -->
						<?php endif; ?>

						<!-- オプション -->
						<?php if(post_custom('cf_product_heading_4') || get_field('cf_option')): ?>

							<script>
								jQuery(function(){
							    /* div要素を4つずつの組に分ける */
							    var sets = [], temp = [];
							    jQuery('.option_thumbnail_box').each(function(i) {
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

							<div class="single_product_detail_category single_product_detail_option">
							<?php if(post_custom('cf_product_heading_4')):?>
								<h3 class="single_product_detail_category_title">
									<span>
									<?php echo esc_html(post_custom('cf_product_heading_4')); ?>
									</span>
								</h3>
							<?php endif; ?>
								<div class="option_list">

								<div class="cancel_thumbnail_margin">

								<?php while(the_repeater_field('cf_option')): ?>
										
										<div class="option_thumbnail_box">
											<?php $image = get_sub_field("cf_option_image", true); ?>
	                			<?php if($image): ?>
													<?php echo wp_get_attachment_image($image, 'thumbnail'); ?>
												<?php endif; ?>
											<dl>
												<dt class="thumbnail_option_name"><?php echo esc_html(the_sub_field("cf_option_name"));?></dt>
												<dd class="thumbnail_option_summary"><?php echo esc_html(the_sub_field("cf_option_description"));?></dd>
											</dl>
										</div><!-- /.option_thumbnail_box-->

								<?php endwhile; ?>
				
								</div><!-- /.cancel_thumbnail_margin-->

								</div><!-- /.option_list-->

							</div><!-- /.single_product_detail_category-->

						<?php endif; ?>

						<!-- 関連商品 -->
						<?php if(post_custom('cf_related_product')): ?>

							<script>
								jQuery(function(){
							    /* div要素を2つずつの組に分ける */
							    var sets = [], temp = [];
							    jQuery('.related_product_thumbnail_box').each(function(i) {
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

							<div class="single_product_detail_category">
							<?php if(post_custom('cf_product_heading_5')):?>
								<h3 class="single_product_detail_category_title">
									<span>
									<?php echo esc_html(post_custom('cf_product_heading_5')); ?>
									</span>
								</h3>
							<?php endif; ?>
								<div class="related_product_list">

								<div class="cancel_thumbnail_margin">

									<?php $fields = get_field('cf_related_product'); ?>
									<?php foreach($fields as $post_object): ?>

										<div class="related_product_thumbnail_box">
											<a href="<?php $permalink = get_permalink($post_object->ID); ?><?php echo $permalink; ?>">
												<?php
                      		$field_image = get_post_meta($post_object->ID, 'cf_product_image', true);
                      		if($field_image){
                      			echo wp_get_attachment_image($field_image, 'thumbnail');
                      		}
                      	?>
											</a>
									
											<div class="related_product_thumbnail_detail">
												<p class="related_product_maker_name">
												<?php
													$terms_makers = get_the_terms($post_object->ID, 'maker');
													if(is_array($terms_makers)){
														foreach($terms_makers as $terms_maker){
			                      	$terms_maker_name = esc_html($terms_maker->name);
			                      	echo $terms_maker_name;
			                      }
		                      }
												?>
												</p>
												<dl>
													<dt class="related_product_name">
														<a href="<?php $permalink = get_permalink($post_object->ID); ?>
														<?php echo $permalink; ?>">
															<?php echo $post_object->post_title; ?>
														</a>
													</dt>
													<dd class="related_product_summary">
														<?php
		                      		$field_instruction = get_post_meta($post_object->ID, 'cf_quick_instruction', true);
		                      		if($field_instruction){
		                      			echo esc_html($field_instruction);
		                      		}
                      			?>
													</dd>
												</dl>
											</div><!-- /.related_product_thumbnail_detail -->
										</div><!-- /.related_product_thumbnail_box -->
									<?php endforeach; ?>

								</div><!-- /.cancel_thumbnail_margin -->

								</div><!-- /.related_product_list-->

							</div><!-- /.single_product_detail_category -->

						<?php endif; ?>

					</div><!-- /.single_product_detail-->

					<?php endwhile; ?>

					<?php else : ?>

          	<p>商品がありません</p>

				<?php endif; ?>

				</div><!-- /.underlayer_page_single_product_main_content -->

				<!-- サイドコンテンツ -->
				<?php get_sidebar('product_catalog'); ?>
				

			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>