<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-qrcodeweipay" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
			  <div class="panel-body">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-qrcodeweipay" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $entry_key; ?>"><?php echo $entry_key; ?></span></label>
								<div class="col-sm-10">
								  <input type="text" name="qrcodeweipay_key" value="<?php echo $qrcodeweipay_key; ?>" placeholder="<?php echo $entry_key; ?>" id="input-key" class="form-control" />
								  <?php if ($error_key) { ?>
								  <div class="text-danger"><?php echo $error_key; ?></div>
								  <?php } ?>
								</div>
			        </div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $entry_appid; ?>"><?php echo $entry_appid; ?></span></label>
								<div class="col-sm-10">
								  <input type="text" name="qrcodeweipay_appid" value="<?php echo $qrcodeweipay_appid; ?>" placeholder="<?php echo $entry_appid; ?>" id="input-appid" class="form-control" />
								  <?php if ($error_appid) { ?>
								  <div class="text-danger"><?php echo $error_appid; ?></div>
								  <?php } ?>
								</div>
			        </div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $entry_mchid; ?>"><?php echo $entry_mchid; ?></span></label>
								<div class="col-sm-10">
								  <input type="text" name="qrcodeweipay_mchid" value="<?php echo $qrcodeweipay_mchid; ?>" placeholder="<?php echo $entry_mchid; ?>" id="input-mchid" class="form-control" />
								  <?php if ($error_mchid) { ?>
								  <div class="text-danger"><?php echo $error_mchid; ?></div>
								  <?php } ?>
								</div>
			        </div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $entry_appsecret; ?>"><?php echo $entry_appsecret; ?></span></label>
								<div class="col-sm-10">
								  <input type="text" name="qrcodeweipay_appsecret" value="<?php echo $qrcodeweipay_appsecret; ?>" placeholder="<?php echo $entry_appsecret; ?>" id="input-appsecret" class="form-control" />
								  <?php if ($error_appsecret) { ?>
								  <div class="text-danger"><?php echo $error_appsecret; ?></div>
								  <?php } ?>
								</div>
			        </div>
							<div class="form-group">
							  <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
							  <div class="col-sm-10">
							    <select name="qrcodeweipay_order_status_id" id="input-order-status" class="form-control">
							      <?php foreach ($order_statuses as $order_status) { ?>
							      <?php if ($order_status['order_status_id'] == $qrcodeweipay_order_status_id) { ?>
							      <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
							      <?php } else { ?>
							      <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
							      <?php } ?>
							      <?php } ?>
							    </select>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
							  <div class="col-sm-10">
							    <select name="qrcodeweipay_status" id="input-status" class="form-control">
							      <?php if ($qrcodeweipay_status) { ?>
							      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							      <option value="0"><?php echo $text_disabled; ?></option>
							      <?php } else { ?>
							      <option value="1"><?php echo $text_enabled; ?></option>
							      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
							      <?php } ?>
							    </select>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
							  <div class="col-sm-10">
							    <input type="text" name="qrcodeweipay_sort_order" value="<?php echo $qrcodeweipay_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-2"></label>
							  <div class="col-sm-10">
			          	使用注意已经存在CNY的人民币汇率设置。Code为CNY
							  </div>
							</div>
			    </form>
			  </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 