<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use app\models\Agent;
use app\models\search\AgentSearch;

$searchModel = new AgentSearch();
$searchModel->parent_id = $model->id;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
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
            'attribute' => 'customer_number',
            'label' => '从业人员数量',
            'value' => function($model){
                return $model->getCustomers()->count();
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
