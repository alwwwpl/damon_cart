<?php
class ModelBossthemesBossNewMegamenu extends Model { 
	public function createdb(){
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."megamenu'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="delete from `".DB_PREFIX."megamenu`";
			$query = $this->db->query( $sql );
		}
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."megamenu_column'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="delete from `".DB_PREFIX."megamenu_column`";
			$query = $this->db->query( $sql );
		}
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."megamenu_description'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="delete from `".DB_PREFIX."megamenu_description`";
			$query = $this->db->query( $sql );
		}
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."megamenu_row'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="delete from `".DB_PREFIX."megamenu_row`";
			$query = $this->db->query( $sql );
		}
		$sql = array();
		$sql[]  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu` (
			  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
			  `status` tinyint(1) NOT NULL DEFAULT '0',
			  `sort_order` int(3) NOT NULL DEFAULT '0',
			  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `icon` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `label_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `num_column` int(2) unsigned DEFAULT '1',
			  `icon_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `icon_class_status` tinyint(1) NOT NULL DEFAULT '1',
			  `module_id` int(11) NOT NULL,
			  PRIMARY KEY (`menu_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;";
		$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_column` (
			`column_id` int(11) NOT NULL AUTO_INCREMENT,
			`row_id` int(11) NOT NULL,
			`sort_order` int(3) NOT NULL DEFAULT '0',
			`status` tinyint(1) NOT NULL,
			`num_column` int(2) unsigned NOT NULL DEFAULT '1',
			`type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			`params` text COLLATE utf8_unicode_ci,
			PRIMARY KEY (`column_id`,`row_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;";
		
		$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_description` (
			`menu_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
		  PRIMARY KEY (`menu_id`,`language_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

		$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_row` (
			`row_id` int(11) NOT NULL AUTO_INCREMENT,
		  `menu_id` int(11) NOT NULL,
		  `sort_order` int(3) NOT NULL DEFAULT '0',
		  `status` tinyint(1) NOT NULL,
		  `height` decimal(10,0) DEFAULT NULL,
		  `bg_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
		  `bg_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
		  PRIMARY KEY (`row_id`,`menu_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;";
		
		$sql[] = "INSERT INTO `".DB_PREFIX."megamenu` (`menu_id`, `status`, `sort_order`, `url`, `icon`, `label_color`, `num_column`, `icon_class`, `icon_class_status`, `module_id`) VALUES
(24, 1, 1, 'index.php?route=product/category&amp;path=20', '', '', 3, '', 0, 2),
(25, 1, 10, 'index.php?route=bossblog/bossblog', '', '', 1, '', 0, 2),
(26, 1, 3, 'index.php?route=product/category&amp;path=20', '', '', 6, '', 0, 2),
(27, 1, 5, 'index.php?route=product/category&amp;path=20', '', '', 6, '', 0, 2),
(28, 1, 6, 'index.php?route=product/category&amp;path=20', '', '', 6, '', 0, 2),
(29, 1, 4, 'index.php?route=product/category&amp;path=20', '', '', 1, '', 0, 2),
(30, 1, 7, 'index.php?route=product/category&amp;path=20', '', '', 1, '', 0, 2),
(31, 1, 2, 'index.php?route=product/category&amp;path=20', '', '', 6, '', 0, 2),
(46, 1, 8, 'index.php?route=product/category&amp;path=20', '', '', 1, '', 0, 2);";
		$sql[] = "INSERT INTO `".DB_PREFIX."megamenu_row` (`row_id`, `menu_id`, `sort_order`, `status`, `height`, `bg_color`, `bg_image`) VALUES
(16, 31, 1, 1, 0, '', ''),
(17, 26, 0, 1, 0, '', ''),
(18, 27, 0, 1, 0, '', ''),
(19, 28, 0, 1, 0, '', ''),
(20, 29, 0, 1, 0, '', ''),
(22, 24, 0, 1, 0, '', ''),
(24, 26, 2, 1, 0, '', ''),
(25, 26, 3, 1, 0, '', ''),
(26, 26, 3, 1, 0, '', '');";
		$param1 =  $this->db->escape('{"category_id":"34","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param2 =  $this->db->escape('{"category_id":"20","product_img_w":"","product_img_h":"","manufacturer_img_w":"196","manufacturer_img_h":"80","manufacturer_name":"0","manufacturer_id":["5","7","9","8","10","6"],"content_text":{"1":"\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t"}}');
		$param3 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;h3&gt;There is an example of a large container with 6 columns&lt;\\/h3&gt;\\n","2":"&lt;h3&gt;There is an example of a large container with 6 columns&lt;\\/h3&gt;\\n"}}');
		$param4 =  $this->db->escape('{"category_id":"25","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param5 =  $this->db->escape('{"category_id":"20","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param6 =  $this->db->escape('{"category_id":"24","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;p&gt;&lt;img alt=&quot;Banner&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/static_logo.jpg&quot; style=&quot;width:177px;height:49px&quot; title=&quot;canon&quot; \\/&gt;&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum vitae eget neque.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl.&lt;\\/p&gt;\\n\\n&lt;p&gt;Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl. Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n","2":"&lt;p&gt;&lt;img alt=&quot;Banner&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/static_logo.jpg&quot; style=&quot;width:177px;height:49px&quot; title=&quot;canon&quot; \\/&gt;&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum vitae eget neque.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl.&lt;\\/p&gt;\\n\\n&lt;p&gt;Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl. Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n"}}');
		$param7 =  $this->db->escape('{"category_id":"0","product_img_w":"150","product_img_h":"191","product_ids":["41","40","48","36"],"manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;p&gt;&lt;img alt=&quot;Banner&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/menu_logo2.jpg&quot; style=&quot;width:203px;height:40px&quot; title=&quot;canon&quot; \\/&gt;&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum vitae eget neque.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl.&lt;\\/p&gt;\\n\\n&lt;p&gt;Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl. Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n","2":"&lt;p&gt;&lt;img alt=&quot;Banner&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/menu_logo2.jpg&quot; style=&quot;width:203px;height:40px&quot; title=&quot;canon&quot; \\/&gt;&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum vitae eget neque.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl.&lt;\\/p&gt;\\n\\n&lt;p&gt;Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum lorem interdum et eu nisi. In hac habitasse platea mas dictumst. Maecenas sed velit nisl. Duis enim arcu, sodales vitae interdum sed, ma dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n"}}');
		$param8 =  $this->db->escape('{"category_id":"20","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;div class=&quot;sub-menu-block&quot;&gt;&lt;a href=&quot;#&quot; title=&quot;TitianShop&quot;&gt;&lt;img alt=&quot;menu-logo&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/titanshop_v2_vintage\\/image\\/catalog\\/bt_titanshop\\/brand.png&quot;&gt;&lt;\\/a&gt;&lt;p&gt;Quisque interdum sem eu urna facilisis, sit amet feugiat tortor iaculis. Sed tortor veliQuisque interdum sem eu urna facilisis, sit amet feugiat tortor iaculis. Sed tortor velit, pellentesque vel egestas&lt;\\/p&gt;\\n&lt;p&gt;Vitae, accumsan sit amet ligula. Nullam nec diam vitae tellus rhoncus sollicitudin. Morbi malesuada&lt;\\/p&gt;\\n&lt;\\/div&gt;\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t","2":"&lt;div class=&quot;sub-menu-block&quot;&gt;&lt;a href=&quot;#&quot; title=&quot;TitianShop&quot;&gt;&lt;img alt=&quot;menu-logo&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/titanshop_v2_vintage\\/image\\/catalog\\/bt_titanshop\\/brand.png&quot;&gt;&lt;\\/a&gt;&lt;p&gt;Quisque interdum sem eu urna facilisis, sit amet feugiat tortor iaculis. Sed tortor veliQuisque interdum sem eu urna facilisis, sit amet feugiat tortor iaculis. Sed tortor velit, pellentesque vel egestas&lt;\\/p&gt;\\n\\n&lt;p&gt;Vitae, accumsan sit amet ligula. Nullam nec diam vitae tellus rhoncus sollicitudin. Morbi malesuada&lt;\\/p&gt;\\n\\n&lt;\\/div&gt;\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t"}}');
		$param9 =  $this->db->escape('{"category_id":"34","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param10 =  $this->db->escape('{"category_id":"33","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param11 =  $this->db->escape('{"category_id":"25","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param12 =  $this->db->escape('{"category_id":"17","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param13 =  $this->db->escape('{"category_id":"33","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param14 =  $this->db->escape('{"category_id":"45","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param15 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;h3&gt;Here is some contents with side images&lt;\\/h3&gt;\\n\\t\\t\\t\\t\\t\\t","2":"&lt;h3&gt;Here is some contents with side images&lt;\\/h3&gt;\\n\\t\\t\\t\\t\\t\\t"}}');
		$param16 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;h3&gt;This is a blackbox, you can use it to highlight some contens&lt;\\/h3&gt;\\n\\t\\t\\t\\t\\t\\t","2":"&lt;h3&gt;This is a blackbox, you can use it to highlight some contens&lt;\\/h3&gt;\\n\\t\\t\\t\\t\\t\\t"}}');
		$param17 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;p&gt;&lt;img alt=&quot;static_banner_1&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/static_menu.jpg&quot; title=&quot;static banner 1&quot; \\/&gt;&lt;\\/p&gt;\\n","2":"&lt;p&gt;&lt;img alt=&quot;static_banner_1&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/static_menu.jpg&quot; title=&quot;static banner 1&quot; \\/&gt;&lt;\\/p&gt;\\n"}}');
		$param18 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;p&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum vitae eget neque.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum interdum et eu nisi. In hac habitasse platea dictumst. Maecenas sed velit nisl.&lt;br \\/&gt;\\nDuis enim arcu, sodales vitae interdum sed, dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n\\n&lt;p&gt;Curabitur pulvinar tincidunt sapien vitae pellentesque. Fusce metus turpis, hendrerit vitae sollicitudin quis, sollicitudin non dolor. Aenean pretium metus id tortor molestie egestas.&lt;\\/p&gt;\\n","2":"&lt;p&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum vitae eget neque.&lt;\\/p&gt;\\n\\n&lt;p&gt;Suspendisse et libero non dolor fermentum interdum et eu nisi. In hac habitasse platea dictumst. Maecenas sed velit nisl.&lt;br \\/&gt;\\nDuis enim arcu, sodales vitae interdum sed, dignissim ut dui. Fusce tincidunt dapibus tortor.&lt;\\/p&gt;\\n\\n&lt;p&gt;Curabitur pulvinar tincidunt sapien vitae pellentesque. Fusce metus turpis, hendrerit vitae sollicitudin quis, sollicitudin non dolor. Aenean pretium metus id tortor molestie egestas.&lt;\\/p&gt;\\n"}}');
		$param19 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;p&gt;Praesent eleifend arcu id sem imperdiet porttitor. Suspendisse accumsan purus sit amet augue luctus in semper elit sodales.&lt;\\/p&gt;\\n\\n&lt;p&gt;Nulla quis eros arcu, eget dapibus mauris. Duis at tellus orci, vitae porta elit. Nam pellentesque blandit velit. Vestibulum dapibus quam sit amet dui interdum ut ultricies dolor porta.&lt;\\/p&gt;\\n\\n&lt;p&gt;Curabitur pulvinar tincidunt sapien vitae pellentesque. Fusce metus turpis, hendrerit vitae sollicitudin quis, sollicitudin non dolor. Aenean pretium metus id tortor molestie egestas.&lt;\\/p&gt;\\n","2":"&lt;p&gt;Praesent eleifend arcu id sem imperdiet porttitor. Suspendisse accumsan purus sit amet augue luctus in semper elit sodales.&lt;\\/p&gt;\\n\\n&lt;p&gt;Nulla quis eros arcu, eget dapibus mauris. Duis at tellus orci, vitae porta elit. Nam pellentesque blandit velit. Vestibulum dapibus quam sit amet dui interdum ut ultricies dolor porta.&lt;\\/p&gt;\\n\\n&lt;p&gt;Curabitur pulvinar tincidunt sapien vitae pellentesque. Fusce metus turpis, hendrerit vitae sollicitudin quis, sollicitudin non dolor. Aenean pretium metus id tortor molestie egestas.&lt;\\/p&gt;\\n"}}');
		$param20 =  $this->db->escape('{"category_id":"33","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param21 =  $this->db->escape('{"category_id":"20","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param22 =  $this->db->escape('{"category_id":"34","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param23 =  $this->db->escape('{"category_id":"0","product_img_w":"80","product_img_h":"80","product_ids":["40"],"manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param24 =  $this->db->escape('{"category_id":"25","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param25 =  $this->db->escape('{"category_id":"20","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"\\t\\t\\t\\t\\t\\t","2":"\\t\\t\\t\\t\\t\\t"}}');
		$param26 =  $this->db->escape('{"category_id":"0","product_img_w":"","product_img_h":"","manufacturer_img_w":"","manufacturer_img_h":"","manufacturer_name":"0","content_text":{"1":"&lt;h4&gt;Maecenas duis autem hendrerit&lt;\\/h4&gt;\\n\\n&lt;p class=&quot;video&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/video.jpg&quot;&gt;&lt;\\/p&gt;\\n\\n&lt;p class=&quot;video&quot;&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum viate aget neque.&lt;\\/p&gt;\\n\\t\\t\\t\\t\\t\\t","2":"&lt;h4&gt;Maecenas duis autem hendrerit&lt;\\/h4&gt;\\n\\n&lt;p class=&quot;video&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;http:\\/\\/demo.bossthemes.com\\/fashionist_v2\\/image\\/catalog\\/bt_fashionist\\/video.jpg&quot;&gt;&lt;\\/p&gt;\\n\\n&lt;p class=&quot;video&quot;&gt;Suspendisse sed viverra nibh. Mauris nec sapien commodo risus molestie vestibulum viate aget neque.&lt;\\/p&gt;\\n\\t\\t\\t\\t\\t\\t"}}');
		$sql[] = "INSERT INTO `".DB_PREFIX."megamenu_column` (`column_id`, `row_id`, `sort_order`, `status`, `num_column`, `type`, `params`) VALUES
(47, 24, 3, 1, 1, 'category', '".$param1."'),
(32, 16, 1, 1, 6, 'manufacturer', '".$param2."'),
(33, 17, 1, 1, 6, 'html', '".$param3."'),
(45, 24, 1, 1, 1, 'category', '".$param4."'),
(46, 24, 2, 1, 1, 'category', '".$param5."'),
(34, 18, 1, 1, 2, 'html', '".$param6."'),
(35, 19, 1, 1, 2, 'html', '".$param7."'),
(36, 20, 1, 1, 1, 'category', '".$param8."'),
(42, 22, 1, 1, 1, 'category', '".$param9."'),
(43, 22, 2, 1, 1, 'category', '".$param10."'),
(44, 22, 3, 1, 1, 'category', '".$param11."'),
(48, 24, 4, 1, 1, 'category', '".$param12."'),
(49, 24, 5, 1, 1, 'category', '".$param13."'),
(50, 24, 6, 1, 1, 'category', '".$param14."'),
(51, 25, 1, 1, 2, 'html', '".$param15."'),
(52, 25, 2, 1, 2, 'html', '".$param16."'),
(53, 26, 1, 1, 2, 'html', '".$param17."'),
(54, 26, 2, 1, 2, 'html', '".$param18."'),
(55, 26, 3, 1, 2, 'html', '".$param19."'),
(56, 18, 2, 1, 1, 'category', '".$param20."'),
(57, 18, 3, 1, 1, 'category', '".$param21."'),
(58, 18, 4, 1, 1, 'category', '".$param22."'),
(59, 18, 6, 1, 1, 'product', '".$param23."'),
(60, 19, 2, 1, 1, 'category', '".$param24."'),
(61, 19, 3, 1, 1, 'category', '".$param25."'),
(62, 19, 5, 1, 2, 'html', '".$param26."');";
		$sql[] = "INSERT INTO `".DB_PREFIX."megamenu_description` (`menu_id`, `language_id`, `title`, `label`) VALUES
(24, 1, 'Accessories', ''),
(25, 2, 'Blog', ''),
(25, 1, 'Blog', ''),
(26, 1, 'Bracelets', ''),
(27, 2, 'Belts', ''),
(28, 1, 'Sunglasses', ''),
(29, 1, 'Key rings', ''),
(30, 2, 'Gravida', ''),
(30, 1, 'Gravida', ''),
(31, 2, 'Brands', ''),
(24, 2, 'Accessories', ''),
(31, 1, 'Brands', ''),
(27, 1, 'Belts', ''),
(28, 2, 'Sunglasses', ''),
(46, 1, 'Hendrerit', ''),
(26, 2, 'Bracelets', ''),
(29, 2, 'Key rings', ''),
(46, 2, 'Hendrerit', '');";
		
		foreach( $sql as $q ){
			$query = $this->db->query($q);
		}
	}
	public function addMenu($module_id,$data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "megamenu SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "',num_column = '" . (int)$data['num_column'] . "', url = '" . $this->db->escape($data['url']) . "',icon = '" . $this->db->escape($data['icon']) . "',label_color = '" . $this->db->escape($data['label_color']) . "', icon_class_status = '" . (int)$data['icon_class_status'] . "', icon_class = '" . $this->db->escape($data['icon_class']) . "',module_id = '" . (int)$module_id . "'");
		
		$menu_id = $this->db->getLastId();

		foreach ($data['menudes'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "megamenu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "',label = '" . $this->db->escape($value['label']) . "'");
		}
	}
	
	public function addMenuRow($menu_id,$data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "megamenu_row SET menu_id = '" . (int)$menu_id . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', height = '" . (float)$data['height'] . "', bg_color = '" . $this->db->escape($data['bg_color']) . "', bg_image = '" . $this->db->escape($data['bg_image']) . "'");
	}
	
	public function addMenuColumn($row_id,$data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "megamenu_column SET row_id = '" . (int)$row_id . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', num_column = '" . (int)$data['num_column'] . "', type = '" . $this->db->escape($data['type']) . "', params = '" . $this->db->escape(json_encode($data['params'])) . "'");
	}
	
	public function editMenu($menu_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "megamenu SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "',url = '" . $this->db->escape($data['url']) . "', icon_class_status = '" . (int)$data['icon_class_status'] . "', icon_class = '" . $this->db->escape($data['icon_class']) . "', num_column = '" . (int)$data['num_column'] . "', icon = '" . $this->db->escape($data['icon']) . "',label_color = '" . $this->db->escape($data['label_color']) . "' WHERE menu_id = '" . (int)$menu_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "megamenu_description WHERE menu_id = '" . (int)$menu_id . "'");

		foreach ($data['menudes'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "megamenu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "',label = '" . $this->db->escape($value['label']) . "'");
		}
	}
	
	public function editMenuRow($row_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "megamenu_row SET menu_id = '" . (int)$data['menu_id'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', height = '" . (float)$data['height'] . "', bg_color = '" . $this->db->escape($data['bg_color']) . "', bg_image = '" . $this->db->escape($data['bg_image']) . "' WHERE row_id = '" . (int)$row_id . "'");
	}
	
	public function editMenuColumn($column_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "megamenu_column SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', num_column = '" . (int)$data['num_column'] . "', type = '" . $this->db->escape($data['type']) . "', params = '" . $this->db->escape(json_encode($data['params'])) . "' WHERE column_id = '" . (int)$column_id . "'");
	}
	
	public function deleteMenu($menu_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "megamenu WHERE menu_id = '" . (int)$menu_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "megamenu_description WHERE menu_id = '" . (int)$menu_id . "'");
	}
	
	public function deleteMenuRow($row_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "megamenu_row WHERE row_id = '" . (int)$row_id . "'");
	}
	public function deleteMenuColumn($column_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "megamenu_column WHERE column_id = '" . (int)$column_id . "'");
	}
	
	public function getMenus(){
		$sql = "SELECT * FROM " . DB_PREFIX . "megamenu m LEFT JOIN " . DB_PREFIX . "megamenu_description md ON (m.menu_id = md.menu_id)";
		
		$sql .= " WHERE md.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		$sql .= " GROUP BY m.menu_id";
		
		$sql .= " ORDER BY m.sort_order";
		
		$query = $this->db->query($sql);

		return $query->rows;
		
	}
	public function getMenusByModuleId($module_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "megamenu m LEFT JOIN " . DB_PREFIX . "megamenu_description md ON (m.menu_id = md.menu_id)";
		
		$sql .= " WHERE m.module_id = '" . (int)$module_id . "' and md.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		$sql .= " GROUP BY m.menu_id";
		
		$sql .= " ORDER BY m.sort_order";
		
		$query = $this->db->query($sql);

		return $query->rows;
		
	}
	
	public function getMenuRows($menu_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "megamenu_row mr WHERE mr.menu_id = '" . (int)$menu_id . "'";
		
		$sql .= " ORDER BY mr.sort_order";
		
		$query = $this->db->query($sql);

		return $query->rows;
		
	}
	
	public function getMenuColumns($row_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "megamenu_column mc WHERE mc.row_id = '" . (int)$row_id . "'";
		
		$sql .= " ORDER BY mc.sort_order";
		
		$query = $this->db->query($sql);

		return $query->rows;
		
	}
	
	public function getMenu($menu_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "megamenu m LEFT JOIN " . DB_PREFIX . "megamenu_description md ON (m.menu_id = md.menu_id) WHERE m.menu_id = '" . $menu_id . "' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
		
	}
	
	public function getMenuRow($row_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "megamenu_row mr WHERE mr.row_id = '" . (int)$row_id . "'");

		return $query->row;
		
	}
	
	public function getMenuColumn($column_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "megamenu_column mc WHERE mc.column_id = '" . (int)$column_id . "'");

		return $query->row;
		
	}
	
	public function getMenuDescription($menu_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "megamenu_description md WHERE md.menu_id = '" . $menu_id . "'");

		foreach ($query->rows as $result) {
			$menu_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'label'             => $result['label']
			);
		}

		return $menu_description_data;
		
	}
	
	public function updateSortMenu($data){
		$count = 1;
		foreach ($data as $menu_id) {
			$query = "UPDATE " . DB_PREFIX . "megamenu SET sort_order = " . $count . " WHERE menu_id = " . $menu_id;
			$this->db->query($query);
			$count ++;	
		}
	}
	public function updateSortRow($menu_id,$data){
		$count = 1;
		foreach ($data as $row_id) {
			$this->db->query("UPDATE " . DB_PREFIX . "megamenu_row SET sort_order = " . $count . " WHERE menu_id = " . $menu_id." AND row_id = ".$row_id);
			$count ++;	
		}
	}
	public function updateSortColumn($row_id,$data){
		$count = 1;
		foreach ($data as $column_id) {
			$this->db->query("UPDATE " . DB_PREFIX . "megamenu_column SET sort_order = " . $count . " WHERE row_id = " . $row_id." AND column_id = ".$column_id);
			$count ++;	
		}
	}
	
	public function install(){
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."megamenu'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="delete from `".DB_PREFIX."megamenu`";
			$query = $this->db->query( $sql );
			$sql = array();			
			$sql[]  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu` (
			  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
			  `status` tinyint(1) NOT NULL DEFAULT '0',
			  `sort_order` int(3) NOT NULL DEFAULT '0',
			  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `icon` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `label_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `num_column` int(2) unsigned DEFAULT '1',
			  `icon_class` varchar(255) CHARACTER SET utf8_unicode_ci DEFAULT NULL,
			  `icon_class_status` tinyint(1) NOT NULL DEFAULT '1',
			  `module_id` int(11) NOT NULL,
			  PRIMARY KEY (`menu_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;";
			$sql[] = "CREATECREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_description` (
			  `menu_id` int(11) NOT NULL,
			  `language_id` int(11) NOT NULL,
			  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
			  PRIMARY KEY (`menu_id`,`language_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;";
			$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_row` (
				  `row_id` int(11) NOT NULL AUTO_INCREMENT,
				  `menu_id` int(11) NOT NULL,
				  `sort_order` int(3) NOT NULL DEFAULT '0',
				  `status` tinyint(1) NOT NULL,
				  `height` decimal(10,0) DEFAULT NULL,
				  `bg_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				  `bg_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				  PRIMARY KEY (`row_id`,`menu_id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;";
			$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_column` (
				  `column_id` int(11) NOT NULL AUTO_INCREMENT,
				  `row_id` int(11) NOT NULL,
				  `sort_order` int(3) NOT NULL DEFAULT '0',
				  `status` tinyint(1) NOT NULL,
				  `num_column` int(2) unsigned NOT NULL DEFAULT '1',
				  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				  `params` text COLLATE utf8_unicode_ci,
				  PRIMARY KEY (`column_id`,`row_id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;";
			foreach( $sql as $q ){
				$query = $this->db->query( $q );
			}
		}else{ 
			$sql = array();
			$sql[]  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu` (
			  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
			  `status` tinyint(1) NOT NULL DEFAULT '0',
			  `sort_order` int(3) NOT NULL DEFAULT '0',
			  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `icon` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `label_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `num_column` int(2) unsigned DEFAULT '1',
			  `icon_class` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
			  `icon_class_status` tinyint(1) NOT NULL DEFAULT '1',
			  `module_id` int(11) NOT NULL,
			  PRIMARY KEY (`menu_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;";
			$sql[] = "CREATECREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_description` (
			  `menu_id` int(11) NOT NULL,
			  `language_id` int(11) NOT NULL,
			  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
			  PRIMARY KEY (`menu_id`,`language_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;";
			$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_row` (
				  `row_id` int(11) NOT NULL AUTO_INCREMENT,
				  `menu_id` int(11) NOT NULL,
				  `sort_order` int(3) NOT NULL DEFAULT '0',
				  `status` tinyint(1) NOT NULL,
				  `height` decimal(10,0) DEFAULT NULL,
				  `bg_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				  `bg_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				  PRIMARY KEY (`row_id`,`menu_id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;";
			$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."megamenu_column` (
				  `column_id` int(11) NOT NULL AUTO_INCREMENT,
				  `row_id` int(11) NOT NULL,
				  `sort_order` int(3) NOT NULL DEFAULT '0',
				  `status` tinyint(1) NOT NULL,
				  `num_column` int(2) unsigned NOT NULL DEFAULT '1',
				  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				  `params` text COLLATE utf8_unicode_ci,
				  PRIMARY KEY (`column_id`,`row_id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;";

			foreach( $sql as $q ){
				$query = $this->db->query( $q );
			}
		}	
	}
}

?>