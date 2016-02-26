<?php
$this->title = '我的钱包';
echo $this->render('@app/views/layouts/_account_header');
?>

    <div class="js_lib_content">
        <div class="mybag-total clearfix">
            <a href="/account/balance" style="color: #ff821c;">
                <em>
                    <img src="<?php echo Yii::$app->request->baseUrl;?>/images/bag_yupng.png" >账户余额
                </em>
                <span>￥<?= round($balance->balance, 2) ?></span>
            </a>
        </div>
        <div class="maybag-cate">
            <div class="cai-cata clearfix">
                <div class="menu-list clearfix">
                    <ul>
                        <li>
                            <a href="/account/cash">
                                <img src="<?php echo Yii::$app->request->baseUrl;?>/images/mybagca01.png">
                                <p>提现</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="<?php echo Yii::$app->request->baseUrl;?>/images/mybagca02.png">
                                <p>佣金</p>
                            </a>
                        </li>
                        <li class="last">
                            <a href="/account/balance-detailed">
                                <img src="<?php echo Yii::$app->request->baseUrl;?>/images/mybagca03.png">
                                <p>明细</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cai-order clearfix">
            <div class="h-title">
                <a href="/account/coupon">
                    <em class="bag-hcard"></em>我的优惠卡<span>10<i class="r-ico"></i></span>
                </a>
            </div>
        </div>
        <div class="cai-order dm-bag clearfix">
            <div class="h-title">
                <a href="/account/bank">
                    <em class="bag-ycard"></em>我的银行卡<span><?= $bankCardNum ?><i class="r-ico"></i></span>
                </a>
            </div>
        </div>
        <div class="szhi-edit clearfix">
            <div class="h-title">
                <em class="bag_pass"></em>设置支付密码<span><i class="down-ico"></i></span>
            </div>
            <div class="edit-all">
                <?php
                if (empty(Yii::$app->user->identity->payment_password))
                {
                ?>
                    <input type="hidden" name="oldpaymentpassword" value="password"  placeholder="6-18位字母或数字" class="txt-input txt-password-old ciphertext_old" id="oldPaymentPassword">
                <?php
                }
                else
                {
                ?>
                    <div class="item item-password clearfix">
                        <span>旧密码</span><input type="password" maxlength="18" name="oldpaymentpassword" value=""  placeholder="6-18位字母或数字" class="txt-input txt-password-old ciphertext_old" id="oldPaymentPassword">
                    </div>
                <?php
                }
                ?>
                <div class="item item-password clearfix">
                    <span>新密码</span><input type="password" maxlength="18" name="paymentpassword" placeholder="6-18位字母或数字" value="" class="txt-input txt-password ciphertext" id="paymentPassword">
                </div>
                <div class="item item-password-two clearfix">
                    <span>确认密码</span><input type="password" maxlength="18" name="confirmpaymentpassword" placeholder="再次填写新密码" value="" class="txt-input txt-password_PwdTwo ciphertext_PwdTwo" id="confirmPaymentPassword">
                </div>
                <div class="edit-submit-all">
                    <button type="button" class="btn btn-off">取消</button>
                    <button type="button" class="btn btn-submit">确定</button>
                </div>
            </div>
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

        $('.btn-submit').on('click',function(){
            var oldPaymentPassword = $('#oldPaymentPassword').val();
            var paymentPassword = $('#paymentPassword').val();
            var confirmPaymentPassword = $('#confirmPaymentPassword').val();

            if (oldPaymentPassword == "" || paymentPassword == "" || confirmPaymentPassword == "")
            {
                layer.msg('请输入完整信息!');
                return false;
            }
            else if (oldPaymentPassword.lenth < 6)
            {
                layer.msg('旧密码长度为6-18位！');
                return false;
            }
            else if (paymentPassword.lenth < 6)
            {
                layer.msg('密码长度为6-18位！');
                return false;
            }
            else if (confirmPaymentPassword != paymentPassword)
            {
                layer.msg('确认密码和新密码不致!');
                return false;

            }
            else
            {
                $.post('/account/ajax-payment-password',{oldPaymentPassword:oldPaymentPassword,paymentPassword:paymentPassword,confirmPaymentPassword:confirmPaymentPassword},function(data){
                    if (data == 'success')
                    {
                        layer.msg('修改成功!');
                        return false;
                        history.go(0);
                    }
                    else
                    {
                        layer.msg('修改失败!');
                        return false;
                    }
                });
            }
        });



    })
</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>