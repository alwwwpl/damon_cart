<?php
class ModelBossblogCategory extends Model {
	public function addCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
	
		$blog_category_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog_category SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		}
		
		foreach ($data['blog_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_description SET blog_category_id = '" . (int)$blog_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if (isset($data['blog_category_store'])) {
			foreach ($data['blog_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_store SET blog_category_id = '" . (int)$blog_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['blog_category_layout'])) {
			foreach ($data['blog_category_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_layout SET blog_category_id = '" . (int)$blog_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_category_id=" . (int)$blog_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('blog_category');
	}
	
	public function editCategory($blog_category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog_category SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_description WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		foreach ($data['blog_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_description SET blog_category_id = '" . (int)$blog_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_store WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		
		if (isset($data['blog_category_store'])) {		
			foreach ($data['blog_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_store SET blog_category_id = '" . (int)$blog_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_layout WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		if (isset($data['blog_category_layout'])) {
			foreach ($data['blog_category_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "blog_category_layout SET blog_category_id = '" . (int)$blog_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_category_id=" . (int)$blog_category_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_category_id=" . (int)$blog_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('blog_category');
	}
	
	public function deleteCategory($blog_category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_description WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_store WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_category_layout WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_category_id=" . (int)$blog_category_id . "'");
		
		$query = $this->db->query("SELECT blog_category_id FROM " . DB_PREFIX . "blog_category WHERE parent_id = '" . (int)$blog_category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteCategory($result['blog_category_id']);
		}
		
		$this->cache->delete('blog_category');
	} 

	public function getCategory($blog_category_id) {
	   $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_category_id=" . (int)$blog_category_id . "') AS keyword FROM " . DB_PREFIX . "blog_category bc LEFT JOIN " . DB_PREFIX . "blog_category_description bcd ON (bc.blog_category_id = bcd.blog_category_id) WHERE bc.blog_category_id = '" . (int)$blog_category_id . "' AND bcd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
	
		return $query->row;
	} 
   
	public function getCategories($parent_id = 0) {
		$blog_category_data = $this->cache->get('blog_category.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id);
	
		if (!$blog_category_data) {
			$blog_category_data = array();
		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category bc LEFT JOIN " . DB_PREFIX . "blog_category_description bcd ON (bc.blog_category_id = bcd.blog_category_id) WHERE bc.parent_id = '" . (int)$parent_id . "' AND bcd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bc.sort_order, bcd.name ASC");
		
			foreach ($query->rows as $result) {
				$blog_category_data[] = array(
					'blog_category_id' => $result['blog_category_id'],
					'name'        => $this->getPath($result['blog_category_id'], $this->config->get('config_language_id')),
					'status'  	  => $result['status'],
					'sort_order'  => $result['sort_order']
				);
			
				$blog_category_data = array_merge($blog_category_data, $this->getCategories($result['blog_category_id']));
			}	
	
			$this->cache->set('blog_category.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id, $blog_category_data);
		}
		
		return $blog_category_data;
	}
	
	public function getPath($blog_category_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "blog_category bc LEFT JOIN " . DB_PREFIX . "blog_category_description bcd ON (bc.blog_category_id = bcd.blog_category_id) WHERE bc.blog_category_id = '" . (int)$blog_category_id . "' AND bcd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bc.sort_order, bcd.name ASC");
		
		if ($query->row['parent_id']) {
			return $this->getPath($query->row['parent_id'], $this->config->get('config_language_id')) . ' &gt; ' . $query->row['name'];
		} else {
			return $query->row['name'];
		}
	}
	
	public function getCategoryDescriptions($blog_category_id) {
		$blog_category_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category_description WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		
		foreach ($query->rows as $result) {
			$blog_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $blog_category_description_data;
	}	
	
	public function getCategoryStores($blog_category_id) {
		$blog_category_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category_store WHERE blog_category_id = '" . (int)$blog_category_id . "'");

		foreach ($query->rows as $result) {
			$blog_category_store_data[] = $result['store_id'];
		}
		
		return $blog_category_store_data;
	}

	public function getCategoryLayouts($blog_category_id) {
		$blog_category_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_category_layout WHERE blog_category_id = '" . (int)$blog_category_id . "'");
		
		foreach ($query->rows as $result) {
			$blog_category_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $blog_category_layout_data;
	}
		
	public function getTotalCategories() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_category");
		
		return $query->row['total'];
	}	
		
	public function getTotalCategoriesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_category WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}

	public function getTotalCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_category_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
    
    public function checkBlogCategory() {       
		$create_blog_category = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_category` (`blog_category_id` int(11) NOT NULL auto_increment, `status` tinyint(1) NOT NULL default '0', `parent_id` int(11) NOT NULL default '0', `sort_order` int(3) NOT NULL default '0', `image` varchar(255) collate utf8_unicode_ci default NULL, `date_added` datetime default NULL, `date_modified` datetime default NULL, PRIMARY KEY  (`blog_category_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_category);
		$insert_blog_category = "INSERT INTO `" . DB_PREFIX . "blog_category` (`blog_category_id`, `status`, `parent_id`, `sort_order`, `image`, `date_added`, `date_modified`) VALUES
(1, 1, 0, 0, 'data/bossblog/blog_category.jpg', '2012-11-14 09:36:32', '2014-09-23 11:52:10'),
(2, 1, 0, 1, '', '2012-11-14 09:38:51', '2014-09-23 15:23:00'),
(3, 1, 0, 2, 'data/bossblog/blog_category_03.jpg', '2012-11-14 09:39:57', '2014-07-18 14:24:46'),
(4, 1, 1, 0, 'data/bossblog/blog_category_03.jpg', '2012-11-19 09:36:05', '2014-07-18 14:24:26'),
(5, 1, 1, 0, 'data/bossblog/blog_category_03.jpg', '2012-11-19 09:36:22', '2014-07-18 14:24:03'),
(6, 1, 0, 0, 'data/bossblog/blog_category.jpg', '2012-11-19 09:36:49', '2014-09-23 15:18:28'),
(8, 1, 5, 0, 'data/bossblog/blog_category_03.jpg', '2012-11-27 15:23:20', '2014-07-18 14:24:15');";
		$this->db->query($insert_blog_category);
		
		$create_blog_category_descriptions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_category_description` (`blog_category_id` int(11) NOT NULL default '0', `language_id` int(11) NOT NULL default '0', `name` varchar(255) collate utf8_unicode_ci NOT NULL default '', `meta_description` varchar(255) collate utf8_unicode_ci NOT NULL, `meta_keyword` varchar(255) collate utf8_unicode_ci NOT NULL, `description` text collate utf8_unicode_ci NOT NULL, PRIMARY KEY  (`blog_category_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_category_descriptions);
		$insert_blog_category_descriptions = "INSERT INTO `" . DB_PREFIX . "blog_category_description` (`blog_category_id`, `language_id`, `name`, `meta_description`, `meta_keyword`, `description`) VALUES
(1, 1, 'Technology', '', '', '&lt;p&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tellus posuere sagittis. Etiam ultricies fermentum ultrices. Nam vulputate augue quis velitellus posuere sagittis. Etiam ultricies fermentum ultrices. Nam vulputate augue quis velits nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tellus&lt;/p&gt;\r\n'),
(1, 2, 'Technology', '', '', '&lt;p&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tellus posuere sagittis. Etiam ultricies fermentum ultrices. Nam vulputate augue quis velitellus posuere sagittis. Etiam ultricies fermentum ultrices. Nam vulputate augue quis velits nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tellus&lt;/p&gt;\r\n'),
(2, 1, 'Business', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(2, 2, 'Business', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(3, 1, 'Sport', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(3, 2, 'Sport', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(4, 1, 'Smart phone', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(4, 2, 'Smart phone', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(5, 1, 'Digital Camera', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(5, 2, 'Digital Camera', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(6, 1, 'Smart phone', 'boss blog', 'boss blog', '&lt;p&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tellus posuere sagittis. Etiam ultricies fermentum ultrices. Nam vulputate augue quis velitellus posuere sagittis. Etiam ultricies fermentum ultrices. Nam vulputate augue quis velits nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tellus&lt;/p&gt;\r\n'),
(6, 2, 'Smart phone', '', '', ''),
(8, 1, 'Sony', 'boss blog', 'boss blog', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n'),
(8, 2, 'Sony', 'boss blog', 'boss blog', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor.&lt;/p&gt;\r\n\r\n&lt;p&gt;vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor. Nullam at semper mauris. Maecenas commodo tincidunt leo eget mattis. Aenean nec felis eu velit interdum laoreet eget vitae purus. Donec vel sem sapien, a interdum ligula. Fusce convallis orci quis lorem bibendum ullamcorper. Maecenas convallis sapien non lorem semper quis convallis libero varius. Duis cursus nibh vel magna lobortis vehicula.&lt;br /&gt;\r\n&lt;br /&gt;\r\nFusce consectetur, velit eu pretium euismod, eros urna sollicitudin enim, eu ornare tellus magna quis justo. Etiam placerat, diam sed rutrum rutrum, orci risus volutpat augue, semper varius velit enim quis leo. Cras lectus quam, vulputate eget scelerisque at, sodales at turpis. Nulla tincidunt, velit et posuere pharetra, magna massa sagittis ligula, ac placerat ipsum elit ac risus.&lt;/p&gt;\r\n');";
		$this->db->query($insert_blog_category_descriptions);
		
		$create_blog_category_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_category_store` (`blog_category_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, PRIMARY KEY  (`blog_category_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_category_store);
		$insert_blog_category_store = "INSERT INTO `" . DB_PREFIX . "blog_category_store` (`blog_category_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(8, 0);";
		$this->db->query($insert_blog_category_store);
		
        $create_blog_category_layout = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_category_layout` (`blog_category_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, `layout_id` int(11) NOT NULL, PRIMARY KEY  (`blog_category_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_category_layout);
	}		
}
?>