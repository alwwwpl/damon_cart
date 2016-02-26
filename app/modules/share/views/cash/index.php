<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = '达蒙商城-资金管理';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><i class="con-shopping-cart"></i>资金记录</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            编号
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单ID
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>描述
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>余额记录
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>现金记录
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
                                <td><?php echo $val['extensioner_transaction_id'];?></td>
                                <td><?php echo $val['order_id'];?></td>
                                <td><?php echo $val['description'];?></td>
                                <td><?php echo $val['amount'];?></td>
                                <td><?php echo $val['cash'];?></td>
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