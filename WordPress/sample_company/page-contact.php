<?php get_header(); ?>

			<div class="main_side_content_wrap">
				<div class="underlayer_page_company_main_content">

					<div class="headline">
						<h1>お問い合わせ</h1>
					</div><!-- /.headline -->

					<div class="content_box content_box_contact">
						<p>ご入力下さい。</p>
					</div>

					<div class="content_box content_box_contact">
						<div class="subhead subhead_contact">
							<h2><span>お問い合わせフォーム</span></h2>
						</div>
						<p>以下の項目にご記入頂後、確認ボタンを押してください。</p>
						<p class="cautionary_statement"><span>※</span>は必須項目ですので、必ずご記入下さい。</p>
					</div><!-- /.content_box content_box_contact -->

					<div class="content_box content_box_contact_form">
						<form action="" method="post">
							<table border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<th>お問合せ内容<span>※</span></th>
										<td><input type="checkbox" name="お問合せ内容" value="見積依頼" /> 見積依頼　 <input type="checkbox" name="お問合せ内容" value="資料請求" /> 資料請求　 <input type="checkbox" name="お問合せ内容" value="その他" /> その他</td>
									</tr>
									<tr>
										<th>お名前<span>※</span></th>
										<td><input type="text" maxlength="100" name="お名前" size="30" /></td>
									</tr>
										<th>メールアドレス<span>※</span></th>
										<td><input type="text" maxlength="100" name="メールアドレス" size="50" /></td>
									</tr>
									<tr>
										<th>電話番号</th>
										<td><input id="tel2" type="text" name="電話番号" /></td>
									</tr>
									<tr>
										<th class="textarea_label">詳細内容<span>※</span></th>
										<td><textarea id="textarea" cols="35" name="詳細内容" rows="6"></textarea></td>
									</tr>
									<tr id="last">
										<th>メールマガジン配信の希望</th>
										<td><input type="radio" checked="checked" name="サービス・情報提供の希望" value="希望する" /> 希望する　 <input type="radio" name="サービス・情報提供の希望" value="希望しない" /> 希望しない</td>
									</tr>
								</tbody>
							</table>

							<div class="personal_information_box">
								<h3>■ 当社の個人情報の取り扱いについて</h3>
								<div class="personal_information_description">
									<p>
										ご入力いただく個人情報につきましては、下記の通りの取り扱いとさせていただきます。<br>
										取り扱い内容につき、ご同意いただいた上で、ご提供下さい。<br>
									</p>
								</div>

								<input type="checkbox" name="個人情報の取り扱い" value="同意する">
								<p class="personal_information_agree">個人情報の取り扱いについて同意する</p>
								
							</div><!-- /.personal_information_box -->
							<input type="hidden" name="require" value="inquiry.php">
							<p class="input_content_check"><input type="submit" name="conf" value="入力内容の確認"></p>
						</form>
					</div><!-- /.content_box content_box_contact_form -->

				</div><!-- /.underlayer_page_company_main_content -->

				<!-- サイドコンテンツ -->
				<?php get_sidebar('side_contact'); ?>
				
			</div><!-- /.main_side_content_wrap -->

		</div><!-- /.underlayer_page_contents_inside -->
	</div><!-- /#underlayer_page_content_whole -->
<?php get_footer(); ?>