<?php 
	$b_login = 0; 
    $b_register = 0;
    $b_forgotten = 0; 
    $b_account = 0; 
    $b_edit = 0;  
    $b_password = 0;  
    $b_wishlist = 0;  
    $b_order = 0; 
    $b_download = 0;    
    $b_reward = 0;    
    $b_return = 0;   
    $b_transaction = 0;  
    $b_newsletter = 0;  
    $b_recurring = 0;  
    $b_address = 0;
    $b_product_distribute = 0;
    if(isset($_GET['route'])){     
		switch($_GET['route']){
		  case 'account/login':   $b_login = 1;     break;    
		  case 'account/register':  $b_register = 1;    break;    
		  case 'account/forgotten': $b_forgotten = 1;   break;    
		  case 'account/account':   $b_account = 1;     break;    
		  case 'account/edit':    $b_edit = 1;      break;    
		  case 'account/password':  $b_password = 1;    break;    
		  case 'account/wishlist':  $b_wishlist = 1;    break;    
		  case 'account/order':   $b_order = 1;     break;    
		  case 'account/download':  $b_download = 1;    break;    
		  case 'account/reward':  $b_reward = 1;    break;    
		  case 'account/return':    $b_return = 1;      break;    
		  case 'account/transaction': $b_transaction = 1;   break;    
		  case 'account/newsletter':  $b_newsletter = 1;    break;
		  case 'account/recurring':   $b_recurring = 1;   break;
		  case 'account/address':   $b_address = 1;   break;
          case 'account/product_distribute':   $b_product_distribute = 1;   break;
		}
    }  
?>
<div class="bt-box">
	<div class="box-heading"><span><?php echo $heading_title; ?></span></div>
	<div class="box-content">
	  <ul>
	  <?php if (!$logged) { ?>
	  <li <?php echo ($b_login==1 ? 'class="active"' : ''); ?>><a href="<?php echo $login; ?>" class="list-group-item"><?php echo $text_login; ?></a></li> 
	  <li <?php echo ($b_register==1 ? 'class="active"' : ''); ?>><a href="<?php echo $register; ?>" class="list-group-item"><?php echo $text_register; ?></a></li> 
	  <li <?php echo ($b_forgotten==1 ? 'class="active"' : ''); ?>><a href="<?php echo $forgotten; ?>" class="list-group-item"><?php echo $text_forgotten; ?></a></li>
	  <?php } ?>
	  <li <?php echo ($b_account==1 ? 'class="active"' : ''); ?>><a href="<?php echo $account; ?>" class="list-group-item"><?php echo $text_account; ?></a></li>
	  <?php if ($logged) { ?>
	  <li <?php echo ($b_edit==1 ? 'class="active"' : ''); ?>><a href="<?php echo $edit; ?>" class="list-group-item"><?php echo $text_edit; ?></a></li> 
	  <li <?php echo ($b_password==1 ? 'class="active"' : ''); ?>><a href="<?php echo $password; ?>" class="list-group-item"><?php echo $text_password; ?></a></li>
	  <?php } ?>
	  <li <?php echo ($b_address==1 ? 'class="active"' : ''); ?>><a href="<?php echo $address; ?>" class="list-group-item"><?php echo $text_address; ?></a></li> 
	  <li <?php echo ($b_wishlist==1 ? 'class="active"' : ''); ?>><a href="<?php echo $wishlist; ?>" class="list-group-item"><?php echo $text_wishlist; ?></a></li> 
	  <li <?php echo ($b_order==1 ? 'class="active"' : ''); ?>><a href="<?php echo $order; ?>" class="list-group-item"><?php echo $text_order; ?></a></li> 
	  <!-- <li <?php echo ($b_download==1 ? 'class="active"' : ''); ?>><a href="<?php echo $download; ?>" class="list-group-item"><?php echo $text_download; ?></a></li> --> 
	  <li <?php echo ($b_reward==1 ? 'class="active"' : ''); ?>><a href="<?php echo $reward; ?>" class="list-group-item"><?php echo $text_reward; ?></a></li> 
	  <li <?php echo ($b_return==1 ? 'class="active"' : ''); ?>><a href="<?php echo $return; ?>" class="list-group-item"><?php echo $text_return; ?></a></li> 
	  <li <?php echo ($b_transaction==1 ? 'class="active"' : ''); ?>><a href="<?php echo $transaction; ?>" class="list-group-item"><?php echo $text_transaction; ?></a></li> 
	  <li <?php echo ($b_newsletter==1 ? 'class="active"' : ''); ?>><a href="<?php echo $newsletter; ?>" class="list-group-item"><?php echo $text_newsletter; ?></a></li>
	  <li <?php echo ($b_recurring==1 ? 'class="active"' : ''); ?>><a href="<?php echo $recurring; ?>" class="list-group-item"><?php echo $text_recurring; ?></a></li>
      <li <?php echo ($b_product_distribute==1 ? 'class="active"' : ''); ?>><a href="<?php echo $product_distribute; ?>" class="list-group-item"><?php echo $text_product_distribute; ?></a></li>
	  <?php if ($logged) { ?>
	  <li><a href="<?php echo $logout; ?>" class="list-group-item"><?php echo $text_logout; ?></a></li>
	  <?php } ?>
	  </ul>
	</div>
</div>
