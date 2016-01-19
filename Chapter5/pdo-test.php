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
        <pre><?php
            // データベースへの接続
            try {
                $db = new PDO("sqlite:test2.db");
            } catch (PDOException $e) {
                echo "データベースに接続できません。" . $e->getMessage();
                exit;
            }
            // テーブルを作成する
            $create_query = <<< __SQL__
    CREATE TABLE IF NOT EXISTS items (
        item_id    INTEGER,  /* アイテムID */
        name       TEXT,     /* 商品名 */
        price      INTEGER   /* 値段 */
    );
__SQL__;
            $result = $db->exec($create_query); // SQLを実行
            if ($result === false) { // エラーがあれば表示
                print_r($db->errorInfo());
                exit;
            }
            $db->exec("DELETE FROM items"); // 以前挿入したことがあれば一度初期化
            // データを挿入
            $idata = array(
                array("item_id" => 1, "name" => "あんぱん", "price" => 100),
                array("item_id" => 2, "name" => "焼きそばパン", "price" => 150),
                array("item_id" => 3, "name" => "メロンパン", "price" => 230),
                array("item_id" => 4, "name" => "カレーパン", "price" => 210),
                array("item_id" => 5, "name" => "食パン", "price" => 130)
            );
            foreach ($idata as $i) {
                // 挿入する値をクォートする
                $item_id = intval($i["item_id"]);
                $name = $db->quote($i["name"]); // 文字列にクォート('...')を足す
                $price = intval($i["price"]);
                $result = $db->exec(
                        "INSERT INTO items (item_id,name,price)" .
                        "VALUES($item_id, $name, $price)"); // SQLを実行
                if ($result === FALSE) { // エラーがあれば表示
                    print_r($db->errorInfo());
                }
            }
            // データを表示
            $stmt = $db->query("SELECT * FROM items");
            while ($row = $stmt->fetch()) {
                $item_id = $row["item_id"];
                $name = $row["name"];
                $price = $row["price"];
                echo "($item_id) $name → {$price}円\n";
            }
            ?>
    </body>
</html>
