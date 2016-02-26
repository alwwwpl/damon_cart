<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\ExtensionerAccounting;


$this->title = '达蒙商城-添加';
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

                <div style="display: none"><?= $form->field($model, 'extensioner_id')->hiddenInput(['value' => $extensioner_id]) ?></div>

                <?= $form->field($model, 'type')->dropDownList($categoryData) ?>

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'each')->dropDownList($each) ?>


                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-11">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

