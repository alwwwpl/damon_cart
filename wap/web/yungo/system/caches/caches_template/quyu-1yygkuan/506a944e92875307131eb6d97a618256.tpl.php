<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>充 值 - <?php echo $webname; ?>触屏版</title>
        <meta content="app-id=518966501" name="apple-itunes-app" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/login.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
		
<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
    </head>
    <body>
        <div class="h5-1yyg-v1" id="content">

            <!-- 栏目页面顶部 -->


            <!-- 内页顶部 -->
<header class="header">
<div class="n-header-wrap">
<div class="backbtn">
<a href="javascript:;" onclick="history.go(-1)" class="h-count white">
</a>
</div>
<div class="h-top-right ">
<a href="<?php echo WEB_PATH; ?>/mobile/home" class="h-search white"></a>
</div>
<div class="n-h-tit"><h1 class="header-logo">充 值</h1></div>
</div>
</header>

            <section>
                <div class="registerCon">
                    <form action="<?php echo WEB_PATH; ?>/cardrecharge/cardrcg/" method="post">
                        <ul>
                            <li class="accAndPwd">
                                <dl><input id="txtCZMoney" value="" maxlength="30" name="code" type="text" placeholder="请输入卡号" class="lEmail"  maxlength="20"><s class="rs4"></s></dl>
                                <dl>
                                    <input type="password" id="txtCZPwd" value="" maxlength="10" name="codepwd" class="lPwd" placeholder="请输入卡密" name="text" >
                                    <s class="rs3"></s>
                                </dl>
                            </li>
                            <li><input name="recharge" id="btnSQCZ" type="submit" value=" 确认充值" /></li>
                    </form>
                    
                    <li class="rSelect" style="width: 80%;"><!-- <a href="FindPassword.html">忘记密码？</a> -->
                          
                    </li><li class="rSelect" style="width: 80%;">
                                         </ul>
                </div>
            </section>

            <?php include templates("mobile/index","footer");?>
            <script language="javascript" type="text/javascript">
                var Path = new Object();
                Path.Skin = "<?php echo G_TEMPLATES_STYLE; ?>";
                Path.Webpath = "<?php echo WEB_PATH; ?>";

                var Base = {head: document.getElementsByTagName("head")[0] || document.documentElement, Myload: function (B, A) {
                        this.done = false;
                        B.onload = B.onreadystatechange = function () {
                            if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                                this.done = true;
                                A();
                                B.onload = B.onreadystatechange = null;
                                if (this.head && B.parentNode) {
                                    this.head.removeChild(B)
                                }
                            }
                        }
                    }, getScript: function (A, C) {
                        var B = function () {
                        };
                        if (C != undefined) {
                            B = C
                        }
                        var D = document.createElement("script");
                        D.setAttribute("language", "javascript");
                        D.setAttribute("type", "text/javascript");
                        D.setAttribute("src", A);
                        this.head.appendChild(D);
                        this.Myload(D, B)
                    }, getStyle: function (A, B) {
                        var B = function () {
                        };
                        if (callBack != undefined) {
                            B = callBack
                        }
                        var C = document.createElement("link");
                        C.setAttribute("type", "text/css");
                        C.setAttribute("rel", "stylesheet");
                        C.setAttribute("href", A);
                        this.head.appendChild(C);
                        this.Myload(C, B)
                    }}
                function GetVerNum() {
                    var D = new Date();
                    return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1))
                }
                Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v=' + GetVerNum());
            </script>

        </div>
    </body>
</html>
