<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-customer" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                        class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
                   class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $heading_title; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if (isset($error_warning)) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-general">
                        <div class="row">
                            <div class="col-sm-2">
                                <ul class="nav nav-pills nav-stacked" id="address">
                                    <li class="active"><a href="#tab-customer" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-10">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-customer">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-customer-group">所属类别</label>
                                            <div class="col-sm-10">
                                                <select name="gold_category_id" id="input-gold_category" class="form-control">
                                                    <?php foreach ($gold_categorys as $gold_category) { ?>
                                                    <?php if ($gold_category['gold_category_id'] == $gold_category_id) { ?>
                                                    <option value="<?php echo $gold_category['gold_category_id']; ?>" selected="selected"><?php echo $gold_category['name']; ?></option>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $gold_category['gold_category_id']; ?>"><?php echo $gold_category['name']; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-firstname">最新价</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="latest" value="<?php echo $latest; ?>" id="input-latest" class="form-control"/>
                                                <?php if (isset($error_latest)) { ?>
                                                <div class="text-danger"><?php echo $error_latest; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-lastname">开盘价</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="opening" value="<?php echo $opening; ?>" id="input-opening" class="form-control"/>
                                                <?php if (isset($error_opening)) { ?>
                                                <div class="text-danger"><?php echo $error_opening; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-email">最高价</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="highest" value="<?php echo $highest; ?>" id="input-highest" class="form-control"/>
                                                <?php if (isset($error_highest)) { ?>
                                                <div class="text-danger"><?php echo $error_highest; ?></div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-telephone">最低价</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="lowest" value="<?php echo $lowest; ?>" id="input-lowest" class="form-control"/>
                                                <?php if (isset($error_lowest)) { ?>
                                                <div class="text-danger"><?php echo $error_lowest; ?></div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-fax">昨收价</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="yesterday" value="<?php echo $yesterday; ?>"  id="input-yesterday" class="form-control"/>
                                                <?php if (isset($error_yesterday)) { ?>
                                                <div class="text-danger"><?php echo $error_yesterday; ?></div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-fax">涨跌幅</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="upsdowns" value="<?php echo $upsdowns; ?>"  id="input-upsdowns" class="form-control"/>
                                                <?php if (isset($error_upsdowns)) { ?>
                                                <div class="text-danger"><?php echo $error_upsdowns; ?></div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-fax">所属日期</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="datetime" value="<?php echo $datetime; ?>"  id="input-datetime" class="form-control"/>
                                                <?php if (isset($error_datetime)) { ?>
                                                <div class="text-danger"><?php echo $error_datetime; ?></div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>