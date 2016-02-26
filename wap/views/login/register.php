<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '帐号注册';
?>
<style>
    select {
        height: 80px;
        border: 0px !important;
        margin-left: 3%;
        float: left;
        width: 150px;
        font-size: 26px;
        overflow: hidden;
        border-radius: 8px;
        background: #FFF;
    }
    select option {
        border: 0px;
        width: 150px;
        height: 40px;
        line-height: 40px;
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
                <span>手机号</span>
                <input type="tel" maxlength="11" placeholder="请填写注册手机号" class="txt-input txt-phone" name="Customer[telephone]" id="customer-telephone" data-code=""><input class="code" style="font-size: 24px;" id="code" value="获取验证码">
            </div>
            <div class="item item-captcha clearfix">
                <span>验证码</span>
                <input type="tel" size="11" maxlength="4" autocomplete="off" placeholder="验证码" class="txt-input txt-captcha" id="validateCode">
            </div>
            <div class="item item-password clearfix">
                <span>设置密码</span>
                <input type="password" name="Customer[password]" placeholder="请输入密码" class="txt-input txt-password ciphertext" id="customer-password">
            </div>
            <div class="item item-password clearfix">
                <span>确认密码</span>
                <input type="password" name="Customer[password_confirm]" placeholder="确认密码" class="txt-input txt-password_PwdTwo ciphertext_PwdTwo" id="customer-password_confirm">
            </div>
            <div class="item area clearfix" style="margin-top: 20px;">
                <span>所属城市</span>
                <div class="select">
                    <select name="Customer[province]" id="customer-province">
                        <option value="0">省份</option>
                        <?php
                        if (!empty($data['agent_province']))
                        {
                            echo "<option value='".$data['agent_province'][0]['area_name']."' data-area-id=''>".$data['agent_province'][0]['area_name']."</option>";
                        }
                        else
                        {
                            foreach ($provinces as $province)
                            {
                                echo "<option value='".$province['area_name']."' data-area-id='".$province['area_id']."'>".$province['area_name']."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="select">
                    <select name="Customer[city]" id="customer-city">
                        <?php
                        if (!empty($data['agent_city']))
                        {
                            echo "<option value='".$data['agent_city'][0]['area_name']."'>".$data['agent_city'][0]['area_name']."</option>";
                        }
                        else
                        {
                            echo "<option value='0' data-id=''>城市</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!--<div class="item item-tcode clearfix">
                <span>验证码</span><input type="text" size="11" maxlength="6" autocomplete="off" placeholder="推荐人所提供的6位编码(选填)" class="txt-input txt-tcode" id="register-code" name="register_code">
            </div>-->
            <div class="ui-btn-wrap"><input type="submit" class="ui-btn-lg ui-btn-primary" value="注册"> </div>
            <div class="zc-xy clearfix">
                <div class="zc-xy-left"><span>注册即视为同意 <a href="">达蒙商城服务条款</a></span></div>
                <div class="zc-xy-right"><span>已有账号?<a href="/login">登录</a></span></div>
            </div>
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

    setTimeout(function(){
        $('.layui-layer-tips').remove();
    },5000);


    $('#customer-province').on('change',function(){
        var province_id = $(this).find('option:selected').attr('data-area-id');
        var html = '<option value="0">城市</option>';
        $.post('./getcity',{province_id:province_id},function(data){
            if (data.status == 'success'){
                $.each(data.citys,function(index,item){
                    html += "<option value='"+item.area_name+"'>"+item.area_name+"</option>";
                });
            }
            $('#customer-city').html(html);
        },'json');
    });

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
        var password_confirm = $('#customer-password_confirm').val();

        if(!telephone.match(/^[1][3,4,5,7,8][0-9]{9}$/))
        {
            layer.msg('手机号码不正确!');
            return false;
        }
        else if (code != code_data || code == '')
        {
            layer.msg('验证码输入不正确!');
            return false;
        }
        else if (password == '')
        {
            layer.msg('请输入帐户密码!');
            return false;
        }
        else if (password_confirm == '')
        {
            layer.msg('请输入确认密码!');
            return false;
        }
        else if (password != password_confirm)
        {
            layer.msg('两次密码不一致!');
            return false;
//            e.preventDefault();
        }

    });


</script>