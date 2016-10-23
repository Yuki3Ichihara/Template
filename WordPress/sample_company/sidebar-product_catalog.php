<div class="side_content_whole">
	<div class="sub_nav_heading">
		<img src="" alt="" width="275" height="160">
	</div>

	<div class="side_content_inside">
		<div class="side_bar">

			<div class="searchbox">
				<div class="product_name_search">
					<p>商品名検索</p>
					<?php get_search_form(); ?>
				</div><!-- /.product_name_search -->

				<div class="maker_name_search">
					<p>メーカー名検索</p>

					<form role="search" method="get" id="maker_searchform" action="<?php echo home_url( '/' ); ?>" onsubmit= "if(this.maker.value==''){return false}">
           <select name="maker" class="maker_search easy-select-box">
            <option value="" selected="selected"></option>
            <?php
              $maker_terms = get_terms( 'maker', 'hide_empty=1');
              foreach($maker_terms as $maker_term):?>
                <option value="<?php echo esc_attr($maker_term->slug); ?>"><?php echo esc_html($maker_term->name); ?></option>
            <?php endforeach; ?>
            </select>
            <input id="submit" class="submit_button" type="submit" value="検索">
          </form>

				</div><!-- /.maker_name_search -->

				<div class="tag_name_search">
					<p>タグ検索</p>

					<form role="search" method="get" id="tag_searchform" action="<?php echo home_url( '/' ); ?>" onsubmit= "if(this.product_tag.value==''){return false}">
           <select name="product_tag" class="tag_search easy-select-box">
            <option value="" selected="selected"></option>
            <?php
              $tag_terms = get_terms( 'product_tag', 'hide_empty=1');
              foreach($tag_terms as $tag_term):?>
                <option value="<?php echo esc_attr($tag_term->slug); ?>"><?php echo esc_html($tag_term->name); ?></option>
            <?php endforeach; ?>
            </select>
            <input id="submit_tag" class="submit_button" type="submit" value="検索">
          </form>

				</div><!-- /.maker_name_search -->
				
			</div><!-- /.searchbox -->

			<div class="product_category">
				<h3 class="side_subhead">商品カテゴリー</h3>
				<ul>
					<?php
        		$args = array('taxonomy' => 'product_category','title_li' => '', 'hide_empty'=>1);
        		wp_list_categories($args);
      		?>
				</ul>
			</div><!-- /.product_category -->

		</div><!-- /.side_bar -->

		<div class="advertisement">
			<?php get_template_part('advertising_banner'); ?>
		</div><!-- /.advertisement -->

	</div><!-- /.side_content_inside -->
</div><!-- /.side_content_whole -->