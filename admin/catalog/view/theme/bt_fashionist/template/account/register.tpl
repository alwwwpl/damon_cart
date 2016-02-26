<?php echo $header; ?>
<script type="text/javascript" src="./catalog/view/javascript/js.KinerCode.js"></script>
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
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="register" id="register-form">
<fieldset id="account">
<h2><?php echo $text_your_details; ?></h2>
<div class="form-group required" style="display: <?php echo (count($customer_groups) > 1 ? 'block' : 'none'); ?>;">
    <label class="control-label"><?php echo $entry_customer_group; ?></label>
    <div>
        <input type="hidden" name="parent" value="<?php echo $_GET['code'];?>">
        <?php foreach ($customer_groups as $customer_group) { ?>
        <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
        <div class="radio">
            <label>
                <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                <?php echo $customer_group['name']; ?></label>
        </div>
        <?php }
               }
              ?>
    </div>
</div>
<div class="form-group required" style="display: none;">
    <label class="control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
    <div>
        <input type="text" name="firstname" value="0" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
        <?php if ($error_firstname) { ?>
        <div class="text-danger"><?php echo $error_firstname; ?></div>
        <?php } ?>
    </div>
</div>
<div class="form-group required">
    <label class="control-label" for="input-lastname">您的姓名：</label>
    <div>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="您的姓名" id="input-lastname" class="form-control" />
        <?php if ($error_lastname) { ?>
        <div class="text-danger"><?php echo $error_lastname; ?></div>
        <?php } ?>
    </div>
</div>
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
    <div style="float: left; width: 100%;">
        <div class="col-xs-12 col-sm-12" style="padding-left: 0px;">
            <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" data-code=""  style="width: 50%; min-width:100px; float: left;"/>
        </div>
        <div class="col-xs-12 col-sm-12" style="padding-left: 0px;">
            <input type="text" class="form-control" placeholder="验证码" id="inputCode" style="width: 70px; text-align: center; float: left; margin: 6px 5px 20px 0px;">
            <div class="mycode" id="code" style="width: 70px; height:34px; overflow: hidden;float:left; margin: 6px 5px 20px;"></div>
            <input class="form-control" id="phone-code" placeholder="4位验证码" style="float: left; margin: 6px 5px 20px 0px; display: none; width: 70px;" type="text">
            <input class="btn btn-default" id="getcode" style=" margin: 6px 5px 20px; float:left; padding: 0px 5px; font-size: 11px; width: 80px; border-radius: 3px; line-height: 37px; font-size: 11px; background: #337AB7; color: #FFF;" value="获取验证码">
        </div>

        <?php if ($error_telephone) { ?>
        <div class="text-danger"><?php echo $error_telephone; ?></div>
        <?php } ?>
    </div>
</div>
<div class="form-group" style="display: none;">
    <label class="control-label" for="input-fax"><?php echo $entry_fax; ?></label>
    <div>
        <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
    </div>
</div>
<?php foreach ($custom_fields as $custom_field) { ?>
<?php if ($custom_field['location'] == 'account') { ?>
<?php if ($custom_field['type'] == 'select') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'radio') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label"><?php echo $custom_field['name']; ?></label>
    <div>
        <div>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="radio">
                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } else { ?>
                <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'checkbox') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label"><?php echo $custom_field['name']; ?></label>
    <div>
        <div>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="checkbox">
                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $register_custom_field[$custom_field['custom_field_id']])) { ?>
                <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } else { ?>
                <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'text') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'textarea') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'file') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label"><?php echo $custom_field['name']; ?></label>
    <div>
        <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
        <input type="hidden" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : ''); ?>" />
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'date') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <div class="input-group date">
            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'time') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <div class="input-group time">
            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'datetime') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <div class="input-group datetime">
            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php } ?>
<?php } ?>
</fieldset>
<fieldset id="address">
<h2><?php echo $text_your_address; ?></h2>
<div class="form-group" style="display: none;">
    <label class="control-label" for="input-company"><?php echo $entry_company; ?></label>
    <div>
        <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
    </div>
</div>
<div class="form-group required">
    <label class="control-label" for="input-country"><?php echo $entry_country; ?></label>
    <div>
        <select name="country_id" id="input-country" class="form-control">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($countries as $country) { ?>
            <?php if ($country['country_id'] == $country_id) { ?>
            <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <?php if ($error_country) { ?>
        <div class="text-danger"><?php echo $error_country; ?></div>
        <?php } ?>
    </div>
</div>
<div class="form-group required">
    <label class="control-label" for="input-zone"><?php echo $entry_zone; ?></label>
    <div>
        <select name="zone_id" id="input-zone" class="form-control">
        </select>
        <?php if ($error_zone) { ?>
        <div class="text-danger"><?php echo $error_zone; ?></div>
        <?php } ?>
    </div>
</div>
<div class="form-group required">
    <label class="control-label" for="input-city"><?php echo $entry_city; ?></label>
    <div>
        <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
        <?php if ($error_city) { ?>
        <div class="text-danger"><?php echo $error_city; ?></div>
        <?php } ?>
    </div>
</div>
<div class="form-group required">
    <label class="control-label" for="input-address-1"><?php echo $entry_address_1; ?></label>
    <div>
        <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1" class="form-control" />
        <?php if ($error_address_1) { ?>
        <div class="text-danger"><?php echo $error_address_1; ?></div>
        <?php } ?>
    </div>
</div>
<div class="form-group" style="display: none;">
    <label class="control-label" for="input-address-2"><?php echo $entry_address_2; ?></label>
    <div>
        <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2" class="form-control" />
    </div>
</div>
<div class="form-group required" style="display: none;">
    <label class="control-label" for="input-postcode"><?php echo $entry_postcode; ?></label>
    <div>
        <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
        <?php if ($error_postcode) { ?>
        <div class="text-danger"><?php echo $error_postcode; ?></div>
        <?php } ?>
    </div>
</div>

<?php foreach ($custom_fields as $custom_field) { ?>
<?php if ($custom_field['location'] == 'address') { ?>
<?php if ($custom_field['type'] == 'select') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'radio') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label"><?php echo $custom_field['name']; ?></label>
    <div>
        <div>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="radio">
                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } else { ?>
                <label>
                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'checkbox') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label"><?php echo $custom_field['name']; ?></label>
    <div>
        <div>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="checkbox">
                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $register_custom_field[$custom_field['custom_field_id']])) { ?>
                <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } else { ?>
                <label>
                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                    <?php echo $custom_field_value['name']; ?></label>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'text') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'textarea') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'file') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label"><?php echo $custom_field['name']; ?></label>
    <div>
        <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
        <input type="hidden" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : ''); ?>" />
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'date') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <div class="input-group date">
            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'time') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <div class="input-group time">
            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($custom_field['type'] == 'datetime') { ?>
<div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
    <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
    <div>
        <div class="input-group datetime">
            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
        <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php } ?>
<?php } ?>
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
<fieldset>
    <h2><?php echo $text_newsletter; ?></h2>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_newsletter; ?></label>
        <div>
            <?php if ($newsletter) { ?>
            <label class="radio-inline">
                <input type="radio" name="newsletter" value="1" checked="checked" />
                <?php echo $text_yes; ?></label>
            <label class="radio-inline">
                <input type="radio" name="newsletter" value="0" />
                <?php echo $text_no; ?></label>
            <?php } else { ?>
            <label class="radio-inline">
                <input type="radio" name="newsletter" value="1" />
                <?php echo $text_yes; ?></label>
            <label class="radio-inline">
                <input type="radio" name="newsletter" value="0" checked="checked" />
                <?php echo $text_no; ?></label>
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

    $('#address .form-group[data-sort]').detach().each(function() {
        if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .form-group').length) {
            $('#address .form-group').eq($(this).attr('data-sort')).before(this);
        }

        if ($(this).attr('data-sort') > $('#address .form-group').length) {
            $('#address .form-group:last').after(this);
        }

        if ($(this).attr('data-sort') < -$('#address .form-group').length) {
            $('#address .form-group:first').before(this);
        }
    });

    $('input[name=\'customer_group_id\']').on('change', function() {
        $.ajax({
            url: 'index.php?route=account/register/customfield&customer_group_id=' + this.value,
            dataType: 'json',
            success: function(json) {
                $('.custom-field').hide();
                $('.custom-field').removeClass('required');

                for (i = 0; i < json.length; i++) {
                    custom_field = json[i];

                    $('#custom-field' + custom_field['custom_field_id']).show();

                    if (custom_field['required']) {
                        $('#custom-field' + custom_field['custom_field_id']).addClass('required');
                    }
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('input[name=\'customer_group_id\']:checked').trigger('change');
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
    //-->

    $('#register-form').submit(function(e){
        var code = $('#phone-code').val();
        var code_data = $('#input-telephone').attr('data-code');
        if (code != code_data || code == '')
        {
            alert('验证码输入不正确！');
            e.preventDefault();
        }
    });

    var inp = document.getElementById('inputCode');
    var code = document.getElementById('code');
    var submit = document.getElementById('getcode');

    //======================插件引用主体
    var c = new KinerCode({
        len: 4,//需要产生的验证码长度
//        chars: ["1+2","3+15","6*8","8/4","22-15"],//问题模式:指定产生验证码的词典，若不给或数组长度为0则试用默认字典
        chars: [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        ],//经典模式:指定产生验证码的词典，若不给或数组长度为0则试用默认字典
        question: false,//若给定词典为算数题，则此项必须选择true,程序将自动计算出结果进行校验【若选择此项，则可不配置len属性】,若选择经典模式，必须选择false
        copy: false,//是否允许复制产生的验证码
        bgColor: "",//背景颜色[与背景图任选其一设置]
        bgImg: "#",//若选择背景图片，则背景颜色失效
        randomBg: false,//若选true则采用随机背景颜色，此时设置的bgImg和bgColor将失效
        inputArea: inp,//输入验证码的input对象绑定【 HTMLInputElement 】
        codeArea: code,//验证码放置的区域【HTMLDivElement 】
        click2refresh: true,//是否点击验证码刷新验证码
        false2refresh: true,//在填错验证码后是否刷新验证码
        validateObj: submit,//触发验证的对象，若不指定则默认为已绑定的输入框inputArea
        validateEven: "click",//触发验证的方法名，如click，blur等
        validateFn: function (result, code) { //验证回调函数
            var phone = $('#input-telephone').val();
            if (isNaN(phone) || phone == '')
            {
                alert('请输入正确的手机号码!');
            }
            else
            {
                if (result) {

                    var countdown=60;
                    function settime() {
                        if (countdown == 0) {
                            $('#getcode').removeAttr("disabled");//去除input元素的disabled属性
                            $('#getcode').val('获取验证码');
                            countdown = 60;
                            return;
                        } else {
                            $('#getcode').attr("disabled","disabled")//将input元素设置为disabled
                            $('#getcode').val('重新发送(' + countdown + ')');
                            countdown--;
                        }
                        setTimeout(function(){
                            settime();
                        },1000);
                    }


                    var obj = $('#getcode');
                    obj.blur();
                    $.post('./index.php?route=account/account/sendmessage',{phone:phone},function(data){
                        if (data.status == 'success') {
                            $('#inputCode').css('display','none');
                            $('#code').css('display','none');
                            $('#phone-code').css('display','block');

                            $('#input-telephone').attr('data-code',data.code);
                            settime();
                        }
                        else {
//                            alert(data.status);
                            alert('短信发送失败,请检验手机号码是否正确！');
                        }
                    },'json');

                }
                else {
                    if (this.opt.question) {
                        alert('验证码输入错误!');
                    } else {
                        alert('验证码输入错误!');
                    }
                }
            }
        }
    });

</script>
<?php echo $footer; ?>