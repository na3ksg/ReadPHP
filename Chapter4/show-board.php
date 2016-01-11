<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <!--メッセージを表示するプログラム-->
        <h1>美人店長による本日の一言</h1>
        <?php
        //ファイルの保存先を指定する
        $save_file = dirname(__FILE__)."/message.txt";
        //ファイルがあるか
        if (!file_exists($save_file)){
            echo "まだメッセージはないよ！";
            exit;
        }
        //メッセージを読み込んで画面に表示
        $msg = file_get_contents($save_file);
        //(重要)HTMLに変換
        $msg_html = htmlspecialchars($msg);
        //改行を<br>に変換する
        $msg_html = str_replace("\n", "<br/>", $msg_html);
        //HTMLを表示
        echo <<< __HTML__
        <div style="border: dashed 3px red;padding: 12px">
        <div style="font-size: 26px; color: blue">
            {$msg_html}
        </div></div>  
__HTML__;
        ?>
    </body>
</html>
