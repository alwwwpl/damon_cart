<?php
$this->title = '商品列表';
echo $this->render('@app/views/layouts/_header');
?>
<div class="ca-main-two clearfix">
    <div class="ca-details openwebview clearfix">
        <div class="pxui-content clearfix">
            <div>
                <?php
                function tree($directory)
                {
                    $mydir = dir($directory);
                    echo "<ul>\n";
                    while($file = $mydir->read())
                    {
                        if((is_dir("$directory/$file")) && ($file!=".") && ($file!=".."))
                        {
//                            echo "<li><font color='#ff00cc'><b>$file</b></font></li>\n";
                            tree("$directory/$file");
                        }
                        elseif ($file  !="." && $file != "..")
                        {
//                            $file = iconv("gb2312","utf-8",$file);
                            ?>
                            <a href="javascript:void(0)">
                                <div class="img160" style="background-image: none;"><img src="<?= $directory ?>/<?= $file ?>"></div>
                                <span class="name" style="height: 60px; line-height: 30px; font-size: 24px;"><?= explode('_',explode('.',$file)[0])[0].'_'.explode('_',explode('.',$file)[0])[1] ?></span>
                                <span class="price">￥237.6/g</span>
                            </a>
                            <?php
                        }
                    }
                    echo "</ul>\n";
                    $mydir->close();
                }
                //开始运行
                tree("img/product");
                ?>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->render('@app/views/layouts/_footer');
?>
