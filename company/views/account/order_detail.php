<?php
$this->title = '订单详情';
echo $this->render('@app/views/layouts/_account_header');
?>

    <div class="js_lib_content">
        <div class="order-xiq">
            <div class="z-order-number">订单号：<?= $_GET['order_id'] ?></div>
            <?php
            if ($orderData->order_status_id == 3 || $orderData->order_status_id == 5)
            {
            ?>
            <div class="logistics">
                <div class="logistics-title">物流信息</div>
                <div class="logistics-content">
                    <a href="">
                        <div class="f-left">
                            <p><span>物流公司: </span><?= explode('|',$orderData->express)[0]?></p>
                            <p><span>运单编号: </span><?= explode('|',$orderData->express)[1]?></p>
                        </div>
                        <div class="f-right">
                            <span><i class="r-ico"></i></span>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="selected_addr clearfix">
                <div class="addr_title">收货地址</div>
                <a href="">
                    <div class="addr_box">
                        <p class="na-tel"><span class="addr_name"><?= $orderData->shipping_lastname ?></span><span class="addr_tel"><?= $orderData->telephone ?></span></p>
                        <p class="addr_text"><?= $orderData->shipping_zone ?> <?= $orderData->shipping_city ?> <?= $orderData->shipping_address_1 ?></p>
                    </div>
                </a>
            </div>
            <div class="userdiv clearfix">
                <div class="orderlisttit">
                    <p class="f-left order-number">订单号：<?= $_GET['order_id']?></p>
                </div>
                <?php
                if (!empty($orderProducts))
                {
                    foreach ($orderProducts as $orderProduct)
                    {
                ?>
                        <div class="orderlistdiv clearfix">
                            <a href="/product?product_id=<?= $orderProduct['product_id']; ?>&supplier_id=<?= $orderProduct['supplier_id'] ?><?= !empty($orderProduct['distribute_id']) ? '&distribute_id='.$orderProduct['distribute_id'] : '' ?><?= !empty($orderProduct['bidding_id']) ? '&bidding_id='.$orderProduct['bidding_id'] : '' ?>">
                                <img src="http://iddmall.com/image/<?= $orderProduct['image']; ?>">
                                <div class="cart_orderlist_text">
                                    <p class="cart_g_name"><?= $orderProduct['model']; ?></p>
                                    <p class="cart_g_price">单价  ￥<?= $orderProduct['price']; ?></p>
                                    <p class="cart_g_number">购买数量  <?= $orderProduct['quantity']; ?></p>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="o-time">下单时间：<?= $orderData->date_added ?></div>
            </div>
            <div class="yun_content">
                <?php
                foreach($orderTotals as $orderTotal)
                {
                    switch($orderTotal['code'])
                    {
                        case 'shipping':
                            echo '<div class="freight">运费<span>￥'.round($orderTotal['value'],2).'</span></div>';
                            break;
                        case 'credit':
                            echo '<div class="freight">余额抵扣<span>￥'.round($orderTotal['value'],2).'</span></div>';
                            break;
                        case 'coupons':
                            echo '<div class="freight">优惠券<span>￥'.round($orderTotal['value'],2).'</span></div>';
                            break;
                    }
                }
                ?>
<!--                <div class="freight">运费<span>￥10.00</span></div>-->
<!--                <div class="coupons">优惠券<span>-￥20.00</span></div>-->
            </div>

            <div class="orderlistbot">
                <div class="f-left">合计:<span class="big-toal">￥<?= $orderData->total ?></div>
                <?php
                if ((int)$orderData->order_status_id == 3)
                {
                ?>
                    <div class="f-right">
                        <a class="btn_white_order order-cancel" data-order="<?= $_GET['order_id']?>" data-status="5" href="javascript:void(0);">确认收货</a>
                    </div>
                <?php
                }
                elseif ((int)$orderData->order_status_id == 1 && $orderData['payment_code'] != 'cod' && $orderData['payment_code'] != 'free_checkout')
                {
                ?>
                    <div class="f-right">
                        <a class="btn_cancel_order order-cancel" href="javascript:void(0);" data-order="<?= $_GET['order_id']?>" data-status="16">取消订单</a>
                        <a class="btn_white_order"  href="/account/payment?order_id=<?= $_GET['order_id'] ?>">立即支付</a>
                    </div>
                <?php
                }
                else
                {
                ?>
                    <div class="f-right">
                        <a class="btn_white_order" href="javascript:void(0);">等待发货</a>
                        <a class="btn_cancel_order order-refund" href="javascript:void(0);"  data-order="<?= $_GET['order_id']?>">申请退款</a>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
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