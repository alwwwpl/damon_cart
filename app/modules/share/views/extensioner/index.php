<?php

//use yii\helpers\Html;
//use kartik\grid\GridView;
//
use app\models\Extensioner;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '达蒙商城-推广人员管理';
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
                    <a href="./add"><button class="btn pull-right btn-primary">添加</button></a>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            用户名
                        </th>
                        <th>
                            <span class="line"></span>姓名
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
                                <td><?php echo $val['username'];?></td>
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
                                    <a href="./plus?extensioner_id=<?php echo $val['extensioner_id'];?>" title="添加分帐"><i class="icon-plus"></i></a>
                                    <a href="./edit?extensioner_id=<?php echo $val['extensioner_id'];?>" title="编辑" style="margin-left: 15px;"><i class="icon-pencil"></i></a>
                                    <a href="./info?extensioner_id=<?php echo $val['extensioner_id'];?>" title="查看详细" style="margin: 0px 15px;"><i class="icon-eye-open"></i></a>
                                    <a class="extension-del" data-ets-id="<?php echo $val['extensioner_id'];?>" href="javascript:void(0);" title="删除"><i class="icon-trash"></i></a>
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
<script>
    $('.extension-del').on('click',function(){
        var extensioner_id = $(this).attr('data-ets-id');
        $.post('./del',{extensioner_id:extensioner_id,extensioner_accounting_id:0},function(data){
            if (data == 'success')
            {
                $('#extensioner-id'+extensioner_id).remove();
            }
            else {
                alert('操作失败!');
            }
        });
    });
</script>

