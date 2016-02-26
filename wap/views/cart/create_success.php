<?php
$this->title = '订单创建成功';
echo $this->render('@app/views/layouts/_account_header');
?>

    <div class="order-notice">
        <img src="<?php echo Yii::$app->request->baseUrl;?>/images/order-cen.png">
        <div class="no-notice-text">订单创建成功</div>
        <div class="order-ball clearfix">
            <a href="/" class="f-left">回首页</a>
            <a href="/account/order" class="f-right">查看订单</a>
        </div>
    </div>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>