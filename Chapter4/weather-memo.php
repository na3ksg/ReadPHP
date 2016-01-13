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
        //さいたまの天気を表すRSS
        $weather_rss = "http://weather.livedoor.com/forecast/rss/area/110010.xml";
        //天気予報をメモしておくファイル
        $savefile = "comment.log";
        //処理を分ける
        $m = isset($_GET["m"]) ? $_GET["m"] : "";
        if ($m == "write") {
            write_comment();
        } else {
            show_weather();
        }

        //天気とコメントフォームの表示
        function show_weather() {
            global $weather_rss;
            $info = load_log();
            //今日の日付のタグ
            $tag = date("Y-m-d");
            if (empty($info[$tag])) {//今日の天気予報を取得するか
                //RSSデータをWebからダウンロードする
                $s = trim(@file_get_contents($weather_rss));
                $list = array();
                //XMLをパースする
                $xml = simplexml_load_string($s);
                foreach ($xml->channel->item as $item) {
                    $list[] = strval($item->title);
                }
                $info[$tag] = array("yohou" => $list);
                save_log($info);
            }
            //表示する
            $self = $_SERVER["SCRIPT_NAME"];
            $info = array_reverse($info);
            foreach ($info as $key => $item) {
                $yohou_h = htmlspecialchars(implode("\n", $item["yohou"]));
                //天気予報を表示
                echo "<h3>$key</h3>";
                echo "<pre>$yohou_h</pre>";
                //コメントフォーム
                echo "<form action = '$self'>";
                echo "<input type='hidden' name='m' value='write'/>";
                echo "<input type='hidden' name='tag' value='$key'/>";
                echo "コメント：";
                echo "<input type='text' name='memo' value=''/>";
                echo "<input type='submit' value='書き込む'/>";
                echo "</form>";
                //コメントを表示
                $comment = isset($item["comment"]) ? $item["comment"] : array();
                foreach ($comment as $row) {
                    $row_h = htmlspecialchars($row);
                    echo "<div>→{$row_h}</div>";
                }
            }
        }

        //コメントを書き込む
        function write_comment() {
            $info = load_log();
            $tag = isset($_GET["tag"]) ? $_GET["tag"] : "";
            $memo = isset($_GET["memo"]) ? $_GET["memo"] : "";
            if (empty($info[$tag]["comment"])) {
                $info[$tag]["comment"] = array();
            }
            $info[$tag]["comment"][] = $memo;
            save_log($info);
            header("location:" . $_SERVER["SCRIPT_NAME"]);
        }
        //データを読み込む
        function load_log(){
            global $savefile;
            $info = array();
            if (file_exists($savefile)){//ログファイルの読み込み
                $info = unserialize(file_get_contents($savefile));
            }
            return $info;
        }
        //データを保存する
        function save_log($info){
            global $savefile;
            file_put_contents($savefile, serialize($info));
        }
        ?>
    </body>
</html>
