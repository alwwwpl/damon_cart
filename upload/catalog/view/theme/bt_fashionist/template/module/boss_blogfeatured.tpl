<div class="container">
<div class="row">
	<div class="boss-blog-featured not-animated" data-animate="fadeInUp" data-delay="300">
		<div class="block-heading"><span><?php echo $heading_title; ?></span></div>
		<div class="block-content">
			<div class="box-article">
				<?php if($use_slider){ ?>
				<ul id="slider-article<?php echo $module; ?>">
					<?php foreach ($articles as $article) { ?>
					<li><div class="article_content"><div class="article-item"><div class="std">
						<?php if ($article['thumb']) { ?>
						<div class="col-sm-5 col-xs-12">
							<div class="image">
								<a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" /></a>
							</div>
						<?php } ?>	
						</div>	
						<div class="col-sm-7 col-xs-12">
							<div class="article-detail">
								<div class="article-name"><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
								<div class="description"><p><?php echo $article['content']; ?></p></div>
							</div>
						</div>
					</div>
					<div class="boss_footer">						
						<?php $date = new DateTime($article['date_added']);?>
						<div class="time-stamp">					
							<?php echo $date->format('Y-m-d');?></small> 
						</div>						
						<!-- <div class="comment"><span class="comment-count"><a href="<?php echo $article['href']; ?>"><?php echo $article['comment']; ?></a></span> <?php echo $text_comment; ?></div>	 -->					
						<div class="read-more"><a href="<?php echo $article['href']; ?>"><?php echo $text_read_more; ?></a></div>
						
					</div>
					</div></div></li>
					<?php } ?>
				</ul>
				<a id="article_prev<?php echo $module; ?>" class="btn-nav-center prev nav_thumb" href="javascript:void(0)" title="prev"><i class="fa fa-angle-left"></i></a>
				<a id="article_next<?php echo $module; ?>" class="btn-nav-center next nav_thumb" href="javascript:void(0)" title="next"><i class="fa fa-angle-right"></i></a>
				<?php }else{ ?>
				<div class="row">
					<?php foreach ($articles as $article) { ?>
					<div class="col-sm-6 col-xs-12">
					<div class="article_content"><div class="article-item"><div class="std">
						<?php if ($article['thumb']) { ?>
						<div class="col-sm-4 col-xs-12">
							<div class="image">
								<a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" /></a>
							</div>
						</div>
						<?php } ?>
						<div class="col-sm-8 col-xs-12">
							<div class="article-detail">
								<div class="article-name"><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
								<div class="description"><p><?php echo $article['content']; ?></p></div>
							</div>
						</div>
						</div>
						<div class="boss_footer">	
							<?php $date = new DateTime($article['date_added']);?>
							<div class="time-stamp">
							<small class="time-date">							
							<?php echo $date->format('j');?></small> 
							<small class="time-month">							
							<?php echo $date->format('M');?></small> 
							</div>
							<div class="comment">
								<span class="comment-count"><a href="<?php echo $article['href']; ?>"><?php echo $article['comment']; ?></a></span>
							</div>
							<span class="post-by"><span><?php echo $article['author']; ?></span></span>
						</div>		
					</div></div>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php if($use_slider){ ?>
<script type="text/javascript"><!--
$(window).load(function(){
    $('#slider-article<?php echo $module; ?>').carouFredSel({
        auto: false,
        responsive: true,
        width: '100%',
        next: '#article_next<?php echo $module; ?>',
        prev: '#article_prev<?php echo $module; ?>',
        swipe: {
        onTouch : true
        },
        items: {
            width: 500,
            height: 'auto',
            visible: {
            min: 1,
            max: 2
            }
        },
        scroll: {
            direction : 'left',    //  The direction of the transition.
            duration  : 1000   //  The duration of the transition.
        }
    });
});
//--></script>
<?php } ?>
</div>
</div>