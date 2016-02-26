<?php if (count($currencies) > 1) { ?>
<?php
	global $config; 
	$b_currency = 1;
	if($config->get('boss_manager')){
		$boss_manager = $config->get('boss_manager');
		$b_currency = isset($boss_manager['other']['currency'])?$boss_manager['other']['currency']:1;
	}
?>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="currency">
  <div class="btn-group">
	<?php if($b_currency ==2){ ?>
    <button class="btn-link dropdown-toggle" data-toggle="dropdown">
    <span><?php echo $text_currency; ?></span>
	<?php foreach ($currencies as $currency) { ?>
    <?php if ($currency['symbol_left'] && $currency['code'] == $code) { ?>
    <strong><?php echo $currency['code']; ?></strong>
    <?php } elseif ($currency['symbol_right'] && $currency['code'] == $code) { ?>
    <strong><?php echo $currency['code']; ?></strong>
    <?php } ?>
    <?php } ?>
     <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu">
      <?php foreach ($currencies as $currency) { ?>
      <?php if ($currency['symbol_left']) { ?>
      <li><button class="currency-select" type="button" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_left']; ?> <?php echo $currency['code']; ?></button></li>
      <?php } else { ?>
      <li><button class="currency-select" type="button" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_right']; ?> <?php echo $currency['code']; ?></button></li>
      <?php } ?>
      <?php } ?>
    </ul>
	<?php }else{ ?>
		<?php foreach ($currencies as $currency) { ?>
    <?php if ($currency['code'] == $code) { ?>
    <?php if ($currency['symbol_left']) { ?>
    <a class="active" title="<?php echo $currency['title']; ?>"><?php echo $currency['symbol_left']; ?></a>
    <?php } else { ?>
    <a class="active" title="<?php echo $currency['title']; ?>"><?php echo $currency['symbol_right']; ?></a>
    <?php } ?>
    <?php } else { ?>
    <?php if ($currency['symbol_left']) { ?>
    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'code\']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_left']; ?></a>
    <?php } else { ?>
    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'code\']').attr('value', '<?php echo $currency['code']; ?>'); $('#form_currency').submit();"><?php echo $currency['symbol_right']; ?></a>
    <?php } ?>
    <?php } ?>
    <?php } ?>
	<?php } ?>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
<?php } ?>
