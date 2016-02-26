<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\models\Extensioner;
use app\models\ExtensionerAccounting;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '达蒙商城-推广人详细';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div id="pad-wrapper" class="user-profile">
        <!-- header -->
        <div class="row header">
            <div class="col-md-8">
                <img src="img/contact-profile.png" class="avatar img-circle">
                <h3 class="name"><?php echo $model->lastname;?></h3>
                <span class="area"><?php echo $model->email.' '.$model->phone;?></span>
            </div>
        </div>

        <div class="row">
            <!-- bio, new note & orders column -->
            <div class="col-md-9">
                <div class="profile-box">
                    <!-- biography -->
                    <?php //var_dump($orderData);?>
                    <div class="col-md-12" style="margin-bottom: 80px; padding: 0px;">
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
                                <th class="align-right">
                                    <span class="line"></span>时间
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr id="extensioner-id<?php echo $model->extensioner_id;?>">
                                <th>
                                    <?php echo $model->extensioner_id;?>
                                </th>
                                <th>
                                    <?php echo $model->lastname;?>
                                </th>
                                <th>
                                    </span><?php echo $model->phone;?>
                                </th>
                                <th>
                                    <?php echo $model->email;?>
                                </th>
                                <th class="order-status">
                                    <?php
                                    if ($model->status == Extensioner::STATUS_PASSED)
                                    {
                                        echo '<span class="label label-success">已通过</span>';
                                    }
                                    elseif ($model->status == Extensioner::STATUS_PENDING){
                                        echo '<span class="label label-success">待审核</a>';
                                    }
                                    else {
                                        echo '<span class="label label-gray">已拒绝</span>';
                                    }
                                    ?>
                                </th>
                                <th class="align-right order-action">
                                    <?php echo $model->create_time;?>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h6>分账列表</h6>
                    <br>
                    <!-- recent orders table -->
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-2">
                                ID
                            </th>
                            <th class="col-md-2">
                                <span class="line"></span>
                                类型
                            </th>
                            <th class="col-md-3">
                                <span class="line"></span>
                                提成
                            </th>
                            <th class="col-md-2 align-right">
                                <span class="line"></span>
                                操作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row -->

                        <?php
                        if (!empty($model_type))
                        {
                        foreach ($model_type as $val)
                        {
                            ?>
                            <tr id="ea-<?php echo $val['extensioner_accounting_id'];?>">
                                <td>
                                    <?php echo $val['extensioner_accounting_id'] ?>
                                </td>
                                <td>
                                    <?php echo $val['type'];?>
                                </td>
                                <td>
                                    <?php
                                    if($val['each'] == 'g')
                                    {
                                        echo $val['price'].'元/'.$val['each'];
                                    }
                                    elseif($val['each'] == '%')
                                    {
                                        echo $val['price'].$val['each'].'/单';
                                    }
                                    ?>
                                </td>
                                <td class="align-right">
                                    <a href="./plus?extensioner_id=<?php echo $val['extensioner_id'];?>" title="添加分帐"><i class="icon-plus"></i></a>
                                    <a href="./edit?extensioner_id=<?php echo $val['extensioner_id'];?>&extensioner_accounting_id=<?php echo $val['extensioner_accounting_id'];?>" title="编辑" style="margin: 0px 15px;"><i class="icon-pencil"></i></a>
                                    <a href="javascript:void(0);" class="extension-del" data-ets-id="<?php echo $val['extensioner_id'];?>" data-etsact-id="<?php echo $val['extensioner_accounting_id'];?>" title="删除"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.extension-del').on('click',function(){
        var extensioner_id = $(this).attr('data-ets-id');
        var extensioner_accounting_id = $(this).attr('data-etsact-id');
        $.post('./del',{extensioner_id:extensioner_id,extensioner_accounting_id:extensioner_accounting_id},function(data){
            if (data == 'success')
            {
                $('#ea-'+extensioner_accounting_id).remove();
            }
            else {
                alert('操作失败!');
            }
        });
    });
</script>



