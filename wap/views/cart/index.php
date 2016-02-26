<?php
use app\models\Product;
$this->title = '购物车';
if (!empty($productDatas))
{
    ?>
    <div class="com-content">
        <header>
            <div class="new-header">
                <div class="u-hd-tit"><span>购物车</span></div>
                <div class="u-hd-edit f-right"><a href="javascript:">删除</a></div>
            </div>
        </header>

        <div class="js_lib_content">
            <div class="zhu-cart">
                <form method="" action="">
                    <?php
                    $checkoutProducts = array();

                    foreach ($productDatas as $value)
                    {
                        $checkoutProducts[$value['distribute_id']][$value['agent_id']][] = $value;
                    }

                    $checkoutProducts = array_filter(array_unique($checkoutProducts));

                    //分销
                    foreach ($checkoutProducts as $checkoutProduct)
                    {
                        //代理
                        foreach ($checkoutProduct as $products)
                        {
                    ?>
                            <div class="cart_list">
                                <div class="cart_list_title clearfix">
                                    <div class="cart_orderfeng"><span class=""><input type="hidden"></span></div>
                                    <div class="cart_list_text">达蒙商城</div>
                                </div>
                                <ul>
                                    <?php
                                    $product_total = 0;

                                    foreach ($products as $product)
                                    {
                                    ?>
                                        <li class="clearfix" data-key="<?= $product['key'] ?>" data-total="<?= $product['total'] ?>" data-num="<?= $product['quantity'] ?>">
                                            <div class="cart_orderlist_check"><span class=""><input type="hidden"></span></div>
                                            <div class="cart-img">
                                                <a href="/product?product_id=<?= $product['product_id']; ?>&supplier_id=<?= $product['supplier_id'] ?><?= !empty($product['distribute_id']) ? '&distribute_id='.$product['distribute_id'] : '' ?><?= !empty($product['bidding_id']) ? '&bidding_id='.$product['bidding_id'] : '' ?>">
                                                    <img src="http://iddmall.com/image/<?= $product['image']; ?>">
                                                </a>
                                            </div>
                                            <div class="cart_orderlist_info">
                                                <p class="cart_g_name">
                                                    <a style="color: #939292;" href="/product?product_id=<?= $product['product_id']; ?>&supplier_id=<?= $product['supplier_id'] ?><?= !empty($product['distribute_id']) ? '&distribute_id='.$product['distribute_id'] : '' ?><?= !empty($product['bidding_id']) ? '&bidding_id='.$product['bidding_id'] : '' ?>">
                                                    <?= $product['name'] ?>
                                                    </a>
                                                </p>
                                                <div class="cart_nops"><?= Product::getProductCategory($product['product_id']) ? '注:10.5g请拍1050件' : '' ?></div>
                                                <div class="cart-order-bottom clearfix">
                                                    <div class="cart_g_divrice f-left">￥<em><?= $product['price'] ?></em></div>
                                                    <div class="add-minustext f-right">
                                                        <input type="button" class="minus"  value="-" >
                                                        <input type="text" class="result" value="<?= $product['quantity'] ?>" >
                                                        <input type="button" class="add" value="+" >
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <footer id="fo1">
        <div class="ft-lt">
            <div class="cart_orderlist_all f-left"><span class="cart-input"><input type="hidden"></span><span>全选</span></div>
            <p class="f-right">合计:<span class="total" id="total">0</span></p>
        </div>
        <div class="ft-rt go-checkout">
            <a href="javascript:void(0);">去结算(<span class="total-number">0</span>)</a>
        </div>
    </footer>
    <footer id="fo2">
        <div class="ft-lt">
            <div class="cart_orderlist_all f-left"><span class="cart-input"><input type="hidden"></span><span>全选</span></div>
        </div>
        <div class="ft-rt go-del">
            <a href="javascript:void(0);">删除</a>
        </div>
    </footer>
    <?php
    echo $this->render('@app/views/layouts/_cart_footer');
    ?>
    <script type="text/javascript">
        $(function(){

            function updatecart(key,num)
            {
                $.post('/cart/update-cart',{key:key, num:num},function(data){

                });
            }

            $('input[class*=result]').change(function()
            {
                if ($(this).val() < 1)
                {
                    $(this).val(1);
                }

                var num = $(this).val();

                var key = $(this).parent().parent().parent().parent().attr('data-key');

                updatecart(key,num);

                setTotal();
            });

            $(".add").click(function()
            {
                var t = $(this).parent().find('input[class*=result]');

                t.val(parseInt(t.val())+1);

                var num = $(this).parent().find('input[class*=result]').val();

                var key = $(this).parent().parent().parent().parent().attr('data-key');

                updatecart(key,num);

                setTotal();
            })

            $(".minus").click(function()
            {
                var t = $(this).parent().find('input[class*=result]');

                t.val(parseInt(t.val())-1);

                if(parseInt(t.val()) < 1)
                {
                    t.val(1);
                }

                var num = $(this).parent().find('input[class*=result]').val();

                var key = $(this).parent().parent().parent().parent().attr('data-key');

                updatecart(key,num);

                setTotal();
            })

            function setTotal()
            {
                var s = 0;

                var v = 0;

                var status = 1;

                var num = 0;

                $(".cart_orderlist_check .checked").each(function(){

                    v += parseInt($(this).parent().parent().find('input[class*=result]').val());

                    s += parseInt($(this).parent().parent().find('input[class*=result]').val())*parseFloat($(this).parent().parent().find('em').text());

                });

                $('.zhu-cart ul li').each(function()
                {
                    if ($(this).find('.cart_orderlist_check span').hasClass('checked'))
                    {
                        num += 1;
                    }
                    else
                    {
                        status = 0;
                    }
                });

                if (status == 0)
                {
                    $('#fo1 .cart_orderlist_all span').removeClass('checked');
                    $('#fo2 .cart_orderlist_all span').removeClass('checked');
                }
                else
                {
                    $('#fo1 .cart_orderlist_all span').addClass('checked');
                    $('#fo2 .cart_orderlist_all span').addClass('checked');
                }

                if (num > 0)
                {
                    if (!$("#fo1 .ft-rt").hasClass('lin'))
                    {
                        $("#fo1 .ft-rt").addClass('lin');
                    }

                    if (!$("#fo2 .ft-rt").hasClass('lin'))
                    {
                        $("#fo2 .ft-rt").addClass('lin');
                    }
                }
                else
                {
                    $(".ft-rt").removeClass('lin');
                }

                $(".total-number").html(v);
                $("#total").html(s.toFixed(2));
            }


            $(".cart_orderlist_all .cart-input").click(function()
            {
                if (!$(this).hasClass("checked"))
                {
                    $(this).addClass("checked");
                    $(".cart_orderlist_check span").addClass("checked");
                    $(".cart_orderfeng span").addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                    $(".cart_orderlist_check span").removeClass("checked");
                    $(".cart_orderfeng span").removeClass("checked");
                }

                setTotal();
            });

            $(".cart_orderfeng span").click(function()
            {
                if (!$(this).hasClass("checked"))
                {
                    $(this).addClass("checked");
                    $(this).parent().parent().siblings().find('span').addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                    $(this).parent().parent().siblings().find('span').removeClass("checked");
                }
                setTotal();
            });


            $(".cart_orderlist_check span").click(function()
            {
                var status = 1;

                if (!$(this).hasClass("checked"))
                {
                    $(this).siblings().removeClass("checked");
                    $(this).addClass("checked");
                }
                else
                {
                    $(this).removeClass("checked");
                }

                $(this).parent().parent().parent().parent().find('li').each(function()
                {
                    if (!$(this).find('.cart_orderlist_check span').hasClass('checked'))
                    {
                        status = 0;
                    }
                });

                if (status == 0)
                {
                    $(this).parent().parent().parent().parent().find('.cart_orderfeng span').removeClass('checked');
                }
                else
                {
                    $(this).parent().parent().parent().parent().find('.cart_orderfeng span').addClass('checked');
                }

                setTotal();
            });


            $(".u-hd-edit").click(function() {
                $("#fo1").toggle();
                $("#fo2").toggle();
                setTotal();
            });
        })

        //全选与单选
        $(function(){
            $('.go-checkout').on('click',function(){
                var keys = '';
                $('.cart_list ul li').each(function(){
                    if ($(this).find('.cart_orderlist_check span').hasClass('checked'))
                    {
                        keys += $(this).attr('data-key') + '@';
                    }
                });
                $.post('/cart/set-key',{key:keys},function(data){
                    if (data == 'success')
                    {
                        location.href = '/cart/check-out';
                    }
                });
            });

            $('.go-del').on('click',function(){
                var keys = '';
                $('.cart_list ul li').each(function(){
                    if ($(this).find('.cart_orderlist_check span').hasClass('checked'))
                    {
                        keys += $(this).attr('data-key') + ',';
                    }
                });
                $.post('/cart/del-batch-cart',{cart:keys},function(data){
                    if (data.status == 'success')
                    {
                        history.go(0);
                    }
                    else
                    {
                        layer.msg('删除失败！');
                    }
                },'json');
            });
        })
    </script>
<?php
}
else
{
    ?>
    <div class="com-content">
        <header>
            <div class="new-header">
                <div class="u-hd-left f-left">
                    <a class="J_backToPrev" href="javascript:history.go(-1);"><span class="u-icon i-hd-back"></span></a>
                </div>
                <div class="u-hd-tit"><span>提示</span></div>
                <div class="top-info">
                    <img src="<?php echo Yii::$app->request->baseUrl;?>/images/h-member-cart.png">
                    <span class="text">更多</span>
                    <span class="t-number"></span>
                </div>
                <div class="nav_erjinv" style="display:none;">
                    <div class="arrow-up"></div>
                    <ul>
                        <li>
                            <!--<a href="http://wx99610dc3355e3524.m.weimob.com/Weisite/Home?pid=55681479&bid=1002181&wechatid=fromUsername">-->
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=3096669723&site=qq&menu=yes">
                                <span class="icon-customer"></span>
                                <span class="text">客服</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="icon-message"></span>
                                <span class="text">消息:<em>(0)</em></span>
                            </a>
                        </li>
                        <li>
                            <a href="http://wap.iddmall.com">
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
        </script>
        <div class="no-notice">
            <img src="<?php echo Yii::$app->request->baseUrl;?>/images/no-pngtwo.png">
            <div class="no-notice-text">您还没有加入购物车</div>
        </div>
        <?php
        echo $this->render('@app/views/layouts/_account_footer');
        ?>
    </div>

<?php
}
?>