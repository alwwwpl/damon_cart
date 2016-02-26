<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=640, initial-scale=1">
    <title>达蒙珠宝-系统邮件</title>
    <style>
        body,div,ul,li,p{margin:0;padding:0;}
        body{font:12px/1.5 Arial;}
        ul{list-style-type:none;}
        .clearfix:after{visibility:hidden;display:block;font-size:0;content: ".";clear:both;height:0;}
        .clearfix{ display:block;}
        .email-main{margin:0 auto;max-width:640px;min-width:320px;background-color:#f3f3f1;padding-bottom:70px;padding-top:26px;}
        .email-all{margin:0 auto;width:620px;background-color:#FFF;border-right:2px solid #C0C0C0; box-shadow: 0 0 2px #C0C0C0;border-bottom:2px solid #c0c0c0;}
        .email-top{padding-top:44px;margin-left:-10px;padding-bottom:12px;}
        .email-text{margin:0 auto;padding-top:54px;width:564px;border-top:1px solid #e8e8e8;}
        .email-text p{font-size:16px;line-height:28px;}
        .department{padding-top:128px;text-align:right;padding-bottom:50px;border-bottom:1px solid #e8e8e8;}
        .email-info{padding:28px 0;}
        .email-link img{float:left;}
        .email-link ul{float:left;font-size:16px;margin-left:8px;}
    </style>
</head>
<body>
<?= $content ?>
<script>
    var phoneWidth = parseInt(window.screen.width);
    var phoneScale = phoneWidth / 640;

    var ua = navigator.userAgent;
    if (/Android (\d+\.\d+)/.test(ua)) {
        var version = parseFloat(RegExp.$1);
        // andriod 2.3
        if (version > 2.3) {
            document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
            // andriod 2.3以上
        } else {
            document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
        }
        // 其他系统
    } else {
        document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
    }

</script>
</body>
</html>
