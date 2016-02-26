<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo $add; ?>" data-toggle="tooltip" title="添加" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            <button type="button" data-toggle="tooltip" title="删除" class="btn btn-danger" onclick="confirm('确定要删除选中项?') ? $('#form-customer').submit() : false;"><i class="fa fa-trash-o"></i></button>
        </div>
        <h1>金价管理</h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>">金价管理</a></li>
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
            <h3 class="panel-title"><i class="fa fa-list"></i> 金价列表</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                            <td class="text-left"><?php if ($sort == 'g.gold_category_id') { ?>
                                <a href="<?php echo $sort_gold_category_id; ?>" class="<?php echo strtolower($order); ?>">类别</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_gold_category_id; ?>">类别</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.latest') { ?>
                                <a href="<?php echo $sort_latest; ?>" class="<?php echo strtolower($order); ?>">最新价</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_latest; ?>">最新价</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.opening') { ?>
                                <a href="<?php echo $sort_opening; ?>" class="<?php echo strtolower($order); ?>">开盘价</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_opening; ?>">开盘价</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.highest') { ?>
                                <a href="<?php echo $sort_highest; ?>" class="<?php echo strtolower($order); ?>">最高价</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_highest; ?>">最高价</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.lowest') { ?>
                                <a href="<?php echo $sort_lowest; ?>" class="<?php echo strtolower($order); ?>">最低价</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_lowest; ?>">最低价</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.yesterday') { ?>
                                <a href="<?php echo $sort_yesterday; ?>" class="<?php echo strtolower($order); ?>">昨收价</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_yesterday; ?>">昨收价</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.upsdowns') { ?>
                                <a href="<?php echo $sort_upsdowns; ?>" class="<?php echo strtolower($order); ?>">涨跌幅</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_upsdowns; ?>">涨跌幅</a>
                                <?php } ?></td>
                            <td class="text-left"><?php if ($sort == 'g.datetime') { ?>
                                <a href="<?php echo $sort_datetime; ?>" class="<?php echo strtolower($order); ?>">日期</a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_datetime; ?>">日期</a>
                                <?php } ?></td>
                            <td class="text-right">操作</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($golds) { ?>
                        <?php foreach ($golds as $gold) { ?>
                        <tr>
                            <td class="text-center"><?php if (in_array($gold['gold_id'], $selected)) { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $gold['gold_id']; ?>" checked="checked" />
                                <?php } else { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $gold['gold_id']; ?>" />
                                <?php } ?></td>
                            <td class="text-left"><?php echo $gold['gold_category']; ?></td>
                            <td class="text-left"><?php echo $gold['latest']; ?></td>
                            <td class="text-left"><?php echo $gold['opening']; ?></td>
                            <td class="text-left"><?php echo $gold['highest']; ?></td>
                            <td class="text-left"><?php echo $gold['lowest']; ?></td>
                            <td class="text-left"><?php echo $gold['yesterday']; ?></td>
                            <td class="text-left"><?php echo $gold['upsdowns']; ?></td>
                            <td class="text-left"><?php echo $gold['datetime']; ?></td>
                            <td class="text-right">
                                <a href="<?php echo $gold['edit']; ?>" data-toggle="tooltip" title="修改" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo $gold['delete']; ?>" data-toggle="tooltip" title="删除" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
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
