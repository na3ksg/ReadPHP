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
        <!--メッセージを保存するプログラム-->
        <?php
        //ファイルの保存先を指定する
        $save_file = dirname(__FILE__)."/message.txt";
        //更新用のパスワードを指定する
        $master_password = "11111";
        //投稿があるか
        if (isset($_POST["msg"])){
            //パスワードが合わない場合は保存しない
            $pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
            if ($pass !== $master_password){
                echo "パスワードが違うよ！";
                exit;
            }
            //ファイルにメッセージを保存
            file_put_contents($save_file, $_POST["msg"]);
            echo "保存しました！";
        } else {
            //投稿フォームの表示
            $self = $_SERVER["SCRIPT_NAME"];
            echo <<< __FORM__
            <form method ="POST" action = "$self">
            <textarea name = "msg" cols = "60" rows = "6">
            ここにメッセージを入力してね
            </textarea><br/>
            パスワード：
            <input type = "password" name = "pass" />
            <input type = "submit" value = "記録" />
            </form>
__FORM__;
        }
        ?>
    </body>
</html>
