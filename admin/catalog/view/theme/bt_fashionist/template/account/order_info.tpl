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
            <h2><?php echo $heading_title; ?></h2>
            <div class="content_bg">
                <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php } ?>
                <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php } ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-left" colspan="2"><?php echo $text_order_detail; ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left" style="width: 50%;"><?php if ($invoice_no) { ?>
                            <b><?php echo $text_invoice_no; ?></b> <?php echo $invoice_no; ?><br />
                            <?php } ?>
                            <b><?php echo $text_order_id; ?></b> #<?php echo $order_id; ?><br />
                            <b><?php echo $text_date_added; ?></b> <?php echo $date_added; ?></td>
                        <td class="text-left"><?php if ($payment_method) { ?>
                            <b><?php echo $text_payment_method; ?></b> <?php echo $payment_method; ?><br />
                            <?php } ?>
                            <?php if ($shipping_method) { ?>
                            <b><?php echo $text_shipping_method; ?></b> <?php echo $shipping_method; ?>
                            <?php } ?></td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-left" style="width: 50%;"><?php echo $text_payment_address; ?></td>
                        <?php if ($shipping_address) { ?>
                        <td class="text-left"><?php echo $text_shipping_address; ?></td>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left"><?php echo $payment_address; ?></td>
                        <?php if ($shipping_address) { ?>
                        <td class="text-left"><?php echo $shipping_address; ?></td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left"><?php echo $column_name; ?></td>
                            <td class="text-center"><?php echo $column_model; ?></td>
                            <td class="text-center"><?php echo $column_quantity; ?></td>
                            <td class="text-center"><?php echo $column_price; ?></td>
                            <td class="text-center"><?php echo $column_total; ?></td>
                            <?php if (!$parent){ ?>
                            <td class="text-center">状态</td>
                            <td class="text-right">物流</td>
                            <?php } ?>
                            <?php if ($products) { ?>
                            <td style="width: 20px;"></td>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product) { ?>
                        <tr>
                            <td class="text-left"><?php echo $product['name']; ?>
                                <?php foreach ($product['option'] as $option) { ?>
                                <br />
                                &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                                <?php } ?></td>
                            <td class="text-left"><?php echo $product['model']; ?></td>
                            <td class="text-center"><?php echo $product['quantity']; ?></td>
                            <td class="text-center"><?php echo $product['price']; ?></td>
                            <td class="text-center"><?php echo $product['total']; ?></td>
                            <?php if (!$parent){ ?>
                            <td class="text-center"><?php echo $product['status']; ?></td>
                            <td class="text-center"><?php echo $product['express'] ? $product['express'] : '-'; ?></td>
                            <?php } ?>
                            <td class="text-right" style="white-space: nowrap;">
                                <a href="<?php echo $product['return']; ?>" data-toggle="tooltip" title="<?php echo $button_return; ?>" class="btn btn-return">
                                    <i class="fa fa-reply"></i>
                                </a>
                                <?php if ($product['status'] == '已发货' && !$parent) { ?>
                                <a href="javascript:void(0);" data-proid="<?php echo $product['product_id']; ?>" data-orderid="<?php echo $_GET['order_id']; ?>" title="确认收货" class="btn confirm">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php foreach ($vouchers as $voucher) { ?>
                        <tr>
                            <td class="text-left"><?php echo $voucher['description']; ?></td>
                            <td class="text-left"></td>
                            <td class="text-right">1</td>
                            <td class="text-right"><?php echo $voucher['amount']; ?></td>
                            <td class="text-right"><?php echo $voucher['amount']; ?></td>
                            <?php if ($products) { ?>
                            <td></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <?php foreach ($totals as $total) { ?>
                        <tr>
                            <td colspan="<?php echo $parent ? 3 : 5; ?>"></td>
                            <td class="text-right"><b><?php echo $total['title']; ?></b></td>
                            <td class="text-right"><?php echo $total['text']; ?></td>
                            <?php if ($products) { ?>
                            <td></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        </tfoot>
                    </table>
                </div>
                <?php if ($comment) { ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-left"><?php echo $text_comment; ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left"><?php echo $comment; ?></td>
                    </tr>
                    </tbody>
                </table>
                <?php } ?>
                <?php if ($histories) { ?>
                <h3><?php echo $text_history; ?></h3>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-left"><?php echo $column_date_added; ?></td>
                        <td class="text-left"><?php echo $column_status; ?></td>
                        <td class="text-left"><?php echo $column_comment; ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($histories as $history) { ?>
                    <tr>
                        <td class="text-left"><?php echo $history['date_added']; ?></td>
                        <td class="text-left"><?php echo $history['status']; ?></td>
                        <td class="text-left"><?php echo $history['comment']; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
        var order_id = $(this).attr('data-orderid');
        var product_id = $(this).attr('data-proid');
        var status = '已完成';
        if (order_id && product_id){
            $.post('./index.php?route=account/order/productconfirm',{order_id:order_id,product_id:product_id,status:status},function(data){
                if (data == 'success'){
                    alert('成功！');
                    history.go(0)
                }
                else if(data == 'login') {
                    alert('请先登录！');
                    history.go(0)
                }
                else {
                    alert('操作失败! ');
                }
            });
        }
    });
</script>
<?php echo $footer; ?>