<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
  <div class="review_list">
	<div class="author"><?php echo $review['author']; ?></div>
    <div class="date_added"><?php echo $review['date_added']; ?></div>
	<div class="rating">
      <?php for ($i = 1; $i <= 5; $i++) { ?>
      <?php if ($review['rating'] < $i) { ?>
      <span class="fa fa-stack fa-hidden"><i class="fa fa-heart"></i></span>
      <?php } else { ?>
      <span class="fa fa-stack"><i class="fa fa-heart"></i></span>
      <?php } ?>
      <?php } ?>
	</div>  
	<div class="text"><?php echo $review['text']; ?></div>
	</div>
<?php } ?>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<p><?php echo $text_no_reviews; ?></p>
<?php } ?>
