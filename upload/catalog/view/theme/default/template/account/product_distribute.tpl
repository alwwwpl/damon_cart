<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <p><?php echo $text_description; ?></p>
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-code"><?php echo $entry_code; ?></label>
          <div class="col-sm-10">
            <textarea cols="40" rows="5" placeholder="<?php echo $entry_code; ?>" id="input-code" class="form-control"><?php echo $code; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-generator"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
          <div class="col-sm-10">
            <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-prodcut" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-generator"><span data-toggle="tooltip" title="<?php echo $help_price; ?>"><?php echo $entry_price; ?></span></label>
          <div class="col-sm-10">
            <input type="text" name="price" value="" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
          </div>
        </div>
      </form>
      <div class="buttons clearfix">
        <div class="col-sm-10 col-"><a href="<?php echo $button_add; ?>" class="btn btn-primary"><?php echo $button_add; ?></a></div>
      </div>
  
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>商品</th>
            <th>商品价格</th>
            <th>分销价格</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php foreach($product_distributes as $product_distribute){ ?>
            <td><?php echo $product_distribute['name'] ?></td>
            <td><?php echo $product_distribute['price'] ?></td>
            <td><?php echo $product_distribute['distribute_price'] ?></td>
            <td>
              <a href="<?php echo $product_distribute['update']; ?>" class="btn btn-info"><?php echo $button_edit; ?></a> &nbsp; 
              <a href="<?php echo $product_distribute['delete']; ?>" class="btn btn-danger"><?php echo $button_delete; ?></a>
            </td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: 'index.php?route=affiliate/tracking/autocomplete&filter_name=' +  encodeURIComponent(request),
            dataType: 'json',           
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['name'],
                        value: item['link']
                    }
                }));
            }
        });
    },
    'select': function(item) {
        $('input[name=\'product\']').val(item['label']);
        $('textarea[name=\'link\']').val(item['value']);    
    }   
});
//--></script> 
<?php echo $footer; ?>