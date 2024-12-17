<?php
function get_token($len = 20){
    $let = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $word ='';
    for($i=0; $i< $len; $i++ ){
        $word .=$let[rand(0, strlen($let)-1)];
    }
    
    //var_dump($token);
    return $word;
}

$token = get_token();
