<div id="comments-header">
    <h3 class="tab-header"><span><?php echo $view_comment.' ('.$comment_total.')';?></span></h3>
</div>
<?php if ($comments) { ?>
<div id="allcomments">
    <?php foreach($comments as $comment){?>
        <div class="comment-item">
			<div class="comment-body">
				<?php echo $comment['text'];?>
			</div>
            <div class="comment-item-header">
                <span class="comment-by"><?php echo $text_comment_by;?>&nbsp;<span><?php echo $comment['author'];?></span></span>
				<small class="time-stamp">
					<?php $date = new DateTime($comment['date_added']);?>
					<?php echo $date-> format('Y-m-d, H:i:s');?>
                </small>
			</div>	
        </div>
    <?php } ?>
</div>
    <div class="bt_pagination">
        <?php if(!empty($pagination)){?><div class="links"><?php echo $pagination; ?></div> <?php } ?>
        <div class="results"><?php echo $results; ?></div>
    </div>
<?php } else { ?>
<div class="allcomments"><?php echo $text_no_comments; ?></div>
<?php } ?>
<script type="text/javascript"><!--
$('#article-comments .pagination a').on('click', function() {
	$('#article-comments').fadeOut('slow');
		
	$('#article-comments').load(this.href);
	
	$('#article-comments').fadeIn('slow');
	
	return false;
});	

//--></script> 