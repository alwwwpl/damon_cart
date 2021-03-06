<?php echo $header; 
	global $config;
	$view='both_grid'; $boss_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
	if($config->get('boss_manager')){
		$boss_manager = $config->get('boss_manager'); 
	}else{
		$boss_manager = '';
	}
	if(!empty($boss_manager)){				
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
	<h1><?php echo $heading_title; ?></h1>
	<?php echo $content_top; ?>     
	  <?php if ($thumb || $description) { ?>
		<div class="content_bg">
			<?php if ($thumb) { ?>
			<div class="img_thumb"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></div>
			<?php } ?>
			<?php if ($description) { ?>
			<div class="blogcategories-description"><?php echo $description; ?></div>
			<?php } ?>
		</div>
      <?php } ?>
      <?php if ($blogcategories) { ?>
	  <div class="content_bg category-list">
      <h3><?php echo $text_sub_category; ?></h3>
      <?php if (count($blogcategories) <= 5) { ?>
          <ul>
            <?php foreach ($blogcategories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
      <?php } else { ?>
        <?php foreach (array_chunk($blogcategories, ceil(count($blogcategories) / 4)) as $blogcategories) { ?>
          <ul>
            <?php foreach ($blogcategories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
        <?php } ?>
      <?php } ?>
	  </div>
      <?php } ?>
	  <?php if ($articles) { ?>      
      <div class="product-filter article-filter">
		<div class="compare_display">
		<div class="rss-feed">
			<a href="<?php echo $link_rss; ?>" title='RSS'><img src='catalog/view/theme/<?php echo $config->get('config_template'); ?>/image/rss.png' alt='Rss' /></a>
		</div>	
		<div class="btn-group" <?php if($view == 'grid' || $view =='list')echo 'style="display:none"'; ?>>
			<button type="button" id="grid-view" class="btn-grid" title="<?php echo $text_grid; ?>"></button>
			<button type="button" id="list-view" class="btn-list" title="<?php echo $text_list; ?>"></button>
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
	  <div class="row article-layout">
        <?php foreach ($articles as $article) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="content_bg">
            <div class="article-image"><a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive" /></a></div>
            <div class="article_dt">
				<div class="article-name"><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
				<div class="time-stamp">
					<?php $date = new DateTime($article['date_modified']);?>
					<small><?php echo $date->format('Y-m-d');?></small>
				</div>
				<div class="article-title">
					<p><?php echo $article['title']; ?></p>                   
				</div>
				<div class="article-footer">
					<span class="post-by"><span><?php echo $article['author']; ?></span></span>	
					<span>&nbsp;|&nbsp;</span>
					<span class="comment-count"><span><?php echo $article['comment']; ?> </span><a href="<?php echo $article['href']; ?>"><?php echo $text_comments;?></a></span>                 
				</div> 
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="bt_pagination">
        <?php if(!empty($pagination)){?><div class="links"><?php echo $pagination; ?></div> <?php } ?>
        <div class="results"><?php echo $results; ?></div>
      </div>
      <?php }else{ ?>
	  <p><?php echo $text_empty; ?></p>
	  <?php } ?>
	<?php echo $content_bottom; ?></div>	
    <?php echo $column_right; ?>
</div>
</div>      
<script type="text/javascript"><!--
// Product List
	$('#list-view').click(function() {
		$('#content .product-layout > .clearfix').remove();

		$('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');

		localStorage.setItem('display', 'list');
	});

	// Product Grid
	$('#grid-view').click(function() {
		$('#content .product-layout > .clearfix').remove();

		// What a shame bootstrap does not take into account dynamically loaded columns
		cols = $('#column-right, #column-left').length;

		if (cols == 2) {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');

			$('#content .product-layout:nth-child(2)').after('<div class="clearfix visible-md visible-sm"></div>');
		} else if (cols == 1) {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');

			$('#content .product-layout:nth-child(3)').after('<div class="clearfix visible-lg"></div>');
		} else {
			$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');

			$('#content .product-layout:nth-child(4)').after('<div class="clearfix"></div>');
		}

		 localStorage.setItem('display', 'grid');
	});
	
	if (localStorage.getItem('display') == 'list') {
		$('#list-view').trigger('click');
	}else if (localStorage.getItem('display') == 'grid'){
		$('#grid-view').trigger('click');
	} else {
		<?php if($view == 'grid' || $view == 'both_grid') { ?>
			$('#grid-view').trigger('click');
		<?php } ?>
		<?php if($view == 'list' || $view == 'both_list') { ?>
			$('#list-view').trigger('click');
		<?php } ?>
	}
//--></script>    
<?php echo $footer; ?>