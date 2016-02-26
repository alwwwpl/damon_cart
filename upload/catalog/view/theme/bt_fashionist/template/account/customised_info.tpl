<?php echo $header; ?>
<style>
    .demo { width:620px;
        margin-top:10px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="bt-breadcrumb">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>"> <?php echo $content_top; ?>
            <h2><?php echo $text_add; ?></h2>
            <div class="content_bg">
            <?php
            if(isset($customiseds) && !empty($customiseds))
            {
            ?>
                <table class="table table-striped">
                    <tr>
                        <td style="width: 80px;">图片</td>
                        <td>名称</td>
                        <td>类型</td>
                        <td>品牌</td>
                        <td>数量</td>
                    </tr>
                    <tr>
                        <td style="width:100px;"><img src="<?php echo $customiseds['image']; ?>" height="80" width="80"></td>
                        <td><?php echo $customiseds['product_name']; ?></td>
                        <td><?php echo $customiseds['product_type']; ?></td>
                        <td><?php echo $customiseds['product_brand']; ?></td>
                        <td><?php echo $customiseds['number']; ?></td>
                    </tr>
                </table>
                <div>
                    <span style="width:100px; float: left; margin-left:10px;">描述</span>
                    <span style="width:90%; float: left;"><?php echo htmlspecialchars_decode($customiseds['description']); ?></span>
                </div>

                <br><br><br><br><p><h2>反馈记录</h2></p>

                <table class="table table-striped" id="message_record">
                    <tr>
                        <td>标题</td>
                        <td>内容</td>
                        <td>时间</td>
                    </tr>
                    <?php
                    if (!empty($messages))
                    {
                        foreach ($messages as $message)
                        {
                    ?>
                    <tr>
                        <td><?php echo $message['title'];?></td>
                        <td><?php echo htmlspecialchars_decode($message['content']); ?></td>
                        <td><?php echo $message['datetime'];?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <br><br><br><p><h2>发布留言</h2></p>
                <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-1 control-label"><?php echo $add_customised_name;?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" name="title" id="title"  placeholder="">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-1 control-label">留言内容</label>
                        <div class="col-sm-11">
                            <textarea class="form-control content" rows="2" name="content"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label"></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-default submit" name="submit">提交</button>
                            <a href="#" style="margin-left:30px; background-color: #E6E6E6; color:#555;" class="btn btn-default" name="comeback">返回</a>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>
            </div>
            <?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>
</div>
<script>
    $('.submit').on('click',function(){
        var title = $('#title').val();
        var content = $('.content').val();
        var customised_id = "<?php echo $data['customised_id'];?>";
        var date = '<?php echo date('Y-m-d H:i:s');?>';
        if (title == ''){
            alert('请填写留言标题!');
        }
        else if (content == ''){
            alert('请填写留言内容!');
        }
        else{
            $.post("./index.php?route=account/customised/insertmessage",{title:title,content:content,customised_id:customised_id},function(data){
                if(data.status == 'success')
                {
                    $('#title').val('');
                    $('.content').val('');
                    $('#message_record').append('<tr><td>'+ title +'</td><td>'+ content +'</td><td>'+ date +'</td></tr>');
                    alert('添加成功!');
                }
                else
                {
                    if(data.title)
                    {
                        alert(data.title);
                    }
                    else if (data.content)
                    {
                        alert(data.content);
                    }
                }
            },'json');
        }
    });
</script>
<?php echo $footer; ?>