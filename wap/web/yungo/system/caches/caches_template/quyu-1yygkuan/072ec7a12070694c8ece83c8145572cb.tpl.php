<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head><title>
	帐户充值 - <?php echo $webname; ?>触屏版
</title><meta content="app-id=518966501" name="apple-itunes-app" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" /><meta content="yes" name="apple-mobile-web-app-capable" /><meta content="black" name="apple-mobile-web-app-status-bar-style" /><meta content="telephone=no" name="format-detection" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=130715" rel="stylesheet" type="text/css" /><link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130726" rel="stylesheet" type="text/css" /><script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script><script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/recharge.js" language="javascript" type="text/javascript"></script><link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css"></head>
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
<div class="n-h-tit"><h1 class="header-logo">充值中心</h1></div>
</div>
</header>


    <div class="g-Total gray9">您的当前余额：<span class="orange arial"><?php echo $member['money']; ?></span>元</div>
    <section class="clearfix g-member">
        <div class="g-Recharge">
	        <ul id="ulOption">
		        <li money="10"><a href="javascript:;" class="z-sel">10元<s></s></a></li>
		        <li money="20"><a href="javascript:;">20元<s></s></a></li>
		        <li money="30"><a href="javascript:;">30元<s></s></a></li>
		        <li money="100"><a href="javascript:;">100元<s></s></a></li>
		        <li money="200"><a href="javascript:;">200元<s></s></a></li>
		        <li><b><input type="text" class="z-init" placeholder="    输入金额" maxlength="8" /><s></s></b></li>
	        </ul>
	    </div>
	    <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
	        <ul id="ulBankList">
			     <li class="gray6">选择平台充值<em class="orange">10.00</em>元</li>
			<?php $ln=1;if(is_array($paylist)) foreach($paylist AS $pay): ?>
			<?php if($pay['pay_id'] != 11): ?>
			     <li class="gray9" urm="<?php echo $pay['pay_id']; ?>">
			         <i class="z-bank-Round"><s></s></i><?php echo $pay['pay_name']; ?><!-- CMBCHINA-WAP -->
			     </li>
			<?php endif; ?>
			<?php  endforeach; $ln++; unset($ln); ?>
			    <!-- <li class="gray9" data-urm="ICBC-WAP"><i class="z-bank-Round"><s></s></i>工商银行</li>ICBC-WAP
			    <li class="gray9" data-urm="CCB-WAP"><i class="z-bank-Round"><s></s></i>建设银行</li>CCB-WAP -->
		    </ul>
			<!--<li class="gray9">
			        <a href="<?php echo WEB_PATH; ?>/member/home/waprechargedk"><i class="z-bank-Round"><s></s></i></a><a href="<?php echo WEB_PATH; ?>/member/home/waprechargedk">点卡支付</a>
			     </li>-->
	    </article>
		

	    <div class="mt10 f-Recharge-btn">
		    <a id="btnSubmit" href="javascript:;" class="orgBtn">确认充值</a>
	    </div>
	    <!--<div class="mt10 f-Recharge-btn">-->
		    <!--<a id="btnSubmit" href="<?php echo WEB_PATH; ?>/mobile/autolottery" class="orgBtn">我有充值卡</a>-->
	    <!--</div>-->
    </section>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v='+GetVerNum());
</script>
 
</div>
</body>
</html>
