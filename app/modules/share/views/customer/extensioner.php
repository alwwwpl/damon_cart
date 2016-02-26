<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

use app\models\Extensioner;
use app\models\ExtensionerCustomer;

$this->title = '达蒙商城-推广人员管理';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><i class="con-shopping-cart"></i>推广人员管理</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            编号
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>姓名
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>电话
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>Email
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>分账
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>状态
                        </th>
                        <th class="col-md-2">
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
                                <td><?php echo $val['percent'];?></td>
                                <td>
                                    <?php
                                    if ($val['status'] == Extensioner::STATUS_PASSED)
                                    {
                                        echo '<span class="label label-success">已通过</span>';
                                    }
                                    elseif ($val['status'] == Extensioner::STATUS_PENDING) {
                                        echo '<span class="label label-info">待审核</span>';
                                    }
                                    else {
                                        echo '<span class="label label-gray">已拒绝</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $val['create_time'];?></td>
                                <td class="align-right">
                                    <a href="./update?extensioner_id=<?php echo $val['extensioner_id'];?>&extensioner_customer_id=<?php echo $val['customer_id'];?>" title="编辑" style="margin:0px 10px;"><i class="icon-pencil"></i></a>
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
        $.post('./del',{extensioner_id:extensioner_id,extensioner_customer_id:0},function(data){
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
