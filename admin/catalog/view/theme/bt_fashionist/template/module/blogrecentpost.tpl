<div class="bt-box block boss_block-recent-post">
    <div class="box-heading block-title">
        <span><?php echo $heading_title; ?></span>
    </div>
    <div class="box-content block-content">
        <?php if($articles){?>
        <ol>
            <?php foreach ($articles as $article) { ?>
            <li class="item">
                <a class="article-title" href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a>
                <span class="time-stamp">
                    <?php $date = new DateTime($article['date_added']);?>
                    <?php echo $date->format('M j, Y');?></span> 
                <div class="recent-comment-content">
                    "<?php echo $article['title']; ?>"
                </div>
                <span class="post-by"><?php echo $text_postby; ?><span><?php echo $article['author']; ?></span></span>								
            </li>
            <?php } ?>
        </ol>
        <?php } else {?>
        <?php echo 'There are no Articles.'; ?>
        <?php } ?>
    </div>

</div>
