<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        $self = $_SERVER["SCRIPT_NAME"];
        // サイズ指定が行われたか？
        if (isset($_GET["size"])) {
            // 値の検証
            $size = intval($_GET["size"]);
            if ($size < 12 || $size > 72) {
                echo "サイズ指定が不正です";
                exit;
            }
            // 保存有効期限を指定
            $expire = time() + (60 * 60 * 24) * 365; // 一年間有効
            // クッキーに保存
            setcookie("size", $size, $expire);
            // リロード
            header("location: $self");
            exit;
        }
        // クッキーから値を読み出す
        $size = 26;
        if (isset($_COOKIE["size"])) {
            $size = intval($_COOKIE["size"]);
        }
        // 文字サイズの指定フォームを表示する
        echo <<< __FORM__
    <body style="font-size:{$size}px;">
    <div style="background-color:yellow; text-align:right;">
    文字サイズ:【<a href="$self?size=46">大</a>】
    【<a href="$self?size=26">中</a>】
    【<a href="$self?size=14">小</a>】
</div>
__FORM__;
        ?>
        <!-- 文章 -->
        <p>テストテストテストテストテストテストテストテストテストテスト</p>
        <p>テストテストテストテストテストテストテストテストテストテスト</p>
        <p>テストテストテストテストテストテストテストテストテストテスト</p>
    </body>
</html>
