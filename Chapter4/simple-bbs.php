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
        <?php
        //初期設定（データファイルの保存先）
        $save_file = dirname(__FILE__) . "/bbslog.txt";
        //掲示板の機能に応じて処理を振り分ける
        $mode = isset($_GET["mode"]) ? $_GET["mode"] : "show";
        switch ($mode) {
            case "show": mode_show();
                break;
            case "write": mode_write();
                break;
            case "reset": mode_reset();
                break;
            default : mode_show();
                break;
        }
        function mode_reset(){
            save_date(array());//空の要素で保存する
            echo "掲示板を初期化したよ";
        }
        //データの表示
        function mode_show(){
            //書き込みフォームを表示
            show_form();
            //データの書き込み
            $log = load_date();
            //ログを表示
            echo "<ul>";
            foreach ($log as $i){
                $name = htmlspecialchars($i["name"]);
                $body = htmlspecialchars($i["body"]);
                echo "<li><b style='color:red;'>$name</b>:$body</li>\n";
            }
            echo "</ul>";
        }
        //入力フォームを表示
        function show_form(){
        echo <<< __FORM__
        <form>
        ■名前：<input type="text" name="name" size="8"/>
        本文：<input type="text" name="body" size="30"/>
        <input type="submit" value="投稿"/>
        <input type="hidden" name="mode" value="write"/>
        </form><hr/>
        <!--リセットボタン-->
        <form><input type="hidden" name="mode" value="reset"/ >
              <input type="submit" value="掲示板の初期化"/>
        </form>    
__FORM__;
        }
        //データの書き込み
        function mode_write(){
            //データの検証
            if ($_GET["name"] == "" || $_GET["body"] == ""){
                echo "名前か本文が空だよ。入力してね";
                exit;
            }
            //既存のデータを読み込む
            $log = load_date();
            array_unshift($log, $_GET);
            save_date($log);
            $self = $_SERVER['SCRIPT_NAME'];
            echo "<a href='$self'>書き込みました！！！</a>";
        }
        function load_date(){
            global $save_file;
            $log = array();
            if (file_exists($save_file)){//ファイルがあれば読み込む
                $txt = file_get_contents($save_file);
                $log = unserialize($txt);//テキストからデータを復元
            }
            return $log;
        }
        function save_date($log){
            global $save_file;
            $txt = serialize($log);
            file_put_contents($save_file, $txt);
        }
        ?>
    </body>
</html>
