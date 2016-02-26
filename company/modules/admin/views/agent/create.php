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

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="agent-form">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group required <?= $model->hasErrors('province_id') || $model->hasErrors('city_id') || $model->hasErrors('area_id') ? 'has-error' : '' ?>">
            <label class="control-label col-sm-3">区域</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
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
                </div>

                <?= Html::error($model, 'province_id', ['class' => 'help-block help-block-error']) ?>
                <?= Html::error($model, 'city_id', ['class' => 'help-block help-block-error']) ?>
                <?= Html::error($model, 'area_id', ['class' => 'help-block help-block-error']) ?>
            </div>
        </div>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'id_code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'file1', ['hintOptions' => ['hint' => '请上传jpg,png格式图片']])->widget(FileInput::classname(), [
            'options'=>['accept'=>'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','png'],
                'showUpload' => false
            ]
        ]) ?>

        <?= $form->field($model, 'agent_province_id')->dropDownList(ArrayHelper::map(Area::find()->where(['parent_id' => 1])->all(), 'area_id', 'area_name'), ['prompt' => '请选择...']) ?>

        <?= $form->field($model, 'company_short_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'business_license')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'file2', ['hintOptions' => ['hint' => '请上传jpg,png格式图片']])->widget(FileInput::classname(), [
            'options'=>['accept'=>'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','png'],
                'showUpload' => false
            ]
        ]) ?>

        <?= $form->field($model, 'status')->dropDownList(Agent::$statuses) ?>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-11">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
