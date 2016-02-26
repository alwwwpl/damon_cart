<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/link.css"/>
<div class="links_txt">
	<h3><b>文字链接</b></h3>
	<ul>
	<?php $ln=1;if(is_array($link_size)) foreach($link_size AS $size): ?>	
		<li><a href="<?php echo $size['url']; ?>" target="_blank"><?php echo $size['name']; ?></a></li>
	<?php  endforeach; $ln++; unset($ln); ?>	
	</ul>
</div>
<div class="links_txt">
	<h3><b>图片链接</b></h3>
	<ul>
	<?php $ln=1;if(is_array($link_img)) foreach($link_img AS $img): ?>	
		<li><a href="<?php echo $img['url']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/linkimg/<?php echo $img['logo']; ?>"/></a></li>
	<?php  endforeach; $ln++; unset($ln); ?>	
	</ul>
</div>  
<div class="links_exp">
	<h3><b>联系方式</b></h3>
	<p>
		电话：<?php echo _cfg("cell"); ?><br>
	</p>                 
</div>
<?php include templates("index","footer");?>