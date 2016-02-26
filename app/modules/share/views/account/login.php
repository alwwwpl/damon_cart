<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use dmstr\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = '代理商登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .row-fluid { width: 100%;}
</style>
<div class="row-fluid login-wrapper">
    <?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12 text-left\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 text-left'],
        ],
    ]);
    ?>
    <a href="./">
        <img class="logo" src="http://agent.iddmall.com/images/login-logo.png" />
    </a>
    <div class="span4 box">
        <div class="content-wrap">
            <h6>登录</h6>
            <?php
            echo $form->field($model,'username');
            ?>
            <?php
            echo $form->field($model,'password')->passwordInput();
            ?>
            <div class="remember">
                <input id="remember-me" type="checkbox" />
                <label for="remember-me">Remember me</label>
            </div>
            <button class="btn-glow primary" type="submit">&nbsp;&nbsp; 登&nbsp;&nbsp;&nbsp;&nbsp;录 &nbsp;&nbsp;</button>
        </div>
    </div>
    <?php
    ActiveForm::end();
    ?>
</div>


