<?php
use app\models\Product;
$this->title = '商品列表';
echo $this->render('@app/views/layouts/_header');
?>
<div class="ca-main-two clearfix">
    <div class="ca-details openwebview clearfix">
        <div class="page-change">
            <ul class="dm-search-tab">
                <li>
                    <a href="./search?sort=<?= isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'asc' : 'desc' ?>" class="<?= isset($_GET['order']) && !empty($_GET['order']) ? '' : 'dm-arrow-down' ?> <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' && !isset($_GET['order']) ? 'checked' : '' ?>">
                        综合
                    </a>
                </li>
                <li>
                    <a href="./search?order=sale&sort=<?= isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'asc' : 'desc' ?>" class="<?= isset($_GET['order']) && $_GET['order'] == 'sale'  ? 'dm-arrow-down' : '' ?> <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' && isset($_GET['order']) && $_GET['order'] == 'sale'  ? 'checked' : '' ?>">
                        销量
                    </a>
                </li>
                <li>
                    <a href="./search?order=price&sort=<?= isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'asc' : 'desc' ?>" class="<?= isset($_GET['order']) && $_GET['order'] == 'price' ? 'dm-arrow-down' : '' ?> <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' && isset($_GET['order']) && $_GET['order'] == 'price'  ? 'checked' : '' ?>">
                        价格
                    </a>
                </li>
            </ul>
        </div>
        <div class="pxui-content clearfix">
            <div>
                <?php
                if (!empty($productsData))
                {
                    foreach ($productsData as $products)
                    {
                        ?>
                        <a href="/product?product_id=<?= $products['product_id'] ?>&supplier_id=<?= $products['supplier_id'] ?><?= !empty($products['distribute_id']) ? '&distribute_id='.$products['distribute_id'] : '' ?><?= !empty($products['bidding_id']) ? '&bidding_id='.$products['bidding_id'] : '' ?>">
                            <div class="img160" style="background-image: none;"><img src="http://iddmall.com/image/<?= $products['image']; ?>"></div>
                            <span class="name"><?= $products['name'] ?></span>
                            <span class="price">￥<?= Product::getProductCategory($products['product_id']) ? round($products['price'],2)*100 .'/g' : round($products['price'],2)?></span>
                        </a>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->render('@app/views/layouts/_footer');
?>
