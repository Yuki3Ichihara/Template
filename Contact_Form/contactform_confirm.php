<?php
    // デバッグ用エラー表示
    ini_set('display_errors', "On");
    error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_USER_DEPRECATED & ~ E_NOTICE);

    //h()関数の読み込み
    require_once 'lib/h.php';

    // checkInput()関数の読み込み
    require_once 'lib/checkInput.php';

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

    // 変数にPOSTされたデータを代入
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

    // エラーメッセージを保存する配列を初期化
    $error = array();

    //名前欄のチェック
    if(trim($name) == ''){
        $error[] = 'お名前が未入力です。';
    }elseif(mb_strlen($name) > 100){
        $error[] = 'お名前は100文字以内でお願いします。';
    }

    // メールアドレス欄のチェック
    if(trim($email) == ''){
        $error[] = 'メールアドレスが未入力です。';
    }elseif(mb_strlen($email) > 256){
        $error[] = 'メールアドレスは256文字以内でお願いします。';
    }else{
        $pattern = '/\A([a-z0-9_\-\+\/\?]+)(\.[a-z0-9_\-\+\/\?]+)*'.'@([a-z0-9\-]+\.)+[a-z]{2,6}\z/i';
        // $pattern = '/¥A([a-z0-9_¥-¥+¥/¥?]+)(¥.[a-z0-9_¥-¥+¥/¥?]+)*'.'@([a-z0-9¥-]+¥.)+[a-z]{2,6}¥z/i';
        if(!preg_match($pattern,$email)){
            $error[] = 'メールアドレスの形式が正しくありません。';
        }
    }

    // コメント欄のチェック
    if(trim($comment) == ''){
        $error[] = 'コメントが未入力です。';
    }elseif(mb_strlen($comment) > 500){
        $error[] = 'コメント
        は500文字以内でお願いします。';
    }

    // POSTされたデータとエラーメッセージをセッション変数に保存
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['comment'] = $comment;
    $_SESSION['error'] = $error;

    // エラー数を確認
    if(count($error) > 0){
        // エラーがある場合は入力フォームに戻す
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = ($dirname == DIRECTORY_SEPARATOR) ? '' : $dirname;
        $uri = 'http://'.$_SERVER['SERVER_NAME'].$dirname.'/contactform.php';
        header('HTTP/1.1 303 See Other');
        header('Location:'.$uri);

        // 確認画面を表示
    }else{
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内容確認</title>
</head>
<body>
    <div class="contactform">
        <h1>内容確認</h1>

        <p>以下の内容でよろしければ送信ボタンを押して下さい。</p>

        <dl>
            <dt>お名前</dt>
            <dd><?php echo h($name); ?></dd>
        </dl>
        <dl>
            <dt>メールアドレス</dt>
            <dd><?php echo h($email); ?></dd>
        </dl>
        <dl>
            <dt>コメント</dt>
            <dd><?php echo nl2br(h($comment),false); ?></dd>
        </dl>

        <form action="contactform.php" method="post">
            <input type="submit" name="back" value="入力画面に戻る">
        </form>

        <form action="contactform_thanks.php" method="post">
            <input type="hidden" name="token" value="<?php echo h($token); ?>">
            <input type="submit" name="submit" value="送信する">
        </form>
        
    </div>
    <!-- /.contactform -->
</body>
</html>

<?php
    }