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
            <h1><?php echo $heading_title; ?>
                <?php if ($weight) { ?>
                &nbsp;(<?php echo $weight; ?>)
                <?php } ?>
            </h1>
            <?php if ($attention) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check"></i> <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <div class="content_bg">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="table-responsive cart-info">
                        <table class="table">
                            <thead>
                            <tr>
                                <td class="image" colspan="2"><?php echo $column_name; ?></td>
                                <td class="model"><?php echo $column_model; ?></td>
                                <td class="product_price"><?php echo $column_price; ?></td>
                                <td class="quantity"><?php echo $column_quantity; ?></td>
                                <td class="total"><?php echo $column_total; ?></td>
                                <td class="remove"><?php echo $button_remove; ?></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product) { ?>
                            <tr>
                                <td class="image"><?php if ($product['thumb']) { ?>
                                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="" /></a>
                                    <?php } ?></td>
                                <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                    <?php if (!$product['stock']) { ?>
                                    <span class="text-danger">***</span>
                                    <?php } ?>
                                    <?php if ($product['option']) { ?>
                                    <?php foreach ($product['option'] as $option) { ?>
                                    <br />
                                    <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php if ($product['reward']) { ?>
                                    <br />
                                    <small><?php echo $product['reward']; ?></small>
                                    <?php } ?>
                                    <?php if ($product['recurring']) { ?>
                                    <br />
                                    <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                                    <?php } ?></td>
                                <td class="model"><?php echo $product['model']; ?></td>
                                <td class="quantity"><span class="price"><?php echo $product['price']; ?></span></td>
                                <?php if (isset($product['bidding']) && $product['bidding'] == 'bidding'){ ?>
                                <td class="product_price">
                                    <?php echo $product['quantity']; ?>
                                </td>
                                <?php }else{ ?>
                                <td class="product_price">
                                    <input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                                    <button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="button_update"></button>
                                </td>
                                <?php }?>
                                <td class="total"><span class="price"><?php echo $product['total']; ?></span></td>
                                <td class="remove">
                                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="button_remove" onclick="cart.remove('<?php echo $product['key']; ?>');"></button>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php foreach ($vouchers as $vouchers) { ?>
                            <tr>
                                <td></td>
                                <td class="name"><?php echo $vouchers['description']; ?></td>
                                <td class="model"></td>
                                <td class="quantity"><span class="price"><?php echo $vouchers['amount']; ?></span></td>
                                <td class="product_price">
                                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                                </td>
                                <td class="total"><span class="price"><?php echo $vouchers['amount']; ?></span></td>
                                <td class="remove">
                                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="button_remove" onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"></button>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="content_bg">
                <?php if ($coupon || $voucher || $reward || $shipping || $coupons) { ?>
                <h2 class="text_next_cart"><?php echo $text_next; ?></h2>
                <p style="margin-bottom: 16px;"><?php echo $text_next_choice; ?></p>
                <div class="panel-group cart-module" id="accordion"><?php echo $coupons; ?><?php echo $coupon; ?><?php echo $voucher; ?><?php echo $reward; ?><?php echo $shipping; ?></div>
                <?php } ?>
                <div class="cart-total">
                    <table>
                        <?php foreach ($totals as $total) { ?>
                        <tr>
                            <td class="left <?php echo ($total==end($totals)? ' last': ''); ?>"><b><?php echo $total['title']; ?>:</b></td>
                            <td class="right <?php echo ($total==end($totals)? ' last': ''); ?>"><?php echo $total['text']; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="buttons cart-buttons">
                    <div class="pull-right"><a href="<?php echo $checkout; ?>" class="btn"><?php echo $button_checkout; ?></a></div>
                    <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-shopping"><?php echo $button_shopping; ?></a></div>
                </div>
            </div>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>