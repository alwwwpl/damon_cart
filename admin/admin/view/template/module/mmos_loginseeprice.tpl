<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" id="savestay" form="mmosolution-form" data-toggle="tooltip" title="<?php echo $button_save_stay; ?>" class="btn btn-success">
                    <i class="fa fa-save"></i> <?php echo $button_save_stay; ?>
                </button>
                <button type="submit"  form="mmosolution-form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                </button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><a href="http://mmosolution.com" target="_blank" title="Go to MMOSolution.com" ><img src="//mmosolution.com/image/mmosolution.com_34.png"> </a> <?php echo $heading_title; ?></h1>
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
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks text-warning"></i> <?php echo $text_edit; ?> </h3>
                <span class="pull-right hidden-xs" id="mmos-offer"></span>
            </div>
            <ul style="margin-top: 10px;" class="nav nav-tabs">
                <li class="active"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a>   </li>
                <li><a href="#supporttabs" data-toggle="tab"><?php echo $tab_support; ?></a></li>

                <li class="pull-right hidden-xs"><a style="  background: url('//mmosolution.com/image/opencart.gif') 0px 10px no-repeat; padding-left: 20px; " title="go to Opencart Market"  href="http://www.opencart.com/index.php?route=extension/extension&filter_username=mmosolution" target="_blank">Get Extensions <span class="badge" style="background: gold;">80++</span></a></li>
                <li class="pull-right hidden-xs"><a style="background: url('//mmosolution.com/image/mmosolution_20x20.gif') 0px 8px no-repeat; padding-left: 25px; " title="go to MMOS market"  href="http://mmosolution.com" target="_blank" class="text-success">Get Extensions <span class="badge" style="background: gold;">80++</span></a></li>

            </ul>


            <div class="tab-content">
                <div class="tab-pane active" id="tab-setting">
                     <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="mmosolution-form" class="form-horizontal">
                    <div class="panel-body">
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_login2price_status; ?></label>
                            <div class="col-sm-10">
                                <select name="mmos_loginseeprice_status" id="input-status" class="form-control">
                                    <?php if ($mmos_loginseeprice_status == '1') { ?>
                                    <option value="1" selected="selected"><?php echo $text_enable; ?></option>
                                    <option value="0"><?php echo $text_disable; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enable; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disable; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label" for="input-color"><?php echo $text_color; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mmos_loginseeprice_color" value="<?php echo isset($mmos_loginseeprice_color) ? $mmos_loginseeprice_color : '#FF9430' ; ?>" id="input-color" class="form-control colorpicker" />
                            </div>
                        </div>
                        <?php foreach($languages as $language) { ?>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label" for="input-language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $text_language; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="mmos_loginseeprice_language[<?php echo $language['language_id']; ?>]" value="<?php echo isset($mmos_loginseeprice_language[$language['language_id']]) ? $mmos_loginseeprice_language[$language['language_id']]: $text_mmos_loginseeprice; ?>" placeholder="<?php echo $text_language; ?>" id="input-language<?php echo $language['language_id']; ?>" class="form-control" />
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    </form>
                </div>

                <div class="tab-pane" id="supporttabs">
                    <div class="panel ">
                        <div class="panel-body ">
                            <!-- begin MMOSolution.com -->
                            <div class="row">
                                <div class="col-md-6 col-xs-12">

                                    <h2 class="text-success text-center">Thank You For Choosing MMO Solution  <i class="fa fa-trophy"></i></h2>
                                    <div class="panel-body text-center">
                                        <h4><i class="fa fa-tags"></i> About <?php echo $heading_title; ?></h4>
                                        <h5><i class="fa fa-lock"></i> Installed Version: V.<?php echo $MMOS_version; ?> </h5>
                                        <h5><i class="fa fa-tree"></i> Latest version: <span id="mmos_latest_version"><a href="http://mmosolution.com/index.php?route=product/search&search=<?php echo trim(strip_tags($heading_title)); ?>" target="_blank">Unknown -- Check</a></span></h5>
                                        <br>

                                        <h5 class="hidden-sm"><a style="background: url('//mmosolution.com/image/mmosolution_20x20.gif') 0px 0px no-repeat; padding-left: 25px; " title="go to MMOS market"  href="http://mmosolution.com" target="_blank" class="text-success">Get More Extensions on our site <span id="ontabspromotion"></span></a></h5>
                                        <h5 class="hidden-sm"><a style="  background: url('//mmosolution.com/image/opencart.gif') 0px 0px no-repeat; padding-left: 20px; " title="go to Opencart Market"  href="http://www.opencart.com/index.php?route=extension/extension&filter_username=mmosolution" target="_blank"> Get More Our Extensions on Opencart Market</a></h5><br>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <h3><i class="fa fa-info-circle"></i> Please inform us if you get any troubles & give feedback!</h3>

                                    <div id="contact-infor" class="text-center">
                                        <h4> <i class="fa fa-envelope-o text-primary"></i> <a href="mailto:support@mmosolution.com?Subject=<?php echo trim(strip_tags($heading_title)) . ' OC ' . VERSION; ?>" target="_top">support@mmosolution.com</a></h4>
                                        <h4><i class="fa fa-globe text-success"></i> <a href="http://MMOSolution.com" target="_blank">Www.MMOSolution.com</a></h4>
                                        <h4><i class="fa fa-ticket text-warning"></i> <a href="http://MMOSolution.com/support/" target="_blank">Submit a support Ticket</a></h4>
                                        <h4><i class="fa fa-hand-o-right"></i> <a href="http://MMOSolution.com/support/" target="_blank">Do you need custom-work, custom extensions, fix extensions of another developer? Resolve your site troubles.. ?</a></h4>
                                        <br>

                                        <h3><i class="fa fa-heart-o text-danger"></i> Follow us on the social media web sites.</h3>
                                        <a href="http://www.facebook.com/MMOSolution" target="_blank" title=" Facecook.com"><i class="fa fa-2x fa-facebook-square"></i></a>
                                        <a class="text-danger" href="http://plus.google.com/+Mmosolution" target="_blank" title="Google Plus"><i class="fa  fa-2x fa-google-plus-square"></i></a>
                                        <a class="text-warning" href="http://MMOSolution.com/mmosolution_rss.rss" target="_blank" title="RSS"><i class="fa fa-2x fa-rss-square"></i></a>
                                        <a href="http://twitter.com/MMOSolution" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                                        <a class="text-danger" href="http://www.youtube.com/MMOSolution" target="_blank" title="Youtube.com"><i class="fa fa-2x fa-youtube-square"></i></a>
                                    </div>
                                </div>
                                <div id="relate-products"></div> 
                                <script type="text/javascript"><!--

                                    var productcode = '<?php echo $MMOS_code_id;?>';
                                    $('a[href="#supporttabs"]').bind('click', function () {
                                        $('#ontabspromotion').html('(' + $('#mmos-offer').html() + ')');
                                    });

                                    //--></script>
                                <!-- DO NOT REMOVE -->
                                <script type="text/javascript" src="//mmosolution.com/support.js"></script>

                            </div>
                            <!-- end MMOSolution.com -->
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <script type="text/javascript"><!--
            var productcode = '<?php echo $MMOS_code_id ;?>';
        $('.colorpicker').colorpicker();
        $('#savestay').click(function () {
            $('#mmosolution-form').attr('action', $('#mmosolution-form').attr('action') + '&stay=1');
        });
        //--></script>
    <?php echo $footer; ?>
