<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>

<!DOCTYPE html>
<html>
<head><title>
	我的晒单 - <?php echo $webname; ?>触屏版
</title><meta content="app-id=518966501" name="apple-itunes-app" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" /><meta content="yes" name="apple-mobile-web-app-capable" /><meta content="black" name="apple-mobile-web-app-status-bar-style" /><meta content="telephone=no" name="format-detection" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=130715" rel="stylesheet" type="text/css" />
<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130226" rel="stylesheet" type="text/css" />
<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>


<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/MpostList.js" language="javascript" type="text/javascript"></script></head>
<body>
<div class="h5-1yyg-v1" id="loadingPicBlock">
    
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
<div class="n-h-tit"><h1 class="header-logo">我的晒单</h1></div>
</div>
</header>


    <div class="g-snav m_listNav">
	    <div class="g-snav-lst z-sgl-crt"><a id="btnPost" href="javascript:;" class="gray9">已晒单</a><b></b></div>
	    <div class="g-snav-lst"><a id="btnUnPost" href="<?php echo WEB_PATH; ?>/mobile/home/singlelister" class="gray9">未晒单</a></div>
    </div>
    <section id="divPost" class="clearfix g-Single-lst z-minheight">
        <ul>
        </ul>
    </section>
    <section id="divUnPost" class="clearfix g-Single-lst z-minheight" style="display:none;">
        <ul>
        </ul>
    </section>
    <div id="divPostLoad" class="loading"><b></b>正在加载</div>
    <a id="btnLoadMore" class="loading" href="javascript:;" style="display:none;">点击加载更多</a>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  Path.imgpath = "<?php echo G_WEB_PATH; ?>/statics";
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v='+GetVerNum());
</script>
 
</div>
</body>
</html>
