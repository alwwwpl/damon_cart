<?php
use yii\bootstrap\Nav;
?>
<style>
    #dashboard-menu li a { margin-left:0px;}
    .nav li a:hover {background: none !important;}
</style>
<div id="sidebar-nav">
    <?php
    //var_dump(Yii::$app->extensioner->identity);
    $items = [['label' => '<i class="icon-home"></i><span>管理首页</span>', 'url' => ['/share/default/index']]];

    if (Yii::$app->extensioner->identity->type === 1)
    {
        $items[] = ['label' => '<i class="icon-group"></i><span>从业人员</span>', 'url' => ['/share/customer/index']];

        $items[] = ['label' => '<i class="icon-user"></i><span>推广人员</span>', 'url' => ['/share/customer/extensioner']];

        $items[] = ['label' => '<i class="icon-cloud-upload"></i><span>升级管理</span>', 'url' => ['/share/customer/upgrade']];

        $items[] = ['label' => '<i class="icon-share"></i><span>推广链接</span>', 'url' => ['/share/link/index']];

        $items[] = ['label' => '<i class="icon-credit-card"></i><span>资金管理</span>', 'url' => ['/share/cash/index']];

        $items[] = ['label' => '<i class="icon-info-sign"></i><span>个人信息</span>', 'url' => ['/share/user/update']];
    }
    elseif (Yii::$app->extensioner->identity->type === 2)
    {
        $items[] = ['label' => '<i class="icon-group"></i><span>用户管理</span>', 'url' => ['/share/vip/index']];

        $items[] = ['label' => '<i class="icon-share"></i><span>推广链接</span>', 'url' => ['/share/link/index']];

        $items[] = ['label' => '<i class="icon-credit-card"></i><span>资金管理</span>', 'url' => ['/share/cash/index']];
    }
    elseif (Yii::$app->extensioner->identity->type === 3)
    {
        $items[] = ['label' => '<i class="icon-group"></i><span>从业人员</span>', 'url' => ['/share/customer/index']];

        $items[] = ['label' => '<i class="icon-share"></i><span>推广链接</span>', 'url' => ['/share/link/index']];

        $items[] = ['label' => '<i class="icon-credit-card"></i><span>资金管理</span>', 'url' => ['/share/cash/index']];
    }
    else
    {
        $items[] = ['label' => '<i class="icon-group"></i><span>人员管理</span>', 'url' => ['/share/extensioner/index']];
    }

    $items[] = ['label' => '<i class="icon-cog"></i><span>修改密码</span>', 'url' => ['/share/user/change-password']];
    echo Nav::widget(
        [
            'encodeLabels' => false,
            'options' => ['id' => 'dashboard-menu'],
            'items' => $items,
        ]
    );
    ?>
</div>
