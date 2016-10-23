<div id="footer_whole">
		<div class="footer01_whole">
			<div class="footer01_inside">
				<p>お問い合わせ、ご相談はこちら</p>

				<div class="contact_consultation">

					<div class="mail_contact">
						<a href="<?php
            	$page = get_page_by_path('contact');
            	echo get_permalink($page->ID);
            ?>">
           	<img src="" alt="お問い合わせ">
            </a>
					</div><!-- /.mail_contact -->

					<div class="phone_contact">
						<img src="" alt="電話番号">
					</div><!-- /.phone_contact -->

				</div><!-- /.contact_consultation -->

			</div><!-- /.footer01_inside -->
		</div><!-- /.footer01_whole -->

		<div class="footer02_whole">
			<div class="footer02_inside">

				<div class="footer02_group_wrap">
					<div class="footer02_first_group">
						<div class="footer_logo">
							<a href="<?php echo home_url('/'); ?>"><img src="" alt="ロゴ"></a>
							<p>株式会社サンプル</p>
						</div><!-- /.footer_logo -->

						<div class="privacy_mark">
							<img src="" alt="プライバシー">
						</div><!-- /.privacy_mark -->
					</div><!-- /.footer02_first_group -->

					<div class="footer02_second_group">
						<div class="footer_nav_list footer_nav_list_01">
							<ul class="list_line">
								<?php wp_nav_menu( array('menu' => 'footer_about_shiroyama', 'container' => '','items_wrap' => '%3$s')); ?>
							</ul>
							<ul class="list_line">
								<?php wp_nav_menu( array('menu' => 'footer_product_catalog', 'container' => '','items_wrap' => '%3$s')); ?>
							</ul>
							<ul class="list_line">
								<?php wp_nav_menu( array('menu' => 'footer_mobile_phone_business', 'container' => '','items_wrap' => '%3$s')); ?>
							</ul>
							<ul class="list_line">
								<?php wp_nav_menu( array('menu' => 'footer_careers_information', 'container' => '','items_wrap' => '%3$s')); ?>
							</ul>
							<ul>
								<?php wp_nav_menu( array('menu' => 'footer_company_profile', 'container' => '','items_wrap' => '%3$s')); ?>
							</ul>
						</div>

						<div class="footer_nav_list footer_nav_list_02">
							<ul>	
								<?php wp_nav_menu( array('menu' => 'footer_introduced_in_applications', 'container' => '','items_wrap' => '%3$s')); ?>

								<li>
									<a href="<?php
                		$page = get_page_by_path('introduced_in_applications');
                		echo get_permalink($page->ID);
              		?>">
              			駅
              		</a>
              	</li>

              	<li>
									<a href="<?php
                		$page = get_page_by_path('introduced_in_applications');
                		echo get_permalink($page->ID);
              		?>">
              			スタジアム
              		</a>
              	</li>

              	<li>
									<a href="<?php
                		$page = get_page_by_path('introduced_in_applications');
                		echo get_permalink($page->ID);
              		?>">
              			商業施設
              		</a>
              	</li>

              	<li>
									<a href="<?php
                		$page = get_page_by_path('introduced_in_applications');
                		echo get_permalink($page->ID);
              		?>">
              			公園
              		</a>
              	</li>
								
							</ul>
						</div>
						
						<div class="footer_nav_list footer_nav_list_03">
							<ul>
								<li>
									<a href="<?php
                		$page = get_page_by_path('case_studies');
                		echo get_permalink($page->ID);
              		?>">
              			事例紹介
              		</a>
              	</li>

								<li>
									<a href="<?php
                		$page = get_page_by_path('case_studies');
                		echo get_permalink($page->ID);
              		?>">
              			サンプル１事例
              		</a>
              	</li>

              	<li>
									<a href="<?php
                		$page = get_page_by_path('case_studies');
                		echo get_permalink($page->ID);
              		?>">
              			サンプル2事例
              		</a>
              	</li>

              	<li>
									<a href="<?php
                		$page = get_page_by_path('case_studies');
                		echo get_permalink($page->ID);
              		?>">
              			サンプル3事例
              		</a>
              	</li>

							</ul>
						</div>
					</div><!-- /.footer02_second_group -->
				</div><!-- /.footer02_group_wrap-->

				<div class="group_companies">
					<p>グループ会社</p>
					<ul class="group_companies_list">
						<li><a href="#" target="_blank">・関連会社１</a></li>
						<li><a href="#" target="_blank">・関連会社２</a></li>
					</ul>
				</div>

				<div class="footer_nav_copy">
					<ul>
						<li>
							<a href="<?php
		            $page = get_page_by_path('privacy_policy');
		            echo get_permalink($page->ID);
		          ?>">
		          	・プライバシーポリシー
		        	</a>
		        </li>

						<li>
							<a href="<?php
	            	$page = get_page_by_path('site_map');
	            	echo get_permalink($page->ID);
	            ?>">
	            	・サイトマップ
			        </a>
		       	</li>

						<li>
							<a href="<?php
		            $page = get_page_by_path('contact');
		            echo get_permalink($page->ID);
		          ?>">
		         		・お問い合わせ
	            </a>
            </li>
					</ul>
					<p>Copyright 2016 Sample Company All Rights Reserved</p>
				</div>

			</div><!-- /.footer02_inside -->
		</div><!-- /.footer02_whole -->
	</div><!-- /#footer_whole -->

	<!-- トップへ戻るボタン -->
	<p id="pagetop"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/arrow_top.jpg" alt="トップへ" width="70" height="70"></a></p>

	<script type="text/javascript">
		$(function(){ 
		  $('#pagetop').hide();
		  $(window).scroll(function(){
		    if ($(this).scrollTop() > 100) {
		    	$('#pagetop').fadeIn();
		    }
		    else {
		    	$('#pagetop').fadeOut();
		    }
		  });

		  $('#pagetop').click(function(){
		      $('html,body').animate({
		          scrollTop: 0
		      }, 300);
		      return false;
		  });
		});
	</script>

	<?php wp_footer(); ?>

</body>
</html>