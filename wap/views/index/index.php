<?php
use app\models\Product;
use app\models\Collection;

    $this->title = '达蒙商城';
    echo $this->render('@app/views/layouts/_header');
?>

        <!----------广告轮播---------->
        <div id="focus" class="focus">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    <li><a href="#"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-bg1.jpg"/></a></li>
                    <li><a href="#"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-bg2.jpg"/></a></li>
                    <li><a href="#"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-bg3.jpg"/></a></li>
                    <li><a href="#"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-bg4.jpg"/></a></li>
                    <li><a href="#"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-bg5.jpg"/></a></li>
                </ul>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl;?>/js/lunbo.js"></script>
        <script type="text/javascript">
            Xsanduo({
                slideCell:"#focus",
                titCell:".hd ul",
                mainCell:".bd ul",
                effect:"left",
                autoPlay:true,
                autoPage:true,
                interTime:6000
            });
        </script>
        <!-------达蒙公告---------->
        <div class="dm-gao"><em><img src="<?php echo Yii::$app->request->baseUrl;?>/images/gonggao-ico.png"/>
            </em>
            <div id="callboard">
                <ul>
                    <li>
                        <span>商品精确到0.01克</span>
                    </li>
                    <li>
                        <span>实物存在约1克误差</span>
                    </li>
                    <li>
                        <span>联系QQ客服调差价</span>
                    </li>
                    <li>
                        <span>客服时间 周一至周五 朝九晚五</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="dm-gaoimg">
            <img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-gg.jpg"/>
            <div class="gold-edit">￥262.00</div>
        </div>
        <!--公告板滚动-->
        <script type="text/javascript">
            (function (win){
                var callboarTimer;0
                var callboard = $('#callboard');
                var callboardUl = callboard.find('ul');
                var callboardLi = callboard.find('li');
                var liLen = callboard.find('li').length;
                var initHeight = callboardLi.first().outerHeight(true);
                win.autoAnimation = function (){
                    if (liLen <= 1) return;
                    var self = arguments.callee;
                    var callboardLiFirst = callboard.find('li').first();
                    callboardLiFirst.animate({
                        marginTop:-initHeight
                    }, 500, function (){
                        clearTimeout(callboarTimer);
                        callboardLiFirst.appendTo(callboardUl).css({marginTop:0});
                        callboarTimer = setTimeout(self,2000);
                    });
                }
                callboard.mouseenter(
                    function (){
                        clearTimeout(callboarTimer);
                    }).mouseleave(function (){
                        callboarTimer = setTimeout(win.autoAnimation,2000);
                    });
            }(window));
            setTimeout(window.autoAnimation,2000);
        </script>
        <!-------推荐产品---------->
    <div class="recommend openwebview clearfix">
        <h3>每周精选<a href="/product/search?search=%E9%BB%84%E9%87%91">更多</a></h3>
        <div class="pxui-content clearfix">
            <div>
                <?php
                foreach ($orderProductData as $orderProduct)
                {
                    ?>
                    <a href="./product?product_id=<?= $orderProduct['product_id']; ?>&supplier_id=<?= $orderProduct['supplier_id']; ?><?= !empty($orderProduct['distribute_id']) ? '&distribute_id='.$orderProduct['distribute_id'] : '' ?><?= !empty($orderProduct['bidding_id']) ? '&bidding_id='.$orderProduct['bidding_id'] : '' ?>">
                        <div class="img160" style="background-image: none;"><img src="http://iddmall.com/image/<?= $orderProduct['image']; ?>"></div>
                        <span class="name"><?= $orderProduct['name'];?></span>
                        <span class="price" style="display: none;">￥<?= Product::getProductCategory($orderProduct['product_id']) ? round($orderProduct['price'],2)*100 .'/g' : round($orderProduct['price'],2)?></span>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="center_banner"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner-center.jpg"></div>
    <div class="newproudct openwebview clearfix">
        <h3>新品上架<a href="/product/search?search=%E9%BB%84%E9%87%91">更多</a></h3>
        <div class="pxui-content clearfix">
            <ul>
                <?php
                foreach ($newProductData as $newProduct)
                {
                    ?>
                    <li class="clearfix">
                        <a href="./product?product_id=<?= $newProduct['product_id']; ?>&supplier_id=<?= $newProduct['supplier_id']; ?><?= !empty($newProduct['distribute_id']) ? '&distribute_id='.$newProduct['distribute_id'] : '' ?><?= !empty($newProduct['bidding_id']) ? '&bidding_id='.$newProduct['bidding_id'] : '' ?>">
                            <div class="img160"><img src="http://iddmall.com/image/<?= $newProduct['image']; ?>"></div>
                            <span class="name"><?= $newProduct['name'];?></span>
                            <span class="price" style="display: none;">￥<?= Product::getProductCategory($newProduct['product_id']) ? round($newProduct['price'],2)*100 .'/g' : round($newProduct['price'],2)?></span>
                        </a>
                        <div class="z-fav-c" data-product="<?= $newProduct['product_id']; ?>" data-supplier="<?= $newProduct['supplier_id']; ?>" data-distribute="<?= $newProduct['distribute_id'] ?>" data-bidding="<?= $newProduct['distribute_id'] ?>">
                            <?php
                            if (!empty(Yii::$app->user->identity->customer_id))
                            {
                                $clooection = Collection::getCollection(Yii::$app->user->identity->customer_id, $newProduct['product_id'], $newProduct['supplier_id'], $newProduct['distribute_id'], $newProduct['distribute_id']);

                                echo '<a href="javascript:void(0);" class="collection">';
                                if ($clooection)
                                {
                                    echo '<img src="'.Yii::$app->request->baseUrl.'/images/c-favpng.png">';
                                }
                                else
                                {
                                    echo '<img src="'.Yii::$app->request->baseUrl.'/images/c-favblack.png">';
                                }
                                echo '</a>';
                            }
                            else
                            {
                                echo '<a href="javascript:void(0);" class="collection">';
                                echo '<img src="'.Yii::$app->request->baseUrl.'/images/c-favblack.png">';
                                echo '</a>';
                            }
                            ?>
                            <a href="javascript:void(0);" class="addcart"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/c-cartpng.png"></a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="center_bottom"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/banner_bottom.jpg"></div>
    <div class="pin-recom openwebview clearfix">
        <h3>平台推荐<a href="/product/search?search=%E9%BB%84%E9%87%91">更多</a></h3>
        <div class="pxui-content clearfix">
            <ul>
                <?php
                foreach ($recommendProductData as $recommendProduct)
                {
                    ?>
                    <li class="clearfix">
                        <a href="./product?product_id=<?= $recommendProduct['product_id']; ?>&supplier_id=<?= $recommendProduct['supplier_id']; ?><?= !empty($recommendProduct['distribute_id']) ? '&distribute_id='.$recommendProduct['distribute_id'] : '' ?><?= !empty($recommendProduct['bidding_id']) ? '&bidding_id='.$recommendProduct['bidding_id'] : '' ?>">
                            <div class="img160" style="background-image: none;"><img src="http://iddmall.com/image/<?= $recommendProduct['image']; ?>"></div>
                            <span class="name"><?= $recommendProduct['name'];?></span>
                            <span class="price" style="display: none;">￥<?= Product::getProductCategory($recommendProduct['product_id']) ? round($recommendProduct['price'],2)*100 .'/g' : round($recommendProduct['price'],2)?></span>
                        </a>
                        <div class="z-fav-c" data-product="<?= $recommendProduct['product_id']; ?>" data-supplier="<?= $recommendProduct['supplier_id']; ?>" data-distribute="<?= $recommendProduct['distribute_id'] ?>" data-bidding="<?= $recommendProduct['distribute_id'] ?>">
                            <?php
                            if (!empty(Yii::$app->user->identity->customer_id))
                            {
                                $clooection = Collection::getCollection(Yii::$app->user->identity->customer_id, $recommendProduct['product_id'], $recommendProduct['supplier_id'], $recommendProduct['distribute_id'], $recommendProduct['distribute_id']);

                                echo '<a href="javascript:void(0);" class="collection">';
                                if ($clooection)
                                {
                                    echo '<img src="'.Yii::$app->request->baseUrl.'/images/c-favpng.png">';
                                }
                                else
                                {
                                    echo '<img src="'.Yii::$app->request->baseUrl.'/images/c-favblack.png">';
                                }
                                echo '</a>';
                            }
                            else
                            {
                                echo '<a href="javascript:void(0);" class="collection">';
                                echo '<img src="'.Yii::$app->request->baseUrl.'/images/c-favblack.png">';
                                echo '</a>';
                            }
                            ?>
                            <a href="javascript:void(0);" class="addcart"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/c-cartpng.png"></a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
<script type="text/javascript">
    $('.collection').on('click',function(){
        var product_id = $(this).parent().attr('data-product');
        var supplier_id = $(this).parent().attr('data-supplier');
        var distribute_id = $(this).parent().attr('data-distribute');
        var bidding_id = $(this).parent().attr('data-bidding');

        $.post('./command/add-collection',{product_id:product_id,supplier_id:supplier_id,distribute_id:distribute_id,bidding_id:bidding_id},function(data){
            if (data.status == 'success')
            {
                layer.msg('收藏成功！');
            }
            else if (data.status == 'repeat')
            {
                layer.msg('请勿重复收藏！');
            }
            else if (data.status == 'login')
            {
                layer.msg('请先登录！');
            }
            else
            {
//                alert(data.status);
                layer.msg('收藏失败！');
            }
        },'json');

    });

    $('.addcart').on('click',function(){
        var product_id = $(this).parent().attr('data-product');
        var supplier_id = $(this).parent().attr('data-supplier');
        var distribute_id = $(this).parent().attr('data-distribute');
        var bidding_id = $(this).parent().attr('data-bidding');

        $.post('./cart/add-cart',{product_id:product_id,supplier_id:supplier_id,distribute_id:distribute_id,bidding_id:bidding_id,qty:1,recurring_id:0},function(data){
            if (data.status == 'success')
            {
                layer.msg('添加成功！');
            }
            else
            {
                layer.msg('添加失败！');
            }
        },'json');
    });
</script>
<?php
echo $this->render('@app/views/layouts/_footer');
?>