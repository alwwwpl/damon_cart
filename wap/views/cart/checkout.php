<?php
$this->title = '订单确认';
if (!empty($checkOutDatas))
{
    echo $this->render('@app/views/layouts/_account_header');
    Yii::$app->session->open();
?>

    <div class="js_lib_content">
        <div class="shipper-info">
            <div class="shipper-list">
                <?php
                if (!empty($addressData))
                {
                    $_SESSION['address_id'] = Yii::$app->user->identity->address_id;

                    foreach ($addressData as $address)
                    {
                        if ($address['address_id'] == Yii::$app->user->identity->address_id)
                        {
                ?>
                        <a href="javascript:">
                            <p class="shipper-name">
                                <span><img src="<?php echo Yii::$app->request->baseUrl;?>/images/shipperpng.png"></span>
                                <span class="s-name">收货人: <?= $address['lastname']?></span>
                            </p>
                            <p class="shipper-name clearfix">
                                <span><img src="<?php echo Yii::$app->request->baseUrl;?>/images/saddresspng.png"></span>
                                <span class="s-adr">收货地址: <?= $address['province'].' '.$address['city'].' '.$address['address_1'].' '.$address['phone']?></span>
                                <i class="down-ico"></i>
                            </p>
                        </a>
                <?php
                        }
                    }
                }
                else
                {
                ?>

                <?php
                }
                ?>
            </div>
            <div class="shipper-down">
                <?php
                if (!empty($addressData))
                {
                    foreach ($addressData as $address)
                    {
                        if (empty(Yii::$app->user->identity->address_id))
                        {
                            $_SESSION['address_id'] = $address['address_id'];
                        }
                ?>
                        <a href="javascript:" data-address="<?= $address['address_id'] ?>">
                            <p class="shipper-name"><span><img src="<?php echo Yii::$app->request->baseUrl;?>/images/shipperpng.png"></span>
                                <span class="s-name">收货人: <?= $address['lastname']?></span>
                            </p>
                            <p class="shipper-name clearfix">
                                <?php
                                if ($address['address_id'] == Yii::$app->user->identity->address_id)
                                {
                                    echo '<span>';
                                    echo '<img src="'.Yii::$app->request->baseUrl.'/images/saddresspng.png">';
                                    echo '</span>';
                                }
                                else
                                {
                                    echo '<span class="saddressimg"></span>';
                                }
                                ?>
                                <span class="s-adr">收货地址: <?= $address['province'].' '.$address['city'].' '.$address['address_1'].' '.$address['phone']?></span>
                                <i class="down-ico"></i>
                            </p>
                        </a>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="order-con">
            <ul class="order-list">
                <?php
                if (!empty($checkOutDatas))
                {

                    $_SESSION['cart-shipping'] = '';

                    $_SESSION['cart-payment'] = '';

                    $_SESSION['cart-checkout'] = '';

                    $productDatas = array();

                    $total = 0;

                    //分销
                    foreach ($checkOutDatas as $key => $productData)
                    {
                        //代理
                        foreach ($productData as $k => $products)
                        {
                            $product_total = 0;

                            $product_num = 0;
                ?>
                            <li style="padding-top:20px;">
                                <div class="order-box clearfix">
                                    <div style="width: 100%; height: 90px; background: #FFF; font-size: 30px; line-height: 90px; border-bottom: 1px solid #ccc;">达蒙商城</div>
                <?php
                            foreach ($products as $product)
                            {
                                $_SESSION['cart-checkout'][$key][$k][] = $product;
                ?>
                                    <ul class="book-list clearfix">
                                        <a href="/product?product_id=<?= $product['product_id']; ?>&supplier_id=<?= $product['supplier_id'] ?><?= !empty($product['distribute_id']) ? '&distribute_id='.$product['distribute_id'] : '' ?><?= !empty($product['bidding_id']) ? '&bidding_id='.$product['bidding_id'] : '' ?>">
                                            <div class="order-msg">
                                                <img class="img_ware" src="http://iddmall.com/image/<?= $product['image']; ?>">
                                            </div>
                                            <div class="order-text f-left">
                                                <?= $product['name'] ?>
                                            </div>
                                            <span class="order-price f-right">
                                                <p class="price">￥<?= $product['price'] ?></p>
                                                <p class="order-data">* <?= $product['quantity'] ?></p>
                                            </span>
                                        </a>
                                    </ul>
                <?php
                                    $total += $product['total'];

                                    $product_num += $product['quantity'];

                                    $product_total += $product['total'];

                                    $_SESSION['cart-checkout']['total'] = $total;
                            }
                ?>
                                    <div class="order-width" style="margin-top: 0px;">
                                        <div class="plist liu-text">买家留言:<input type="text" name="liu-text" placeholder="选填，您和卖家达成一致的要求"></div>
                                        <div class="plist">
                                            <div class="ls-link">
                                                <a href="javascript:void(0);">配送方式:
                                                    <span>
                                                        <?php
                                                        foreach ($shippingDatas as $shipping)
                                                        {
                                                            $_SESSION['cart-shipping'][$key.'_'.$k] = $shipping['code'].'_'.$shipping['cost'];

                                                            echo '<em class="sel-text">'.$shipping["title"].'-'.$shipping["cost"].'元</em>';

                                                            break;
                                                        }
                                                        ?>
                                                        <i class="down-ico"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="distribution">
                                                <?php
                                                foreach ($shippingDatas as $shipping)
                                                {
                                                    echo '<a href="javascript:void(0);" data-keys="'.$key."_".$k.'" data-cost="'.$shipping["cost"].'" data-code="'.$shipping["code"].'">'.$shipping["title"].'-'.$shipping["cost"].'元</a>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="plist">
                                            <div class="ls-link"><a href="javascript:void(0);">可用优惠券:<span><em class="sel-text">无</em><i class="down-ico"></i></span></a></div>
<!--                                            <div class="distribution">-->
<!--                                                <a href="javascript:void(0);">10元</a>-->
<!--                                                <a href="javascript:void(0);">20元</a>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="pay-total"><span>共<?= $product_num ?>件商品</span><span class="right">小计:<i>￥<?= $product_total ?></i></span></div>
                                </div>
                            </li>
                <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <div class="order-width">
<!--            <p><a href="">运费险:<span style="color: #f15353;">0元(已购买)</span></a></p>-->
            <div class="plist">
                <div class="ls-link">
                    <a href="javascript:">支付方式:
                        <span>
                            <?php
                            foreach ($paymentDatas as $payment)
                            {
                                $_SESSION['cart-payment'] = $payment['code'].'_'.$payment["title"];

                                echo '<em class="sel-text">'.$payment["title"].'</em>';

                                break;
                            }
                            ?>
                            <i class="down-ico"></i>
                        </span>
                    </a>
                </div>
                <div class="distribution">
                    <?php
                    foreach ($paymentDatas as $payment)
                    {
                        echo '<a href="javascript:" data-payment="'.$payment['code'].'_'.$payment["title"].'">'.$payment["title"].'</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        $_SESSION['total'] = $total;

        if (is_array($_SESSION['cart-shipping']))
        {
            foreach ($_SESSION['cart-shipping'] as $v)
            {
                $_SESSION['total'] += explode('_', $v)[1];
            }
        }
        ?>
        <div class="order-submit clearfix" style="margin-top: 0px;">
            <div class="submit-total f-left">合计:<span>￥<label id="session_total"><?= round($_SESSION['total'],2) ?></label></span></div>
            <div class="pay-button" id="order-submit"><a href="javascript:void(0);">确认</a></div>
        </div>
    </div>
    <br><br><br><br><br>
    <?php
    echo $this->render('@app/views/layouts/_account_footer');
    ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".ls-link a").each(function(){
            $(this).bind('click',function(){
                $(this).parent().next().toggle();
                $(this).find('i').toggleClass('up');
            })
        });

        $(".distribution a").each(function(){
            $(this).bind('click',function(){
                var code = $(this).attr('data-code');
                var cost = $(this).attr('data-cost');
                var keys = $(this).attr('data-keys');

                var payment = $(this).attr('data-payment');

                if (payment)
                {
                    $.post('/cart/ajax-session',{key:'cart-payment',val:payment},function(data)
                    {
                    });
                }
                else if(keys)
                {
                    $.post('/cart/ajax-session',{key:'cart-shipping',keys:keys,val:code+'_'+cost},function(data)
                    {
                        $('#session_total').html(data);
                    });
                }

                var txt = $(this).text();
                $(this).parent().siblings(".ls-link").find('.sel-text').text(txt);
                $(this).parent().hide();
                $(this).find('i').removeClass('up');
            })
        });

        $('#order-submit').on('click',function(){
            var address = '<?= $_SESSION['address_id'] ?>';
            if (address)
            {
                $.post('/cart/ajax-confirm',{type:'post'},function(data){
                    if (data.status == 'error')
                    {
                        layer.msg('下单失败!');
                        return false;
                    }
                    else if (data.status == 'success')
                    {
                        location.href = data.url;
                    }
                },'json');
            }
            else
            {
                layer.msg('请先填写收货地址!');
                location.href = 'http://wap.iddmall.com/account/address';
            }

        });

        $(".shipper-list").click(function() {
            $(".shipper-down").toggle();
            $(this).find('i').toggleClass('up');
        });

        $(".shipper-down a").each(function(){
            $(this).bind('click',function(){
                var address_id = $(this).attr('data-address');
                $.post('/cart/ajax-session',{key:'address_id',val:address_id},function(data)
                {});
                $(this).parent().siblings().empty().append($(this).clone());
                $(this).parent().hide();
                $(this).find('i').toggleClass('up');
            })
        });

    });
</script>
<?php
}
else
{
?>
<script type="text/javascript">
    location.href = "http://wap.iddmall.com/cart/index";
</script>
<?php
}
?>