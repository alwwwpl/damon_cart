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
	<h1 class="article-title-boss"><?php echo $heading_title; ?></h1> 
	<div class="boss_article-item boss_article-detail">
		<div class="content_bg">
		<div class="article-title">
			<p><?php echo $title;?></p>        
		</div> 
		<div class="article-content">
			<?php echo $content;?>			
			<div class="date-post">
				<span class="post-by"><span><?php echo $author; ?></span></span>
				<small class="time-stamp time-article">
					<?php $date = new DateTime($date_modified);?>
					<?php echo $date->format('l, M j, Y');?>
				</small>
				<span class="comment-count"><span><?php echo $comments; ?></span> <?php echo $text_comments;?></span>
			</div>
		</div>
		<div class="boss_article-action">
			<?php if ($tags && !empty($tags)) { ?>
			  <div class="tags"><span><?php echo $text_tags; ?>: </span>
			  <ul>
				<?php for ($i = 0; $i < count($tags); $i++) { ?>
				<?php if ($i < (count($tags) - 1)) { ?>
				<li class="item"><a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a></li>
				<?php } else { ?>
				<li class="item"><a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a></li>
				<?php } ?>
				<?php } ?>
			  </ul>
			  </div>
			<?php } ?>
			<div class="article-share"><!-- AddThis Button BEGIN -->
			  <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share;?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
			  <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
			  <!-- AddThis Button END --> 
			</div>	
		</div>
		</div>
		<div class="article-related content_bg">
			<h3><?php echo $article_related; ?></h3>
			 <ul>
			   <?php foreach ($articles as $article) { ?> 
				   <li><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a>
						<small class="time-stamp"> (
							<?php $date = new DateTime($article['date_added']);?>
							<?php echo $date->format('l, j M , Y');?> )
						</small>
				   </li>
			   <?php } ?> 
			 </ul>
		</div>
			
	<?php if (!empty($products)) { ?>
	<div id="product-related" class="product-related">
		<h2 class="ta-related"><span><?php echo $text_product_related; ?> (<?php echo count($products); ?>)</span></h2>
		<div class="carousel-button">
			<a id="prev_related" class="prev nav_thumb" href="javascript:void(0)" style="display:block;" title="prev"><i title="Previous" class="fa fa-chevron-left">&nbsp;</i></a>
			<a id="next_related" class="next nav_thumb" href="javascript:void(0)" style="display:block;" title="next"><i title="Next" class="fa fa-chevron-right">&nbsp;</i></a>
		</div>
		<div class="list_carousel responsive" >
			<ul id="product_related" class="content-products"><?php foreach ($products as $product) { ?><li>				
			<div class="product-thumb transition">
				<?php if ($product['thumb']) { ?>		
				<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>					
					<div class="button-group">
						<a class="btn-cart" title="<?php echo $button_cart; ?>" onclick="btadd.cart('<?php echo  $product['product_id'];  ?>');"><?php echo $button_cart; ?></a>
						<a class="btn-wishlist" title="<?php echo $text_add_to_compare; ?>" onclick="btadd.compare('<?php echo  $product['product_id'];  ?>');"><?php echo $text_add_to_compare; ?></a>
						<a class="btn-compare" title="<?php echo $text_add_to_wish_list; ?>" onclick="btadd.wishlist('<?php echo  $product['product_id']; ?>');"><?php echo $text_add_to_wish_list; ?></a>
					</div>
				</div>
				<?php } ?>  
				<div class="small_detail">
					<div class="caption">	
						<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
						<?php if ($product['price']) { ?>
						<div class="price">
						  <?php if (!$product['special']) { ?>
						  <?php echo $product['price']; ?>
						  <?php } else { ?>
						 <span class="price-new"><?php echo $product['special']; ?></span>  <span class="price-old"><?php echo $product['price']; ?></span>
						  <?php } ?>
						</div><?php } ?>
					</div>		
				</div>
			
			</div>
			</li><?php } ?></ul>        
		</div>
    </div>
	<?php } ?> 
	<?php if ($allow_comment!=0) {?>
		<?php if ($comment_status==1||$allow_comment==1) {?>
	<div class="comments">                
		<div id="article-comments"></div> 
		<div class="form-comment-container">
			<span id="new">
				<h3><?php echo $text_comment; ?> </h3>
			</span>       
			<div id="0_comment_box" class="form-comment content_bg">
				  <?php if(!$login){?>
					  <div class="field" id="username">
						  <label class="" for="name"><?php echo $text_username; ?><em>*</em></label>
						  <div class="input-box">
							  <input type="text" class="form-control required-entry" value="" title="Name" id="name" name="username">
						  </div>
					  </div>                    
					  <div class="field" id="email">
						  <label class="" for="email"><?php echo $text_email; ?><em>*</em></label>
						  <div class="input-box">
							  <input type="text" class="form-control required-entry validate-email" value="" title="Email" id="email" name="email_blog">
						  </div>
					  </div>
				  <?php } else{?>
						<input type="hidden" class="form-control required-entry" value="<?php echo $username; ?>" title="Name" id="name" name="username">
						<input type="hidden" class="form-control required-entry validate-email" value="<?php echo $email; ?>" title="Email" id="email" name="email_blog">
				  <?php } ?>
				  <div class="input-box-comment">
					  <label class="tt_input" for="comment"><?php echo $entry_comment; ?><em>*</em></label>
					  <textarea rows="2" cols="10" class="required-entry form-control" style="height:200px" title="Comment" id="comment" name="comment_content"></textarea>
				  </div>
				  
				  <?php if($capcha){?>
				  <div class="captcha">
				   <img src="index.php?route=tool/captcha" alt="" id="captcha" /> <br/>
				   <input class="form-control" type="text" name="captcha" value="" /> 
				   <label class="required-1 " for="recaptcha"><?php echo $text_required?><em>*</em></label>
				  </div>
				  <?php }?>
				  <div class="submit-button">
					<div class="left"><br/><a id="button-comment" class="btn"><?php echo $button_continue; ?></a></div>
				  </div>
			</div>
		</div>                   
	 </div>
	 <?php } } ?>   
			
        </div>	
  <?php echo $content_bottom; ?></div>
  <?php echo $column_right; ?>
  </div>
 </div>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/jquery.carouFredSel-6.2.0-packed.js"></script> 
<script type="text/javascript"><!--
$('#article-comments').load('index.php?route=bossblog/article/comment&blog_article_id=<?php echo $blog_article_id; ?>');
$('#button-comment').bind('click', function() { 
	$.ajax({
		url: 'index.php?route=bossblog/article/write&blog_article_id=<?php echo $blog_article_id; ?>&need_approval=<?php echo $need_approval; ?>&approval_status=<?php echo $approval_status; ?>',
		type: 'post',
		dataType: 'json',
		data: 'username=' + encodeURIComponent($('input[name=\'username\']').val()) + '&comment_content=' + encodeURIComponent($('textarea[name=\'comment_content\']').val()) + '&email=' + encodeURIComponent($('input[name=\'email_blog\']').val()) + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),		
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-comment').attr('disabled', true);
			$('#new').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() { 
			$('#button-comment').attr('disabled', false);
			$('#captcha').attr('src', 'index.php?route=tool/captcha#'+new Date().getTime());
			$('.attention').remove();
			$('input[name=\'captcha\']').val('');
		},		
		success: function(json) { 
			if (json['error']) {
				$('#new').after('<div class="warning">' + json['error'] + '</div>');
			}
			
			if (json['success']) {
				$('#new').after('<div class="success">' + json['success'] + '</div>');
				$('#article-comments').load('index.php?route=bossblog/article/comment&blog_article_id=<?php echo $blog_article_id; ?>');				
				$('input[name=\'username\']').val('');
				$('textarea[name=\'comment_content\']').val('');
				$('input[name=\'email_blog\']').val('');
                $('input[name=\'captcha\']').val('');
			}
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
            max: 4
            }
        },
        scroll: {
            direction : 'left',    //  The direction of the transition.
            duration  : 1000   //  The duration of the transition.
        }
	});
});  
//--></script> 
<?php echo $footer; ?>