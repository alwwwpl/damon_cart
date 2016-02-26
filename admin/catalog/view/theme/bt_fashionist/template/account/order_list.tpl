<?php echo $header; ?>
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
      <?php if ($orders) { ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-center"><?php echo $column_order_id; ?></td>
                <td class="text-center"><?php echo $column_customer; ?></td>
                <td class="text-center"><?php echo $column_product; ?></td>
                <td class="text-center"><?php echo $column_total; ?></td>
                <td class="text-center"><?php echo $column_status; ?></td>
                <td class="text-center"><?php echo $column_date_added; ?></td>
                <td class="text-center">操作</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order) { ?>
            <tr>
              <td class="text-center">#<?php echo $order['order_id']; ?></td>
                <td class="text-center"><?php echo $order['name']; ?></td>
                <td class="text-center"><?php echo $order['products']; ?></td>
                <td class="text-center"><?php echo $order['total']; ?></td>
                <td class="text-center"><?php echo $order['status']; ?></td>
                <td class="text-center"><?php echo $order['date_added']; ?></td>
                <td class="text-center">
                    <a href="<?php echo $order['href']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn-info">
                        <i class="fa fa-eye"></i>
                    </a>
                    <?php if ($order['status'] == '已发货'){ ?>
                    <a href="javascript:void(0)" class="confirm" data-order="<?php echo $order['order_id'];?>" data-distribute="<?php echo $order['distribute_id'];?>" title="确认收货" style="margin-left: 10px;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                    <?php }?>
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="text-right"><?php echo $pagination; ?></div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script>
    $('.confirm').on('click',function(){
        var order_id = $(this).attr('data-order');
        var distribute_id = $(this).attr('data-distribute');
        $.post('./index.php?route=account/order/confirm',{order_id:order_id,distribute_id:distribute_id},function(data){
            if (data == 'success')
            {
                alert('操作成功!');
                history.go(0);
            }
        });
    });
</script>
<?php echo $footer; ?>