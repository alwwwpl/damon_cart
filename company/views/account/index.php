<?php
$this->title = '个人中心';
?>
<div class="com-content">
    <div class="js_lib_content">
        <div class="head-img">
            <div class="header-e clearfix">
                <div class="u-hd-left f-left">
                    <a class="J_backToPrev" href="/account/setting"><span class="u-edit i-hd-back"></span></a>
                </div>
                <div class="top-info">
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3096669723&site=qq&menu=yes">
                        <img src="<?php echo Yii::$app->request->baseUrl;?>/images/cus-wr.png">
                    </a>
                </div>
            </div>

            <a href="/account/personal">

            <span class="my-img">
                <img src="<?php echo Yii::$app->request->baseUrl;?>/data/user_logo.jpg">
            </span>
                <div class="user-all">
                    <p class="name"><?= Yii::$app->user->identity->lastname; ?></p>
                    <p class="area"><?= Yii::$app->user->identity->province; ?> <?= Yii::$app->user->identity->city; ?></p>
                </div>
                <div class="edit-right">编辑<i class="r-ico"></i></div>
            </a>
        </div>
        <div class="cai-cata clearfix">
            <div class="menu-list clearfix">
                <ul>
                    <li>
                        <a href="/account/order?status=wait">
                            <img src="<?php echo Yii::$app->request->baseUrl;?>/images/c-order-one.png">
                            <span class="w-number"><?= $waitPayOrderNum > 9 ? '9+' : $waitPayOrderNum; ?></span>
                            <p>待支付</p>
                        </a>
                    </li>
                    <li>
                        <a href="/account/order?status=delivered">
                            <img src="<?php echo Yii::$app->request->baseUrl;?>/images/c-order-two.png">
                            <span class="w-number"><?= $deliveredOrderNum > 9 ? '9+' : $deliveredOrderNum; ?></span>
                            <p>待收货</p>
                        </a>
                    </li>
                    <li class="last">
                        <a href="/index.php/account/order">
                            <img src="<?php echo Yii::$app->request->baseUrl;?>/images/c-order-three.png">
                            <span class="w-number"><?= $orderDataNum > 9 ? '9+' : $orderDataNum; ?></span>
                            <p>全部订单</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="cai-order clearfix">
            <div class="h-title">
                <a href="/account/wallet">
                    <em class="s_bag"></em>我的钱包<span><i class="r-ico"></i></span>
                </a>
            </div>
        </div>
        <div class="cai-order clearfix">
            <div class="h-title">
                <a href="/account/collection">
                    <em class="s_shou"></em>我的收藏<span><i class="r-ico"></i></span>
                </a>
            </div>
        </div>
        <!--<div class="cai-order clearfix">
            <div class="h-title">
                <a href="/account/customised">
                    <em class="s_siren"></em>私人订制<span><i class="r-ico"></i></span>
                </a>
            </div>
        </div>
        <div class="cai-order clearfix">
            <div class="h-title">
                <a href="">
                    <em class="s_dian"></em>店铺管理<span><i class="r-ico"></i></span>
                </a>
            </div>
        </div>
        <div class="cai-order clearfix">
            <div class="h-title">
                <a href="">
                    <em class="s_ding"></em>客户订单<span><i class="r-ico"></i></span>
                </a>
            </div>
        </div>-->
        <?php
        echo $this->render('@app/views/layouts/_cart_footer');
        ?>
    </div>
</div>