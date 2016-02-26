<?php if (count($languages) > 1) { ?>
<?php
	global $config; 
	$b_language = 1;
	if($config->get('boss_manager')){
		$boss_manager = $config->get('boss_manager');
		$b_language = isset($boss_manager['other']['language'])?$boss_manager['other']['language']:1;
	}
?>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language">
  <div class="btn-group">
	<?php if($b_language ==2){ ?>
    <button class="btn-link dropdown-toggle" data-toggle="dropdown">
    <span><?php echo $text_language; ?></span>
	<?php foreach ($languages as $language) { ?>
    <?php if ($language['code'] == $code) { ?>
    <strong><?php echo $language['name']; ?></strong>
    <?php } ?>
    <?php } ?>
    <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu">
      <?php foreach ($languages as $language) { ?>
      <li><a href="<?php echo $language['code']; ?>"><?php echo $language['code']; ?></a>	  
	  </li>
      <?php } ?>
    </ul>
	<?php }else{ ?>
		<?php foreach ($languages as $language) { ?>
		<?php if($language['code']==$code){?>
			<a class="active" title="<?php echo $language['name']; ?>"><?php echo $language['code']; ?></a>
		<?php }else{ ?>
			<a title="<?php echo $language['name']; ?>" onclick="$('input[name=\'code\']').attr('value', '<?php echo $language['code']; ?>'); $('#language').submit();"><?php echo $language['code']; ?></a>
		<?php } ?>
    <?php } ?>
	<?php } ?>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
<?php } ?>
