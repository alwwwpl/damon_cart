<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>邀请管理 - <?php echo $webname; ?>触屏版</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=130715" rel="stylesheet" type="text/css" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130726" rel="stylesheet" type="text/css" /><script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="h5-1yyg-v11">
    
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
<div class="n-h-tit"><h1 class="header-logo">邀请管理</h1></div>
</div>
</header>

    <section class="clearfix g-member">
        <div class="clearfix m-round m-name">
            <div class="fl f-Himg">
                <a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $member['uid']; ?>" class="z-Himg">
                    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($member['uid'],'img'); ?>" border=0/></a>
                <span class="z-class-icon01 gray02"><s></s><?php echo $member['yungoudj']; ?></span>
            </div>
            <div class="m-name-info"><p class="u-name">
                <b class="z-name gray01"><?php echo get_user_name($member['uid']); ?></b><em>(<?php echo $member['mobile']; ?>)</em></p>
                <ul class="clearfix u-mbr-info"><li>可用夺宝币 <span class="orange"><?php echo $member['score']; ?></span></li>
                    <li>经验值 <span class="orange"><?php echo $member['jingyan']; ?></span></li>
                    <li>余额 <span class="orange">￥<?php echo $member['money']; ?></span>
                        <a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="fr z-Recharge-btn">去充值</a></li>
                </ul>
            </div>
        </div>
	    <div class="m-round m-member-nav">
		    <ul id="ulFun">
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/friends"><b class="z-arrow"></b>邀请好友</a></li>
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/commissions"><b class="z-arrow"></b>佣金明细</a></li>
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/cashout"><b class="z-arrow"></b>申请提现</a></li>
			    <li><a href="<?php echo WEB_PATH; ?>/mobile/invite/record"><b class="z-arrow"></b>提现记录</a></li>
		    </ul>
	    </div>
    </section>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
</script>
 
</div>
</body>
</html>