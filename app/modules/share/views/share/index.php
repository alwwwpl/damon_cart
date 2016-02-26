<?php

use app\models\Extensioner;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agents');
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
                    <a href="./customer/add"><button class="btn pull-right btn-primary">添加</button></a>
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
                            <span class="line"></span>状态
                        </th>
                        <th>
                            <span class="line"></span>时间
                        </th>
                        <th class="align-right">
                            <span class="line"></span>操作
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
                            <tr <?php echo $first;?> id="extensioner-id<?php echo $val['extensioner_id'];?>">
                                <td><?php echo $val['extensioner_id'];?></td>
                                <td><?php echo $val['lastname'];?></td>
                                <td><?php echo $val['phone'];?></td>
                                <td><?php echo $val['email'];?></td>
                                <td class="agent-status">
                                    <?php
                                    if ($val['status'] == Extensioner::STATUS_PASSED)
                                    {
                                        echo '<span class="label label-success" onclick="changestatus(\'2\',\''.$val['extensioner_id'].'\')">已通过</span>';
                                    }
                                    elseif ($val['status'] == Extensioner::STATUS_PENDING) {
                                        echo '<span class="label label-info" onclick="changestatus(\'1\',\''.$val['extensioner_id'].'\')">待审核</span>';
                                    }
                                    else {
                                        echo '<span class="label label-gray" onclick="changestatus(\'1\',\''.$val['extensioner_id'].'\')">已拒绝</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $val['create_time'];?></td>
                                <td class="align-right">
                                    <a href="./customer/info?extensioner_id=<?php echo $val['extensioner_id'];?>" title="查看详细"><i class="icon-eye-open"></i></a>
                                    <a href="./customer/del?extensioner_id=<?php echo $val['extensioner_id'];?>" title="删除" style="margin-left: 15px;"><i class="icon-trash"></i></a>
                                </td>
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


