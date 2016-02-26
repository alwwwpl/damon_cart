<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php /*echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer_id',
            [
                'attribute' => 'telephone',
                'value' => function($model){
                    return $model->telephoneHiden;
                }
            ],
            [
                'attribute' => 'email',
                'value' => function($model){
                    return $model->emailHiden;
                }
            ],
            [
                'attribute' => 'customerUserNumer',
                'label' => '小C数量',
                'value' => function($model){
                    return $model->getCustomerUsers()->count();
                }
            ],
            'date_added',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>

</div>

<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><i class="con-shopping-cart"></i>从业人员管理</h3>
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
                            <span class="line"></span>小C数量
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
                    if (!empty($customerData))
                    {
                        $i = 0;
                        foreach($customerData as $val)
                        {
                            $first = '';
                            if ($i == 0){$first = 'class="first"';}else{$first = '';}
                            ?>
                            <tr <?php echo $first;?> >
                                <td><?php echo $val['customer_id'];?></td>
                                <td><?php echo $val['lastname'];?></td>
                                <td><?php echo $val['telephone'];?></td>
                                <td><?php echo $val['email'];?></td>
                                <td><?php echo $val['num'];?></td>
                                <td>
                                    <?php
                                    if ($val['status'] == '1')
                                    {
                                        echo '<span class="label label-success">已通过</span>';
                                    }
                                    elseif ($val['status'] == '0') {
                                        echo '<span class="label label-info">待审核</span>';
                                    }
                                    else {
                                        echo '<span class="label label-gray">已拒绝</span>';
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

