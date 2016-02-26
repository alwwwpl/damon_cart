<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>我的 - <?php echo $webname; ?>触屏版</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=20150129" rel="stylesheet" type="text/css" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130726" rel="stylesheet" type="text/css" /><script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
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
<div class="n-h-tit"><h1 class="header-logo">签到赚红包</h1></div>
</div>
</header>

  <section class="clearfix g-member">
	    <div class="clearfix m-round m-name">
<style>
.u-mbr-info li:nth-child(1) {
border-top: none;
}
.u-mbr-info li:nth-child(3n-1) {
width: 100%;
text-indent: 5px;
line-height: 27px;
border-left: none;
border-top: 1px solid #EFEFEF;
box-shadow: none;
}
.u-mbr-info li:nth-child(3n-3) {
width: 100%;
text-indent: 5px;
line-height: 27px;
border-left: none;
border-top: 1px solid #EFEFEF;
box-shadow: none;
}
.u-mbr-info li {
width: 100%;
text-indent: 5px;
line-height: 27px;
border-left: none;
border-top: 1px solid #EFEFEF;
box-shadow: none;
}
</style>

				<p class="u-name">
					<b class="z-name gray01"><?php echo get_user_name($member['uid']); ?></b><em>(<?php echo $member['mobile']; ?>)</em>
				</p>
				<ul class="clearfix u-mbr-info">
				<li>可用夺宝币 <span class="orange"><?php echo $member['score']; ?></span></li>
				<li>您已连续签到 <span class="orange"><?php echo $member['sign_in_time']; ?></span>天</li>
				<li>总共签到 <span class="orange"><?php echo $member['sign_in_time_all']; ?></span>天</li>
				<li>最后签到 <span class="orange"><?php echo $member['sign_in_date']; ?></span></li>
				<li style="text-align: center;"><a href="<?php echo WEB_PATH; ?>/mobile/home/qiandao/mobile/submit" class="z-Recharge-btn">马上签到</a></li>
				</ul>
		</div>
		<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/help.css?v=130726001" rel="stylesheet" type="text/css" />

	    <div class="helpCon" style="padding: 0;">
    	    <div class="helpMain m-round">
        	    <div class="helpInfo">
            	    <dt>
                	    <h3 style="">签到说明</h3>
                    </dt>
                    <dd id="dd1" class="helpBox">
						1.每天签到时间为00:01到23:59<br />
						2.每次签到可获得200夺宝币（1000夺宝币=1元）<br />
						3.同一IP、同一地址、同一联系人、同一台电脑只允许一个账号签到，发现多个账号签到的全部封号。<br />
                    </dd>
                </div>
			</div>
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
