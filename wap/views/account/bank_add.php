<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '添加银行卡';
echo $this->render('@app/views/layouts/_account_header');
?>
<style>
    .layui-layer-msg .layui-layer-content {
        font-size: 20px;
        line-height: 42px;
    }
    .form-group {
        margin-top: -15px !important;
    }
</style>

    <div class="js_lib_content">
        <div class="payment-add">
            <?php
            $form = ActiveForm::begin([
                'method'=>'post',
                'id' => 'bank-add',
                'fieldConfig' => [
                    'template' => "{input}{error}",
                ],
            ]);
            ?>
                <div class="item item-card clearfix">
                    <span>银行卡号:</span>
                    <?= $form->field($model, 'card_number')->textInput(['class' => 'txt-input txt-captcha','placeholder' => '银行卡号']) ?>
<!--                    <input type="text" size="11" maxlength="4" autocomplete="off" placeholder="银行卡号" class="txt-input txt-captcha" id="validateCode" name="yanma">-->
                </div>
                <div class="item item-card clearfix">
                    <span>所属银行:</span>
                    <?= $form->field($model, 'bank')->textInput(['class' => 'txt-input txt-captcha','placeholder' => '所属银行名称']) ?>
                    <!--<input type="text" size="11" maxlength="4" autocomplete="off" placeholder="所属银行名称" class="txt-input txt-captcha" id="validateCode" name="yanma">-->
                </div>
                <div class="item item-card clearfix">
                    <span>所属支行:</span>
                    <?= $form->field($model, 'subbranch')->textInput(['class' => 'txt-input txt-captcha','placeholder' => '所属支行名称']) ?>
                    <!--<input type="text" size="11" maxlength="4" autocomplete="off" placeholder="所属支行名称" class="txt-input txt-captcha" id="validateCode" name="yanma">-->
                </div>
                <div class="item item-card clearfix">
                    <span>持卡人:</span>
                    <?= $form->field($model, 'username')->textInput(['class' => 'txt-input txt-captcha','placeholder' => '持卡人姓名']) ?>
                    <!--<input type="text" size="11" maxlength="4" autocomplete="off" placeholder="持卡人姓名" class="txt-input txt-captcha" id="validateCode" name="yanma">-->
                </div>
                <!--<div class="item item-card clearfix">
                    <span>联系电话:</span>

                    <input type="text" size="11" maxlength="4" autocomplete="off" placeholder="手机号码" class="txt-input txt-captcha" id="validateCode" name="yanma">
                </div>-->
                <div class="ui-btn-wrap"><input type="submit" name="submit" value="保存" class="ui-btn-lg ui-btn-primary"> </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
        <div class="footer_bar openwebview" style="display: block;">
            <ul class="warp clearfix">
                <li>
                    <a class="new_home" href="">
                        <i class="new_icon"></i>
                        <span>达蒙商城</span>
                    </a>
                </li>
                <li>
                    <a class="new_ca" href="">
                        <i class="new_icon"></i>
                        <span>分类</span>
                    </a>
                </li>
                <li>
                    <a class="new_pai" href="">
                        <i class="new_icon"></i>
                        <span>抢拍</span>
                    </a>
                </li>
                <li>
                    <a class="new_car_center" href="">
                        <i class="new_icon"></i>
                        <span>购物车</span>
                    </a>
                </li>
                <li>
                    <a class="to_personalcenter personalcenternum" href="">
                        <i class="new_icon"><strong style="display: none;"></strong></i>
                        <span>我的</span>
                    </a>
                </li>
            </ul>
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
    })
</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>