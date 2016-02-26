<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><a href="#collapse-coupons" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $heading_title; ?> <i class="fa fa-caret-down"></i></a></h4>
    </div>
    <div id="collapse-coupons" class="panel-collapse collapse">
        <div class="panel-body">
            <label class="control-label" for="input-coupon"><?php echo $entry_coupons; ?></label>
            <div class="input-group">
                <input type="text" name="coupons" value="<?php echo $coupons; ?>" placeholder="<?php echo $entry_coupons; ?>" id="input-coupons" class="form-control" />
                <input type="button" value="<?php echo $button_coupons; ?>" id="button-coupons" data-loading-text="<?php echo $text_loading; ?>"  class="btn" />
            </div>
            <script type="text/javascript"><!--
                $('#button-coupons').on('click', function() {
                    $.ajax({
                        url: 'index.php?route=checkout/coupons/coupons',
                        type: 'post',
                        data: 'coupons=' + encodeURIComponent($('input[name=\'coupons\']').val()),
                        dataType: 'json',
                        beforeSend: function() {
                            $('#button-coupons').button('loading');
                        },
                        complete: function() {
                            $('#button-coupons').button('reset');
                        },
                        success: function(json) {
                            $('.alert').remove();

                            if (json['error']) {
                                $('#content h1').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                                $('html, body').animate({ scrollTop: 0 }, 'slow');
                            }

                            if (json['redirect']) {
                                location = json['redirect'];
                            }
                        }
                    });
                });
                //--></script>
        </div>
    </div>
</div>
