<?php
    // デバッグ用エラー表示
    ini_set('display_errors', "On");
    error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_USER_DEPRECATED & ~ E_NOTICE);

    //h()関数の読み込み
    require_once 'lib/h.php';

    // checkInput()関数の読み込み
    require_once 'lib/checkInput.php';

    // メール送信用のsendmail()関数の読み込み
    require_once 'lib/sendmail.php';

    // メールの宛先
    $mailTo = 'shandy_disarita@yahoo.co.jp';

    // メールのタイトル
    $subject = 'お問い合わせを受信しました。';

    // Return-Pathに指定するメールアドレス
    $returnMail = $mailTo;

    // クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    //セッション開始
    session_start();

    // POSTされたデータをチェック
    $_POST = checkInput($_POST);

    // トークンを確認
    if(isset($_POST['token']) && isset($_SESSION['token'])){
        $token = $_POST['token'];
        if($token != $_SESSION['token']){
            die('不正アクセスの疑いがあります。');
        }
    }else{
        die('不正アクセスの疑いがあります。');
    }

    // 変数にセッション変数を代入
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $comment = $_SESSION['comment'];

    // mbstringの日本語設定
    mb_language('ja');
    mb_internal_encoding('UTF-8');

    // 送信結果をお知らせする変数を初期化
    $message = '';

    // メールの送信と結果の判定
    $result = sendmail($name,$email,$mailTo,$subject,$comment,$returnMail);
    if($result){
        $message = '送信完了';
        // セッションを破棄する
        $_SESSION = array();
        session_destroy();
    }else{
        $message = '送信失敗';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール送信</title>
</head>
<body>
    <div class="contactform">
        <h1>お問い合わせ</h1>
        <p><?php echo h($message); ?></p>
    </div>
</body>
</html>