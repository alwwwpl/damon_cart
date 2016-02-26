<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = '修改密码';
//$this->params['breadcrumbs'][] = $this->title;
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

                <?= $form->field($model, 'oldPassword')->passwordInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-11">
                        <?= Html::submitButton('修改密码', ['class' => 'btn-flat gray', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
