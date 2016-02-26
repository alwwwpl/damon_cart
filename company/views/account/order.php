<?php
$this->title = '订单管理';
echo $this->render('@app/views/layouts/_account_header');
?>

    <div class="js_lib_content">
        <?php
        if (!empty($orderData))
        {
            $i = 0;
            foreach ($orderData as $order)
            {

        ?>
        <div class="userdiv clearfix" <?= $i > 0 ? 'style="margin-top:30px;"' : '' ?>>
            <div class="orderlisttit">
                <p class="f-left order-number" data-order="<?= substr($order['order_id'], 0, 9) - 131311921 ?>">订单号：<?= $order['order_id'] ?></p>
                <p class="f-right <?= $order['order_status_id'] < 3 ? 'no-' : '' ?>delivery"><?= $order['status'] ?></p>
            </div>
            <?php
            foreach ($order['product'] as $val)
            {
            ?>
            <div class="orderlistdiv clearfix">
                <a href="/account/order-detail?order_id=<?= $order['order_id']; ?>">
                    <img src="http://cadmin.iddmall.com/image/<?= $val['image']; ?>">
                    <div class="cart_orderlist_text">
                        <p class="cart_g_name"><?= $val['name'] ?></p>
                        <p class="cart_g_price">单价  ￥<?= $val['price'] ?></p>
                        <p class="cart_g_number">购买数量  <?= $val['quantity'] ?></p>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
            <div class="o-time">下单时间：<?= $order['date_added'] ?></div>
            <div class="orderlistbot">
                <div class="f-left">合计:<span class="big-toal">￥<?= round($order['total'],2) ?></span></div>
                <div class="f-right">
                    <?php
                    if ($order['order_status_id'] == 1 || $order['order_status_id'] == 0)
                    {
                        echo "<a class='btn_cancel_order order-cancel' href='javascript:void(0);' data-order='".$order['order_id']."' data-status='16'>取消订单</a>";
                        echo "<a class='btn_white_order' href='/account/payment?order_id=".$order['order_id']."'>立即支付</a>";
                    }
                    elseif ($order['order_status_id'] == 2 && ($order['payment_code'] == 'cod' || $order['payment_code'] == 'free_checkout'))
                    {
                        echo "<a class='btn_cancel_order order-cancel' href='javascript:void(0);' data-order='".$order['order_id']."' data-status='16'>取消订单</a>";
                    }
                    elseif ($order['order_status_id'] == 2 && $order['payment_code'] != 'cod' && $order['payment_code'] != 'free_checkout')
                    {
                        echo "<a class='btn_cancel_order order-refund' href='javascript:void(0);' data-order='".$order['order_id']."'>申请退款</a>";
                    }
                    elseif ($order['order_status_id'] == 3)
                    {
                        echo "<a class='btn_cancel_order' href='javascript:void(0);'>查看物流</a>";
                        echo "<a class='btn_white_order order-cancel' href='javascript:void(0);' data-order='".$order['order_id']."' data-status='5'>确认收货</a>";
                    }
                    elseif ($order['order_status_id'] == 5)
                    {
                        echo "<a class='btn_cancel_order' href='javascript:void(0);'>申请退款</a>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <?php
                $i++;
            }
        }
        else
        {
        ?>
            <div class="no-notice">
                <img src="<?php echo Yii::$app->request->baseUrl;?>/images/no-pngone.png">
                <div class="no-notice-text">您还没有相关订单</div>
            </div>
        <?php
        }
        ?>
        <br><br><br><br><br>
    </div>

<script type="text/javascript">
    $('.order-cancel').on('click',function(){
        var order_id = $(this).attr('data-order');
        var status_id = $(this).attr('data-status');
        var self = $(this);

        layer.confirm('确定要执行此操作？', {
            btn: ['确定','取消'], //按钮
            title: false
        }, function(){
            if (order_id && status_id)
            {
                $.post('/account/ajax-update-status',{order_id:order_id,status_id:status_id},function(data){
                    if (data.status == 'success')
                    {
                        self.html(data.val);
                        layer.msg('操作成功', {icon: 1});
                    }
                    else
                    {
                        layer.msg('操作失败', {icon: 1});
                    }
                },'json');
            }
        }, function(){
        });

    });

    $('.order-refund').on('click',function(){
        var order_id = $(this).attr('data-order');

        layer.confirm('确定要执行此操作？', {
            btn: ['确定','取消'], //按钮
            title: false
        }, function(){
            if (order_id)
            {
                layer.msg('暂时不支持线上退款，请联系客服处理', {icon: 1});
            }
        }, function(){
        });
    });



</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>

