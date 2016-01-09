<head><meta charset="UTF-8"></head>
<pre><?php
//変数に秒を代入
    $hour = 60 * 60; //1時間は60秒×60分
    $day = 24 * $hour; //1日は24時間
//計算
    $now = time();
    $result = $now + 7 * $day;
//結果を表示
    echo "今日は..." . date("Y-m-d", $now) . "\n";
    echo "7日後は..." . date("Y-m-d", $result) . "\n";


    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

