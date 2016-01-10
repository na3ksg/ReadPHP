<head><meta charset="UTF-8"></head>
<?php
//ファイルパスを設定
$target_dir = dirname(__FILE__);
$target_file = $target_dir . "/test.txt";
//ファイルを文字列に書き込む
file_put_contents($target_file, "テストテストテスト");
//ファイルから文字列を書き込む
$str = file_get_contents($target_file);
echo "読み書きした文字列: $str";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

