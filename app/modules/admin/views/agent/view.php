<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = $model->agent_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->agent_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->agent_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'agent_id',
            'username',
            [
                'attribute' => 'province_id',
                'value' => $model->province ? $model->province->area_name : ''
            ],
            [
                'attribute' => 'city_id',
                'value' => $model->city ? $model->city->area_name : ''
            ],
            [
                'attribute' => 'area_id',
                'value' => $model->area ? $model->area->area_name : ''
            ],
            'address',
            'phone',
            'email:email',
            'contact',
            'id_code',
            'id_file:image',
            [
                'attribute' => 'agent_province_id',
                'value' => $model->agentProvince ? $model->agentProvince->area_name : ''
            ],
            [
                'attribute' => 'agent_city_id',
                'value' => $model->agentCity ? $model->agentCity->area_name : ''
            ],
            'company_short_name',
            'company_name',
            'business_license',
            'business_license_file:image',
            'status',
            [
                'attribute' => 'parent_id',
                'value' => $model->parent ? $model->parent->username : ''
            ],
            [
                'attribute' => 'type',
                'value' => $model->typeName,
            ],
            'date_added:datetime',
            'date_modified:datetime',
        ],
    ]) ?>

</div>
