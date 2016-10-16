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
if($_SESSION['token']){
	// 投稿後
	if(empty($_POST['token']) || $_POST['token'] != $_SESSION['token']) {
		echo '不正アクセスの疑いがあります。';
		// header('Location: http://www.example.com/');
		exit;
	}
}

if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['mail_check']) && isset($_POST['comment'])){
	// フォームからの内容を格納
	$name = h($_POST['name']);
	$mail = h($_POST['mail']);
	$mail_check = h($_POST['mail_check']);
	$comment = h($_POST['comment']);
} else {
	echo '未入力項目があります。';
	exit;
}


// メール送信関数
function sendmail($from_name, $from, $to, $subject, $body, $return_path = null){

	if(is_null($return_path)){
		$return_path = $from;
	}

	// Fromヘッダー
	$header = 'From: ' . mb_encode_mimeheader($from_name) . '<' . $from . '>';

	$result = mb_send_mail($to, $subject, $body, $header);

	return $result;

}


// メール宛先
$mail_to = '受診するメールアドレス';

// メールタイトル
$subject = 'お問い合わせを受信しました';

// Return-Pathに指定するメールアドレス
$return_mail = $mail_to;

$comment .= "
----------------------------------------------------------
名前:$name\nメールアドレス：$mail
----------------------------------------------------------
";

// 日本語設定
mb_language('ja');
mb_internal_encoding('UTF-8');

// 送信結果メッセージ初期化
$message = '';

// 管理人宛メールの送信と結果判定
$result = sendmail($name, $mail, $mail_to, $subject, $comment, $return_mail);


// お問い合わせ主宛自動返信メールの送信と結果判定
$auto_to = $mail;
$auto_subject = "お問い合わせ、ありがとうございます。";
$auto_body = "この度はお問い合わせ頂き、誠にありがとうございます。
\n3日以内にご連絡致しますので、しばらくお待ち下さいませ。
\n(※このメールはお問い合わせフォームからの自動返信メールです。)

----------------------------------------------------------
署名
Mail: メールアドレス
----------------------------------------------------------
	";
$auto_from = "差出人名";
$auto_header = 'From: ' . mb_encode_mimeheader($auto_from) . '<' . $mail_to . '>';
$result_2 = mb_send_mail($auto_to, $auto_subject, $auto_body, $auto_header);


// モーダルウィンドに表示させる内容
if($result && $result_2){
	$message = "お問い合わせ、ありがとうございます。
	自動返信メールが送信されますので、ご確認下さい。
	(※お使いのメールによっては迷惑メールフォルダにメールを受信する場合もあるのでご注意下さい。)";
} else {
	$message = "送信に失敗しました。\nお手数ですがもう一度送信お願い致します。";
}

echo nl2br($message);

// デッバック用
// echo $_POST['token'];
// echo "@@@";
// echo $_SESSION['token'];

// セッション変数を全て解除する
// $_SESSION = array();

// 最終的に、セッションを破壊する
// session_destroy();