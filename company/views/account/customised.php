<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '私人定制';
echo $this->render('@app/views/layouts/_account_header');
?>
<style>
    #customised-add .help-block {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>

    <div class="w-main">
        <div class="add-receiving">
            <?php
            $form = ActiveForm::begin([
                'method'=>'post',
                'id' => 'customised-add',
                'fieldConfig' => [
                    'template' => "{input}{error}",
                ],
            ]);
            ?>
            <div class="js_lib_content">
                <div class="si-img">
                    <?= $form->field($model, 'image')->hiddenInput(['value' => 0]) ?>
                    <img src="<?php echo Yii::$app->request->baseUrl;?>/images/siren_img.jpg">
                </div>
            </div>

            <?= $form->field($model, 'customer_id')->hiddenInput(['value' => Yii::$app->user->identity->customer_id]) ?>
            <div class="item item-recename clearfix">
                <span>产品名称：</span>
                <?= $form->field($model, 'product_name')->textInput(['class' => 'txt-input','placeholder' => '产品名称']) ?>
            </div>
            <div class="item item-species clearfix">
                <span>产品类别：</span>
                <?= $form->field($model, 'product_type')->textInput(['class' => 'txt-input','placeholder' => '产品类型']) ?>
            </div>
            <div class="item item-number clearfix">
                <span>产品品牌：</span>
                <?= $form->field($model, 'product_brand')->textInput(['class' => 'txt-input','placeholder' => '产品品牌']) ?>
            </div>
            <div class="item item-contact clearfix">
                <span>采购数量：</span>
                <?= $form->field($model, 'number')->textInput(['class' => 'txt-input','placeholder' => '采购数量']) ?>
            </div>
            <div class="item item-time clearfix">
                <span>产品描述：</span>
                <?= $form->field($model, 'number')->textarea(['rows'=>3,'cols'=>3,'style' => 'width:65%; float:left; border:0px; margin:20px 0px 10px 20px; font-size:26px;','placeholder' => '产品描述']) ?>
            </div>
            <div class="receiving-submit-all">
                <button type="submit" class="btn btn-receiving">保存</button>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>