<?php echo $header; ?>
<?php global $config; ?>
<?php 
    $refine_search=0; $category_info=0; $view='both_grid'; $boss_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
    if($config->get('boss_manager')){
        $boss_manager = $config->get('boss_manager'); 
    }else{
        $boss_manager = '';
    }
    if(!empty($boss_manager)){
        $refine_search = isset($boss_manager['other']['refine_search'])?$boss_manager['other']['refine_search']:0;      
        $category_info = isset($boss_manager['other']['category_info'])?$boss_manager['other']['category_info']:0;      
        $view = isset($boss_manager['other']['view_pro'])?$boss_manager['other']['view_pro']:'both_grid'; 
        $perrrow = isset($boss_manager['other']['perrow'])?$boss_manager['other']['perrow']:3;
    }
    
    if(isset($perrrow) && $perrrow==1){
        $boss_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
    }else if(isset($perrrow) && $perrrow==2){
        $boss_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
    }else if(isset($perrrow) && $perrrow==3){
        $boss_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
    }else if(isset($perrrow) && $perrrow==4){
        $boss_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
    }else if(isset($perrrow) && $perrrow==5){
        $boss_class = 'boss-col-5column col-md-3 col-sm-6 col-xs-12';
    }else if(isset($perrrow) && $perrrow==6){
        $boss_class = 'col-lg-2 col-md-3 col-sm-6 col-xs-12';
    }
?>
<style type="text/css" media="screen">
#bt_header{display: none;}
</style>
<div class="container">
  <div class="row">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
      <div class="clearfix">
        <a class="pull-right" href="<?php echo $register; ?>" title="">注册</a>
      </div>
      <div class="store_bg">
        <img class="bg" src="/catalog/view/theme/bt_fashionist/image/store_bg.jpg" alt="">
        <h1 class="store_name"><?php echo $customer['store_name']; ?></h1>
        <?php if($store_logo){ ?>
        <img class="store_logo" src="<?php echo $store_logo ?>" width="40">
        <?php } ?>
      </div>
      <?php echo $content_top;
      ?>
      <?php if ($products) { ?>
      <div class="row layout-thumb">
        <?php foreach ($products as $product) { ?>
        <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="product-thumb">
            <div class="image"><a href="<?php echo $product['href'];?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
            </div>
            <div class="name"><a href="<?php echo $product['href'];?>"><?php echo $product['name']; ?></a></div>
            <?php if ($product['price']) { ?>
            <p class="price">
              <?php echo $product['price']; ?>
            </p>
            <?php } ?>
            <?php if ($product['rating']) { ?>
            <div class="rating">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($product['rating'] < $i) { ?>
              <span class="fa fa-stack fa-hidden"><i class="fa fa-heart"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-heart"></i></span>
              <?php } ?>
              <?php } ?>
            </div>
            <?php } ?>
            <p class="description"><?php echo $product['description']; ?></p>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>  
</div>