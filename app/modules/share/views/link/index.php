<?php

$this->title = '达蒙商城-推广链接';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .agent-status span {
        cursor: pointer;
    }
</style>
<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3>推广链接</h3>
                </div>
                <?php

                foreach ($data as $val)
                {
                ?>
                <div>
                    <div class="jumbotron">
                        <div class="container">
                            <h2><?php echo $val['title'];?></h2><br><br>
                            <p><?php echo $val['url'];?></p><br>
                            <p><a class="btn btn-primary btn-lg" target="_blank" href="<?php echo $href.$val['urlcode'];?>" role="button">点击查看二维码</a></p>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


