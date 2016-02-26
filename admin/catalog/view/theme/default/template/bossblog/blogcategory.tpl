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
	  <?php if ($thumb || $description) { ?>
		<div class="content_bg">
			<?php if ($thumb) { ?>
			<div class="img_thumb"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></div>
			<?php } ?>
			<?php if ($description) { ?>
			<div class="description"><?php echo $description; ?></div>
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
      <div class="product-filter">
		<div class="rss-feed">
			<a href="<?php echo $link_rss; ?>" title='RSS'><img src='catalog/view/theme/bt_titanshop/image/RSSFeed.png' alt='Rss' /></a>
		</div>	
		<div class="btn-group">
			<button type="button" id="list-view" class="btn-list" title="<?php echo $text_list; ?>"></button>
			<button type="button" id="grid-view" class="btn-grid" title="<?php echo $text_grid; ?>"></button>
		</div>	
        <div class="sort">
			<label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
			<label class="arrow">
			  <select id="input-sort" class="form-control" onchange="location = this.value;">
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
        <div class="limit">
			<label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
			<label class="arrow">
			  <select id="input-limit" class="form-control" onchange="location = this.value;">
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
<?php echo $footer; ?>