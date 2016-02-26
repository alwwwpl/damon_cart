<?php
use yii\bootstrap\Nav;

use app\models\Agent;
?>
<style>
    #dashboard-menu li a { margin-left:0px;}
    .nav li a:hover {background: none !important;}
</style>
<div id="sidebar-nav">
    <?
    $items = [
        ['label' => '<i class="icon-home"></i><span>管理首页</span>', 'url' => ['/agent/default/index']],
        ['label' => '<i class="icon-shopping-cart"></i><span>订单管理</span>', 'url' => ['/agent/order/index']],
    ];
    if(!Yii::$app->agent->isGuest && Yii::$app->agent->identity->type==Agent::TYPE_PROVINCE){
        $items[] = ['label' => '<i class="icon-map-marker"></i><span>市级代理</span>', 'url' => ['/agent/agent/index']];
    }

    if(!Yii::$app->agent->isGuest && Yii::$app->agent->identity->type==Agent::TYPE_CITY){
        $items[] = ['label' => '<i class="icon-group"></i><span>从业人员</span>', 'url' => ['/agent/customer/index']];
    }
    $items[] = ['label' => '<i class="icon-share"></i><span>推广管理</span>', 'url' => ['/agent/share/index']];
    $items[] = ['label' => '<i class="icon-th-large"></i><span>产品管理</span>', 'url' => ['/agent/product/index']];
    $items[] = ['label' => '<i class="icon-user"></i><span>个人信息</span>', 'url' => ['/agent/user/update']];
    $items[] = ['label' => '<i class="icon-cog"></i><span>修改密码</span>', 'url' => ['/agent/user/change-password']];
    echo Nav::widget(
        [
            'encodeLabels' => false,
            'options' => ['id' => 'dashboard-menu'],
            'items' => $items,
        ]
    );
    ?>
</div>
