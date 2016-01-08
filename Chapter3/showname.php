
<html>
    <head><meta charset="UTF-8"></head>
    <body style="font-size: 28px">
        <?php
        $q = $_GET["q"]; //ユーザーからの入力を得る
        //表示する前にHTMLに変換
        $q_html = htmlspecialchars($q);
        //メッセージを表示
        echo "<div>{$q_html}さん、こんにちは</div>";
        ?>
    </body>
</html>





