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
        $script_name = $_SERVER["SCRIPT_NAME"];      // このプログラムのパス
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
            $stmt->execute(array($_GET["name"], $_GET["body"], time()));
            header("location: $script_name");
            exit; // リロードする
        }
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
        // ログの表示
        $select_query = "SELECT * FROM chatlog ORDER BY log_id DESC";
        $stmt = $db->query($select_query);
        foreach ($stmt as $row) {
            $name = htmlspecialchars($row["name"]);
            $body = htmlspecialchars($row["body"]);
            $ctime = date("H:i:s", $row["ctime"]);
            echo "<div class='log'>($ctime) $name &gt; $body</div>";
        }
        ?>
    </body>
</html>
