<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        //フォームからデータが送信されているか？
        if (isset($_GET["w"]) && isset($_GET["h"])) {
            //データが送信されていればBMIを計算
            $w = floatval($_GET["w"]); //体重（kg）
            $h = floatval($_GET["h"]); //身長（cm）
            $bmi = $w / pow($h / 100, 2); //BMI値を計算
            $per = floor(($bmi / 22) * 100); //肥満率を計算
            //結果を表示
            echo "体重{$w}kg,身長{$h}cm<br/>";
            echo "あなたのBMIは{$bmi}<br/>";
            echo "肥満度は{$per}%だよ。";
        } else {
            //データが送信されていないので、フォームを表示
            echo "<form>";
            echo "身長:<input type = 'text' name = 'h'>cm<br/>";
            echo "体重:<input type = 'text' name = 'w'>kg<br/>";
            echo "<input type = 'submit' value = 'BMI判定'>";
            echo "</form>";
        }
        ?>
    </body>
</html>