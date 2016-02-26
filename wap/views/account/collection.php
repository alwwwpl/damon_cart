<?php
$this->title = '收藏';
if (!empty($collectionData))
{
?>
<div class="s-com-content">
    <div class="js_lib_content">
        <form method="" action="">
            <div class="cart_list">
                <ul>

                    <?php
                        foreach ($collectionData as $value)
                        {
                    ?>
                            <li class="clearfix" data-key="<?= $value['collection_id'] ?>" id="collection-<?= $value['collection_id'] ?>">
                                <div class="cart-img"><img src="http://iddmall.com/image/<?= $value['product']['image']; ?>"></div>
                                <div class="cart_orderlist_info">
                                    <p class="cart_g_name"><?= $value['product']['name'] ?></p>
                                    <p class="cart_g_price">￥<?= round($value['product']['price'],2) ?>  <span style="float: right"><?= date('Y-m-d',strtotime($value['create_time'])) ?></span></p>
                                </div>
                                <div class="cart_orderlist_check"><span><input type="hidden"></span></div>
                            </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </form>
    </div>
    <footer style="z-index: 999;">
        <div class="ft-lt">
            <div class="cart_orderlist_all f-left"><span class="cart-input"><input type="hidden"></span><span>全选</span></div>
            <p class="f-right">合计:<span class="total" id="total">0</span></p>
        </div>
        <div class="ft-rt">
            <a href="javascript:void(0);" id="batch-del">去删除</a>
        </div>
    </footer>
</div>

<script>
    //全选与单选
    $(function(){

        $(".cart_orderlist_all .cart-input").click(function()
        {
            if (!$(this).hasClass("checked"))
            {
                $(this).addClass("checked");
                $(".cart_orderlist_check span").addClass("checked");
            }
            else
            {
                $(this).removeClass("checked");
                $(".cart_orderlist_check span").removeClass("checked");
            }

            setTotal();
        });

        $(".cart_orderlist_check span").click(function()
        {
            if (!$(this).hasClass("checked"))
            {
                $(this).siblings().removeClass("checked");
                $(this).addClass("checked");
            }
            else
            {
                $(this).removeClass("checked");
            }

            setTotal();
        });



        function setTotal()
        {
            var status = 1;

            var num = 0;

            $('.cart_list ul li').each(function()
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
                $('.cart_orderlist_all .cart-input').removeClass('checked');
            }
            else
            {
                $('.cart_orderlist_all .cart-input').addClass('checked');
            }

            if (num > 0)
            {
                if (!$(".ft-rt").hasClass('lin'))
                {
                    $(".ft-rt").addClass('lin');
                }
            }
            else
            {
                $(".ft-rt").removeClass('lin');
            }

            $("#total").html(num);
        }

        $('#batch-del').on('click',function(){
            var key = '';
            $('.cart_list ul li').each(function()
            {
                if ($(this).find('.cart_orderlist_check span').hasClass('checked'))
                {
                   key += $(this).attr('data-key') + ',';
                }
            });

            if (key)
            {
                $.post('/command/del-batch-collection',{collection:key},function(data){
                    if (data.status == 'success')
                    {
                        var keys = data.keys;
                        var arr = keys.split(',');
                        for(var i in arr)
                        {
                            $('#collection-'+arr[i]).remove();
                        }

                        layer.msg('删除成功！');
                    }
                    else
                    {
                        layer.msg('删除失败！');
                    }
                },'json');
            }
        });
    })
</script>
<?php
}
else
{
?>
    <div class="com-content">
        <?php
        echo $this->render('@app/views/layouts/_message_header');
        ?>
        <div class="no-notice">
            <img src="<?php echo Yii::$app->request->baseUrl;?>/images/no-pngthree.png">
            <div class="no-notice-text">您还没有收藏</div>
        </div>
        <?php
        echo $this->render('@app/views/layouts/_cart_footer');
        ?>
    </div>
<?php
}
?>