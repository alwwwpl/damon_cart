<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<div class="login_layout">    
	<div class="login_title">
		<h2>新用户注册</h2>
		<ul class="login_process">
			<li><b>1</b>填写注册信息</li>
			<li class="login_arrow"></li>
			<li class="login_processCur"><b>2</b>验证邮箱/验证手机</li>
			<li class="login_arrow"></li>
			<li><b>3</b>完成注册</li>
		</ul>
		<span>已经是会员？<a id="hylinkLoginPage" class="blue Fb" href="<?php echo WEB_PATH; ?>/member/user/login">登录</a></span>
	</div>
	<div class="login_Content">
		
		<div class="login_CMobile_Complete">
			<p>请点击立即发送<?php echo _cfg("web_name"); ?>会向您的手机 <span class="orange"><?php echo $enname; ?></span> 免费发送了一条验证短信！！</p>
			<div class="login_Email_but">
			
			<button id="retrySend" onclick="javascript:sendmobile();" disabled=1 class="login_SendoutbutClick">立即发送</button>
			
		</div>	
		</div>    		
 

		
		
	</div>
</div>
<script>
	var i = 0;
	var senda=document.getElementById('retrySend');
	setInterval(function(){if(i>0){
		senda.innerHTML = '立即发送'+i;i--;}else{senda.innerHTML = '立即发送';senda.disabled=0;}
	},1000);
	
	function sendmobile(){
		window.location.href="<?php echo WEB_PATH; ?>/member/user/sendmobile/<?php echo $namestr; ?>"
	}
</script>
<?php include templates("index","footer");?>