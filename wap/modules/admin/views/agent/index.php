<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use app\models\Agent;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建省级代理', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('children', ['model'=>$model]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'],
                'expandOneOnly'=>true
            ],
            'agent_id',
            'username',
            'phone',
            'contact',
            [
                'attribute' => 'agent_area',
                'label' => '代理区域',
                'value' => function($model){
                    if($model->type==Agent::TYPE_PROVINCE){
                        return $model->agentProvince->area_name;
                    }else{
                        return $model->agentCity->area_name;
                    }
                }
            ],
            [
                'attribute' => 'agent_number',
                'label' => '代理数量',
                'value' => function($model){
                    return $model->getChildren()->count();
                }
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', Agent::$statuses, ['class' => 'form-control','prompt' => '请选择']),
                'value'=>function ($model) {
                    return Agent::$statuses[$model->status];
                },
                'headerOptions' => ['width' => '100'],
            ],
            // [
            //     'attribute' => 'type',
            //     'filter' => Html::activeDropDownList($searchModel, 'type', Agent::$types, ['class' => 'form-control','prompt' => '请选择']),
            //     'value'=>function ($model) {
            //         return Agent::$types[$model->type];
            //     },
            //     'headerOptions' => ['width' => '100'],
            // ],
            'date_added',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {pass} {refuse} {update} {delete}',
                'buttons' => [
                    'refuse' => function($url, $model, $key){
                        $html = '';
                        if($model->status==Agent::STATUS_PENDING){
                            $html = Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                'title' => '拒绝',
                                'data-confirm' => '确定拒绝吗？',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        }
                        return $html;
                    },
                    'pass' => function($url, $model, $key){
                        $html = '';
                        if($model->status==Agent::STATUS_PENDING){
                            $html = Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                'title' => '同意',
                                'data-confirm' => '确定通过吗？',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        }
                        return $html;
                    },
                ]
            ],
        ],
    ]); ?>

</div>
