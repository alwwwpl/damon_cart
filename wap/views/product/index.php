<?php
use app\models\Product;
use app\models\Collection;
$this->title = '商品详细';
echo $this->render('@app/views/layouts/_header');
?>
    <div class="js_lib_content">
        <div class="proudct-view openwebview clearfix">
            <div class="pxui-content clearfix">
                <a href="javascript:void(0);" style="width: 100%">
                    <div class="img160">
                        <img src="http://iddmall.com/image/<?= $productData['image']; ?>">
                    </div>
                    <span class="name"><?= $productData['name'] ?></span>
                    <?= $productData['weight_range'] ? '<span class="weight-range" style="font-size: 22px; color: #CCC;">克重：'.$productData['weight_range'].'</span>' : '' ?>
                    <span class="price">￥<?= round($productData['price'],2)?><?= Product::getProductCategory($productData['product_id']) ? '/0.01g' : ''?></span>
                    <?= Product::getProductCategory($productData['product_id']) ? '<span class="price-tips" style="font-size: 18px; color: #CCC;">注:如10.5g请拍1050件</span>' : '' ?>
                </a>
                <div class="z-fav-c">
                    <?php
                    if (isset(Yii::$app->user->identity->customer_id))
                    {
                        $clooection = Collection::getCollection(Yii::$app->user->identity->customer_id, $productData['product_id'], $productData['supplier_id'], $productData['distribute_id'], $productData['distribute_id']);

                        echo '<a href="javascript:void(0);" id="collection">';
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
                    <a href="javascript:void(0);" id="addcart"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/c-cartpng.png"></a>
                </div>
            </div>
        </div>
        <div class="cart-btns-box">
            <a id="directorder" class="btn-buy">立即购买</a>
        </div>
        <div class="product_des">
            <div class="procuct_title">图文详情</div>
            <?= html_entity_decode(stripslashes($productData['description'])) ?>
        </div>
    </div>

    <script type="text/javascript">
        $('.collection').on('click',function(){
            var product_id = '<?= $_GET['product_id'] ?>';
            var supplier_id = '<?= isset($_GET['supplier_id']) ? $_GET['supplier_id'] : 0 ?>';
            var distribute_id = '<?= isset($_GET['distribute_id']) ? $_GET['distribute_id'] : 0 ?>';
            var bidding_id = '<?= isset($_GET['bidding_id']) ? $_GET['bidding_id'] : 0 ?>';

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

        $('#addcart').on('click',function(){
            var product_id = '<?= $_GET['product_id'] ?>';
            var supplier_id = '<?= isset($_GET['supplier_id']) ? $_GET['supplier_id'] : 0 ?>';
            var distribute_id = '<?= isset($_GET['distribute_id']) ? $_GET['distribute_id'] : 0 ?>';
            var bidding_id = '<?= isset($_GET['bidding_id']) ? $_GET['bidding_id'] : 0 ?>';

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

        $('#directorder').on('click',function(){
            var product_id = '<?= $_GET['product_id'] ?>';
            var supplier_id = '<?= isset($_GET['supplier_id']) ? $_GET['supplier_id'] : 0 ?>';
            var distribute_id = '<?= isset($_GET['distribute_id']) ? $_GET['distribute_id'] : 0 ?>';
            var bidding_id = '<?= isset($_GET['bidding_id']) ? $_GET['bidding_id'] : 0 ?>';

            $.post('./cart/add-cart',{product_id:product_id,supplier_id:supplier_id,distribute_id:distribute_id,bidding_id:bidding_id,qty:1,recurring_id:0},function(data){
                if (data.status == 'success')
                {
                    location.href = './cart/index';
                }
                else
                {
                    layer.msg('购买失败！');
                }
            },'json');
        });
    </script>
<?php
echo $this->render('@app/views/layouts/_footer');
?>