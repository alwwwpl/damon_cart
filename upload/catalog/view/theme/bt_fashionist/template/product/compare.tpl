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
      <h1><?php echo $heading_title; ?></h1>
	  <?php if ($success) { ?>
	  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	  </div>
	  <?php } ?>
	  <div class="content_bg">
      <?php if ($products) { ?>
	  <div class="compare-infomation">
      <table class="compare-info">
        <thead>
          <tr>
            <td class="compare-product" colspan="<?php echo count($products) + 1; ?>"><?php echo $text_product; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($review_status) { ?>
          <tr>
            <td><?php echo $text_rating; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><div  class="rating"><?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($products[$product['product_id']]['rating'] < $i) { ?>
              <span class="fa fa-stack fa-hidden"><i class="fa fa-heart"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-heart"></i></span>
              <?php } ?>
              <?php } ?>
              <br />
              <?php echo $products[$product['product_id']]['reviews']; ?>
			  </div>
				<div class="remove">
					<a href="<?php echo $product['remove']; ?>" class=""><?php echo $button_remove; ?></a>
				</div>	
			</td>
            <?php } ?>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo $text_image; ?></td>
            <?php foreach ($products as $product) { ?>
            <td>
				<div class="image">
					<?php if ($products[$product['product_id']]['thumb']) { ?>
					<img src="<?php echo $products[$product['product_id']]['thumb']; ?>" alt="<?php echo $products[$product['product_id']]['name']; ?>" title="<?php echo $products[$product['product_id']]['name']; ?>" class="" />
					<?php } ?>
				</div>	
				<div class="name"><a href="<?php echo $products[$product['product_id']]['href']; ?>"><?php echo $products[$product['product_id']]['name']; ?></a></div>
				<div class="price"><?php if ($products[$product['product_id']]['price']) { ?>
				  <?php if (!$products[$product['product_id']]['special']) { ?>
				  <?php echo $products[$product['product_id']]['price']; ?>
				  <?php } else { ?>
				  <span class="price-old"><?php echo $products[$product['product_id']]['price']; ?> </span> <span class="price-new"> <?php echo $products[$product['product_id']]['special']; ?> </span>
				  <?php } ?>
				  <?php } ?>
				</div>
			</td>
			<?php } ?>
          </tr>
          <tr>
            <td><?php echo $text_model; ?></td>
            <?php foreach ($products as $product) { ?>
            <td class="model"><?php echo $products[$product['product_id']]['model']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td><?php echo $text_manufacturer; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['manufacturer']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td><?php echo $text_availability; ?></td>
            <?php foreach ($products as $product) { ?>
            <td class="stock"><?php echo $products[$product['product_id']]['availability']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td><?php echo $text_summary; ?></td>
            <?php foreach ($products as $product) { ?>
            <td class="description"><?php echo $products[$product['product_id']]['description']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td><?php echo $text_weight; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['weight']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td><?php echo $text_dimension; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['length']; ?> x <?php echo $products[$product['product_id']]['width']; ?> x <?php echo $products[$product['product_id']]['height']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
        <?php foreach ($attribute_groups as $attribute_group) { ?>
        <thead>
          <tr>
            <td class="compare-attribute" colspan="<?php echo count($products) + 1; ?>"><?php echo $attribute_group['name']; ?></td>
          </tr>
        </thead>
        <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
        <tbody>
          <tr>
            <td><?php echo $attribute['name']; ?></td>
            <?php foreach ($products as $product) { ?>
            <?php if (isset($products[$product['product_id']]['attribute'][$key])) { ?>
            <td><?php echo $products[$product['product_id']]['attribute'][$key]; ?></td>
            <?php } else { ?>
            <td></td>
            <?php } ?>
            <?php } ?>
          </tr>
        </tbody>
        <?php } ?>
        <?php } ?>
        <tr>
          <td></td>
          <?php foreach ($products as $product) { ?>
          <td>
			<div class="cart_button">
				<input type="button" value="<?php echo $button_cart; ?>" class="btn button_cart" onclick="btadd.cart('<?php echo $product['product_id']; ?>');" />
			</div>	
          </td>
          <?php } ?>
        </tr>
      </table>
	  </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
	  </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>