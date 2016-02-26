<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\file\FileInput;
use kartik\depdrop\DepDrop;

use app\models\Agent;
use app\models\Area;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = '更新个人资料';
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

                <div class="form-group required <?= $model->hasErrors('province_id') || $model->hasErrors('city_id') || $model->hasErrors('area_id') ? 'has-error' : '' ?>">
                    <div class="field-box">
                        <label class="text-right">区域</label>
                        <div class="col-sm-6">
                            <div class="col-sm-4" style="padding-left:0px;">
                                <?= Html::activeDropDownList($model, 'province_id',
                                    ArrayHelper::map(Area::find()->where(['parent_id' => 1])->all(), 'area_id', 'area_name'),
                                    [
                                        'class' => 'form-control',
                                        'prompt' => '请选择...',
                                    ])
                                ?>
                            </div>

                            <div class="col-sm-4">
                                <?= DepDrop::widget(
                                    [
                                        'model' => $model,
                                        'attribute' => 'city_id',
                                        'data' => ArrayHelper::map($model->province ? $model->province->children(1)->all() : [], 'area_id', 'area_name'),
                                        'pluginOptions' => [
                                            'depends' => ['agent-province_id'],
                                            'placeholder' => '请选择...',
                                            'url' => Url::to(['/area/options'])
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?= DepDrop::widget(
                                    [
                                        'model' => $model,
                                        'attribute' => 'area_id',
                                        'data' => ArrayHelper::map($model->city ? $model->city->children(1)->all() : [], 'area_id', 'area_name'),
                                        'pluginOptions' => [
                                            'depends' => ['agent-city_id'],
                                            'placeholder' => '请选择...',
                                            'url' => Url::to(['/area/options'])
                                        ]
                                    ])
                                ?>
                            </div>

                            <?= Html::error($model, 'province_id', ['class' => 'help-block help-block-error']) ?>
                            <?= Html::error($model, 'city_id', ['class' => 'help-block help-block-error']) ?>
                            <?= Html::error($model, 'area_id', ['class' => 'help-block help-block-error']) ?>
                        </div>
                    </div>
                </div>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'disabled' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'contact')->textInput(['maxlength' => true, 'disabled' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'id_code')->textInput(['maxlength' => true, 'disabled' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'agent_province_id')->dropDownList(ArrayHelper::map(Area::find()->where(['parent_id' => 1])->all(), 'area_id', 'area_name'), ['prompt' => '请选择...', 'disabled' => true]) ?>

                <? if($model->type==Agent::TYPE_CITY){
                    echo $form->field($model, 'agent_city_id')->widget(DepDrop::classname(), [
                        'data' => ArrayHelper::map($model->province ? $model->province->children(1)->all() : [], 'area_id', 'area_name'),
                        'pluginOptions' => [
                            'depends' => ['agent-agent_province_id'],
                            'placeholder' => '请选择...',
                            'url' => Url::to(['/area/options']),
                        ],
                        'disabled' => true
                    ]);
                } ?>

                <?= $form->field($model, 'company_short_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

                <?= $form->field($model, 'company_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

                <?= $form->field($model, 'business_license')->textInput(['maxlength' => true, 'disabled' => true]) ?>

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
