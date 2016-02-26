<?php global $config; global $request; ?>
<?php
	$boss_manager = array(
		'option' => array(
			'bt_scroll_top' => true,
			'animation' 	=> true,			
			'loading' 	=> true,			
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
<?php if($config->get('boss_manager')){
		$boss_manager = $config->get('boss_manager'); 
	}else{
		$boss_manager = $boss_manager;
	} 
	$header_link = isset($boss_manager['header_link'])?$boss_manager['header_link']:''; 
	$option = isset($boss_manager['option'])?$boss_manager['option']:''; 
?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bossthemes/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bossthemes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/jquery.smoothscroll.js"></script>
<script src="catalog/view/javascript/bossthemes/jquery.jgrowl.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bossthemes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.useso.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/stylesheet.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/bossthemes/bt_stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/bossthemes/responsive.css" />
<?php if(isset($boss_manager['option']['animation'])&&($boss_manager['option']['animation'])){ ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/bossthemes/cs.animate.css" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/bossthemes/jquery.jgrowl.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/bossthemes/bootstrap-select.css" />
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/cs.bossthemes.js"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/jquery.appear.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/getwidthbrowser.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/bootstrap-select.js"></script>
<?php echo $google_analytics; ?>
<?php if(isset($this->request->get['route'])){$route1 = $this->request->get['route'];}else{$route1 ="";}
	if(isset($route1) && ($route1== "common/home" || $route1=="") && $boss_manager['option']['loading']){ ?>
		<script type="text/javascript"><!--
			window.onload = function() {
				$(".bt-loading").fadeOut("1500", function () {
					$('#bt_loading').css("display", "none");
				});
			};
		//--></script>
	<?php }else{ ?>
		<script type="text/javascript"><!--
		$(document).ready(function() {
		$('#bt_loading').css("display", "none");
		});
		//--></script>
	<?php } ?>

<style>
    <?php
    if ($text_parent > 0) {
    ?>
    .boss_menu, .top_right, #search { display: none;}
    #bt_footer { display: none;}
    <?php
    }
    ?>

    @media  only screen and (max-width: 780px) {
        .layers {
            width: 96% !important; margin-left:4% !important;
        }
        #dialog-loginbox .modal-content { width:100% !important; margin-left:0px !important;}
    }
    @media  only screen and (min-width: 780px)  and (max-width: 1120px){

    }
    .layers { width: 60%; margin-left:20%; position: relative;}

    #dialog-loginbox .modal-content { width:500px; margin-left:250px;}
    #dialog-loginbox .modal-content input{ width:100%;}

	#bt_loading{position:fixed; width:100%; height:100%; z-index:999; background:none repeat scroll 0 0 #fff;}
	.bt-loading{
		height: 100px;
		left: 50%;
		margin-left: -50px;
		margin-top: -50px;
		position: absolute;
		top: 50%;
		width: 100px;
		z-index: 9999;
	}
    .damon-btn .dropdown-menu {
        width:452px;
    }
    .damon-btn .dropdown-menu li {
        width:90px;
        float:left;
    }
    .damon-btn .dropdown-menu  li a {
        width:80px; padding: 5px 10px; float:left;
        text-align: center;
        margin-left:5px;
        margin-right:5px;
    }

    .damon-btn .btn {
        background: #E6E6E6 none repeat scroll 0px 0px;
        background-color: #FFFFFF !important;
        border: 0px solid transparent;
        color: #888;
        cursor: pointer;
        filter: none;
        font-family: "Arial",sans-serif;
        font-size: 13px;
        font-weight: 100;
        padding-bottom: 2px !important;
        line-height: normal;
        outline: medium none;
        padding: 0px 0px;
        text-transform: uppercase;
        transition: all 0.2s ease-out 0s;
        white-space: nowrap;
        display: inline-block;
        text-align: center;
        border-radius: 0px;
    }
    .damon-btn .btn:hover
    {
        color: #000;
        background-color:#FFFFFF;
    }
    .navbar-nav {
        margin: 0px 0px !important;
    }
</style>
<?php 	
	if (isset($option['sticky_menu']) && $option['sticky_menu']) { ?>
	
	<script type="text/javascript"><!--
	$(window).scroll(function() {
			var height_header = $('.b_header_height').height();  			
			if($(window).scrollTop() > height_header) {
				
				$('.boss_menu').addClass('boss_scroll');
			} else {
				$('.boss_menu').removeClass('boss_scroll');
			}
		});
	//--></script>
	<!--[if IE 8]> 
	<script type="text/javascript">
	$(window).scroll(function() {
			var height_header = $('.b_header_height').height();  			
			if($('html').scrollTop() > height_header) {				
				$('.boss_menu').addClass('boss_scroll');
			} else {
				$('.boss_menu').removeClass('boss_scroll');
			}
		});
	</script>
	<![endif]-->
<?php } ?>
<link href='http://fonts.useso.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Playfair+Display:400,700,400italic' rel='stylesheet' type='text/css'>
<?php 
	$b_style = '';$h_style = ''; $status=0; $h_mode_css = ''; $h_mode_css = '';
	
	if(isset($boss_manager) && !empty($boss_manager)){
		$layout = $boss_manager['layout'];
		$status = $boss_manager['status']; 
	
		if(isset($layout['mode_css']) && $layout['mode_css']=='wide'){
			$mode_css = 'bt-wide';
		}else{
			$mode_css = 'bt-boxed';
			$b_style = (!empty($layout['box_width']))?'style="max-width:'.$layout['box_width'].'px"':'';
		}
		if(isset($layout['h_mode_css']) && $layout['h_mode_css']=='boxed'){
			$h_mode_css = 'bt-hboxed';
			$h_style = (!empty($layout['h_box_width']))?'style="max-width:'.$layout['h_box_width'].'px"':'';
		}else{
			$h_mode_css = '';
		}
	
	}
?>
<?php
if($status){
	include "catalog/view/theme/".$config->get('config_template')."/template/bossthemes/boss_color_font_setting.php";
} ?>
</head>

<?php 
	if(isset($request->get['route'])){
		$route = $request->get['route'];
	}else{
		$route ="";
	}
	if(isset($route) && ($route== "common/home" || $route=="")){
		$home_page='bt-home-page';
	}else{
		$home_page="bt-other-page";
	}
?>
<body class="<?php echo $home_page; ?>">
<div id="bt_loading"><div class="bt-loading"><img alt="loading" src="image/catalog/<?php echo $config->get('config_template'); ?>/loading.gif" /></div></div>
<div id="bt_container" class="<?php  echo $mode_css;?>" <?php echo $b_style;?>>
<div id="bt_header" class="<?php echo $h_mode_css;?>" <?php echo $h_style;?>>
<div class="b_header_height">
<nav id="top">	
	<div class="container">
	<div class="row">	
	<div class="row">	
		<div class="top_left col-sm-6 col-xs-12 pull-left">
			<div class="welcome">
				<?php $header_block = $config->get('boss_manager_header_block'); ?>
				<?php if(isset($header_block['status']) && $header_block['status']) { ?>
				<?php echo html_entity_decode(isset($header_block['content'][$config->get('config_language_id')])?$header_block['content'][$config->get('config_language_id')]:'',ENT_QUOTES, 'UTF-8'); ?>
				<?php } ?>
			</div>
			<div id="top-links">
			  <ul class="list-inline">
			  	<?php if ($logged) { ?>
				<?php if(isset($header_link['my_account']) && $header_link['my_account']){ ?><li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text_account; ?><i class="fa fa-angle-down"></i></a>
				  <ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?php echo $account; ?>">我的账户</a></li>
					<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
					<li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
					<!-- <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li> -->
					<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
				  </ul>
				</li>
				<?php } ?>
				<?php } else { ?>
				<li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
				<?php } ?>
				<?php if(isset($header_link['wishlist']) && $header_link['wishlist']){ ?><li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><?php echo $text_wishlist; ?></a></li><?php } ?>
				<?php if(isset($header_link['shopping_cart']) && $header_link['shopping_cart']){ ?><li class="hide-on-mobile"><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li><?php } ?>
				<?php if(isset($header_link['checkout']) && $header_link['checkout']){ ?><li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><?php echo $text_checkout; ?></a></li> <?php } ?>
                  <li style="margin: 0px 10px 0px 15px;">
                      <div class="dropdown damon-btn">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <?php if(!empty($city) && $city != '全国 ') { ?>  <?php echo $city;?><?php }else{ ?> 默认 <?php }?>
                              <!--<span class="caret"></span>-->
                          </button>
                          <!--<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                              <?php
                              /*foreach ($citys as $val)
                              {
                                echo '<li><a href="http://'.$val['pinyin'].'.iddmall.com">'.$val['name'].'</a></li>';
                              }*/
                              ?>
                          </ul>-->
                      </div>
                  </li>
              </ul>
			</div>
		</div>		
		<div class="top_right col-sm-6 col-xs-12 pull-right">
			<div class="language_currency">
				<?php if(isset($header_link['currency']) && $header_link['currency']){ echo $currency;} ?>	
				<?php if(isset($header_link['language']) && $header_link['language']){ echo $language;} ?>		
			</div>
			<?php if(isset($header_link['phone']) && $header_link['phone']){ ?>	<div class="contact"><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i><?php echo $telephone; ?></a> </div> <?php } ?>				
		</div>    
    </div>
    </div>
    </div>	
</nav>
<header>
	<div class="container">
		<div class="row">
			<div class="header_left">
				<?php if(isset($header_link['logo']) && $header_link['logo']){ ?>
				<div id="logo">
				  <?php if ($logo) { ?>
				  <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
				  <?php } else { ?>
				  <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
				  <?php } ?>
				</div>
				<?php } ?>
			</div>
			<div class="header_right">	
				<?php if(isset($header_link['cart_mini']) && $header_link['cart_mini']){ echo $cart;} ?>	
				<?php 
					if(isset($header_link['search']) && $header_link['search']){
						echo $search; 
					} 
				?>	
			</div>
		</div>
	</div>
</header>
<div class="boss_menu">
	<div class="container">
	<div class="row">
	<?php 
		if(isset($option['use_menu']) && $option['use_menu'] == 'megamenu'){
			echo isset($btmainmenu)?$btmainmenu:''; 
		}else{
		?>	
		<?php if ($categories) { ?>	
		  <nav id="menu" class="navbar">
			<div class="navbar-header">
			  <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			  <span id="category" class="visible-xs"><?php echo $text_category; ?></span>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			  <ul class="nav navbar-nav">
				<?php foreach ($categories as $category) { ?>
				<?php if ($category['children']) { ?>
				<li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
				  <div class="dropdown-menu">
					<div class="dropdown-inner">
					  <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
					  <ul class="list-unstyled">
						<?php foreach ($children as $child) { ?>
						<li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
						<?php } ?>
					  </ul>
					  <?php } ?>
					</div>
					<a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> </div>
				</li>
				<?php } else { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
				<?php } ?>
				<?php } ?>
                  <li><a href="./index.php?route=bidding/product">抢拍</a></li>
			  </ul>
			</div>
		  </nav>
	
	<?php } } ?>
	</div>	
	</div>	
</div>
</div>	
<div class="boss-new-position">
	<?php echo isset($btslideshow)?$btslideshow:''; ?>
</div> <!-- End #bt_header -->
</div> <!-- End #bt_header -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content layers">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px; top: 5px; position: absolute; border: 1px solid #FFF; border-radius: 30px; color: #000; width: 30px; height: 30px; background: #FFF;"><span aria-hidden="true">&times;</span></button>
            <img src="http://iddmall.com/image/catalog/001/layers.jpg">
        </div>
    </div>
</div>

<Script>
    function setCookie(name, value, expire) {
        window.document.cookie = name + "=" + escape(value) + ((expire == null) ? "" : ("; expires=" + expire.toGMTString()));
    }

    function getCookie(Name) {
        var search = Name + "=";
        if (window.document.cookie.length > 0) { // if there are any cookies
            offset = window.document.cookie.indexOf(search);
            if (offset != -1) { // if cookie exists
                offset += search.length;
// set index of beginning of value
                end = window.document.cookie.indexOf(";", offset)
// set index of end of cookie value
                if (end == -1)
                    end = window.document.cookie.length;
                return unescape(window.document.cookie.substring(offset, end));
            }
        }
        return null;
    }
    function register(name) {
        var today = new Date();
        var expires = new Date();
        expires.setTime(today.getTime() + 1000*60*60*24);
        setCookie("ItDoor", name, expires);
    }
    function openWin() {

        var c = getCookie("ItDoor");
        if (c != null) {
            return;
        }
        register("damon_cart");

        $('#exampleModal').modal({
            keyboard: false
        })

    }
    openWin();
    window.focus()
</Script>

