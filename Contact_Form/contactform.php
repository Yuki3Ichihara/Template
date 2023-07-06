<?php 
    //h()関数の読み込み
    require_once 'lib/h.php';

    // クリックジャッキング対策
    header('X-FRAME-OPTIONS: SAMEORIGIN');

    //セッション開始
    session_start();

    //CSRF対策
    if(!isset($_SESSION['token'])){
        $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
    }
    $token = $_SESSION['token'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
</head>
<body>
    <div class="contactform">
        <h1>お問い合わせ</h1>

        <?php
            // エラーがある場合に表示
            if(isset($_SESSION['error'])){
                foreach($_SESSION['error'] as $value){
                    echo '<span class="error">'.h($value).'</span><br>'. "\n";
                }
            }

            // セッションに保存されたデータがある場合に変数に代入
            $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $comment = isset($_SESSION['comment']) ? $_SESSION['comment'] : '';
        ?>

        <p>※印は入力必須項目です。</p>

        <form action="contactform_confirm.php" method="post">
            <dl>
                <dt><label for="name">お名前(※)</label></dt>
                <dd><input type="text" name="name" id="name" value="<?php echo h($name); ?>" maxlength="100" required></dd>
            </dl>
            <dl>
                <dt><label for="email">メールアドレス(※)</label></dt>
                <dd><input type="email" name="email" id="email" value="<?php echo h($email); ?>" maxlength="256" required></dd>
            </dl>
            <dl>
                <dt><label for="comment">コメント(※)(500文字以内)</label></dt>
                <dd><textarea name="comment" id="comment" cols="30" rows="6" maxlength="500" required><?php echo h($comment); ?></textarea></dd>
            </dl>
            <input type="hidden" name="token" value="<?php echo h($token); ?>">
            <input type="submit" name="submit" value="入力内容をチェック">
        </form>
        
    </div>
    <!-- /.contactform -->



</body>
</html>