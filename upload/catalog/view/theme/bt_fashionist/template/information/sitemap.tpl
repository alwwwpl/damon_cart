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
	<?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
	  <div class="content_bg">
      <div class="row">
        <div class="col-sm-6">
          <ul class="sitemap">
            <?php foreach ($categories as $category_1) { ?>
            <li><a href="<?php echo $category_1['href']; ?>"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo $category_1['name']; ?></a>
              <?php if ($category_1['children']) { ?>
              <ul>
                <?php foreach ($category_1['children'] as $category_2) { ?>
                <li><a href="<?php echo $category_2['href']; ?>">+ &nbsp;&nbsp;<?php echo $category_2['name']; ?></a>
                  <?php if ($category_2['children']) { ?>
                  <ul class="sitemap">
                    <?php foreach ($category_2['children'] as $category_3) { ?>
                    <li><a href="<?php echo $category_3['href']; ?>">- &nbsp;&nbsp;<?php echo $category_3['name']; ?></a></li>
                    <?php } ?>
                  </ul>
                  <?php } ?>
                </li>
                <?php } ?>
              </ul>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
        </div>
        <div class="col-sm-6">
          <ul class="sitemap">
            <li><a href="<?php echo $special; ?>"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo $text_special; ?></a></li>
            <li><a href="<?php echo $account; ?>"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo $text_account; ?></a>
              <ul class="sitemap">
                <li><a href="<?php echo $edit; ?>">+ &nbsp;&nbsp;<?php echo $text_edit; ?></a></li>
                <li><a href="<?php echo $password; ?>">+ &nbsp;&nbsp;<?php echo $text_password; ?></a></li>
                <li><a href="<?php echo $address; ?>">+ &nbsp;&nbsp;<?php echo $text_address; ?></a></li>
                <li><a href="<?php echo $history; ?>">+ &nbsp;&nbsp;<?php echo $text_history; ?></a></li>
                <li><a href="<?php echo $download; ?>">+ &nbsp;&nbsp;<?php echo $text_download; ?></a></li>
              </ul>
            </li>
            <li><a href="<?php echo $cart; ?>"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo $text_cart; ?></a></li>
            <li><a href="<?php echo $checkout; ?>"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo $text_checkout; ?></a></li>
            <li><a href="<?php echo $search; ?>"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;<?php echo $text_search; ?></a></li>
            <li><?php echo $text_information; ?>
              <ul class="sitemap">
                <?php foreach ($informations as $information) { ?>
                <li><a href="<?php echo $information['href']; ?>">+ &nbsp;&nbsp;<?php echo $information['title']; ?></a></li>
                <?php } ?>
                <li><a href="<?php echo $contact; ?>">+ &nbsp;&nbsp;<?php echo $text_contact; ?></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>