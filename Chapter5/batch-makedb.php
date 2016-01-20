<?php

$fp = fopen("ejdic-hand-utf8.txt", "r"); // 元テキストファイルを開く
$db = new PDO("sqlite:ejdict.db");      // SQLiteデータベースと接続する
// エラーが出たら例外を出して処理を停めるようにする
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// データベースを定義する
$create_query = <<< ___SQL___
    CREATE TABLE words (
        word_id    INTEGER PRIMARY KEY, /* ID */
        title      TEXT, /* 英単語 */
        body       TEXT  /* 意味 */
    );
___SQL___;
$db->exec($create_query);
// 英単語をデータベースに挿入する準備をする
$insert_query = <<< ___SQL___
    INSERT INTO words (title, body)
               VALUES (?,     ?   )
___SQL___;
$insert_stmt = $db->prepare($insert_query);
$db->beginTransaction(); // トランザクションを開始
// テキストファイルを読み込んで辞書に挿入する
while (($line = fgets($fp)) !== false) {
    list($title, $body) = explode("\t", $line, 2); //タブで区切る
    if ($title == "")
        continue; // 空なら代入しない
    $insert_stmt->execute(array($title, $body)); // データベースに挿入
    echo $title . "\n"; // 経過報告を出力
}
$db->commit(); // コミットする
echo "*** completed ***";

