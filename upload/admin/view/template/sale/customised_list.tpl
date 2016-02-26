<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="button" data-toggle="tooltip" title="删除" class="btn btn-danger" onclick="confirm('确定要删除选中项?') ? $('#form-customer').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>定制管理</h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>">定制管理</a></li>
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
                <h3 class="panel-title"><i class="fa fa-list"></i> 定制列表</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                <td class="text-left"><?php if ($sort == 'c.customised_id') { ?>
                                    <a href="<?php echo sort_customised_id; ?>" class="<?php echo strtolower($order); ?>">定制ID</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_customised_id; ?>">定制ID</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'cc.lastname') { ?>
                                    <a href="<?php echo sort_lastname; ?>" class="<?php echo strtolower($order); ?>">客户</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_lastname; ?>">客户</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'c.product_name') { ?>
                                    <a href="<?php echo sort_product_name; ?>" class="<?php echo strtolower($order); ?>">商品名称</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_product_name; ?>">商品名称</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'c.product_type') { ?>
                                    <a href="<?php echo sort_product_type; ?>" class="<?php echo strtolower($order); ?>">商品类型</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_product_type; ?>">商品类型</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'c.product_brand') { ?>
                                    <a href="<?php echo sort_product_brand; ?>" class="<?php echo strtolower($order); ?>">商品品牌</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_product_brand; ?>">商品品牌</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'c.number') { ?>
                                    <a href="<?php echo sort_number; ?>" class="<?php echo strtolower($order); ?>">采购数量</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_number; ?>">采购数量</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'c.status') { ?>
                                    <a href="<?php echo sort_status; ?>" class="<?php echo strtolower($order); ?>">状态</a>
                                    <?php } else { ?>
                                    <a href="<?php echo sort_status; ?>">状态</a>
                                    <?php } ?></td>
                                <td class="text-left"><?php if ($sort == 'c.datetime') { ?>
                                    <a href="<?php echo $sort_datetime; ?>" class="<?php echo strtolower($order); ?>">日期</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_datetime; ?>">日期</a>
                                    <?php } ?></td>
                                <td class="text-right">操作</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($customiseds) { ?>
                            <?php foreach ($customiseds as $customised) { ?>
                            <tr>
                                <td class="text-center"><?php if (in_array($customised['customised_id'], $selected)) { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $gold['customised_id']; ?>" checked="checked" />
                                    <?php } else { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $gold['customised_id']; ?>" />
                                    <?php } ?></td>
                                <td class="text-left"><?php echo $customised['customised_id']; ?></td>
                                <td class="text-left"><?php echo $customised['lastname'].$customised['firstname']; ?></td>
                                <td class="text-left"><?php echo $customised['product_name']; ?></td>
                                <td class="text-left"><?php echo $customised['product_type']; ?></td>
                                <td class="text-left"><?php echo $customised['product_brand']; ?></td>
                                <td class="text-left"><?php echo $customised['number']; ?></td>
                                <td class="text-left"><?php echo $customised['status']; ?></td>
                                <td class="text-left"><?php echo $customised['datetime']; ?></td>
                                <td class="text-right">
                                    <a href="<?php echo $customised['info']; ?>" data-toggle="tooltip" title="查看" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <!--<a href="<?php echo $customised['edit']; ?>" data-toggle="tooltip" title="修改" class="btn btn-primary"><i class="fa fa-pencil"></i></a>-->
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
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
