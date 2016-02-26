<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-coupon').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-coupon">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td style="width: 1px;" class="text-left"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                <td class="text-center"><?php if ($sort == 'coupons_name') { ?>
                                    <a href="<?php echo $sort_coupons_name; ?>" class="<?php echo strtolower($order); ?>">优惠券</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_coupons_name; ?>">优惠券</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'agent_name') { ?>
                                    <a href="<?php echo $sort_agent_name; ?>" class="<?php echo strtolower($order); ?>">代理商</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_agent_name; ?>">代理商</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'condition') { ?>
                                    <a href="<?php echo $sort_condition; ?>" class="<?php echo strtolower($order); ?>">金额</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_condition; ?>">金额</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'discount') { ?>
                                    <a href="<?php echo $sort_discount; ?>" class="<?php echo strtolower($order); ?>">折扣</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_discount; ?>">折扣</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'agent_percent') { ?>
                                    <a href="<?php echo $sort_agent_percent; ?>" class="<?php echo strtolower($order); ?>">代理商</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_agent_percent; ?>">占比(代理商)</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'system_percent') { ?>
                                    <a href="<?php echo $sort_system_percent; ?>" class="<?php echo strtolower($order); ?>">系统</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_system_percent; ?>">占比(商城)</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'start_time') { ?>
                                    <a href="<?php echo $sort_start_time; ?>" class="<?php echo strtolower($order); ?>">开始时间</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_start_time; ?>">开始时间</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php if ($sort == 'over_time') { ?>
                                    <a href="<?php echo $sort_over_time; ?>" class="<?php echo strtolower($order); ?>">结束时间</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_over_time; ?>">结束时间</a>
                                    <?php } ?></td>
                                <td class="text-center"><?php echo $column_action; ?></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($couponses) { ?>
                            <?php foreach ($couponses as $coupons) { ?>
                            <tr>
                                <td class="text-left"><?php if (in_array($coupons['coupons_id'], $selected)) { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $coupon['coupons_id']; ?>" checked="checked" />
                                    <?php } else { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $coupon['coupons_id']; ?>" />
                                    <?php } ?></td>
                                <td class="text-center"><?php echo $coupons['coupons_name']; ?></td>
                                <td class="text-center"><?php echo $coupons['agent_name']; ?></td>
                                <td class="text-center"><?php echo $coupons['condition']; ?></td>
                                <td class="text-center"><?php echo $coupons['discount']; ?></td>
                                <td class="text-center"><?php echo $coupons['agent_percent']; ?></td>
                                <td class="text-center"><?php echo $coupons['system_percent']; ?></td>
                                <td class="text-center"><?php echo $coupons['start_time']; ?></td>
                                <td class="text-center"><?php echo $coupons['over_time']; ?></td>
                                <td class="text-center">
                                    <a href="<?php echo $coupons['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>