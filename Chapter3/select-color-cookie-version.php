<head><meta charset="UTF-8"></head>
<?php
//--------------------------------------------------------------------
// 主な処理の流れ
if (isset($_GET["color"])) { // パラメータが送信されている?
    save_bgcolor();          // ならばクッキーに色を保存
}
// HTMLを表示する
show_header();  // HTMLのヘッダを表示する
show_form();    // 色変更フォームを表示する
show_footer();  // HTMLのフッタを表示する
//--------------------------------------------------------------------
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
// 指定されたパラメータをクッキーに保存する
function save_bgcolor() {
    $color = $_GET["color"];
    // 正規表現で送信されたカラーコードの値をチェック
    if (!preg_match("/^#[0-9a-fA-F]{6}$/", $color)) {
        echo "不正な値が送信されています。"; exit;
    }
    // クッキーに値を保存
    $day = 60 * 60 * 24;           // 1日を秒で表すとこうなる
    $expire = time() + (3 * $day); // 3日後を指定
    setcookie("color", $color, $expire); 
    // 保存を反映するために画面をリロードする
    $self = $_SERVER["SCRIPT_NAME"];
    header("location: $self");
    exit;
}
// HTMLのヘッダを表示する(このとき、背景色を指定する)
function show_header() {
    $color = "#FFFFFF"; // デフォルトは白色
    // クッキーに値があるかどうか調べる
    if (isset($_COOKIE["color"])) { $color = htmlspecialchars($_COOKIE["color"]); }
    echo "<html><body bgcolor='$color'>";
}
// HTMLのフッタを表示する
function show_footer() { echo "</body></html>"; }
//--------------------------------------------------------------------
