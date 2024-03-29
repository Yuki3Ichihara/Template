<?php
    // デバッグ用エラー表示
    ini_set('display_errors', "On");
    error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_USER_DEPRECATED & ~ E_NOTICE);

    function sendmail($fromName,$from,$to,$subject,$body,$returnPath = null){
        // メールアドレスや件名に改行コードが含まれていないことをチェック
        if(preg_match('/[\r\n]/',$fromName) !== 0 || preg_match('/[\r\n]/',$from) !== 0 || preg_match('/[\r\n]/',$to) !== 0 || preg_match('/[\r\n]/',$subject) !== 0){
            die('不正な入力が検出されました。');
        }

        // if(preg_match('/[¥r¥n]/',$fromName) !== 0 || preg_match('/[¥r¥n]/',$from) !== 0 || preg_match('/[¥r¥n]/',$to) !== 0 || preg_match('/[¥r¥n]/',$subject) !== 0){
        //     die('不正な入力が検出されました。');
        // }

        if(is_null($returnPath)){
            $returnPath = $from;
        }

        // Fromヘッダーを作成
        $header = 'From: '.mb_encode_mimeheader($fromName).'<'.$from.'>';

        // メールを送信し、結果を返す
        // セーフモードの対応(セーフモードONの場合、mb_send_mailで第5引数は使用できない)
        if(ini_get('safe_mode')){
            $result = mb_send_mail($to,$subject,$body,$header);
        }else{
            $result = mb_send_mail($to,$subject,$body,$header,'-f'.$returnPath);
        }
        return $result;
    }   