<?php echo $header; ?>
<style>
    #getcash input, #getcash select, #getcash textarea { width: 95%;}
</style>
<div class="bt-breadcrumb">
<div class="container">
  <ul class="breadcrumb">
  <h2><?php echo $heading_title; ?></h2>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  </div>
</div>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
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
      <p><?php echo $text_total; ?> <b><?php echo $total; ?></b> &nbsp;&nbsp; 其中 <b><?php echo $cash;?></b>  可<a href="javascript:void(0);" class="btn-primary" data-toggle="modal" data-target="#getcash" data-whatever="@getbootstrap" id="withdraw">提现</a></p>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left"><?php echo $column_date_added; ?></td>
              <td class="text-left"><?php echo $column_description; ?></td>
              <td class="text-right"><?php echo $column_amount; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($transactions) { ?>
            <?php foreach ($transactions  as $transaction) { ?>
            <tr>
              <td class="text-left"><?php echo $transaction['date_added']; ?></td>
              <td class="text-left"><?php echo $transaction['description']; ?></td>
              <td class="text-right"><?php echo $transaction['amount']; ?></td>
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
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn"><?php echo $button_continue; ?></a></div>
      </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<div class="modal fade" id="getcash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="left: 500px; top: 10%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  style="width: 500px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="getcashLabel" style="margin: 10px 0px;">余额提现</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="inputPassword3">储蓄卡:</label>
                        <select class="form-control" id="bank_card">
                            <?php
                            if (!empty($cards))
                            {
                            foreach ($cards as $card)
                            {
                                echo '<option value="'.$card['card_number'].'" data-card-id="'.$card['bank_card_id'].'" data-username="'. $card['username'] .'" data-bank="'.$card['bank'].'">'.$card['bank'].' '.$card['card_number'].'</option>';
                            }
                            }
                            else
                            {
                                echo '<option value="0">请先添加银行卡</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">提现金额:</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="可提现金额<?php echo $cash;?>" data-cash="<?php echo substr($cash,4);?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3">提现密码:</label>
                        <input type="password" class="form-control" id="payment_password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3">备注:</label>
                        <textarea class="form-control" id="note"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary cashrecord-sumbit">确定</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#withdraw').on('click',function(){
        var withdraw = '<?php echo $withdraw;?>';
        if (!withdraw)
        {
            $.post('./index.php?route=account/transaction/iswithdraw',function(data){
                if (data.status == 'error')
                {
                    location.href = './index.php?route=account/edit';
                }
            },'json');
        }
    });

    $('#amount').on('blur',function(){
        var amount = $(this).val();
        var cash = $(this).attr('data-cash');
        if (amount > cash)
        {
            alert('金额不能大于帐户可用余额');
        }
        else if (amount <= 0)
        {
            alert('提现金额必须大于0元');
        }
    });

    $('.cashrecord-sumbit').on('click',function(){
        var bank_card = $('#bank_card').val();
        var card_id = $('#bank_card option:checked').attr("data-card-id");
        var username = $('#bank_card option:checked').attr("data-username");
        var bank = $('#bank_card option:checked').attr("data-bank");
        var note = $('#note').val();
        var amount = $('#amount').val();
        var payment_password = $('#payment_password').val();

        var cash = $('#amount').attr('data-cash');
        if (amount > cash)
        {
            alert('金额不能大于帐户可用余额');
        }
        else if (amount <= 0)
        {
            alert('提现金额必须大于0元');
        }
        else if (bank_card == ''){
            alert('请选择银行储蓄卡！');
        }
        else if (payment_password == ''){
            alert('请输入提现密码！');
        }
        else {
            $.post('./index.php?route=account/transaction/addcashrecord',{amount:amount,bank_card:bank_card,username:username,bank:bank,note:note,card_id:card_id,payment_password:payment_password},function(data){
                if (data.status == 'success')
                {
                    $('#payment_password').val('');
                    $('#getcash').modal('toggle');
                    history.go(0);
                }
                else {
                    alert(data.status);
                }
            },'json');
        }

    });
</script>
<?php echo $footer; ?>