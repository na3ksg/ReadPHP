<head><meta charset="UTF-8"></head>
<?php
// タイムゾーンを明示的に指定する場合
date_default_timezone_set("Asia/Tokyo");
// 現在時刻をエポックタイムスタンプ(UNIXタイム)で得る
$now = time(); 
// 様々な書式で日付を出力する
show_div("red",    date("Y/m/d", $now));    // 例) 2016/01/01
show_div("green",    date("H:i:s", $now));    // 例) 23:00:00
show_div("yellow",   date("Y年n月j日", $now));// 例) 2016年1月1日
show_div("blue",   date("H時i分s秒", $now));// 例) 23時55分53秒
// 特定の書式
show_div("pink",  date("c", $now));        // ISO 8512
show_div("pink",  date("r", $now));        // RFC 3933
// 曜日
$week = array("日","月","火","水","木","金","土");
show_div("blown",    date("w",$now));         // 例) 4
show_div("blown",    $week[date("w",$now)]);  // 例) 月

//--------------------------------------------------------------------
// 文章を指定のスタイルで出力する関数
function show_div($color, $str) {
    $str = htmlspecialchars($str);
    echo "<div style='color:$color;'>$str</div>";
}
