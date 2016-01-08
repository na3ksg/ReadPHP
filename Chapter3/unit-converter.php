<html>
    <head>
        <meta charset="UTF-8"/>
    </head>
    <body style="font-size: 24px; background-color: #CCCCCC;">
        <h1>インチからセンチへ変換</h1>
        <?php
        if (isset($_GET["inch"])) {//値が送信されているか?
            //変換結果を表示
            $inch = $_GET["inch"]; //入力されたデータを取得
            $inch = floatval($inch); //文字列から数値へ変換
            $cm = 2.54 * $inch; //インチからセンチへ変換
            echo "<div>(結果){$inch}インチ = {$cm}センチメートル</div>";
        } else {
            //値が送信されていない場合（フォームを表示）
            $self = $_SERVER["SCRIPT_NAME"];
            echo "<form action = '$self' method = 'GET'>";
            echo "<input type = 'text' name = 'inch' value = ''/>";
            echo "<input type = 'submit' value = '変換'/>";
            echo "</form>";
        }
        ?>
    </body>
</html>