<?php
$this->title = '订单支付成功';
?>
<div class="com-content">
    <!--<header>
        <div class="new-header">
            <div class="u-hd-left f-left">
                <a class="J_backToPrev" href=""><span class="u-icon i-hd-back"></span></a>
            </div>
            <div class="u-hd-tit"><span>订单支付成功</span></div>
            <div class="top-info">
                <img src="<?php //echo Yii::$app->request->baseUrl;?>/images/h-member-cart.png">
                <span class="text">更多</span>
                <span class="t-number">9</span>
            </div>
            <div class="nav_erjinv" style="display:none;">
                <div class="arrow-up"></div>
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon-customer"></span>
                            <span class="text">客服</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="icon-message"></span>
                            <span class="text">消息:<em>(19)</em></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="icon-index"></span>
                            <span class="text">首页</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <script>
        $(function(){
            $(".top-info").click(function() {
                $(".nav_erjinv").toggle();
            });
        })
    </script>-->
    <div class="order-notice">
        <img src="<?php echo Yii::$app->request->baseUrl;?>/images/order-cen.png">
        <div class="no-notice-text">订单支付成功</div>
        <div class="order-ball clearfix">
            <a href="/" class="f-left">回首页</a>
            <a href="/account/order" class="f-right">查看订单</a>
        </div>
    </div>
</div>
<?php
echo $this->render('@app/views/layouts/_cart_footer');
?>