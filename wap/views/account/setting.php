<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '设置';
echo $this->render('@app/views/layouts/_account_header');
?>
<style>
    #password-edit .help-block {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>

    <div class="js_lib_content">
        <div class="szhi_all">
            <div class="szhi-edit clearfix">
                <div class="h-title">
                    <em class="m_tel"></em>密保手机<span><p><?= !empty($model->security_phone) ? $model->security_phone : '' ?></p><i class="down-ico"></i></span>
                </div>
                <div class="edit-all">
                    <form action="" method="post">
                        <div class="item item-phone clearfix">
                            <span>手机号码</span>
                            <input type="text" value="" maxlength="11" placeholder="请填写手机号码" class="txt-input txt-phone" name="mobile" id="mobile" >
<!--                            <font class="code" id="code">短信验证</font>-->
                            <input class="code" style="font-size: 24px; color: #FF4955; background-color: #EEE;" id="code" value="获取验证码">
                        </div>
                        <div class="item item-captcha clearfix">
                            <span>验证码</span><input type="text" value="" size="11" maxlength="4" autocomplete="off" placeholder="请输入手机收到的验证码" class="txt-input txt-captcha" id="validateCode" name="yanma">
                        </div>
                        <div class="edit-submit-all">
                            <button type="button" class="btn btn-off">取消</button>
                            <button type="button" class="btn btn-submit" id="security-phone">确定</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="szhi-edit clearfix">
                <div class="h-title">
                    <em class="m_email"></em>密保邮箱<span><?= !empty($model->security_email) ? $model->security_email : '' ?><i class="down-ico"></i></span>
                </div>
                <div class="edit-all">
                    <form action="" method="post">
                        <div class="item item-mail clearfix">
                            <span>邮箱地址</span><input type="email" value="" placeholder="请填写邮件地址" class="txt-input txt-mail" name="email" id="email">
<!--                            <font class="code">邮箱验证</font>-->
                            <input class="code" style="font-size: 24px; color: #FF4955; background-color: #EEE;" id="code-email" value="获取验证码">
                        </div>
                        <div class="item item-captcha clearfix">
                            <span>验证码</span><input type="text" value="" maxlength="4" autocomplete="off" placeholder="请输入邮箱收到的验证码" class="txt-input txt-captcha" id="validateCode-email" name="yanma">
                        </div>
                        <div class="edit-submit-all">
                            <button type="button" class="btn btn-off">取消</button>
                            <button type="button" class="btn btn-submit" id="security-email">确定</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="szhi-edit clearfix">
                <div class="h-title">
                    <em class="m_pass"></em>密保管理<span><i class="down-ico"></i></span>
                </div>
                <div class="edit-all">
                    <?php
                    $form = ActiveForm::begin([
                        'method'=>'post',
                        'id' => 'password-edit',
                        'fieldConfig' => [
                            'template' => "{input}{error}",
                        ],
                    ]);
                    ?>
                        <div class="item item-password clearfix">
                            <span>旧密码</span>
                            <?= $form->field($model, 'oldpassword')->passwordInput(['class' => 'txt-input txt-password-old ciphertext_old','placeholder' => '6-18位字母或数字']) ?>
<!--                            <input type="password" name="Customer[oldpassword]" value=""  placeholder="6-18位字母或数字" class="txt-input txt-password-old ciphertext_old" id="customer-oldpassword">-->
                        </div>
                        <div class="item item-password clearfix">
                            <span>新密码</span>
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'txt-input txt-password ciphertext','placeholder' => '6-18位字母或数字','value' => '']) ?>
                            <!--<input type="password" name="Customer[password]" placeholder="6-18位字母或数字" value="" class="txt-input txt-password ciphertext" id="customer-password">-->
                        </div>
                        <div class="item item-password-two clearfix">
                            <span>确认密码</span>
                            <?= $form->field($model, 'password_confirm')->passwordInput(['class' => 'txt-input txt-password_PwdTwo ciphertext_PwdTwo','placeholder' => '确认密码']) ?>
                            <!--<input type="password" name="Customer[password_confirm]" placeholder="再次填写新密码" value="" class="txt-input txt-password_PwdTwo ciphertext_PwdTwo" id="customer-password_confirm">-->
                        </div>
                        <div class="edit-submit-all">
                            <button type="button" class="btn btn-off">取消</button>
                            <button type="submit" class="btn btn-submit">确定</button>
                        </div>
                    <?php
                    ActiveForm::end();
                    ?>
                </div>
            </div>
        </div>
        <div class="edit-btn-controls">
            <a href="/login/logout">
                <button type="button" class="btn btn-exit">退出登录</button>
            </a>
        </div>
    </div>
<script>
    $(document).ready(function() {
        $(".h-title").each(function(){
            $(this).bind('click',function(){
                $(this).next().toggle();
                $(this).find('i').toggleClass('up');
            })
        })
    });


    $('#security-phone').on('click',function(){
        var telephone = $('#mobile').val();

        var code_key = $('#mobile').attr('data-code');

        var code = $('#validateCode').val();

        if (code == code_key)
        {
            $.post('/account/ajax-security-phone',{telephone:telephone},function(data){
                if (data == 'success')
                {
                    history.go(0);
                }
                else {
                    layer.msg('操作失败!');
                }
            });
        }
    });


    $('#security-email').on('click',function(){
        var email = $('#email').val();

        var code_key = $('#email').attr('data-code');

        var code = $('#validateCode-email').val();

        if (code == code_key)
        {
            $.post('/account/ajax-security-email',{email:email},function(data){
                if (data == 'success')
                {
                    layer.msg('绑定成功!');
                    history.go(0);
                }
                else {
                    layer.msg('操作失败!');
                }
            });
        }
    });

    $('#code').on('click',function(){
        var telephone = $('#mobile').val();

        if(!telephone.match(/^[1][3,4,5,7,8][0-9]{9}$/))
        {
            layer.msg('手机号码不正确!');
            return false;
        }
        else
        {
            var obj = $('#code');
            obj.blur();
            $.post('/login/sendmessage',{phone:telephone},function(data){
                if (data.status == 'success') {
                    $('#mobile').attr('data-code',data.code);
                    $('#validateCode').focus();
                    settime();
                }
                else {
                    layer.msg('短信发送失败!');
                }
            },'json');
        }
    });

    $('#code-email').on('click',function(){
        var email = $('#email').val();

        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/; //验证邮箱的正则表达式

        if(!reg.test(email))
        {
            layer.msg("邮箱格式不对");
            return false;
        }
        else
        {
            var obj = $('#code');
            obj.blur();
            $.post('/account/ajax-send-email',{email:email},function(data){
                if (data.status == 'success') {
                    $('#email').attr('data-code',data.code);
                    $('#validateCode-email').focus();
                    settime();
                    layer.msg('邮件已发送，请查收!');
                }
                else {
                    layer.msg('邮件发送失败!');
                }
            },'json');
        }
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


</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>