<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><footer class="footer">
<?php 
	$f_home = '';
	$f_whole = '';
	$f_jiexiao = '';
	$f_car = '';
	$f_personal = '';

	if( ROUTE_C == 'home' || ROUTE_C == 'user' ){
		$f_personal = 'cur';
	}else if( ROUTE_C == 'mobile' && ROUTE_A == 'init'){
		$f_home = 'cur';
	}else if( ROUTE_C == 'mobile' && ROUTE_A == 'glist'){
		$f_whole = 'cur';
	}else if( ROUTE_C == 'mobile' && ROUTE_A == 'lottery'){
		$f_jiexiao = 'cur';
	}else if( ROUTE_C == 'cart'){
		$f_car = 'cur';
	}
 ?>

<style>
.footerdi .f_home i.cur{
	background-position: 0 0 !important;
}
.footerdi .f_whole i.cur{
	background-position: 0 -52px !important;
}
.footerdi .f_jiexiao i.cur{
	background-position: 0 -222px !important;
}
.footerdi .f_car i.cur{
	background-position: 0 -105px !important;
}
.footerdi .f_personal i.cur{
	background-position: 0 -152px !important;
}
</style>

	<div class="u-ft-nav" id="fLoginInfo">
	    <span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/about2">正品保障</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/about">新手必读</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/user/login">登录</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/user/register">注册</a></span>
	</div>
	<p class="m-ftA"><a href="<?php echo WEB_PATH; ?>/mobile/mobile">触屏版</a><a href="<?php echo G_WEB_PATH; ?>/?/PC_SEE=1" target="_blank">电脑版</a><a href="http://m.yyg001.com/app/app.apk">手机客户端</a></p>
	<p class="grayc"><?php echo _cfg('web_copyright'); ?>&nbsp;客服热线<span class="orange"><?php echo _cfg("cell"); ?></span></p>
	<a id="btnTop" href="javascript:;" class="z-top" style="display:none;"><b class="z-arrow"></b></a>
	<!--APP导航开始--></br></br></br>

<div class="footerdi" style="bottom: 0px;">
	<ul>
		<li class="f_home">
			<a title="首页" href="<?php echo WEB_PATH; ?>/mobile/mobile/"><i class="<?php echo $f_home; ?>">&nbsp;</i>首页</a>
		</li>
		<li class="f_whole">
			<a title="所有商品" href="<?php echo WEB_PATH; ?>/mobile/mobile/glist"><i class="<?php echo $f_whole; ?>">&nbsp;</i>所有商品</a>
		</li>
		<li class="f_jiexiao">
			<a title="最新揭晓" href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery"><i class="<?php echo $f_jiexiao; ?>">&nbsp;</i>最新揭晓</a>
		</li>
		<li class="f_car">
			<a title="购物车" href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist"><i class="<?php echo $f_car; ?>">&nbsp;</i>购物车</a>
		</li>
		<li class="f_personal">
			<a title="首页" href="<?php echo WEB_PATH; ?>/mobile/home"><i class="<?php echo $f_personal; ?>">&nbsp;</i>我的云购</a>
		<li>
	</ul>
</div>
</footer>