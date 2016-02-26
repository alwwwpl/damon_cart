<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '登录';
?>
<style>
    .layui-layer-tips .layui-layer-content {
        font-size: 20px;
        line-height: 42px;
    }
    .layui-layer-msg .layui-layer-content {
        font-size: 20px;
        line-height: 42px;
    }
</style>
<div class="com-content">
    <div class="js_lib_content">
        <div class="reg_banner"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner4.jpg"></div>
    </div>
    <div class="w-main dama">
        <?php
        $form = ActiveForm::begin([
            'method'=>'post',
            'id' => 'frm_login'
        ]); ?>
        <div class="item item-username clearfix">
            <span>账 号</span>
            <input type="text" name="LoginForm[email]" value="" placeholder="请输入用户名" class="txt-input txt-username" id="loginform-email" class="email">
        </div>
        <div class="item item-password clearfix">
            <span>密 码</span>
            <input type="password" style="display: inline;" name="LoginForm[password]" placeholder="请输入密码" class="txt-input txt-password ciphertext password" id="loginform-password">
        </div>
        <div class="ui-btn-wrap">
            <input type="submit" class="ui-btn-lg ui-btn-primary" value="登录">
        </div>
        <div class="retrieve-password">
            <a href="/login/find" class="">忘记密码?</a>
        </div>
        <div class="ui-reg-wrap">还没有账号？
            <a href="/login/register">手机注册</a>
        </div>

        <?php
        ActiveForm::end();
        ?>
    </div>

</div>

<script type="text/javascript">

    <?php if ($model->errors){

    foreach ($model->errors as $key => $val)
    {
        echo "layer.tips('".$val[0]."', '.".$key."', {tips:[1,'#78BA32'],time: 4000});";
    }
    }?>

    $(document).ready(function(){
        $("form").submit(function(e){
            var username = $.trim($("#loginform-email").val());
            var password = $.trim($("#loginform-password").val());
            if(username == ''){
                layer.msg('请输入手机号码!');
                return false;
            }else if(password == ''){
                layer.msg('请输入登录密码!');
                return false;
            }
        });
    });
</script>