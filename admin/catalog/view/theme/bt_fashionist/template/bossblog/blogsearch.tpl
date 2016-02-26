<?php echo $header; ?> 
<?php global $config; ?>
<?php 
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
	  <div class="content_bg">
	  <label class="control-label" for="input-search"><?php echo $entry_search; ?></label>
          <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
          <select class="form-control selectpicker" name="filter_category_id">
			<option value="0"><?php echo $text_category; ?></option>
			<?php foreach ($categories as $category_1) { ?>
			<?php if ($category_1['blog_category_id'] == $filter_category_id) { ?>
			<option value="<?php echo $category_1['blog_category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $category_1['blog_category_id']; ?>"><?php echo $category_1['name']; ?></option>
			<?php } ?>
			<?php foreach ($category_1['children'] as $category_2) { ?>
			<?php if ($category_2['blog_category_id'] == $filter_category_id) { ?>
			<option value="<?php echo $category_2['blog_category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $category_2['blog_category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
			<?php } ?>
			<?php foreach ($category_2['children'] as $category_3) { ?>
			<?php if ($category_3['blog_category_id'] == $filter_category_id) { ?>
			<option value="<?php echo $category_3['blog_category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $category_3['blog_category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
			<?php } ?>
			<?php } ?>
			<?php } ?>
			<?php } ?>
		  </select>
		  <br/>
		  <br/>
			<p>
			  <label>
				<?php if ($filter_sub_category) { ?>
				<input type="checkbox" name="filter_sub_category" value="1" checked="checked" />
				<?php } else { ?>
				<input type="checkbox" name="filter_sub_category" value="1" />
				<?php } ?>
				<?php echo $text_sub_category; ?></label>
			</p>
      <p>
        <label>
          <?php if ($filter_content) { ?>
          <input type="checkbox" name="filter_content" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="filter_content" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?></label>
      </p>
	  <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn" />
		</div>
	  <?php if ($articles) { ?>      
      <div class="product-filter">
		<div class="btn-group" <?php if($view == 'grid' || $view =='list')echo 'style="display:none"'; ?>>
			<button type="button" id="grid-view" class="btn-grid" title="<?php echo $text_grid; ?>"></button>
			<button type="button" id="list-view" class="btn-list" title="<?php echo $text_list; ?>"></button>
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

$('#content input[name=\'filter_name\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('#button-search').bind('click', function() { 
	url = 'index.php?route=bossblog/blogsearch';
	
	var filter_name = $('#content input[name=\'filter_name\']').val();
	
	if (filter_name) { 
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_category_id = $('#content select[name=\'filter_category_id\']').val();
	
	if (filter_category_id > 0) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}
	
	var filter_sub_category = $('#content input[name=\'filter_sub_category\']:checked').val();
	
	if (filter_sub_category) {
		url += '&filter_sub_category=true';
	}
		
	var filter_content = $('#content input[name=\'filter_content\']:checked').val();
	
	if (filter_content) {
		url += '&filter_content=true';
	}	
	location = url;
});
//--></script>  
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