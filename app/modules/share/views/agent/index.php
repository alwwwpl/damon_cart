<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use app\models\Agent;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agents');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    /*GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
        'autoXlFormat'=>true,
        'export'=>[
            // 'fontAwesome'=>true,
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'panel'=>[
            'type'=>'primary',
        ],
        'columns' => [
            [
                'attribute' => 'agent_id',
                'headerOptions' => ['width' => '50'],
            ],
            'username',
            'phone',
            'email',
            'contact',
            'company_short_name',
            [
                'attribute' => 'customer_number',
                'value' => function($model){
                    return $model->getCustomers()->count();
                }
            ],
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
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', Agent::$statuses, ['class' => 'form-control','prompt' => '请选择']),
                'value'=>function ($model) {
                    return Agent::$statuses[$model->status];
                },
                'headerOptions' => ['width' => '100'],
            ],
            'date_added',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/

    ?>

</div>
<style>
    .agent-status span {
        cursor: pointer;
    }
</style>
<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><i class="con-shopping-cart"></i>代理管理</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            编号
                        </th>
                        <th>
                            <span class="line"></span>用户名
                        </th>
                        <th>
                            <span class="line"></span>电话
                        </th>
                        <th>
                            <span class="line"></span>Email
                        </th>
                        <th>
                            <span class="line"></span>联系人
                        </th>
                        <th>
                            <span class="line"></span>公司简称
                        </th>
                        <th>
                            <span class="line"></span>从业人员
                        </th>
                        <th>
                            <span class="line"></span>代理区域
                        </th>
                        <th>
                            <span class="line"></span>状态
                        </th>
                        <th class="align-right">
                            <span class="line"></span>时间
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($dataProvider))
                    {
                        $i = 0;
                        foreach($dataProvider as $val)
                        {
                            $first = '';
                            if ($i == 0){$first = 'class="first"';}else{$first = '';}
                            ?>
                            <tr <?php echo $first;?> id="agent-id<?php echo $val['agent_id'];?>">
                                <td><?php echo $val['agent_id'];?></td>
                                <td><?php echo $val['username'];?></td>
                                <td><?php echo $val['phone'];?></td>
                                <td><?php echo $val['email'];?></td>
                                <td><?php echo $val['contact'];?></td>
                                <td><?php echo $val['company_short_name'];?></td>
                                <td><?php echo $val['num'];?></td>
                                <td><?php echo $val['area_name'];?></td>
                                <td class="agent-status">
                                    <?php
                                    if ($val['status'] == '1')
                                    {
                                        echo '<span class="label label-success" onclick="changestatus(\'2\',\''.$val['agent_id'].'\')">已通过</span>';
                                    }
                                    elseif ($val['status'] == '0') {
                                        echo '<span class="label label-info" onclick="changestatus(\'1\',\''.$val['agent_id'].'\')">待审核</span>';
                                    }
                                    else {
                                        echo '<span class="label label-gray" onclick="changestatus(\'1\',\''.$val['agent_id'].'\')">已拒绝</span>';
                                    }
                                    ?>
                                </td>
                                <td class="align-right"><?php echo $val['date_added'];?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?php echo LinkPager::widget(['pagination' => $pages]); ?>
            </div>
        </div>
    </div>
</div>


