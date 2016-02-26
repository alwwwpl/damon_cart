<?php global $config;?>
<style>
    #back_qq {
        bottom: 421px;
        cursor: pointer;
        padding: 4px;
        position: fixed;
        right: 10px;
        text-align: center;
        transition: all 0.3s ease-out 0s;
        z-index: 9998;
        width: 54px;
        height: 54px;
    }
    #back_qq:hover a {
        border: 1px solid #000;
    }
    #back_qq a {
        border: 1px solid #666;
        border-radius: 100%;
        display: block;
        height: 54px;
        padding-top: 6px;
        text-align: center;
        width: 54px;
        transition-duration: 0.3s;
    }
    #back_qq img {
        margin-top: 5px;
    }
</style>
<?php
	$boss_manager = array(
		'option' => array(
'bt_scroll_top' => true,
'animation' 	=> true,
),
'layout' => array(
'mode_css'   => 'wide',
'box_width' 	=> 1200,
'h_mode_css'   => 'inherit',
'h_box_width' 	=> 1200,
'f_mode_css'   => 'inherit',
'f_box_width' 	=> 1200
),
'status' => 1
);
?>
<?php $footer_about = $config->get('boss_manager_footer_about'); ?>
<?php $footer_payment = $config->get('boss_manager_footer_payment'); ?>
<?php $footer_social = $config->get('boss_manager_footer_social'); ?>
<?php $footer_powered = $config->get('boss_manager_footer_powered'); ?>
<?php if($config->get('boss_manager')){
$boss_manager = $config->get('boss_manager');
}else{
$boss_manager = $boss_manager;
} ?>
<?php
	if(!empty($boss_manager)){
		$layout = isset($boss_manager['layout'])?$boss_manager['layout']:'';
		$footer_link = isset($boss_manager['footer_link'])?$boss_manager['footer_link']:'';
	}
	$f_style = '';
	if($layout['f_mode_css']=='fboxed'){
		$f_mode_css = 'bt-fboxed';
		$f_style = (!empty($layout['f_box_width']))?'style="max-width:'.$layout['f_box_width'].'px"':'';
	}else{
		$f_mode_css = '';
	}
?>
<style>
    #bt_footer .row h4 { font-size: 17px;}
</style>
<div id="bt_footer_container" class="<?php echo $f_mode_css;?>" <?php echo $f_style;?>>

<footer id="bt_footer">
    <div class="container">
        <div class="row">
            <div class="footer_column">
                <div class="row">
                    <div class="col-sm-4 col-xs-12 not-animated" data-animate="fadeInUp" data-delay="200">
                        <?php if(isset($footer_about['status']) && $footer_about['status']){ ?>
                        <div class="footer-about">
                            <?php if($footer_about['about_title'][$config->get('config_language_id')]){ ?>
                            <h3><?php echo html_entity_decode($footer_about['about_title'][$config->get('config_language_id')],ENT_QUOTES, 'UTF-8'); ?></h3>
                            <?php } ?>
                            <?php if($footer_about['image_status']){ ?><a href="<?php echo $footer_about['image_url']; ?>" title="logo"><img alt="logo" src="image/<?php echo $footer_about['image_link']; ?>"></a> <?php } ?>
                            <?php echo html_entity_decode($footer_about['about_content'][$config->get('config_language_id')],ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <?php } ?>
                        <?php if(isset($footer_social['status']) && $footer_social['status']){ ?>
                        <div class="footer-social">
                            <h3><?php echo html_entity_decode(isset($footer_social['title'][$config->get('config_language_id')])?$footer_social['title'][$config->get('config_language_id')]:'',ENT_QUOTES, 'UTF-8'); ?></h3>
                            <ul>
                                <li><a href="<?php echo isset($footer_social['face_url'])?$footer_social['face_url']:'#'; ?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?php echo isset($footer_social['twitter_url'])?$footer_social['twitter_url']:'#'; ?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?php echo isset($footer_social['googleplus_url'])?$footer_social['googleplus_url']:'#'; ?>" title="Googleplus"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="<?php echo isset($footer_social['pinterest_url'])?$footer_social['pinterest_url']:'#'; ?>" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="<?php echo isset($footer_social['rss_url'])?$footer_social['rss_url']:'#'; ?>" title="RSS"><i class="fa fa-rss"></i></a></li>
                                <li><a href="<?php echo isset($footer_social['youtube_url'])?$footer_social['youtube_url']:'#'; ?>" title="Youtube"><i class="fa fa-youtube-play"></i></a></li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="column col-sm-6 col-xs-12 not-animated" data-animate="fadeInUp" data-delay="300">
                        <?php if((isset($footer_link['information']) && $footer_link['information']) || (isset($footer_link['contact_us']) && $footer_link['contact_us']) || (isset($footer_link['site_map']) && $footer_link['site_map']) || (isset($footer_link['brands']) && $footer_link['brands'])) { ?>
                        <div class="column col-sm-4 col-xs-12">
                            <h4><?php echo $text_information; ?></h4>
                            <ul>
                                <?php if ($informations) { ?>
                                <?php foreach ($informations as $information) { ?>
                                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                <?php } ?>
                                <?php } ?>

                                <?php if(isset($footer_link['contact_us']) && $footer_link['contact_us']){ ?>
                                <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                                <?php } if(isset($footer_link['site_map']) && $footer_link['site_map']){ ?>
                                <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
                                <?php } if(isset($footer_link['brands']) && $footer_link['brands']){ ?>
                                <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>

                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                        <?php if((isset($footer_link['my_account']) && $footer_link['my_account']) || (isset($footer_link['return']) && $footer_link['return']) || (isset($footer_link['newsletter']) && $footer_link['newsletter']) || (isset($footer_link['order_history']) && $footer_link['order_history']) || (isset($footer_link['gift_vouchers']) && $footer_link['gift_vouchers']) || (isset($footer_link['affiliates']) && $footer_link['affiliates']) || (isset($footer_link['specials']) && $footer_link['specials']) || (isset($footer_link['wishlist']) && $footer_link['wishlist'])) { ?>
                        <div class="column col-sm-4 col-xs-12 not-animated" data-animate="fadeInUp" data-delay="400">
                            <h4><?php echo $text_account; ?></h4>
                            <ul>
                                <?php if(isset($footer_link['my_account']) && $footer_link['my_account']){ ?>
                                <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                                <?php } if(isset($footer_link['return']) && $footer_link['return']){ ?>
                                <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                                <?php } if(isset($footer_link['newsletter']) && $footer_link['newsletter']){ ?>
                                <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                                <?php } if(isset($footer_link['order_history']) && $footer_link['order_history']){ ?>
                                <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                                <?php } if(isset($footer_link['gift_vouchers']) && $footer_link['gift_vouchers']){ ?>
                                <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                                <?php } if(isset($footer_link['affiliates']) && $footer_link['affiliates']){ ?>
                                <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
                                <?php } if(isset($footer_link['specials']) && $footer_link['specials']){ ?>
                                <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="column col-sm-4 col-xs-12 not-animated" data-animate="fadeInUp" data-delay="500">
                            <h4>合作伙伴</h4>
                            <ul>
                                <li><a href="http://m.kuaidi100.com" target="_blank">快递查询</a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-sm-2 col-xs-12 not-animated" data-animate="fadeInUp" data-delay="400">
                        <div class="column col-sm-12 col-xs-12">
                            <h4 style="margin-left:10px;">微信公众号</h4>
                            <img src="image/catalog/slides/wechat_iddmall.jpg" style="width:100%">
                        </div>
                    </div>
                    <?php echo isset($btfooter)?$btfooter:''; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="powered-payment">
        <div class="container">
            <div class="row">
                <div class="powered col-sm-12 col-xs-12">
                    <?php echo html_entity_decode(isset($footer_powered[$config->get('config_language_id')])?$footer_powered[$config->get('config_language_id')]:'',ENT_QUOTES, 'UTF-8'); ?>
                </div>
                <?php if(isset($footer_payment['status']) && $footer_payment['status']){ ?>
                <div class="payment col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul>
                        <?php if(isset($footer_payment['visa_status'])&&$footer_payment['visa_status']){ ?>
                        <li><a title="Visa" href="<?php echo isset($footer_payment['visa_link'])?$footer_payment['visa_link']:'#'; ?>" class="visa"><img alt="Visa" src="image/catalog/<?php echo $config->get('config_template'); ?>/visa.png"></a></li>
                        <?php } ?>
                        <?php if(isset($footer_payment['master_status'])&&$footer_payment['master_status']){ ?>
                        <li><a title="MasterCard" href="<?php echo isset($footer_payment['master_link'])?$footer_payment['master_link']:'#'; ?>" class="masterCard"><img alt="MasterCard" src="image/catalog/<?php echo $config->get('config_template'); ?>/master.png" /></a></li>
                        <?php } ?>
                        <?php if(isset($footer_payment['merican_status'])&&$footer_payment['merican_status']){ ?>
                        <li><a title="Merican" href="<?php echo isset($footer_payment['merican_link'])?$footer_payment['merican_link']:'#'; ?>" class="merican"><img alt="Merican" src="image/catalog/<?php echo $config->get('config_template'); ?>/american.png" /></a></li>
                        <?php } ?>
                        <?php if(isset($footer_payment['paypal_status'])&&$footer_payment['paypal_status']){ ?>
                        <li><a title="Paypal" href="<?php echo isset($footer_payment['paypal_link'])?$footer_payment['paypal_link']:'#'; ?>" class="paypal"><img alt="Paypal" src="image/catalog/<?php echo $config->get('config_template'); ?>/paypal.png"></a></li>
                        <?php } ?>
                        <?php if(isset($footer_payment['skrill_status'])&&$footer_payment['skrill_status']){ ?>
                        <li><a title="Skrill" href="<?php echo isset($footer_payment['skrill_link'])?$footer_payment['skrill_link']:'#'; ?>" class="skrill"><img alt="Skrill" src="image/catalog/<?php echo $config->get('config_template'); ?>/skrill.png"></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</footer>
</div>
<?php if(isset($boss_manager['option']['bt_scroll_top'])&&($boss_manager['option']['bt_scroll_top'])){ ?>
<div id="back_qq" class="back_top">
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=3096669723&site=qq&menu=yes">
        <img border="0" src="./image/catalog/qq.png" alt="联系客服" title="联系客服"/>
    </a>
</div>
<div id="back_top" class="back_top" title="Back To Top"><span><i class="fa fa-caret-up"></i></span></div>
<script type="text/javascript">
    $(function(){
        $(window).scroll(function(){
            if($(this).scrollTop()>600){
                $('#back_top').fadeIn();
            }
            else{
                $('#back_top').fadeOut();
            }
        });
        $("#back_top").click(function (e) {
            e.preventDefault();
            $('body,html').animate({scrollTop:0},800,'swing');
        });
    });
</script>
<?php } ?>
<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->
</div> <!-- End #bt_container -->
<div style="display: none;">
    <script src="http://s95.cnzz.com/z_stat.php?id=1256828646&web_id=1256828646" language="JavaScript"></script>
</div>
</body></html>