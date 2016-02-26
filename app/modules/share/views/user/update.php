<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\file\FileInput;
use kartik\depdrop\DepDrop;

use app\models\Extensioner;
use app\models\Area;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = '达蒙商城-个人资料';
//$this->params['breadcrumbs'][] = '更新个人资料';
?>
<style>
    .text-right {
        text-align: right !important;
    }
    .form-control {
        height: 35px !important;
        line-height: 35px;
    }
</style>
<div class="container-fluid">
    <div id="pad-wrapper" class="form-page">
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12 column">
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "<div class=\"field-box\">{label}\n<div class=\"col-md-6\">{input}</div>\n<div class=\"col-md-4 text-left\">{error}</div></div>",
                        'labelOptions' => ['class' => 'text-right'],
                    ],
                ]); ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'disabled' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'id_number')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'company_number')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'company_short')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-11">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn-flat success' : 'btn-flat gray']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
