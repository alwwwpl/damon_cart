<?php echo $header; ?>
<?php global $config; ?>
<?php
	$pro_des ='use_tab';
	if($config->get('boss_manager')){
$boss_manager = $config->get('boss_manager');
}else{
$boss_manager = '';
}
if(!empty($boss_manager)){
$pro_des = isset($boss_manager['other']['pro_tab'])?$boss_manager['other']['pro_tab']:'use_tab';
}
?>
<div class="container">
<div class="row">
<div class="bt-breadcrumb">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
</div>
<?php echo $column_left; ?>
<?php if ($column_left && $column_right) { ?>
<?php $class = 'col-sm-6'; ?>
<?php } elseif ($column_left || $column_right) { ?>
<?php $class = 'col-sm-9'; ?>
<?php } else { ?>
<?php $class = 'col-sm-12'; ?>
<?php } ?>
<div class="product-info">
<div class="row">
<?php if ($column_left && $column_right) { ?>
<?php $class = 'col-sm-6'; ?>
<?php } elseif ($column_left || $column_right) { ?>
<?php $class = 'col-sm-6'; ?>
<?php } else { ?>
<?php $class = 'col-sm-8'; ?>
<?php } ?>
<div class="<?php echo $class; ?>">
    <div class="bt-product-zoom">
        <?php if ($thumb || $images) { ?>
        <ul class="thumbnails">
            <?php if ($thumb) { ?>
            <li><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
            <?php } ?>
        </ul>
        <ul class="thumbnails" id="boss-image-additional">
            <?php if ($images) { ?>
            <?php foreach ($images as $image) { ?>
            <li class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
        <a id="prev_image_additional" class="prev nav_thumb" href="javascript:void(0)" style="display:block;" title="prev"><i title="Previous" class="fa fa-chevron-left">&nbsp;</i></a>
        <a id="next_image_additional" class="next nav_thumb" href="javascript:void(0)" style="display:block;" title="next"><i title="Next" class="fa fa-chevron-right">&nbsp;</i></a>
        <?php } ?>
    </div>
</div>
<?php if ($column_left && $column_right) { ?>
<?php $class = 'col-sm-6'; ?>
<?php } elseif ($column_left || $column_right) { ?>
<?php $class = 'col-sm-6'; ?>
<?php } else { ?>
<?php $class = 'col-sm-4'; ?>
<?php } ?>
<div class="<?php echo $class; ?>">
<h1><?php echo $heading_title; ?></h1>
<ul class="list-unstyled description">
    <?php if ($manufacturer) { ?>
    <li><?php echo $text_manufacturer; ?> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>
    <?php } ?>
    <li><?php echo $text_model; ?> <?php echo $model; ?></li>
    <?php if ($reward) { ?>
    <li><?php echo $text_reward; ?> <?php echo $reward; ?></li>
    <?php } ?>
</ul>
<div id="product">
<input type="hidden" name="bidding_id" value="<?php echo isset($_GET['bidding_id']) ? $_GET['bidding_id'] : 0 ?>">

<?php if ($options) { ?>
<div class="options">
    <h2><?php echo $text_option; ?></h2>
    <?php foreach ($options as $option) { ?>
    <?php if ($option['type'] == 'select') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
        <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control selectpicker">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['product_option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
            </option>
            <?php } ?>
        </select>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'radio') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label"><?php echo $option['name']; ?></label>
        <div id="input-option<?php echo $option['product_option_id']; ?>">
            <?php foreach ($option['product_option_value'] as $option_value) { ?>
            <div class="radio">
                <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                </label>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'checkbox') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label"><?php echo $option['name']; ?></label>
        <div id="input-option<?php echo $option['product_option_id']; ?>">
            <?php foreach ($option['product_option_value'] as $option_value) { ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                </label>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'image') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label"><?php echo $option['name']; ?></label>
        <div id="input-option<?php echo $option['product_option_id']; ?>">
            <?php foreach ($option['product_option_value'] as $option_value) { ?>
            <div class="radio">
                <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                </label>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'text') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'textarea') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
        <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'file') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label"><?php echo $option['name']; ?></label>
        <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
        <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'date') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
        <div class="input-group date">
            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'datetime') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
        <div class="input-group datetime">
            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'time') { ?>
    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
        <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
        <div class="input-group time">
            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php if ($recurrings) { ?>
    <hr>
    <h3><?php echo $text_payment_recurring ?></h3>
    <div class="form-group required">
        <select name="recurring_id" class="form-control selectpicker">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($recurrings as $recurring) { ?>
            <option value="<?php echo $recurring['recurring_id'] ?>"><?php echo $recurring['name'] ?></option>
            <?php } ?>
        </select>
        <div class="help-block" id="recurring-description"></div>
    </div>
    <?php } ?>
</div>
<?php } ?>
<div class="form-group cart">
    <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label>
    <div class="select_number">
        <p><?php echo $bidding_stock;?></p>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
    <?php if ($minimum > 1) { ?>
    <div class="minimum"><?php echo $text_minimum; ?></div>
    <?php } ?>
    <?php if ($price) { ?>
    <div class="price_info">
        <?php if ($bidding_price){  if ($floor_price <= $bidding_price) {echo '<span>'.$bidding_price.'</span>';} else {echo '<span>'.$start_price.'</span>';} }elseif (!$special) { ?>
        <span><?php echo $price; ?></span>
        <?php } else { ?>
        <span class="price-old"><?php echo $price; ?></span>
        <span class="price-new"><?php echo $special; ?></span>
        <?php } ?>
        <?php if ($tax) { ?>
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span>
        <?php } ?>
        <?php if ($points) { ?>
        <br/><br/><p><?php echo $text_points; ?> <?php echo $points; ?></p>
        <?php } ?>
        <?php if ($discounts) { ?>
        <?php foreach ($discounts as $discount) { ?>
        <p><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></p>
        <?php } ?>
        <?php } ?>
        <?php
             if (strtotime($over_time) >= strtotime($next_time) && strtotime($over_time) > strtotime(date('Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) > strtotime($start_time)) {echo '<span style="font-size:12px; line-height:25px; font-weight:100;">下次降价时间: '.$next_time.'</span>'; }?>
    </div>
    <?php } ?>
    <div class="cart_button">
        <?php

            if ($bidding_stock > 0 && strtotime($over_time) > strtotime(date('Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) > strtotime($start_time))
        {
        ?>
        <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn button_cart"> 抢 拍 </button>
        <?php
            }
            elseif ($bidding_stock > 0 && strtotime(date('Y-m-d H:i:s')) < strtotime($start_time))
        {
        ?>
        <button type="button"  data-loading-text="<?php echo $text_loading; ?>" class="btn button_cart"> <?php echo date('m月d日 H时i分',strtotime($start_time));?> 开始 </button>
        <?php
            }
            else
            {
            ?>
        <button type="button"  data-loading-text="<?php echo $text_loading; ?>" class="btn button_cart"> 已成交 </button>
        <?php
            }
            ?>
    </div>
    <div class="btn-group">
        <button type="button" data-toggle="tooltip" class="btn-compare" title="<?php echo $button_compare; ?>" onclick="btadd.compare('<?php echo $product_id; ?>');"><i class="fa fa-heart"></i><?php echo $button_compare; ?></button>
        <button type="button" data-toggle="tooltip" class="btn-wishlist" title="<?php echo $button_wishlist; ?>" onclick="btadd.wishlist('<?php echo $product_id; ?>');"><i class="fa fa-arrow-down"></i><?php echo $button_wishlist; ?></button>
    </div>
    <?php if ($review_status) { ?>
    <div class="rating">
        <p>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
            <?php if ($rating < $i) { ?>
            <span class="fa fa-stack fa-hidden"><i class="fa fa-heart"></i></span>
            <?php } else { ?>
            <span class="fa fa-stack"><i class="fa fa-heart"></i></span>
            <?php } ?>
            <?php } ?>
            <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click');goToByScroll('review'); return false;"><?php echo $reviews; ?></a> / <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click');goToByScroll('tab-review'); return false;"><?php echo $text_write; ?></a></p>
        <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
    </div>
    <?php } ?>
</div>
</div>
</div>
</div>
</div>
<?php if($pro_des=='use_tab'){ ?>
<div class="htabs">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>
        <?php if ($attribute_groups) { ?>
        <li><a href="#tab-specification" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
        <?php } ?>

    </ul>
</div>
<?php } ?>
<div class="tab-content">
    <?php if($pro_des!='use_tab'){?><h2><?php echo $tab_description; ?></h2><?php } ?>
    <div class="<?php if($pro_des=='use_tab') echo 'tab-pane active'; ?>" id="tab-description"><?php echo $description; ?></div>
    <?php if ($attribute_groups) { ?>
    <?php if($pro_des!='use_tab'){?><h2><?php echo $tab_attribute; ?></h2><?php } ?>
    <div class="<?php if($pro_des=='use_tab') echo 'tab-pane'; ?>" id="tab-specification">
        <table class="table table-bordered">
            <?php foreach ($attribute_groups as $attribute_group) { ?>
            <thead>
            <tr>
                <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
            <tr>
                <td><?php echo $attribute['name']; ?></td>
                <td><?php echo $attribute['text']; ?></td>
            </tr>
            <?php } ?>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <?php } ?>
    <?php if ($review_status) { ?>
    <div class="" id="tab-review">
        <form class="form-horizontal">
            <h3 class="tab-header"><span><?php echo $tab_review; ?></span></h3>
            <div id="review"></div>
            <h2 class="tab-header"><span><?php echo $text_write; ?></span></h2>
            <?php if ($review_guest) { ?>
            <div class="form-group required">
                <div class="col-sm-12">
                    <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                </div>
            </div>
            <div class="form-group required">
                <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div>
                </div>
            </div>
            <div class="form-group required">
                <div class="col-sm-12">
                    <label class="control-label"><?php echo $entry_rating; ?></label>
                    &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                    <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;<?php echo $entry_good; ?></div>
            </div>
            <div class="form-group required">
                <div class="col-sm-12">
                    <label class="control-label" for="input-captcha"><?php echo $entry_captcha; ?></label>
                    <input type="text" name="captcha" value="" id="input-captcha" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12"> <img src="index.php?route=tool/captcha" alt="" id="captcha" /> </div>
            </div>
            <div class="buttons">
                <div class="pull-left">
                    <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                </div>
            </div>
            <?php } else { ?>
            <?php echo $text_login; ?>
            <?php } ?>
        </form>
    </div>
    <?php } ?>
</div>
<?php if ($products) { ?>
<div class="product-related">
    <h2 class="tab-header"><span><?php echo $text_related; ?></span></h2>
    <div class="carousel-button">
        <a id="prev_related" class="prev nav_thumb" href="javascript:void(0)" style="display:block;" title="prev"><i title="Previous" class="fa fa-angle-left">&nbsp;</i></a>
        <a id="next_related" class="next nav_thumb" href="javascript:void(0)" style="display:block;" title="next"><i title="Next" class="fa fa-angle-right">&nbsp;</i></a>
    </div>
    <div class="list_carousel responsive product-grid" >
        <ul id="product_related" class="content-products"><?php foreach ($products as $product) { ?><li>
                <div class="product-thumb transition">
                    <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                        <div class="button-group">
                            <button type="button" class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="btadd.wishlist('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                            <button type="button" class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="btadd.compare('<?php echo $product['product_id']; ?>');"><i class="fa fa-arrow-down"></i></button>
                        </div>
                    </div>
                    <div class="caption">
                        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                        <?php if ($product['price']) { ?>
                        <p class="price">
                            <?php if (!$product['special']) { ?>
                            <?php echo $product['price']; ?>
                            <?php } else { ?>
                            <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                            <?php } ?>
                            <?php if ($product['tax']) { ?>
                            <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                            <?php } ?>
                        </p>
                        <?php } ?>
                        <?php if ($product['rating']) { ?>
                        <div class="rating">
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <?php if ($product['rating'] < $i) { ?>
                            <span class="fa fa-stack fa-hidden"><i class="fa fa-heart"></i></span>
                            <?php } else { ?>
                            <span class="fa fa-stack"><i class="fa fa-heart"></i></span>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <button type="button" class="btn-cart" onclick="btadd.cart('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></button>
                </div>
            </li><?php } ?></ul>
    </div>
</div>
<?php } ?>
<?php if ($tags) { ?>
<p><?php echo $text_tags; ?>
    <?php for ($i = 0; $i < count($tags); $i++) { ?>
    <?php if ($i < (count($tags) - 1)) { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
    <?php } else { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
    <?php } ?>
    <?php } ?>
</p>
<?php } ?>
<?php echo $content_bottom; ?></div>
<?php echo $column_right; ?></div>
</div>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/carouFredSel-6.2.0.js"></script>
<script type="text/javascript"><!--
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function() {
                $('#recurring-description').html('');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //--></script>
<script type="text/javascript"><!--
    function changeQty(increase) {
        var qty = parseInt($('.select_number').find("input").val());
        if ( !isNaN(qty) ) {
            qty = increase ? qty+1 : (qty > <?php echo $minimum; ?> ? qty-1 : <?php echo $minimum; ?>);
            $('.select_number').find("input").val(qty);
        }else{
            $('.select_number').find("input").val(1);
        }
    }
    $('#button-cart').on('click', function() {
        var product_id = '<?php echo $_GET["product_id"];?>';
        var bidding_id = '<?php echo $_GET["bidding_id"];?>';
        $.post('index.php?route=bidding/detailed/getstock',{product_id:product_id,bidding_id:bidding_id},function(data){
            if (data == 'success')
            {
                $.ajax({
                    url: 'index.php?route=bossthemes/boss_add/cart',
                    type: 'post',
                    data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
                    dataType: 'json',
                    beforeSend: function() {
                        //$('#button-cart').button('loading');
                    },
                    complete: function() {
                        //$('#button-cart').button('reset');
                    },
                    success: function(json) {
                        $('.alert, .text-danger').remove();
                        $('.form-group').removeClass('has-error');

                        if (json['error']) {
                            if (json['error']['option']) {
                                for (i in json['error']['option']) {
                                    var element = $('#input-option' + i.replace('_', '-'));

                                    if (element.parent().hasClass('input-group')) {
                                        element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                    } else {
                                        element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                    }
                                }
                            }

                            if (json['error']['recurring']) {
                                $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                            }

                            // Highlight any found errors
                            $('.text-danger').parent().addClass('has-error');
                        }

                        if (json['success']) {
                            addProductNotice(json['title'], json['thumb'], json['success'], 'success');

                            $('#cart-total').html(json['total']);

                            $('#cart > ul').load('index.php?route=common/cart/info ul li');
                            window.location.href = 'index.php?route=checkout/cart';
                        }
                    }
                });
            }
            else if (data == 'over')
            {
                alert('商品已经被拍下，您拍晚了！');
                window.location.reload();
            }
        });

    });
    //--></script>
<script type="text/javascript"><!--
    $('.date').datetimepicker({
        pickTime: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function() {
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        $('#form-upload input[name=\'file\']').on('change', function() {
            $.ajax({
                url: 'index.php?route=tool/upload',
                type: 'post',
                dataType: 'json',
                data: new FormData($(this).parent()[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(node).button('loading');
                },
                complete: function() {
                    $(node).button('reset');
                },
                success: function(json) {
                    $('.text-danger').remove();

                    if (json['error']) {
                        $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                    }

                    if (json['success']) {
                        alert(json['success']);

                        $(node).parent().find('input').attr('value', json['code']);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
    });
    //--></script>
<script type="text/javascript"><!--
    $('#review').delegate('.pagination a', 'click', function(e) {
        e.preventDefault();

        $('#review').fadeOut('slow');

        $('#review').load(this.href);

        $('#review').fadeIn('slow');
    });

    $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

    $('#button-review').on('click', function() {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
            beforeSend: function() {
                $('#button-review').button('loading');
            },
            complete: function() {
                $('#button-review').button('reset');
                $('#captcha').attr('src', 'index.php?route=tool/captcha#'+new Date().getTime());
                $('input[name=\'captcha\']').val('');
            },
            success: function(json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                    $('input[name=\'captcha\']').val('');
                }
            }
        });
    });

    $(document).ready(function() {
        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
        });
    });
    $(window).load(function(){
        $('#product_related').carouFredSel({
            auto: false,
            responsive: true,
            width: '100%',
            prev: '#prev_related',
            next: '#next_related',
            swipe: {
                onTouch : true
            },
            items: {
                width: 280,
                height: 'auto',
                visible: {
                    min: 1,
                    max: 3
                }
            },
            scroll: {
                direction : 'left',    //  The direction of the transition.
                duration  : 1000   //  The duration of the transition.
            }
        });
        $('#boss-image-additional').carouFredSel({
            auto: false,
            responsive: true,
            width: '100%',
            prev: '#prev_image_additional',
            next: '#next_image_additional',
            swipe: {
                onTouch : true
            },
            items: {
                width: 100,
                height: 'auto',
                visible: {
                    min: 1,
                    max: 4
                }
            },
            scroll: {
                direction : 'left',    //  The direction of the transition.
                duration  : 1000   //  The duration of the transition.
            }
        });
    });
    function goToByScroll(id){
        $('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');

    }
    //--></script>
<?php echo $footer; ?>