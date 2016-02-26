<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = '找回密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <img src="/images/login-logo.png" alt=""><br/>
        <?= Html::encode($this->title) ?>
    </div>

    <div class="login-box-body">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-12'],
            ],
        ]); ?>

        <?= Alert::widget() ?>

        <?= $form->field($model, 'email') ?>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-11">
                <?= Html::submitButton('找回密码', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        
    </div>
</div>
