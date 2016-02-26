<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-coupon" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-coupon" class="form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                    <?php if ($coupons_id) { ?>
                    <li><a href="#tab-history" data-toggle="tab">优惠券记录</a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-general">
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-coupons_name"><?php echo $entry_coupons_name; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="coupons_name" value="<?php echo $coupons_name; ?>" placeholder="<?php echo $entry_coupons_name; ?>" id="input-coupons_name" class="form-control" />
                                <?php if ($error_coupons_name) { ?>
                                <div class="text-danger"><?php echo $error_coupons_name; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-agent_id"><?php echo $entry_agent_id; ?></label>
                            <div class="col-sm-10">
                                <select name="agent_id" placeholder="<?php echo $entry_agent_id; ?>" id="input-agent_id" class="form-control" >
                                    <?php
                                    foreach($agents as $agent){
                                    ?>
                                    <option value="<?php echo $agent['agent_id'];?>" <?php if ($agent['agent_id'] == $agent_id){ echo 'selected';} ?>><?php echo $agent['username'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php if ($error_agent_id) { ?>
                                <div class="text-danger"><?php echo $error_agent_id; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-category"><?php echo $entry_product_category; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="category" value="" placeholder="<?php echo $entry_product_category; ?>" id="input-category" class="form-control" />
                                <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                                    <?php foreach ($product_categories as $product_category) { ?>
                                    <div id="product-category<?php echo $product_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['name']; ?>
                                        <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-condition"><?php echo $entry_condition; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="condition" value="<?php echo $condition; ?>" placeholder="<?php echo $entry_condition; ?>" id="input-condition" class="form-control" />
                                <?php if ($error_condition) { ?>
                                <div class="text-danger"><?php echo $error_condition; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-discount"><?php echo $entry_discount; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="discount" value="<?php echo $discount; ?>" placeholder="<?php echo $entry_discount; ?>" id="input-discount" class="form-control" />
                                <?php if ($error_discount) { ?>
                                <div class="text-danger"><?php echo $error_discount; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-agent_percent"><?php echo $entry_agent_percent; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="agent_percent" value="<?php echo $agent_percent; ?>" placeholder="<?php echo $entry_agent_percent; ?>" id="input-agent_percent" class="form-control" />
                                <?php if ($error_agent_percent) { ?>
                                <div class="text-danger"><?php echo $error_agent_percent; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-system_percent"><?php echo $entry_system_percent; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="system_percent" value="<?php echo $system_percent; ?>" placeholder="<?php echo $entry_system_percent; ?>" id="input-system_percent" class="form-control" />
                                <?php if ($error_system_percent) { ?>
                                <div class="text-danger"><?php echo $error_system_percent; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-start_time"><?php echo $entry_start_time; ?></label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <input type="text" name="start_time" value="<?php echo $start_time; ?>" placeholder="<?php echo $entry_start_time; ?>" data-date-format="YYYY-MM-DD" id="input-start_time" class="form-control" />
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-over_time"><?php echo $entry_over_time; ?></label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <input type="text" name="over_time" value="<?php echo $over_time; ?>" placeholder="<?php echo $entry_over_time; ?>" data-date-format="YYYY-MM-DD" id="input-over_time" class="form-control" />
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php if ($coupons_id) { ?>
                    <div class="tab-pane" id="tab-history">
                        <div id="history">
                            <a href="javascript:void(0);" class="btn btn-default" id="create-coupons">生成优惠券</a><br><br>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>CODE</td>
                                        <td>STATUS</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($coupons_codes){
                                    foreach($coupons_codes as $coupons_code) {
                                ?>
                                <tr>
                                    <td><?php echo $coupons_code['coupons_code_id'];?></td>
                                    <td><?php echo $coupons_code['code'];?></td>
                                    <td><?php echo $coupons_code['status'] == 0 ? '未使用' : '已保用';?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.date').datetimepicker({
        pickTime: false
    });

    // Category
    $('input[name=\'category\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['category_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'category\']').val('');

            $('#product-category' + item['value']).remove();

            $('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product-category').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });

    $('#create-coupons').on('click',function(){
        var coupons_id = '<?php echo $_GET['coupons_id'];?>';
        $.post('./index.php?route=sale/coupons/createCoupons&token=<?php echo $token; ?>',{coupons_id:coupons_id},function(data){
            if (data == 'success')
            {
                alert('生成成功！');
                history.go(0);
            }
        });
    });

 </script>
</div>
<?php echo $footer; ?>