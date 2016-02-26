<?php echo $header; ?>
<div class="container">
  <div class="row">
	<div class="bt-breadcrumb">
	  <ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	  </ul>
	</div>
    <div id="content"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
		  <?php if ($success) { ?>
		  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		  </div>
		  <?php } ?>
	<div class="content_bg">	  
      <?php if ($products) { ?>
	  <div class="wishlist-info">
      <table class="table">
        <thead>
          <tr>
            <td colspan="2" class="image"><?php echo $column_name; ?></td>
            <td class="model"><?php echo $column_model; ?></td>
            <td class="product_price"><?php echo $column_price; ?></td>
            <td class="stock"><?php echo $column_stock; ?></td>
            <td class="action"><?php echo $column_action; ?></td>
            <td class="remove"><?php echo $button_remove; ?></td>
          </tr>
        </thead>        
        <tbody>
		<?php foreach ($products as $product) { ?>
          <tr>
            <td class="image"><?php if ($product['thumb']) { ?>
              <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
              <?php } ?></td>
            <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></td>
            <td class="model"><?php echo $product['model']; ?></td>
            <td class="product_price"><?php if ($product['price']) { ?>
              <div class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-old"><?php echo $product['price']; ?></span><span class="price-new"><?php echo $product['special']; ?></span> 
                <?php } ?>
              </div>
              <?php } ?></td>
            <td class="stock"><?php echo $product['stock']; ?></td>
			<td class="action">
				<div class="cart_button">
					<button type="button" onclick="btadd.cart('<?php echo $product['product_id']; ?>');" title="<?php echo $button_cart; ?>" class="btn button_cart"><?php echo $button_cart; ?></button>
				</div>
			</td>	
            <td class="remove"><a href="<?php echo $product['remove']; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="button_remove"></a></td>
          </tr>
		  <?php } ?>
        </tbody>        
      </table>
	  </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn"><?php echo $button_continue; ?></a></div>
      </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 