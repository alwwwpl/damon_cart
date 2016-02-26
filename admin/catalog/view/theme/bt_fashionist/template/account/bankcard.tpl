<?php echo $header; ?>
<style>
    #myModal input, #myModal select { width: 95%;}
</style>
<div class="container">
    <div class="row">
        <div class="bt-breadcrumb">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <h1 style="margin-top:0"><?php echo $heading_title; ?></h1>
            <div class="content_bg">
                <div style="margin-bottom: 10px;">
                    <span style="float: left; line-height: 40px;"><?php echo $text_total; ?> <b><?php echo $total; ?></b></span>
                    <button style="float: right;"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">添加</button>
                    <br><br>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-center"><?php echo $column_bank_card_id; ?></td>
                            <td class="text-center"><?php echo $column_username; ?></td>
                            <td class="text-center"><?php echo $column_bank; ?></td>
                            <td class="text-center"><?php echo $column_card_number; ?></td>
                            <td class="text-center"><?php echo $column_create_time; ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($bankcards) { ?>
                        <?php foreach ($bankcards  as $bankcard) { ?>
                        <tr>
                            <td class="text-center"><?php echo $bankcard['bank_card_id']; ?></td>
                            <td class="text-center"><?php echo $bankcard['username']; ?></td>
                            <td class="text-center"><?php echo $bankcard['bank']; ?></td>
                            <td class="text-center"><?php echo $bankcard['card_number']; ?></td>
                            <td class="text-center"><?php echo $bankcard['create_time']; ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td class="text-center" colspan="5"><?php echo $text_empty; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
                <div class="buttons clearfix">
                    <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
                </div>
            </div>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="left: 500px; top: 10%;">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 500px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="margin: 10px 0px;">添加银行卡</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">持卡人:</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $lastname;?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">所属银行</label>
                        <select class="form-control" name="bank" id="bank">
                            <option value="中国农业银行">中国农业银行</option>
                            <option value="中国工商银行">中国工商银行</option>
                            <option value="中国建设银行">中国建设银行</option>
                            <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                            <option value="中国银行">中国银行</option>
                            <option value="招商银行">招商银行</option>
                            <option value="交通银行">交通银行</option>
                            <option value="浦发银行">浦发银行</option>
                            <option value="中国光大银行">中国光大银行</option>
                            <option value="平安银行">平安银行</option>
                            <option value="中国民生银行">中国民生银行</option>
                            <option value="华夏银行">华夏银行</option>
                            <option value="广发银行">广发银行</option>
                            <option value="兴业银行">兴业银行</option>
                            <option value="微商银行">微商银行</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">银行卡号:</label>
                        <input type="number" class="form-control" id="card_number" name="card_number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary bankcard-submit">保存</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.bankcard-submit').on('click',function(){
        var bank = $('#bank').val();
        var card = $('#card_number').val();
        var name = $('#username').val();
        if (name == ''){
            alert('请完善个人信息后再添加！');
        }else if (bank == ''){
            alert('请选择发卡银行！');
        }
        else if (card == ''){
            alert('请输入银行卡号！');
        }
        else {
            $.post('./index.php?route=account/bankcard/addcard',{username:name,bank:bank,card_number:card},function(data){
                if (data.status == 'success')
                {
                    $('#card_number').val('');
                    $('#myModal').modal('toggle');
                }
                else {
                    alert(data.status);
                }
            },'json');
        }

    });
</script>
<?php echo $footer; ?>