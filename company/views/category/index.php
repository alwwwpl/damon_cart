<?php
$this->title = '商品分类';
echo $this->render('@app/views/layouts/_header');
?>
        <div class="ca-main clearfix">
            <div class="nav-lf">
                <ul id="nav">
                    <?php
                    $i = 1;
                    foreach ($categoryParentData as $categoryParent)
                    {
                        ?>
                        <li <?= $i == 1 ? 'class="current"' : '';?>><a href="javascript:void(0);"><?= $categoryParent['name']; ?></a></li>
                        <!--<li><a href="#st2">铂金饰品</a></li>
                        <li><a href="#st3">K金饰品</a></li>
                        <li><a href="#st4">镶嵌饰品</a></li>
                        <li><a href="#st5">裸钻</a></li>-->
                        <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
            <div class="right-container">
                <?php
                $j = 1;
                foreach ($categoryParentData as $categoryParent)
                {
                    ?>
                    <div class="u-pro-list" <?= $j == 1 ? '' : 'style="display:none"' ?>>
                        <div class="u-pro-title" id="st<?= $j;?>"><?= $categoryParent['name'];?></div>
                        <ul class="clearfix">
                            <?php
                            foreach ($categoryData as $category)
                            {
                                if ($category['parent_id'] == $categoryParent['category_id'])
                                {
                                    ?>
                                    <li>
                                        <a href="./product/list?category=<?= $category['category_id'];?>">
                                            <img src="http://cadmin.iddmall.com/image/<?= $category['image']; ?>">
                                            <p class="b_goods_name"><?= $category['name']; ?></p>
                                        </a>
                                    </li>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                    $j++;
                }
                ?>
            </div>
        </div>
<script>
    $(function(){

        var $nav_li =$("#nav li");

        $nav_li.click(function(){

            $(this).addClass("current").siblings().removeClass("current");

            var index =  $nav_li.index(this);

            $(".u-pro-list").eq(index).show().siblings().hide();

        }).hover(function(){

            $(this).addClass("hover");

        },function(){

            $(this).removeClass("hover");

        });
    });
</script>
<?php
echo $this->render('@app/views/layouts/_footer');
?>
