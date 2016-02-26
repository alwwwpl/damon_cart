<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>结算支付 - <?php echo $webname; ?>触屏版</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=20150129" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/cartList.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/Payment.js" language="javascript" type="text/javascript"></script>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/recharge.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<style>
.registerCon select{
background: #FFF none repeat scroll 0% 0%;
border: 5px solid #DDD;
color: #CCC;
border-radius: 5px;
padding: 0px 5px;
display: inline-block;
position: relative;
font-size: 16px;
height: 50px;
width: 101%;
}
.registerCon .loading{
	padding-top: 20px;
	color: #999;
}
.registerCon .form{
	display:none;
}


.regular-radio {
	display: none;
}

.regular-radio + label {
	-webkit-appearance: none;
	background-color: #fafafa;
	border: 1px solid #cacece;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	padding: 5px;
	border-radius: 50px;
	display: inline-block;
	position: relative;
}

.regular-radio:checked + label:after {
	content: ' ';
	width: 12px;
	height: 12px;
	border-radius: 50px;
	position: absolute;
	top: 0px;
	background: #99a1a7;
	box-shadow: inset 0px 0px 10px rgba(0,0,0,0.3);
	text-shadow: 0px;
	left: 0px;
	font-size: 32px;
}

.regular-radio:checked + label {
	background-color: #e9ecee;
	color: #99a1a7;
	border: 0px solid #ADB8C0;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1), inset 0px 0px 10px rgba(0,0,0,0.1);
}

.regular-radio + label:active, .regular-radio:checked + label:active {
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}
</style>
<div class="h5-1yyg-v1">

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
<div class="n-h-tit"><h1 class="header-logo">结算支付</h1></div>
</div>
</header>

<form id="form_paysubmit" action="<?php echo WEB_PATH; ?>/member/cart/paysubmit" method="post">
    <input name="hidShopMoney" type="hidden" id="hidShopMoney" value="<?php echo $MoenyCount; ?>" />
    <input name="hidBalance" type="hidden" id="hidBalance" value="<?php echo $Money; ?>" />
    <input name="hidPoints" type="hidden" id="hidPoints" value="<?php echo $member['score']; ?>" />
    <input name="shopnum" type="hidden" id="shopnum" value="<?php echo $shopnum; ?>" />
    <input name="pointsbl" type="hidden" id="pointsbl" value="<?php echo $fufen_dikou; ?>" />
    <section class="clearfix g-pay-lst">
		<ul>
		 <?php $ln=1; if(is_array($shoplist)) foreach($shoplist AS $key => $val): ?>

			<li>
			    <a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $val['id']; ?>" class="gray6">(第<?php echo $val['qishu']; ?>期)<?php echo $val['title']; ?>  (<?php echo $val['title2']; ?>)</a>
			    <span>
			        <em class="orange arial"><?php echo $val['cart_xiaoji']; ?></em>人次
			    </span>
			</li>
		 <?php  endforeach; $ln++; unset($ln); ?>

		</ul>
		<p class="g-pay-Total gray9">合计：<span class="orange arial Fb F16"><?php echo $MoenyCount; ?></span> 元</p>
		<p class="g-pay-bline"></p>
    </section>
    <section class="clearfix g-Cart">
	    <article class="clearfix m-round g-pay-ment">
		    <ul id="ulPayway">
			<?php if($fufen_dikou >= $MoenyCount): ?>
			    <li class="gray9 z-pay-ff z-pay-grayC">
				<i id="spPoints" class="z-pay-ment" sel="0"></i>
				<span>您可以使用夺宝币付款（您的夺宝币：<?php echo $member['score']; ?>）</span>
				</li>
			<?php  else: ?>
			     <li class="gray6 z-pay-ff z-pay-grayC">
				<span>您的夺宝币不足（您的夺宝币：<?php echo $member['score']; ?>）1000夺宝币=1元 </span>
				</li>
			<?php endif; ?>

			<?php if($Money >= $MoenyCount): ?>
				<li class="gray9 z-pay-ye z-pay-grayC">
				<i id="spBalance" class="z-pay-ment" sel="0"></i>
				<span>您可以使用余额付款（账户余额：<?php echo $Money; ?> 元）</span>
				</li>
			<?php  else: ?>
			    <li class="gray6 z-pay-ye z-pay-grayC">
				<a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="z-pay-Recharge">去充值</a>
				<span>您的余额不足（账户余额：<?php echo $Money; ?> 元）</span>
				</li>
			<?php endif; ?>
		    </ul>
	    </article>
	    <article id="bankList" class="clearfix mt10 m-round g-pay-ment g-bank-ct" style="display: none;">
		    <ul>
			    <li class="gray6 z-pay-grayC"><s class="z-arrow"></s>选择网银支付</li>
			    <li class="gray9" style="display:none;" umb='CMBCHINA'><i class="z-bank-Roundsel"><s></s></i>招商银行</li>
			    <li class="gray9" style="display:none;" umb='ICBC'><i class="z-bank-Round"><s></s></i>工商银行</li>
			    <li class="gray9" style="display:none;" umb='CCB'><i class="z-bank-Round"><s></s></i>建设银行</li>
		    </ul>
	    </article>
	    <div>
			<?php if($Money >= $MoenyCount || $fufen_dikou >= $MoenyCount): ?>
			   <a id="btnPay" href="javascript:;" class="orgBtn">确认支付</a>
			<?php  else: ?>
				

		 <section class="clearfix g-member">
	    <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
	        <ul id="ulBankList">
			<li class="gray6">选择平台支付<em class="orange"><?php echo $MoenyCount; ?></em>元</li>
<?php $ln=1;if(is_array($paylist)) foreach($paylist AS $pay): ?>
			<?php if($pay['pay_id'] != 1): ?>
			<?php if($pay['pay_id'] != 2): ?>
			<?php if($pay['pay_id'] != 3): ?>
			<?php if($pay['pay_id'] != 4): ?>
			<?php if($pay['pay_id'] != 8): ?>
			     
				
			     <li class="gray9" urm="<?php echo $pay['pay_id']; ?>">
			         <i><s></s>
					 <input id="<?php echo $pay['pay_id']; ?>" class="regular-radio" checked="checked" type="radio" value="<?php echo $pay['pay_id']; ?>" name="account" id="Tenpay">
					<label for="<?php echo $pay['pay_id']; ?>"></label>
					 </i><?php echo $pay['pay_name']; ?>
			     </li>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
<?php  endforeach; $ln++; unset($ln); ?>
		    </ul>

	    </article>
		<div class="mt10 f-Recharge-btn">
					
		    <a id="btnSubmit" href="javascript:;" class="orgBtn">			<input type="hidden" name="submitcode" value="<?php echo $submitcode; ?>">
			<input id="submit_ok" class="shop_pay_but" type="submit" name="submit" value="马上支付" style="background-color: transparent;width: 100%;"></a>
	    </div>
			
	    </div>
		<?php endif; ?>
    </section>
</form>
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  Path.submitcode = '<?php echo $submitcode; ?>';

var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v='+GetVerNum());

</script>
</div>
</body>
</html>