<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="bt-breadcrumb">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <div class="content_bg">
                <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
                <?php } ?>
                <h2 class="title_border"><?php echo $text_my_account; ?></h2>
                <ul class="list-unstyled myaccount">
                    <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                    <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                    <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                    <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                    <li><a href="index.php?route=account/bankcard">我的银行卡</a></li>
                    <?php if ($parent == 0){
                        //echo '<li><a href="index.php?route=account/product_distribute">商品分销</a></li>';
                    }
                    ?>
                </ul>
                <h2 class="title_border"><?php echo $text_my_orders; ?></h2>
                <ul class="list-unstyled myaccount">
                    <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                    <?php if ($parent == 0){
                        //echo '<li><a href="index.php?route=account/order/distribute">分销订单</a></li>';
                    }
                    ?>
                    <!-- <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li> -->
                    <?php if ($reward) { ?>
                    <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                    <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                    <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
                    <?php if ($parent == 0){
                        echo '<li><a href="index.php?route=account/customised">定制反馈</a></li>';
                    }
                    ?>
                </ul>
                <h2 class="title_border"><?php echo $text_my_newsletter; ?></h2>
                <ul class="list-unstyled myaccount">
                    <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                </ul>
                <?php echo $content_bottom; ?></div></div>
        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $footer; ?>