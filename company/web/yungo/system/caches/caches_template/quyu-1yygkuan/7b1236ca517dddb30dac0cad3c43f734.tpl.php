<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>

<header class="header">
<div class="n-header-wrap">
<div class="backbtn">
<a href="javascript:;" onclick="history.go(-1)" class="h-count white">
</a>
</div>
<?php if($item['q_end_time']!=''): ?>
<div class="n-h-tit"><h1 class="header-logo">揭晓结果</h1></div>
<div class="h-top-right ">
<a href="<?php echo WEB_PATH; ?>/mobile/home" class="h-search white"></a>
</div>
<?php  else: ?>
<div class="n-h-tit"><h1 class="header-logo">商品详情</h1></div>
</div>
<?php include templates("mobile/index","headertop");?>
		<?php endif; ?>
</header>