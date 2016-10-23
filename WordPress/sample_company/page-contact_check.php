<?php get_header(); ?>

			<div class="main_side_content_wrap">
				<div class="underlayer_page_company_main_content">

					<div class="headline">
						<h1>お問い合わせ・資料請求</h1>
					</div><!-- /.headline -->

					<div class="content_box content_box_contact">
						<p>ご入力下さい。</p>
					</div>

					<div class="content_box content_box_contact">
						<div class="subhead subhead_contact">
						<?php require "sendmail.php"; ?>
							<h2><span>お問い合わせ内容の確認</span></h2>
						</div>
					</div><!-- /.content_box content_box_contact -->

					<div class="content_box content_box_contact_form">

						<form action="" method="post">
							<table border="0" cellspacing="0" cellpadding="0">
								<?php print $conf_code; ?>
							</table>

							<input name="require" type="hidden" value="inquiry.php" />
		         	<div id="submit" style="text-align:center;"><input type="button" value="キャンセル" onClick="history.back(); return false;" />
		          	<?php if(!isset($_SESSION["error"])){ ?><input type="submit" name="send" value="　送　信　" /><?php } ?>
		          </div>
						</form>
						
					</div><!-- /.content_box content_box_contact_form -->

				</div><!-- /.underlayer_page_company_main_content -->

				<!-- サイドコンテンツ -->
				<?php get_sidebar('side_contact'); ?>
				
			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>