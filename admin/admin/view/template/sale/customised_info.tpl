<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="#" data-toggle="tooltip" title="取消" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $heading_title; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-order" data-toggle="tab">定制详细</a></li>
                    <li><a href="#tab-history" data-toggle="tab">反馈记录</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-order">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width:215px;">定制号：</td>
                                <td>#<?php echo $customiseds['customised_id']; ?></td>
                            </tr>
                            <tr>
                                <td>用户姓名：</td>
                                <td><?php echo $customiseds['lastname'].$customiseds['firstname'];?></td>
                            </tr>
                            <tr>
                                <td>商品名称：</td>
                                <td><?php echo $customiseds['product_name']; ?></td>
                            </tr>
                            <tr>
                                <td>商品类型：</td>
                                <td><?php echo $customiseds['product_type']; ?></td>
                            </tr>
                            <tr>
                                <td>采购数量</td>
                                <td><?php echo $customiseds['number']; ?></td>
                            </tr>
                            <tr>
                                <td>商品图片</td>
                                <td><img src="<?php echo $customiseds['image']; ?>"></td>
                            </tr>
                            <tr>
                                <td>商品描述</td>
                                <td><?php echo htmlspecialchars_decode($customiseds['description']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-history">
                        <table class="table table-bordered" id="message_record">
                            <tr>
                                <td>反馈ID</td>
                                <td>反馈用户</td>
                                <td>反馈标题</td>
                                <td>反馈内容</td>
                                <td>反馈时间</td>
                            </tr>
                            <?php
                            if (isset($messages) && !empty($messages)){
                                foreach ($messages as $message){
                            ?>
                            <tr>
                                <td><?php echo $message['message_id'];?></td>
                                <td><?php echo $message['name'] ? $message['name'] : 'ADMIN';?></td>
                                <td><?php echo $message['title'];?></td>
                                <td><?php echo $message['content'];?></td>
                                <td><?php echo $message['datetime'];?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                        <fieldset>
                            <legend>回复</legend>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-order-status">标题</label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" id="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-comment">内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" rows="8"  class="form-control content"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="text-right">
                                <button id="button-history"  class="btn btn-primary"><i class="fa fa-plus-circle"></i> 提交</button>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#button-history').on('click',function(){
            var title = $('#title').val();
            var content = $('.content').val();
            var customised_id = "<?php echo $_GET['customised_id'];?>";
            var date = "<?php echo date('Y-m-d H:i:s');?>";
            if (title == ''){
                alert('请填写留言标题!');
            }
            else if (content == ''){
                alert('请填写留言内容!');
            }
            else{
                $.post("index.php?route=sale/customised/add&token=<?php echo $token;?>",{title:title,content:content,customised_id:customised_id},function(data){
                    if(data.status == 'success')
                    {
                        $('#title').val('');
                        $('.content').val('');
                        $('#message_record').append('<tr><td>'+ data.message +'</td><td>ADMIN</td><td>'+ title +'</td><td>'+ content +'</td><td>'+ date +'</td></tr>');
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
</div>
<?php echo $footer; ?>