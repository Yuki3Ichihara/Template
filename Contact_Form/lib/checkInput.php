<?php
    ini_set('display_errors', "On");
    error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_USER_DEPRECATED & ~ E_NOTICE);
    // 入力値に不正なデータがないかなどをチェックする関数
    function checkInput($var){
        if(is_array($var)){
            return array_map('checkInput',$var);
        }else{
            // nullバイト攻撃対策
            // nullバイトを含む制御文字が含まれていないかをチェック(最大1000文字)
            if(preg_match('/\A[\r\n\t[:^cntrl:]]{0,1000}\z/u',$var) == 0){
                die('不正な入力です');
            }
            // if(preg_match('/¥A[¥r¥n¥t[:^cntrl:]]{0,1000}¥z/u',$var) == 0){
            //     die('不正な入力です');
            // }
            // 文字エンコードの確認
            if(!mb_check_encoding($var,'UTF-8')){
                die('不正なエンコードです');
            }
            return $var;
        }
    }