<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // 100個のbuttonタグを作成
        echo "<form>";
        for ($i = 1; $i <= 100; $i++){
            echo "<input type='submit' name='btn' value='{$i}' style='width:48px;'/>";
        }
        echo "</form>";
        // ボタンが押されていれば、押された番号を表示
        if (isset($_GET["btn"])){
            $btn = intval($_GET["btn"]);
            echo "<p>ボタンの{$btn}番が押されたよ！</p>";
        }
        ?>
    </body>
</html>
