<?php

//use yii\helpers\Html;
//use kartik\grid\GridView;
//
use app\models\Extensioner;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '从业人员管理';
//$this->params['breadcrumbs'][] = $this->title;
?>
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
                    <h3><i class="con-shopping-cart"></i>人员管理</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            编号
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>用户名
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>电话
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>Email
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>状态
                        </th>
                        <th class="col-md-2">
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
                            <tr <?php echo $first;?>>
                                <td><?php echo $val['customer_id'];?></td>
                                <td><?php echo $val['lastname'];?></td>
                                <td><?php echo $val['telephone'];?></td>
                                <td><?php echo $val['email'];?></td>
                                <td class="agent-status">
                                    <?php
                                    if ($val['status'] == 1)
                                    {
                                        echo '<span class="label label-success")">已通过</span>';
                                    }
                                    elseif ($val['status'] == 0) {
                                        echo '<span class="label label-info")">待审核</span>';
                                    }
                                    else {
                                        echo '<span class="label label-gray")">已拒绝</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $val['date_added'];?></td>
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
