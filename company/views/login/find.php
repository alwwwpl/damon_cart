<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '设置登录密码';
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
    <div class="w-main">
        <?php
        $form = ActiveForm::begin([
            'method'=>'post',
            'id' => 'frm_login'
        ]); ?>
            <div class="item item-phone clearfix">
                <span>手机号</span><input type="tel" maxlength="11" placeholder="请填写注册手机号" class="txt-input txt-phone" name="Customer[telephone]" id="customer-telephone"  data-code=""><input class="code" style="font-size: 24px;" id="code" value="获取验证码">
            </div>
            <div class="item item-captcha clearfix">
                <span>验证码</span><input type="tel" size="11" maxlength="6" autocomplete="off" placeholder="验证码" class="txt-input txt-captcha" id="validateCode" name="validatecode">
            </div>
            <div class="item item-password clearfix">
                <span>设置密码</span><input type="password" name="Customer[password]" placeholder="请输入密码" class="txt-input txt-password ciphertext" id="customer-password">
            </div>
            <div class="ui-btn-wrap"><input type="submit" class="ui-btn-lg ui-btn-primary" value="完成"> </div>
        <?php
        ActiveForm::end();
        ?>
    </div>

</div>

<script>
    <?php if ($model->errors){
    foreach ($model->errors as $key => $val)
    {
        echo "layer.tips('".$val[0]."','#customer-".$key."', {tips:[1,'#78BA32'],time: 4000});";
    }
    }?>

    var countdown=60;

    function settime() {
        if (countdown == 0) {
            $('#code').removeAttr("disabled");//去除input元素的disabled属性
            $('#code').val('获取验证码');
            countdown = 60;
            return;
        } else {
            $('#code').attr("disabled","disabled")//将input元素设置为disabled
            $('#code').val('重新发送(' + countdown + ')');
            countdown--;
        }
        setTimeout(function(){
            settime();
        },1000);
    }

    $('#code').on('click',function(){
        var telephone = $('#customer-telephone').val();

        if(!telephone.match(/^[1][3,4,5,7,8][0-9]{9}$/))
        {
            layer.msg('手机号码不正确!');
            return false;
        }
        else
        {
            var obj = $('#code');
            obj.blur();
            $.post('./sendmessage',{phone:telephone},function(data){
                if (data.status == 'success') {
                    $('#customer-telephone').attr('data-code',data.code);
                    $('#validateCode').focus();
                    settime();
                }
                else {
                    layer.msg('短信发送失败!');
                }
            },'json');
        }
    });


    $('#frm_login').submit(function(e){

        var code = $('#validateCode').val();
        var code_data = $('#customer-telephone').attr('data-code');
        var telephone = $('#customer-telephone').val();
        var password = $('#customer-password').val();

        if(!telephone.match(/^[1][3,4,5,7,8][0-9]{9}$/))
        {
            layer.msg('手机号码不正确!');
            return false;
        }
        /*
        else if (code != code_data || code == '')
        {
            layer.msg('验证码输入不正确!');
            return false;
        }
        */
        else if (password == '')
        {
            layer.msg('请输入帐户密码!');
            return false;
        }

    });


</script>