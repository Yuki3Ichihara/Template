<?php
    // HTMLでのエスケープ処理をする関数
    function h($var){
        if(is_array($var)){
            return array_map('h',$var);
        }else{
            return htmlspecialchars($var,ENT_QUOTES,'UTF-8');
        }
    }