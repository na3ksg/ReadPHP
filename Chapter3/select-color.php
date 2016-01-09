<head><meta charset="UTF-8"></head>
<?php
// 主な処理の流れ
show_header();  // HTMLのヘッダを表示する
show_form();    // 色変更フォームを表示する
show_footer();  // HTMLのフッタを表示する
//--------------------------------------------------------------------
// HTMLのヘッダを表示する(このとき、背景色を指定する)
function show_header() {
    // 色が送信されているか調べて背景色を決定する
    $color = "#FFFFFF";          // デフォルトは白色
    if (isset($_GET["color"])) { // 色が送信されているか?
        $color = htmlspecialchars($_GET["color"]);
    }
    echo "<html><body bgcolor='$color'>";        // HTMLのヘッダを表示
}
function show_footer() { echo "</body></html>"; }// HTMLのフッタを表示
// フォームの表示処理
function show_form() {
    // 色名とカラーコードを連想配列で指定する
    $colors = array("赤"=>"#FF0000","水色"=>"#00FFFF","白"=>"#FFFFFF");
    echo "<form>";
    // ラジオボタンを次々と表示する
    foreach ($colors as $name => $color) {
        echo create_radio_code($name, $color);
    }
    echo "<input type='submit' value='色変更' />";
    echo "</form>";
}
// フォームの表示で利用するラジオボタンとラベルの作成
function create_radio_code($name, $code) {
    return <<< __RADIO__
<input type="radio" id="$name" name="color" value="$code" />
<label for="$name"/>$name</label>
__RADIO__;
}
