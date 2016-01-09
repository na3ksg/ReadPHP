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
        <div style="font-size: 32px;">
        <?php
        $no = rand(1,5);
        switch ($no){
        case 1:
            $msg = "トゥットゥルー♪";
            break;
        case 2:
            $msg = "にゃんぱすー";
            break;
        case 3:
            $msg = "おはらっきー";
            break;
        default :
            $msg = "んちゃ";
        }
        echo $msg;
        ?>
        </div>
    </body>
</html>
