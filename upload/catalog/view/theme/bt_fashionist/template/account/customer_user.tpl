<?php echo $header; ?>
<div class="container">
  <div class="row">
    <div class="bt-breadcrumb">
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <div id="content"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <p><?php echo $text_account_already; ?></p>
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
        <?php } ?>
      <div class="content_bg">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="register">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <fieldset id="account">
          <h2><?php echo $text_your_details; ?></h2>
          <div class="form-group required">
            <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
            <div>
              <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
            <div>
              <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
              <?php if ($error_telephone) { ?>
              <div class="text-danger"><?php echo $error_telephone; ?></div>
              <?php } ?>
            </div>
          </div>
        </fieldset>
        <fieldset class="password">
          <h2><?php echo $text_your_password; ?></h2>
          <div class="form-group required">
            <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
            <div>
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
            <div>
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php } ?>
            </div>
          </div>
        </fieldset>
        
        <?php if ($text_agree) { ?>
        <div class="buttons">
          <div class="pull-left">
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } ?>
            &nbsp;<?php echo $text_agree; ?> <br/><br/>
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn" />
          </div>
        </div>
        <?php } else { ?>
        <div class="buttons">
          <div class="pull-left">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn" />
          </div>
        </div>
        <?php } ?>
      </form>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div> 
<script type="text/javascript"><!--
// Sort the custom fields
$('#account .form-group[data-sort]').detach().each(function() {
    if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
        $('#account .form-group').eq($(this).attr('data-sort')).before(this);
    } 
    
    if ($(this).attr('data-sort') > $('#account .form-group').length) {
        $('#account .form-group:last').after(this);
    }
        
    if ($(this).attr('data-sort') < -$('#account .form-group').length) {
        $('#account .form-group:first').before(this);
    }
});
//--></script> 
<script type="text/javascript"><!--
$('button[id^=\'button-custom-field\']').on('click', function() {
    var node = this;

    $('#form-upload').remove();

    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

    $('#form-upload input[name=\'file\']').trigger('click');

    timer = setInterval(function() {
        if ($('#form-upload input[name=\'file\']').val() != '') {
            clearInterval(timer);
            
            $.ajax({
                url: 'index.php?route=tool/upload',
                type: 'post',
                dataType: 'json',
                data: new FormData($('#form-upload')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(node).button('loading');
                },
                complete: function() {
                    $(node).button('reset');
                },
                success: function(json) {
                    $(node).parent().find('.text-danger').remove();
                    
                    if (json['error']) {
                        $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                    }
    
                    if (json['success']) {
                        alert(json['success']);

                        $(node).parent().find('input').attr('value', json['code']);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }, 500);
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});

$('.time').datetimepicker({
    pickDate: false
});

$('.datetime').datetimepicker({
    pickDate: true,
    pickTime: true
});
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
    $.ajax({
        url: 'index.php?route=account/account/country&country_id=' + this.value,
        dataType: 'json',
        beforeSend: function() {
            $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        complete: function() {
            $('.fa-spin').remove();
        },
        success: function(json) {
            if (json['postcode_required'] == '1') {
                $('input[name=\'postcode\']').parent().parent().addClass('required');
            } else {
                $('input[name=\'postcode\']').parent().parent().removeClass('required');
            }
            
            html = '<option value=""><?php echo $text_select; ?></option>';
            
            if (json['zone'] != '') {
                for (i = 0; i < json['zone'].length; i++) {
                    html += '<option value="' + json['zone'][i]['zone_id'] + '"';
                    
                    if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
                        html += ' selected="selected"';
                    }
                
                    html += '>' + json['zone'][i]['name'] + '</option>';
                }
            } else {
                html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
            }
            
            $('select[name=\'zone_id\']').html(html);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
<?php echo $footer; ?>