<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\Extensioner;


/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = '达蒙商城-编辑';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'disabled' => true])?>

                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'disabled' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'disabled' => true]) ?>

                <?php
                    if ($model->type == 3)
                    {
                        echo $form->field($model, 'status')->dropDownList(Extensioner::$statuses);
                    }
                ?>

                <?= $form->field($model, 'percent')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-11">
                        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

