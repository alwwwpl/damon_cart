<?php
$this->title = '订单确认';
echo $this->render('@app/views/layouts/_account_header');
    Yii::$app->session->open();
    ?>
    <div class="js_lib_content">
    <div class="order-con">
        <ul class="order-list">
            <li style="padding-top:20px;">
                <div class="order-box clearfix">
                    <div style="width: 100%; height: 90px; background: #FFF; font-size: 30px; line-height: 90px; border-bottom: 1px solid #ccc;">订单ID：<?= $_GET['order_id'] ?></div>
                    <?php
                    $product_num = 0;

                    foreach ($orderProductData as $product)
                    {
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
                        $product_num += $product['quantity'];
                    }
                    ?>
                    <div class="pay-total"><span>共<?= $product_num ?>件商品</span></div>
                </div>
            </li>
        </ul>
    </div>
    <div class="order-width">
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
    <div class="order-submit clearfix" style="margin-top: 0px;">
        <div class="submit-total f-left">合计:<span>￥<label id="session_total"><?= round($_SESSION['total']/100,2) ?></label></span></div>
        <div class="pay-button" id="order-submit"><a href="javascript:void(0);">确认</a></div>
    </div>

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

                    var payment = $(this).attr('data-payment');

                    if (payment)
                    {
                        $.post('/cart/ajax-session',{key:'cart-payment',val:payment},function(data)
                        {
                        });
                    }

                    var txt = $(this).text();
                    $(this).parent().siblings(".ls-link").find('.sel-text').text(txt);
                    $(this).parent().hide();
                    $(this).find('i').removeClass('up');
                })
            });

            $('#order-submit').on('click',function(){
                $.post('/account/ajax-confirm',{type:'post'},function(data){
                    if (data.status == 'error')
                    {
                        layer.msg('支付失败!');
                        return false;
                    }
                    else if (data.status == 'success')
                    {
                        location.href = data.url;
                    }
                },'json');
            });


        });
    </script>
        <?php
        echo $this->render('@app/views/layouts/_account_footer');
        ?>
