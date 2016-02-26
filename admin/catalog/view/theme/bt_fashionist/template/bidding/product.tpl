<?php echo $header; ?>
<?php global $config; ?>
<?php
	$refine_search=0; $category_info=0; $view='both_grid'; $boss_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
	if($config->get('boss_manager')){
$boss_manager = $config->get('boss_manager');
}else{
$boss_manager = '';
}
if(!empty($boss_manager)){
$refine_search = isset($boss_manager['other']['refine_search'])?$boss_manager['other']['refine_search']:0;
$category_info = isset($boss_manager['other']['category_info'])?$boss_manager['other']['category_info']:0;
$view = isset($boss_manager['other']['view_pro'])?$boss_manager['other']['view_pro']:'both_grid';
$perrrow = isset($boss_manager['other']['perrow'])?$boss_manager['other']['perrow']:3;
}

if(isset($perrrow) && $perrrow==1){
$boss_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
}else if(isset($perrrow) && $perrrow==2){
$boss_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
}else if(isset($perrrow) && $perrrow==3){
$boss_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
}else if(isset($perrrow) && $perrrow==4){
$boss_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
}else if(isset($perrrow) && $perrrow==5){
$boss_class = 'boss-col-5column col-md-3 col-sm-6 col-xs-12';
}else if(isset($perrrow) && $perrrow==6){
$boss_class = 'col-lg-2 col-md-3 col-sm-6 col-xs-12';
}
?>

<div class="parallax parallax1">
    <div class="boss-static-content2 boss_category" style="background-image: url(<?php echo (isset($thumb)&&!empty($thumb))?$thumb:'image/catalog/bt_fashionist/boss_category.jpg' ?>); background-position: 50% 0;">
        <div class="boss_text not-animated" data-animate="fadeInLeft" data-delay="200">
            <div class="container">
                <div class="row"><div class="detail-text"><span class="detail detail2"><?php echo $heading_title; ?></span><span class="detail detail3"><?php echo isset($description)?$description:''; ?></span></div></div>
            </div>
        </div>
    </div>
</div>
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
<div id="content" class="<?php echo $class; ?>">
    <div class="content_bg"><?php if ($description) { ?>
        <?php if($category_info){ ?>
        <div class="category-info">
            <h1><?php echo $heading_title; ?></h1>
            <?php if ($description) { ?>
            <div class="info_detail"><?php echo $description; ?></div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
    <?php if ($products) { ?>
    <div class="product-filter">
        <div class="compare_display">
            <div class="product-compare"><a href="<?php echo $compare; ?>" id="compare-total" class="btn"><?php echo $text_compare; ?></a></div>
            <div class="btn-group" <?php if($view == 'grid' || $view =='list')echo 'style="display:none"'; ?>>
            <button type="button" id="grid-view" title="<?php echo $button_grid; ?>">&nbsp;</button>
            <button type="button" id="list-view" title="<?php echo $button_list; ?>">&nbsp;</button>
        </div>
    </div>
    <div class="limit_sort">
        <div class="limit">
            <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
            <label class="boss_select">
                <select id="input-limit" class="form-control selectpicker" onchange="location = this.value;">
                    <?php foreach ($limits as $limits) { ?>
                    <?php if ($limits['value'] == $limit) { ?>
                    <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </label>
        </div>
        <div class="sort">
            <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
            <label class="boss_select">
                <select id="input-sort" class="form-control selectpicker" onchange="location = this.value;">
                    <?php foreach ($sorts as $sorts) { ?>
                    <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                    <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </label>
        </div>
    </div>
</div>
<div class="row layout-thumb">
    <?php
            foreach ($products as $product)
            {
                if (strtotime(date('Y-m-d H:i:s')) > strtotime($product['start_time']) && strtotime(date('Y-m-d H:i:s')) < strtotime($product['over_time']))
    {
    if ($product['bidding_stock'] > 0)
    {
    ?>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                <div class="button-group">
                    <button type="button" class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="btadd.wishlist('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                    <button type="button" class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="btadd.compare('<?php echo $product['product_id']; ?>');"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <?php if ($product['price']) { ?>
            <p class="price">
                <?php if ($product['bidding_price']){ echo $product['bidding_price']; }elseif (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>
                <?php if ($product['tax']) { ?>
                <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                <?php } ?>
                <button type="button" class="btn" onclick="btadds.cart('<?php echo $product['product_id']; ?>','<?php echo $product['bidding_id']; ?>');">抢拍</button>
            <div id="product_<?php echo $product['product_id'];?>" style="display: none;">
                <input type="hidden" name="bidding_id" value="<?php echo $product['bidding_id']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            </div>
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
            <p class="description"><?php echo $product['description']; ?></p>
            <p><?php echo date('m月d日 H时i分',strtotime($product['over_time']));?> 结束</p>
        </div>
    </div>
    <?php
                    }
                    else
                    {
            ?>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                <div class="button-group">
                    <button type="button" class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="btadd.wishlist('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                    <button type="button" class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="btadd.compare('<?php echo $product['product_id']; ?>');"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <?php if ($product['price']) { ?>
            <p class="price">
                <?php if ($product['start_price']){ echo $product['start_price']; }elseif (!$product['special']) { ?>
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
            <p class="description"><?php echo $product['description']; ?></p>
            <p>已成交</p>
        </div>
    </div>
    <?php
                    }
                }
                elseif (strtotime(date('Y-m-d H:i:s')) < strtotime($product['start_time']))
                {
            ?>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                <div class="button-group">
                    <button type="button" class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="btadd.wishlist('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                    <button type="button" class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="btadd.compare('<?php echo $product['product_id']; ?>');"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <?php if ($product['price']) { ?>
            <p class="price">
                <?php if ($product['start_price']){ echo $product['start_price']; }elseif (!$product['special']) { ?>
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
            <p class="description"><?php echo $product['description']; ?></p>
            <p><?php echo date('m月d日 H时i分',strtotime($product['start_time']));?> 开始</p>
        </div>
    </div>
    <?php
                }
                else
                {
            ?>
    <div class="product-layout product-list col-xs-12">
        <div class="product-thumb">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                <div class="button-group">
                    <button type="button" class="btn-wishlist" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="btadd.wishlist('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                    <button type="button" class="btn-compare" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="btadd.compare('<?php echo $product['product_id']; ?>');"><i class="fa fa-arrow-down"></i></button>
                </div>
            </div>
            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <?php if ($product['price']) { ?>
            <p class="price">
                <?php if ($product['start_price']){ echo $product['start_price']; }elseif (!$product['special']) { ?>
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
            <p class="description"><?php echo $product['description']; ?></p>
            <p>已成交</p>
        </div>
    </div>
    <?php
                }
            }
            ?>
</div>
<div class="bt_pagination">
    <?php if(!empty($pagination)){?><div class="links"><?php echo $pagination; ?></div> <?php } ?>
    <div class="results"><?php echo $results; ?></div>
</div>
<?php } ?>
<?php echo $content_bottom; ?></div>
<?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
    // Product List
    $('#list-view').click(function() {
        $('#content .product-layout > .clearfix').remove();

        $('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');

        localStorage.setItem('display', 'list');
    });
    var btadds = {
        'cart': function(product_id,bidding_id) {
            $.post('index.php?route=bidding/detailed/getstock',{product_id:product_id,bidding_id:bidding_id},function(data){
                if (data == 'success')
                {
                    $.ajax({
                        url: 'index.php?route=bossthemes/boss_add/cart/',
                        type: 'post',
//                    data: 'product_id=' + product_id,
                        data: $('#product_'+ product_id +' input[type=\'hidden\'], #product_'+ product_id +' input[type=\'radio\']:checked, #product_'+ product_id +' input[type=\'checkbox\']:checked, #product_'+ product_id +' select, #product_'+ product_id +' textarea'),
                        dataType: 'json',
                        success: function(json) {
                            if (json['redirect']) {
                                location = json['redirect'];
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
        }
    }

    // Product Grid
    $('#grid-view').click(function() {
        $('#content .product-layout').attr('class', 'product-layout product-grid <?php echo $boss_class; ?>');
        localStorage.setItem('display', 'grid');
    });

    if (localStorage.getItem('display') == 'list') {
        $('#list-view').trigger('click');
    } else if (localStorage.getItem('display') == 'grid'){
        $('#grid-view').trigger('click');
    }else {
    <?php if($view == 'grid' || $view == 'both_grid') { ?>
            $('#grid-view').trigger('click');
        <?php } ?>
    <?php if($view == 'list' || $view == 'both_list') { ?>
            $('#list-view').trigger('click');
        <?php } ?>
    }
    //--></script>
<?php echo $footer; ?>