<?php
$controller = Yii::$app->controller->id;
?>
<div class="footer_bar openwebview" style="display: block;">
    <ul class="warp clearfix">
        <li class="<?= $controller == 'index' ? 'on' : '' ?>">
            <a class="new_home" href="/index">
                <i class="new_icon"></i>
                <span>至宝母婴</span>
            </a>
        </li>
        <li class="<?= $controller == 'category' || $controller == 'product' ? 'on' : '' ?>">
            <a class="new_ca" href="/category">
                <i class="new_icon"></i>
                <span>分类</span>
            </a>
        </li>
        <li class="<?= $controller == 'special' ? 'on' : '' ?>" >
            <a class="new_pai" href="#">
                <i class="new_icon"></i>
                <span>定制</span>
            </a>
        </li>
        <li class="<?= $controller == 'cart' ? 'on' : '' ?>">
            <a class="new_car_center" href="/cart">
                <i class="new_icon"></i>
                <span>购物车</span>
            </a>
        </li>
        <li class="<?= $controller == 'account' ? 'on' : '' ?>">
            <a class="to_personalcenter personalcenternum" href="/account">
                <i class="new_icon"><strong style="display: none;"></strong></i>
                <span>我的</span>
            </a>
        </li>
    </ul>
</div>
</div>
</div>