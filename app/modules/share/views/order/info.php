<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div id="pad-wrapper" class="user-profile">
        <!-- header -->
        <div class="row header">
            <div class="col-md-8">
                <img src="img/contact-profile.png" class="avatar img-circle">
                <h3 class="name"><?php echo $orderData['username'];?></h3>
                <span class="area"><?php echo $orderData['phone'].' '.$orderData['province'].' '.$orderData['city'].' '.$orderData['remarks'];?></span>
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
                                    订单编号
                                </th>
                                <th>
                                    <span class="line"></span>商品总数
                                </th>
                                <th>
                                    <span class="line"></span>订单总价
                                </th>
                                <th>
                                    <span class="line"></span>订单时间
                                </th>
                                <th>
                                    <span class="line"></span>状态
                                </th>
                                <th class="align-right">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr id="order-id<?php echo $orderData['order_id'];?>">
                                <th>
                                    <?php echo $orderData['order_id'];?>
                                </th>
                                <th>
                                    <?php echo $orderData['number'];?>
                                </th>
                                <th>
                                    </span><?php echo $orderData['total'];?>
                                </th>
                                <th>
                                    <?php echo $orderData['date_added'];?>
                                </th>
                                <th class="order-status">
                                    <?php
                                    if ($orderData['status'] == '已发货' || $orderData['status'] == '已完成')
                                    {
                                        echo '<span class="label label-success">'.$orderData['status'].'</span>';
                                    }
                                    elseif ($orderData['status'] == '已付款'){
                                        echo '<span class="label label-success">待发货</a>';
                                    }
                                    else {
                                        echo '<span class="label label-gray">待付款</span>';
                                    }
                                    ?>
                                </th>
                                <th class="align-right order-action">
                                    <?php
                                    if ($val['status'] == '已付款'){
                                        echo '<a href="javascript:void(0)" class="deliver" data-toggle="modal" data-target="#myModal" data-id="'.$val['order_id'].'"><i class="icon-truck"></i></a>';
                                    }else {
                                        echo '<span class="label">'.$orderData['status'].'</span>';
                                    }
                                    ?>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h6>商品列表</h6>
                    <br>
                    <!-- recent orders table -->
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-4">
                                产品
                            </th>
                            <th class="col-md-1">
                                <span class="line"></span>
                                库存
                            </th>
                            <th class="col-md-1">
                                <span class="line"></span>
                                价格
                            </th>
                            <th class="col-md-1">
                                <span class="line"></span>
                                数量
                            </th>
                            <th class="col-md-1">
                                <span class="line"></span>
                                总价
                            </th>
                            <th class="col-md-2">
                                <span class="line"></span>
                                物流
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row -->

                        <?php
                        foreach ($productData as $val)
                        {
                        ?>
                            <tr>
                                <td>
                                    <img src="http://iddmall.com/image/<?php $val['image'] ?>" class="img-circle avatar hidden-phone">
                                    <a href="user-profile.html" class="name"><?php echo $val['agent_product_name'];?></a>
                                    <span class="subtext"><?php echo $val['agent_product_model'];?></span>
                                </td>
                                <td>
                                    <?php echo $val['agent_product_stock'] ?>
                                </td>
                                <td>
                                    <?php echo $val['cost_price'] ?>
                                </td>
                                <td>
                                    <?php echo $val['quantity'] ?>
                                </td>
                                <td>
                                    <?php echo $val['total'] ?>
                                </td>
                                <td>
                                    <?php echo $val['express'] ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="fade" id="myModal" data-id="" style="display:none; position: fixed; top: 10%; left: 50%; z-index: 1050; width: 560px; margin-left: -280px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">发货</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">物流公司：</label>
                        <div class="col-sm-6" style="padding: 0px;">
                            <select class="form-control" id="express_name">
                                <option value="顺丰速运">顺丰速运</option>
                                <option value="申通快递">申通快递</option>
                                <option value="圆通快递">圆通快递</option>
                                <option value="汇通快递">汇通快递</option>
                                <option value="中通快递">中通快递</option>
                                <option value="韵达快递">韵达快递</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">物流编号：</label>
                        <div class="col-sm-6" style="padding: 0px;">
                            <input type="text" class="form-control" id="express" placeholder="物流编号" name="express" style="height: 35px; line-height: 35px;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="deliver-submit">保存</button>
            </div>
        </div>
    </div>
</div>




