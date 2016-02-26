<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php echo $string; ?></title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/cartList.css" rel="stylesheet" type="text/css" />


</head>
<body>
    <div class="h5-1yyg-v1">

<!-- 栏目页面顶部 -->


<!-- 内页顶部 -->
<header class="header">
<div class="n-header-wrap">
<div class="h-top-right ">
<a href="<?php echo WEB_PATH; ?>/mobile/home" class="h-search white"></a>
</div>
<div class="n-h-tit"><h1 class="header-logo">提示</h1></div>
</div>
</header>

	<div class="g-pay-auto">
		<div class="z-pay-tips"><b><em class="gray6"><?php echo $string; ?></em></b></div>
	</div>
        <script>



            setTimeout(function locahost(){
                location.href="<?php echo $defurl; ?>";
            },"2000");



        </script>
<?php include templates("mobile/index","footer");?>
</div>
</body>
</html>