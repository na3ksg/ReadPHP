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
        $savepath = dirname(__FILE__) . '/chatlog.db'; // ログの保存先
        $page_max = 30;//1ページ内に表示するチャットログの数
        // データベースへの接続
        try {
            $db = new PDO("sqlite:$savepath");
        } catch (PDOException $e) {
            echo "接続失敗:" . $e->getMessage();
            exit;
        }
        // チャットログのテーブル定義
        $create_query = <<< ___SQL___
    CREATE TABLE IF NOT EXISTS chatlog (
        log_id    INTEGER PRIMARY KEY, /* ログID */
        name      TEXT,                /* 名前 */
        body      TEXT,                /* 本文 */
        ctime     INTEGER              /* 投稿日時 */
    );
___SQL___;
        $db->exec($create_query);
        $script_name = $_SERVER["SCRIPT_NAME"];
        // 書き込みフォームの表示
        echo <<< __FORM__
        <link type="text/css" rel="stylesheet" href="chat.css" />
        <h3>チャット</h3>
        <form action="$script_name" method="GET"><div id="chatform">
        名前:<input type="text" name="name" size="8" />
        本文:<input type="text" name="body" size="40" />
        <input type="submit" value="書込" />
        </div></form>
__FORM__;
        // 書き込み処理があったか？
        if (isset($_GET["name"]) && isset($_GET["body"])) {
            if ($_GET["name"] == "" || $_GET["body"] == "") {// 入力の検証
                echo "<p>名前と本文は必ず入力してね。</p>";
                exit;
            }
            // データベースに挿入
            $template = "INSERT INTO chatlog (name,body,ctime)" .
                    "VALUES(?,?,?);";
            $stmt = $db->prepare($template);
            $r = $stmt->execute(array($_GET["name"], $_GET["body"], time()));
            if ($r === false) {
                echo "挿入に失敗：".$db->errorInfo(); exit;
            }
            //リロードする
            header("location: $script_name"); exit;
        }
        // ログの表示
        $offset  = isset($_GET["offset"]) ? intval($_GET["offset"]) : 0;
        $limit = $page_max + 1;//ページャー判定のため1つ多めに値を取る
        $select_query = <<< __SQL__
                SELECT * FROM chatlog
                    ORDER BY log_id DESC/*並び順の指定*/
                    LIMIT $limit OFFSET $offset;/*取り出す数を指定*/
__SQL__;
        $stmt = $db->query($select_query);
        $rows = $stmt->fetchAll();//結果を配列として取得
        //ページャーの処理
        $pager = "";
        if (count($rows) > 30) { //30以上あれば次ページのリンクを表示
            array_pop($rows);//余分な行を削除
            $next = $offset + $page_max;
            $pager = "[<a href='$script_name?offset=$next'>次のページ</a>]";
        }
        if ($offset > 0) { //offsetが0以上あれば前ページのリンクを表示
            $prev = $offset - $page_max;
            $pager = "[<a href='$script_name?offset=$next'>前のページ</a>]";
        }
        //ログを画面に表示
        foreach ($rows as $row) {
            $name = htmlspecialchars($row["name"]);
            $body = htmlspecialchars($row["body"]);
            $ctime = date("H:i:s",$row["ctime"]);
            echo "<div class='log'>$ctime:$name&gt;$body</div>";
        }
        if ($pager != "") {
            echo "<p>$pager</p>";
        }
        ?>
    </body>
</html>
