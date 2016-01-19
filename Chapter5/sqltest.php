<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>SQLテスト</title>
    </head>
    <body bgcolor="#f0f0f0">
        <?php
        //SQLの入力フォームを作成
        $query = isset($_GET["query"]) ? $_GET["query"] : "";
        $q_html = htmlspecialchars($query);
        echo <<< __FORM__
        <form><div>SQLを以下に記述：</div>
        <textarea name="query" rows="5" cols="70">{$q_html}</textarea>
        <div><input type="submit" value="SQL実行"/></div>
__FORM__;
        //SQLを実行する
        if ($query != "") {
            $ab = new PDO("sqlite:./test.ab");
            $ab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                //実行して結果を表示する
                $html = $head = "";
                foreach ($ab->query($query, PDO::FETCH_ASSOC)as $row) {
                    if ($head == "") {//ヘッダ行
                        $keys = array_keys($row);
                        $head .= "<tr>";
                        foreach ($keys as $c) {
                            $c_html = htmlspecialchars($c);
                            $head .= "<th>$c_html</th>";
                        }
                        $head .= "</tr>";
                    }
                    $html .= "<tr>";
                    foreach ($row as $c) {//実行結果
                        $c_html = htmlspecialchars($c);
                        $html .= "<td><pre>$c_html</pre></td>";
                    }
                    $html .= "</tr>\n";
                }
                echo "<p style='font-weight:bold;color:blue;'>実行しました</p>";
                echo "<table border='1' bgcolor='#fff' cellpadding='4'>";
                echo "$head . $html";
                echo "</table>";
            } catch (Exception $e) {
                $msg = $e->getMessage();
                echo "<div style='color:red'>$msg</div>";
            }
        }
        ?>
    </body>
</html>
