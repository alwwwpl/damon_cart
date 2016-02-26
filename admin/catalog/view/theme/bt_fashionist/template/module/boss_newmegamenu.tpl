
<?php 
function showSubmenu($category) {
	if (count($category['children']) > 0) {
		echo '<div class="sub_menu"><ul>';
		foreach ($category['children'] as $cat) {
			if(count($cat['children']) > 0){
				echo '<li class="sub_category"><a href="'.$cat['href'].'">'.$cat['name'].'</a>';
				showSubmenu($cat);
				echo '</li>';
			}else{
				echo '<li ><a href="'.$cat['href'].'">'.$cat['name'].'</a></li>';
			}
		}
		echo '</ul></div>';
	}
}
?>
<a class="open-panel"><i class="fa fa-bars"></i></a>
<nav class="mega-menu">
	<a class="close-panel"><i class="fa fa-times-circle"></i></a>
	<ul class="nav nav-pills">
		<?php foreach($menus as $menu){ if($menu['status']){ ?>
		<li <?php if ((!empty($menu['menurow']))&&(count($menu['menurow']) > 0)) { echo 'class="parent"'; } ?>>
			<?php if ((!empty($menu['menurow']))&&(count($menu['menurow']) > 0)) { echo '<p class="plus visible-xs">+</p>'; } ?>
			<a href="<?php echo $menu['url']; ?>"><?php if($menu['icon_class_status']){ echo '<span class="'.$menu['icon_class'].'"></span>'; }else{ if($menu['thumb']){ ?><span><img alt="<?php echo $menu['title']; ?>" src="<?php echo $menu['thumb']; ?>"/></span><?php } }?><span class="menu-title"><?php echo $menu['title']; ?><i class="fa fa-sort-down"></i></span><span class="label label-success"<?php if(!empty($menu['label_color'])){ ?>style="background-color:#<?php echo $menu['label_color']; ?>" <?php } ?> ><?php echo $menu['label']; ?></span></a>
			<?php if(!empty($menu['menurow'])){ ?>
			<div class="dropdown drop-grid-<?php echo $menu_column; ?>-<?php echo ($menu['num_column']>$menu_column)?$menu_column:$menu['num_column']; ?>">
			
				<?php $menurow = $menu['menurow']; ?>
				<?php foreach($menurow as $row){ if($row['status']){ ?>
				<div class="menu-row row-col-<?php echo ($menu['num_column']>$menu_column)?$menu_column:$menu['num_column']; ?>" <?php if(!empty($row['bg_color'])){ ?>style="background-color:#<?php echo $row['bg_color']; ?>" <?php } ?>>
				<?php 
					if($menu['num_column']>$menu_column){
						$numrow = $menu_column;
					}else{$numrow = $menu['num_column'];}
				?>
				<?php if(!empty($row['columns'])){ ?>
				
					<?php if($row['bg_image']){ ?>
					<img alt="bg image" src="<?php echo $row['bg_image']; ?>" class="row-bg-image bt-menu-bg">
					<?php } ?>
					
					<?php $menucolumn = $row['columns']; ?>
					<?php $i = 1;?>
					<?php foreach($menucolumn as $column){ if($column['status']){?>
					<div class="menu-column row-grid-<?php echo ($column['num_column']>$numrow)?$numrow:$column['num_column']; ?>">
						<?php if ($column['type'] == 'information') { ?><!-- information -->
							<ul class="column information">
								<?php foreach($column['coldata'] as $information) { ?>
								<li class="col-grid-<?php echo ($column['num_column']>$numrow)?$numrow:$column['num_column']; ?>"><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
								<?php } ?>
							</ul>
						<?php } ?>
						
						<?php if ($column['type'] == 'html') { ?><!-- html-->
							<div class="staticblock"><?php echo $column['coldata']; ?></div>
						<?php } ?>
						
						<?php if ($column['type'] == 'category') { ?><!-- category -->
							
							<?php if ($column['parent']) { ?>
								<a href="<?php echo $column['parent']['href']; ?>" class="parent">
									<?php echo $column['parent']['name']; ?>
								</a>
							<?php } ?>
							
							<ul class="column category">
								<?php foreach($column['coldata'] as $category) { ?>
									<li class="col-grid-<?php echo $column['num_column']; ?> <?php if (count($category['children']) > 0) { echo'sub_category'; } ?>">
										<div><a href="<?php echo $category['href']; ?>">
										<?php echo $category['name']; ?>
										<i class="fa fa-caret-right"></i></a>
										<?php showSubmenu($category); ?></div>
									</li>
								<?php } ?>
							</ul>
						
						<?php } ?>
						
						<?php if ($column['type'] == 'product') { ?>
							<ul class="column product"><!-- product -->
								<?php foreach($column['coldata'] as $product) { ?>
									<li class="col-grid-<?php echo $column['num_column']; ?>"> <!--style="width: <?php echo $product['li_width']; ?>px;"--> 
										<div class="image">
										<?php if ($product['thumb']) { ?><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>"/></a><br/><?php } ?></div>
											<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><br /></div>
											<div class="price">
											<?php if (!$product['special']) { ?>
												<?php echo $product['price']; ?>
											<?php } else { ?>
												<span class="price-old"><?php echo $product['price']; ?></span>
												<span class="price-new"><?php echo $product['special']; ?></span>
											<?php } ?>
											</div>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
						
						<?php if ($column['type'] == 'manufacturer') { ?><!-- manufacturer -->
							<ul class="column manufacturer">
								<?php foreach($column['coldata'] as $manufacturer) { ?>
									<li class="col-grid-<?php echo ($column['num_column']>$numrow)?$numrow:$column['num_column']; ?>"><!--style="width: <?php echo $manufacturer['li_width']; ?>px;"-->
									<a href="<?php echo $manufacturer['href']; ?>"><img src="<?php echo $manufacturer['image']; ?>" alt="<?php echo $manufacturer['name']; ?>"/></a><br/>
									<a href="<?php echo $manufacturer['href']; ?>"><?php if ($manufacturer['show_name']) { ?><span class="name"><?php echo $manufacturer['name']; ?></span><?php } ?>
									</a></li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
					<?php } }?>
				<?php $i++;} ?>
				
				</div>
				<?php }} ?>
				
			</div>
			<?php } ?>
		</li>
		<?php } }?>
	</ul>
</nav>
<style>
.bt-menu-bg img{
position: absolute;
bottom: 0;
left: 0;
z-index: -1;
max-width: none;
}
</style>