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
		<form action="" enctype="application/x-www-form-urlencoded" method="post">
		<div class="login_CMobile_Complete">
			<p><?php echo _cfg("web_name"); ?>已向您的手机 <span class="orange"><?php echo $enname; ?></span> 免费发送了一条验证短信，请查看您的手机短信！</p>
			<dl>
				<dt style="width:200px">请输入手机短信收到的验证码：</dt>
				<dd><input id="mobileCode" name="checkcode" class="login_CMobile_Code" type="text"></dd>
				<dd></dd>
			</dl>
			<input type="submit" name="submit" id="btnSubmitRegister" href="javascript:void(0);" class="login_Email_but" value="提交验证" />		
		</div>    		
        </form>
		<div class="login_Explain">
			<h2>没收到验证短信？</h2>
			<p>1.请查看手机的垃圾短信，信息有可能被误认为是垃圾信息。</p>
			<p>2.如果在2分钟后仍未收到验证短信，请点击<button id="retrySend" onclick="javascript:sendmobile();" disabled=1 class="login_SendoutbutClick">重新发送</button> </p>
			<p>3.如果手机号码不小心输错了或者想换个号码？请点击 <a id="hylinkRegisterPageA" class="blue Fb" href="<?php echo WEB_PATH; ?>/register">重新注册</a></p>
		</div>
		
		
	</div>
</div>
<script>
	var i = 0;
	var senda=document.getElementById('retrySend');
	setInterval(function(){if(i>0){
		senda.innerHTML = '重新发送'+i;i--;}else{senda.innerHTML = '重新发送';senda.disabled=0;}
	},1000);
	
	function sendmobile(){
		window.location.href="<?php echo WEB_PATH; ?>/member/user/sendmobile/<?php echo $namestr; ?>"
	}
</script>
<?php include templates("index","footer");?>