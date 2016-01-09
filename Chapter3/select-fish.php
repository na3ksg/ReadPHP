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
        //-------------
        //商品一覧の定義
        $fish = array(
           "サンマ","マグロ","カサゴ","クエ","ヒラメ","フナ","サバ");
        //-------------
        //パラメーターに応じて処理を変える
        if (isset($_GET["fish"])){
            show_item();
        } else {
            show_form();
        }
        //--------------
        //選択したアイテムを表示する
        function show_item(){
            $fish = $_GET["fish"];
            $fish_html = htmlspecialchars($fish);//HTML変換
            echo "商品{$fish_html}をゲットだぜ！";
        }
        //フォームを表示する
        function show_form(){
            global $fish;//グローバル宣言
            //選択肢の文字列を生成する
            $options = "";
            foreach ($fish as $item){
                $options.= "<option value = '$item'>$item</option>";
            }
            //フォームをヒアドキュメントで表示
            echo <<<_FORM_
            <form>
            <select name=fish">
            <option>魚を選択</option>
            {$options}
            </select>
            <input type="submit" value = "購入"/>
            </form>
_FORM_;
        }
        ?>
    </body>
</html>
