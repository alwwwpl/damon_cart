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
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <h3><i class="con-shopping-cart"></i>订单管理</h3>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        订单编号
                    </th>
                    <th>
                        <span class="line"></span>收货地址
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
                <?php
                if (!empty($orderData))
                {
                    $i = 0;
                    foreach($orderData as $val)
                    {
                        $first = '';
                        if ($i == 0){$first = 'class="first"';}else{$first = '';}
                        ?>
                        <tr <?php echo $first;?> id="order-id<?php echo $val['order_id'];?>">
                            <td><?php echo $val['order_id'];?></td>
                            <td><?php if (!empty($val['username'])){echo $val['username'].' '.$val['phone'].' '.$val['province'].' '.$val['city'].' '.$val['remarks'];}else{echo $val['shipping_lastname'].' '.$val['shipping_zone'].' '.$val['shipping_city'].' '.$val['shipping_address_1'].' '.$val['shipping_postcode'];}?></td>
                            <td><?php echo $val['number'];?></td>
                            <td><?php echo $val['total'];?></td>
                            <td><?php echo $val['date_added'];?></td>
                            <td class="order-status">
                                <?php
                                if ($val['status'] == '已发货' || $val['status'] == '已完成')
                                {
                                    echo '<span class="label label-success">'.$val['status'].'</span>';
                                }
                                elseif ($val['status'] == '已付款'){
                                    echo '<span class="label label-success">待发货</a>';
                                }
                                else {
                                    echo '<span class="label label-gray">待付款</span>';
                                }
                                ?>
                            </td>
                            <td class="align-right order-action">
                                <?php
                                if ($val['status'] == '已付款'){
                                echo '<a href="javascript:void(0)" class="deliver" data-toggle="modal" data-target="#myModal" data-id="'.$val['order_id'].'"><i class="icon-truck"></i></a>';
                                }
                                ?>
                                <a href="./info?order_id=<?php echo $val['order_id']; ?>"><i class="icon-eye-open"></i></a>
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


<!--
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <?php //foreach ($orderData as $value) { ?>

                    <div class="panel panel-default"  style="border-radius: 0px;">
                        <div class="panel-heading" role="tab" id="headingOne" style="padding: 0px;">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php //$value['order_id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                                <div class="container-fluid">
                                    <div class="row" style="font-size: 14px; height: 45px; line-height: 45px;">
                                        <div class="col-xs-1 col-sm-1 col-md-1"><?php //$value['order_id'] ?></div>
                                        <div class="col-xs-4 col-sm-4 col-md-4"><?php //$value['username'].' '.$value['phone'].' '.$value['province'].' '.$value['city'].' '.$value['remarks']?></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2"><?php //$value['number'] ?></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2"><?php //$value['total'] ?></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2"><?php //$value['date_added'] ?></div>
                                        <div class="col-xs-1 col-sm-1 col-md-1">
                                            <?php
                                            /*if ($value['status'] == '已发货' || $value['status'] == '已完成')
                                            {
                                                echo $value['status'];
                                            }
                                            elseif ($value['status'] == '已付款'){
                                                echo '<a hef="javascript:void(0)" class="btn btn-primary deliver" data-toggle="modal" data-target="#myModal" data-id="'.$value['order_id'].'">发货</a>';
                                            }*/
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="collapseOne<?php //$value['order_id'] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body" style="padding: 0px; margin: 0px;">
                                <div class="container-fluid" style="background: #fcf8e3; height: 40px ;line-height: 40px; color: #3C8DBC; font-weight: 800;">
                                    <div class="row">
                                        <div class="col-xs-1 col-sm-1 col-md-1">图片</div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">名称</div>
                                        <div class="col-xs-1 col-sm-1 col-md-1">编号</div>
                                        <div class="col-xs-1 col-sm-1 col-md-1">库存</div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">价格</div>
                                        <div class="col-xs-1 col-sm-1 col-md-1">数量</div>
                                        <div class="col-xs-1 col-sm-1 col-md-1">总价</div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">物流</div>
                                    </div>
                                </div>
                                <?php //foreach ($value['products'] as $val){ ?>
                                <div class="container-fluid">
                                    <div class="row" style="font-size: 14px; height: 45px; line-height: 45px; border-top: 1px solid #f0f0f0;">
                                        <div class="col-xs-1 col-sm-1 col-md-1"><img src="http://iddmall.com/image/<?php //$val['image'] ?>" style="width: 80px; height: 80px;"></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2"><?php //$val['agent_product_name'] ?></div>
                                        <div class="col-xs-1 col-sm-1 col-md-1"><?php //$val['agent_product_model'] ?></div>
                                        <div class="col-xs-1 col-sm-1 col-md-1"><?php //$val['agent_product_stock'] ?></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2"><?php //$val['cost_price'] ?></div>
                                        <div class="col-xs-1 col-sm-1 col-md-1"><?php //$val['quantity'] ?></div>
                                        <div class="col-xs-1 col-sm-1 col-md-1"><?php //$val['total'] ?></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2"><?php // $val['express'] ?></div>
                                    </div>
                                </div>
                                <?php //} ?>
                            </div>
                        </div>
                    </div>
                <?php
               // }
                ?>
        </div>-->




<!--        <table class="table table-bordered table-striped dataTable">-->
<!--            <thead>-->
<!--                <tr>-->
<!--                    <td>订单编号</td>-->
<!--                    <td>收货地址</td>-->
<!--                    <td>商品总数</td>-->
<!--                    <td>订单总价</td>-->
<!--                    <td>订单时间</td>-->
<!--                    <td>操作</td>-->
<!--                </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--                --><?php //foreach ($orderData as $value) { ?>
<!--                    <tr>-->
<!--                        <td>--><?//= $value['order_id'] ?><!--</td>-->
<!--                        <td></td>-->
<!--                        <td>--><?//= $value['number'] ?><!--</td>-->
<!--                        <td>--><?//= $value['total'] ?><!--</td>-->
<!--                        <td>--><?//= $value['date_added'] ?><!--</td>-->
<!--                        <td>发货 <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></td>-->
<!--                    </tr>-->
<!--                    <div style="display: none; width:100%;" class="order-show">-->
<!--                        <table class="table table-bordered table-striped">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th style="width:30%">图片</th>-->
<!--                                <th>名称</th>-->
<!--                                <th>价格</th>-->
<!--                                <th>数量</th>-->
<!--                                <th>总价</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php //foreach ($value['products'] as $val){ ?>
<!--                                <tr>-->
<!--                                    <td>--><?//= $val['image'] ?><!--</td>-->
<!--                                    <td>--><?//= $val['model'] ?><!--</td>-->
<!--                                    <td>--><?//= $val['cost_price'] ?><!--</td>-->
<!--                                    <td>--><?//= $val['quantity'] ?><!--</td>-->
<!--                                    <td>--><?//= $val['total'] ?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--            </tbody>-->
<!--        </table>-->
<!--        --><?//= LinkPager::widget(['pagination' => $dataProvider->pagination]); ?>

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



