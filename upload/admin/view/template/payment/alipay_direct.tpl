<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-cod" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cod" class="form-horizontal">
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="alipay_direct_hezuozhe_id"><span data-toggle="tooltip" title="<?php echo $entry_hezuozhe_id_help; ?>"><?php echo $entry_hezuozhe_id; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="alipay_direct_hezuozhe_id" value="<?php echo $alipay_direct_hezuozhe_id; ?>" placeholder="<?php echo $entry_hezuozhe_id_help; ?>" id="alipay_direct_hezuozhe_id" class="form-control" />
              <?php if ($error_alipay_direct_hezuozhe_id) { ?>
              	<div class="text-danger"><?php echo $error_alipay_direct_hezuozhe_id; ?></div>
              <?php } ?>
            </div>
          </div>
          
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="alipay_direct_zhifubao_account"><?php echo $entry_zhifubao_account; ?></label>
            <div class="col-sm-10">
              <input type="text" name="alipay_direct_zhifubao_account" value="<?php echo $alipay_direct_zhifubao_account; ?>" placeholder="<?php echo $entry_zhifubao_account; ?>" id="alipay_direct_zhifubao_account" class="form-control" />
              <?php if ($error_alipay_direct_zhifubao_account) { ?>
              	<div class="text-danger"><?php echo $error_alipay_direct_zhifubao_account; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="alipay_direct_cod"><span data-toggle="tooltip" title="<?php echo $entry_cod_help; ?>"><?php echo $entry_cod; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="alipay_direct_cod" value="<?php echo $alipay_direct_cod; ?>" placeholder="<?php echo $entry_cod_help; ?>" id="alipay_direct_cod" class="form-control" />
              <?php if ($error_alipay_direct_cod) { ?>
              	<div class="text-danger"><?php echo $error_alipay_direct_cod; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
            <div class="col-sm-10">
              <select name="alipay_direct_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $alipay_direct_order_status_id) { ?>
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
              <select name="alipay_direct_status" id="input-status" class="form-control">
                <?php if ($alipay_direct_status) { ?>
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
            <label class="col-sm-2 control-label" for="alipay_direct_sort_order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="alipay_direct_sort_order" value="<?php echo $alipay_direct_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="alipay_direct_sort_order" class="form-control" />
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 