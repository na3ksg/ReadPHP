<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="form.css">
    </head>
    <body>
        <?php
            echo <<< __FORM__
        <div id="loginform">
        <form action="" method="POST"><h3>ログインしてね</h3>    
        <label>ユーザー名</label><input type="text" name="user"/>
        <label>パスワード</label><input type="password" name="pass"/>
        <button type="submit">ログイン</button>
        </form></div>
__FORM__;
        ?>
    </body>
</html>
