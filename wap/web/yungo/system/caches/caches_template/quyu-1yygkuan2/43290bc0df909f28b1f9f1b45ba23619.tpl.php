<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>登录 - <?php echo $webname; ?>触屏版</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/login.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/qqlogin.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/Login.js" language="javascript" type="text/javascript"></script>
	<style type="text/css">
.style1 {
	text-align: center;
}
</style>
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
<div class="n-h-tit"><h1 class="header-logo">用户登录</h1></div>
</div>
</header>


        <section>
	        <div class="registerCon">
    	        <ul>
        	        <li class="accAndPwd">
            	        <dl><input id="txtAccount" type="text" placeholder="请输入您的手机号码/邮箱" class="lEmail"><s class="rs4"></s></dl>
                        <dl>
                            <input type="password" id="txtPassword" class="lPwd" placeholder="密码">
                            <s class="rs3"></s>
                        </dl>
                        <dl>
                            <input type="text" id="txtVerify" class="lVerify" placeholder="验证码"><span class="fog"><img id="checkcode" src="<?php echo WEB_PATH; ?>/api/checkcode/image/80_27/"/></span>
                            <s class="rs3"></s>
                        </dl>
                    </li>
                    <li><a href="javascript:;" id="btnLogin" class="nextBtn orgBtn">登 录</a>
					
					<input name="hidLoginForward" type="hidden" id="hidLoginForward" value="<?php echo WEB_PATH; ?>/mobile/home" /></li>
                    <li class="rSelect"><!--a href="FindPassword.html">忘记密码？</a-->
					<b></b>没账号?请 <a href="<?php echo WEB_PATH; ?>/mobile/user/register">新用户注册</a></li>.
				<!-- 直接使用合作账号登录 -->
				<div class="other-login-outer">
				<ul class="coo_login clearfix">
                <li><a href="<?php echo WEB_PATH; ?>/api/qqlogin" class="coo_a coo_qq"></a></li>

            </ul>
			<div class="style1">
	如果您在微信上进入，请长按关注微信公众服务号后继续<br>
	<img src="/app/myyg001com.png" width="220" height="220"> <br>
	<a title="点击下载安卓客户端" href="/app/app.apk">
	<img src="/images/downs.png" width="182" height="43"></a>   
        </div>
                </ul>
	        </div>       </section>
	        	<style type="text/css">
.style1 {
	text-align: center;
}
</style>

    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v='+GetVerNum());
  var checkcode=document.getElementById('checkcode');
  checkcode.src = checkcode.src + new Date().getTime();
  var src=checkcode.src;
  checkcode.onclick=function(){
      this.src=src+'/'+new Date().getTime();
  }
</script>

    </div>

    </div>
</body>
</html>
