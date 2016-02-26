<?php echo $header; ?>  
<div class="bt-breadcrumb">
<div class="container">
  <ul class="breadcrumb">
  <h2><?php echo $heading_title; ?></h2>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  </div>
</div>
<div class="container">
<div class="row"><?php echo $column_left; ?>
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
		<div class="btn-group">
			<button type="button" id="list-view" class="btn-list" title="<?php echo $text_list; ?>"></button>
			<button type="button" id="grid-view" class="btn-grid" title="<?php echo $text_grid; ?>"></button>
		</div>	
      </div>
	  <div class="row article-layout">
        <?php foreach ($articles as $article) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="content_bg">
            <div class="article-image"><a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive" /></a></div>
            <div class="article_dt">
				<div class="article-name"><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
				<div class="article-title">
					<p><?php echo $article['title']; ?></p>                   
				</div>
				<div class="article-footer">
					<span class="post-by"><span><?php echo $article['author']; ?></span></span>	
					<span class="time-stamp">
						<?php $date = new DateTime($article['date_modified']);?>
						<small><?php echo $date->format('l, M j, Y');?></small>
					</span>   
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
<?php echo $footer; ?>