<?php echo $header; ?>
<style>
    .table thead tr td {
        background-color: #F9F9F9;
        color: #555;
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
                <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
                <?php } ?>
                <?php if ($error_warning) { ?>
                <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
                <?php } ?>
                <?php if ($customiseds) { ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <td class="text-center" style="width: 60px;"><?php echo $column_image; ?></td>
                            <td class="text-center"><?php echo $column_name; ?></td>
                            <td class="text-center"><?php echo $column_model; ?></td>
                            <td class="text-center"><?php echo $column_brand; ?></td>
                            <td class="text-center"><?php echo $column_quantity; ?></td>
                            <td class="text-center" style="width: 80px;"><?php echo $column_status; ?></td>
                            <td class="text-center" style="width: 100px;"><?php echo $column_date_added; ?></td>
                            <td class="text-center" style="width: 60px;"><?php echo $column_action; ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customiseds as $customised) { ?>
                        <tr>
                            <td class="text-center"><img src="./<?php echo $customised['image']; ?>" style="width:60px; height: 60px;"></td>
                            <td class="text-center" style="line-height: 60px;"><?php echo $customised['name']; ?></td>
                            <td class="text-center" style="line-height: 60px;"><?php echo $customised['product_type']; ?></td>
                            <td class="text-center" style="line-height: 60px;"><?php echo $customised['product_brand']; ?></td>
                            <td class="text-center" style="line-height: 60px;"><?php echo $customised['number']; ?></td>
                            <td class="text-center" style="line-height: 60px;"><?php if ($customised['status'] == 0){echo '待处理';}elseif ($customised['status'] == 1){echo '成功';}elseif ($customised['status'] == 2){echo '处理中';}elseif ($customised['status'] == 3){echo '失败';} ?></td>
                            <td class="text-center" style="line-height: 60px;"><?php echo $customised['date_added']; ?></td>
                            <td class="text-center" style="line-height: 60px;"><a href="<?php echo $customised['href']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn-info"><i class="fa fa-eye"></i></a></td>
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
                    <div class="pull-right" style="margin-right: 10px;"><a href="index.php?route=account/customised/add" class="btn btn-primary">我要订制</a></div>
                </div>
            </div>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>