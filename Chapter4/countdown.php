<head><meta charset="UTF-8"></head>
<?php
$name = "東京五輪";
$yotei = strtotime("2020-7-24"); //予定日
$today = time();
$interval = $yotei - $today;
$days = ceil($interval / (24 * 60 * 60));
echo "<p>今日は、" . date("Y-m-d", $today) . "</p>";
echo "<p>本番は、" . date("Y-m-d", $yotei) . "</p>";
echo "<p>{$name}まであと{$days}日！</p>";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

