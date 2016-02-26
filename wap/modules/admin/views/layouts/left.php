<?php
use yii\bootstrap\Nav;

use app\models\Agent;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <?
        $items = [
            ['label' => '首页', 'url' => ['/admin/default/index']],
            ['label' => '代理管理', 'url' => ['/admin/agent/index']],
        ];
        echo Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => $items,
            ]
        );
        ?>
    </section>

</aside>
