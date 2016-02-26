<div id="comments-header">
    <h3><?php echo $view_comment.' ('.$comment_total.')';?></h3>
</div>
<?php if ($comments) { ?>
<div id="allcomments">
    <?php foreach($comments as $comment){?>
        <div class="comment-item">
            <div class="comment-item-header">
                <span class="comment-by"><?php echo $text_comment_by;?>&nbsp;<span><?php echo $comment['author'];?></span></span>
				<small class="time-stamp">
					<?php $date = new DateTime($comment['date_added']);?>
					<?php echo $date-> format('l, M j Y, h:iA');?>
                </small>
			</div>	
			<div class="comment-body">
				<?php echo $comment['text'];?>
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
/*$('#button-comment').bind('click', function() { 
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
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#new').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#new').after('<div class="success">' + data['success'] + '</div>');
				$('#article-comments').load('index.php?route=bossblog/article/comment&blog_article_id=<?php echo $blog_article_id; ?>');				
				$('input[name=\'username\']').val('');
				$('textarea[name=\'comment_content\']').val('');
				$('input[name=\'email_blog\']').val('');
                $('input[name=\'captcha\']').val('');
			}
		}
	});
});*/
//--></script> 