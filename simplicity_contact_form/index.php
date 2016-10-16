<?php

	// エラー表示設定(デバッグ時のみ使用)
	// error_reporting(E_ALL);

	//HTMLエスケープ
	function h($s){
		if(is_array($s)){
			return array_map('h', $s);
		} else {
			return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
		}

	}

	// クリックジャッキング対策
	header('X-FRAME-OPTIONS: SAMEORIGIN');

	// セッション開始
	session_start();

	// CSRF対策
	if(!isset($_SESSION['token'])){
		// 投稿前
		$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
	}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=2.0">
	<meta name="description" content="">
	<meta name="keywords" content="">


	<link rel="stylesheet" href="css/style.css" type="text/css">

	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

	<!-- IE8以下にHTML5とCSSを適用 -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="css/lt_ie8.css" type="text/css">
	<![endif]-->

	<script type="text/javascript" src="js/validate.js"></script>

	<!-- 高解像度ディスプレイ対応 -->
	<script type="text/javascript" src="js/retina.min.js"></script>

	<title>簡易お問い合わせフォーム</title>

</head>

<body>

		<!-- Contact -->
		<div id="contact">

			<div id="contact_inner">
				<h2 class="heading">Contact</h2>
				<div class="contact_description">
					<p>お気軽にお問い合わせフォームよりご連絡下さい。</p>
					<p><span>※</span>全て必須項目です。</p>
				</div>
				<form action="" method="post">
					<dl>
						<dt>お名前</dt>
						<dd><input type="text" class="validate required" name="name" id="name" size="40"></dd>
						
						<dt>メールアドレス</dt>
						<dd><input type="text" class="validate required mail" name="mail" id="mail" size="40"></dd>

						<dt>メールアドレス&nbsp;(確認用)</dt>
						<dd><input type="text" class="validate required mail mail_check" name="mail_check" id="mail_check" size="40"></dd>
						
						<dt>お問い合わせ内容</dt>
						<dd><textarea class="validate required" name="comment" id="comment" rows="15" cols="40"></textarea></dd>
						
						<input type="hidden" id="token" name="token" value="<?php echo h($_SESSION['token']); ?>">
						<p><input type="submit" id="submit" value="送信" name="submit"></p>
						
					</dl>
				</form>
			</div><!--/contact_inner-->

		</div><!--/contact-->

		<!-- お問い合わせフォームのモーダルウィンドウ -->
		<div id="glay_layer" class="close"></div>
		<div id="form_window">
			<p class="message"></p>
			<p class="close_wrap"><span class="close">閉じる</span></p>
		</div>


</body>

</html>