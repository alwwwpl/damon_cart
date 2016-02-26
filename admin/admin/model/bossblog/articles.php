<?php
class ModelBossblogArticles extends Model {
	public function addArticle($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article SET author = '" . $this->db->escape($data['author']) . "', status = '" . (int)$data['status'] . "', allow_comment = '" . (int)$data['allow_comment'] . "', need_approval = '" . (int)$data['need_approval'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");
		
		$blog_article_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog_article SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		}
		
		foreach ($data['article_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_description SET blog_article_id = '" . (int)$blog_article_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', title = '" . $this->db->escape($value['title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', content = '" . $this->db->escape($value['content']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}
		
		if (isset($data['article_store'])) {
			foreach ($data['article_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_store SET blog_article_id = '" . (int)$blog_article_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		
		if (isset($data['article_category'])) {
			foreach ($data['article_category'] as $blog_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_category SET blog_article_id = '" . (int)$blog_article_id . "', blog_category_id = '" . (int)$blog_category_id . "'");
			}
		}
		
		if (isset($data['article_related'])) {
			foreach ($data['article_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$blog_article_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_related SET blog_article_id = '" . (int)$blog_article_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$related_id . "' AND related_id = '" . (int)$blog_article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_related SET blog_article_id = '" . (int)$related_id . "', related_id = '" . (int)$blog_article_id . "'");
			}
		}
        
        if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $product_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$blog_article_id . "' AND product_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_product_related SET blog_article_id = '" . (int)$blog_article_id . "', product_id = '" . (int)$product_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$product_id . "' AND product_id = '" . (int)$blog_article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_product_related SET blog_article_id = '" . (int)$product_id . "', product_id = '" . (int)$blog_article_id . "'");
			}
		}

		if (isset($data['article_layout'])) {
			foreach ($data['article_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_layout SET blog_article_id = '" . (int)$blog_article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
        
        if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_article_id=" . (int)$blog_article_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
	}
	
	public function editArticle($blog_article_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog_article SET author = '" . $this->db->escape($data['author']) . "', status = '" . (int)$data['status'] . "', allow_comment = '" . (int)$data['allow_comment'] . "', need_approval = '" . (int)$data['need_approval'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = '" . $this->db->escape($data['date_modified']) . "' WHERE blog_article_id = '" . (int)$blog_article_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog_article SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_description WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		foreach ($data['article_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_description SET blog_article_id = '" . (int)$blog_article_id . "', language_id = '" . (int)$language_id . "',  name = '" . $this->db->escape($value['name']) . "', title = '" . $this->db->escape($value['title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', content = '" . $this->db->escape($value['content']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_store WHERE blog_article_id = '" . (int)$blog_article_id . "'");

		if (isset($data['article_store'])) {
			foreach ($data['article_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_store SET blog_article_id = '" . (int)$blog_article_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_category WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		if (isset($data['article_category'])) {
			foreach ($data['article_category'] as $blog_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_category SET blog_article_id = '" . (int)$blog_article_id . "', blog_category_id = '" . (int)$blog_category_id . "'");
			}		
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE related_id = '" . (int)$blog_article_id . "'");
		
        if (isset($data['article_related'])) {
			foreach ($data['article_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$blog_article_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_related SET blog_article_id = '" . (int)$blog_article_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$related_id . "' AND related_id = '" . (int)$blog_article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_related SET blog_article_id = '" . (int)$related_id . "', related_id = '" . (int)$blog_article_id . "'");
			}
		}

        $this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE product_id = '" . (int)$blog_article_id . "'");

        if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $product_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$blog_article_id . "' AND product_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_product_related SET blog_article_id = '" . (int)$blog_article_id . "', product_id = '" . (int)$product_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$product_id . "' AND product_id = '" . (int)$blog_article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_product_related SET blog_article_id = '" . (int)$product_id . "', product_id = '" . (int)$blog_article_id . "'");
			}
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_layout WHERE blog_article_id = '" . (int)$blog_article_id . "'");

		if (isset($data['article_layout'])) {
			foreach ($data['article_layout'] as $store_id => $layout) {
				if (isset($layout['layout_id']) && $layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "blog_article_layout SET blog_article_id = '" . (int)$blog_article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_article_id=" . (int)$blog_article_id. "'");
        if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'blog_article_id=" . (int)$blog_article_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
										
		$this->cache->delete('blog_article');
	}
	
	public function deleteArticle($blog_article_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_description WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_related WHERE related_id = '" . (int)$blog_article_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product_related WHERE product_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_category WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_layout WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_article_store WHERE blog_article_id = '" . (int)$blog_article_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_article_id=" . (int)$blog_article_id. "'");	
		$this->cache->delete('blog_article');
	}
	
	public function getArticle($blog_article_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_article_id=" . (int)$blog_article_id . "') AS keyword FROM " . DB_PREFIX . "blog_article ba LEFT JOIN " . DB_PREFIX . "blog_article_description bad ON (ba.blog_article_id = bad.blog_article_id) WHERE ba.blog_article_id = '" . (int)$blog_article_id . "' AND bad.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
		return $query->row;
	}
	
	public function getArticles($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "blog_article ba LEFT JOIN " . DB_PREFIX . "blog_article_description bad ON (ba.blog_article_id = bad.blog_article_id)";
			
			if (!empty($data['filter_blog_category_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "blog_article_category bac ON (ba.blog_article_id = bac.blog_article_id)";			
			}
					
			$sql .= " WHERE bad.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
			
			if (!empty($data['filter_name'])) {
				$sql .= " AND LCASE(bad.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND ba.status = '" . (int)$data['filter_status'] . "'";
			}
					
			if (!empty($data['filter_blog_category_id'])) {
				if (!empty($data['filter_sub_category'])) {
					$implode_data = array();
					
					$implode_data[] = "blog_category_id = '" . (int)$data['filter_blog_category_id'] . "'";
					
					$this->load->model('bossblog/articles');
					
					$categories = $this->model_bossblog_category->getCategories($data['filter_blog_category_id']);
					
					foreach ($categories as $category) {
						$implode_data[] = "bac.blog_category_id = '" . (int)$category['blog_category_id'] . "'";
					}
					
					$sql .= " AND (" . implode(' OR ', $implode_data) . ")";			
				} else {
					$sql .= " AND bac.blog_category_id = '" . (int)$data['filter_blog_category_id'] . "'";
				}
			}
			
			$sql .= " GROUP BY ba.blog_article_id";
						
			$sort_data = array(
				'bad.name',
				'ba.status',
				'ba.sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY bad.name";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
		
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}				

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	
			
			$query = $this->db->query($sql);
		
			return $query->rows;
		} else {
			$article_data = $this->cache->get('article.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));
		
			if (!$article_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_article ba LEFT JOIN " . DB_PREFIX . "blog_article_description bad ON (ba.blog_article_id = bad.blog_article_id) WHERE bad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bad.name ASC");
	
				$article_data = $query->rows;
			
				$this->cache->set('article.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $article_data);
			}	
	
			return $article_data;
		}
	}
    
	public function getArticleDescriptions($blog_article_id) {
		$article_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_article_description WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		foreach ($query->rows as $result) {
			$article_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
                'title'            => $result['title'],
				'content'      => $result['content'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'tag'              => $result['tag']
			);
		}
		
		return $article_description_data;
	}

	public function getArticleStores($blog_article_id) {
		$article_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_article_store WHERE blog_article_id = '" . (int)$blog_article_id . "'");

		foreach ($query->rows as $result) {
			$article_store_data[] = $result['store_id'];
		}
		
		return $article_store_data;
	}

	public function getArticleLayouts($blog_article_id) {
		$article_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_article_layout WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		foreach ($query->rows as $result) {
			$article_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $article_layout_data;
	}
		
	public function getArticleCategories($blog_article_id) {
		$article_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_article_category WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		foreach ($query->rows as $result) {
			$article_category_data[] = $result['blog_category_id'];
		}

		return $article_category_data;
	}

	public function getArticleRelated($blog_article_id) {
		$article_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_article_related WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		foreach ($query->rows as $result) {
			$article_related_data[] = $result['related_id'];
		}
		
		return $article_related_data;
	}
    
   	public function getBlogProductRelated($blog_article_id) {
		$product_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_product_related WHERE blog_article_id = '" . (int)$blog_article_id . "'");
		
		foreach ($query->rows as $result) {
			$product_related_data[] = $result['product_id'];
		}
		
		return $product_related_data;
	}
	
	public function getTotalArticles($data = array()) {
		$sql = "SELECT COUNT(DISTINCT ba.blog_article_id) AS total FROM " . DB_PREFIX . "blog_article ba LEFT JOIN " . DB_PREFIX . "blog_article_description bad ON (ba.blog_article_id = bad.blog_article_id)";

		if (!empty($data['filter_blog_category_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "blog_article_category bac ON (ba.blog_article_id = bac.blog_article_id)";			
		}
		 
		$sql .= " WHERE bad.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		 			
		if (!empty($data['filter_name'])) {
			$sql .= " AND LCASE(bad.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND ba.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_blog_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$implode_data[] = "bac.<strong>blog_category_id</strong> = '" . (int)$data['filter_blog_category_id'] . "'";
				
				$this->load->model('bossblog/articles');
				
				$categories = $this->model_bossblog_category->getCategories($data['filter_blog_category_id']);
				
				foreach ($categories as $category) {
					$implode_data[] = "bac.blog_category_id = '" . (int)$category['blog_category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";			
			} else {
				$sql .= " AND bac.blog_category_id = '" . (int)$data['filter_blog_category_id'] . "'";
			}
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	

	public function getTotalProductsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_article_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
    
    public function checkBlogArticle() {       
		$create_blog_article = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_article` (`blog_article_id` int(11) NOT NULL auto_increment, `status` tinyint(1) NOT NULL default '0', `allow_comment` tinyint(1) NOT NULL default '0',`author` varchar(255) collate utf8_unicode_ci NOT NULL default '', `need_approval` tinyint(1) NOT NULL default '0', `sort_order` int(11) NOT NULL default '0', `viewed` int(5) NOT NULL default '0', `image` varchar(255) collate utf8_unicode_ci default NULL, `date_added` datetime default NULL, `date_modified` datetime default NULL, PRIMARY KEY  (`blog_article_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article);
		$insert_blog_article = "INSERT INTO `" . DB_PREFIX . "blog_article` (`blog_article_id`, `status`, `allow_comment`, `author`, `need_approval`, `sort_order`, `viewed`, `image`, `date_added`, `date_modified`) VALUES
(2, 1, 2, 'Admin', 2, 2, 45, 'catalog/bossblog/h3.jpg', '2012-11-14 09:28:23', '2012-11-23 00:00:00'),
(3, 1, 2, 'Admin', 2, 0, 52, 'catalog/bossblog/h7.jpg', '2012-11-14 09:35:07', '2012-11-23 00:00:00'),
(4, 1, 2, 'Admin', 2, 4, 330, 'catalog/bossblog/h1.jpg', '2012-11-14 09:42:58', '2012-11-23 00:00:00'),
(5, 1, 2, 'Admin', 2, 0, 173, 'catalog/bossblog/h5.jpg', '2012-11-19 11:36:59', '2012-11-23 00:00:00'),
(6, 1, 2, 'Admin', 2, 0, 108, 'catalog/bossblog/h4.jpg', '2012-11-19 16:34:36', '2012-11-23 00:00:00'),
(8, 1, 2, 'Admin', 2, 0, 353, 'catalog/bossblog/h2.jpg', '2012-11-22 16:10:24', '2012-11-23 00:00:00'),
(9, 1, 2, 'Admin', 2, 0, 42, 'catalog/bossblog/h6.jpg', '2012-11-26 14:39:44', '1970-01-01 00:00:00');";
		$this->db->query($insert_blog_article);
		
		
		$create_blog_article_descriptions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_article_description` (`blog_article_id` int(11) NOT NULL default '0', `language_id` int(11) NOT NULL default '0', `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',`title` varchar(500) collate utf8_unicode_ci NOT NULL default '', `meta_description` varchar(255) collate utf8_unicode_ci NOT NULL, `meta_keyword` varchar(255) collate utf8_unicode_ci NOT NULL, `content` text collate utf8_unicode_ci NOT NULL, `tag` text collate utf8_unicode_ci NOT NULL, PRIMARY KEY (`blog_article_id`,`language_id`),
		  FULLTEXT KEY `tag` (`tag`,`content`),
		  FULLTEXT KEY `tag_2` (`tag`),
		  FULLTEXT KEY `tag_3` (`tag`),
		  FULLTEXT KEY `tag_4` (`tag`),
		  FULLTEXT KEY `content` (`content`),
		  FULLTEXT KEY `content_2` (`content`),
		  FULLTEXT KEY `tag_5` (`tag`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article_descriptions);
		
		$add_fulltext ="ALTER TABLE `" . DB_PREFIX . "blog_article_description` ADD FULLTEXT(`tag`,`content`)";
        $this->db->query($add_fulltext);
		
		$insert_blog_article_descriptions = "INSERT INTO `" . DB_PREFIX . "blog_article_description` (`blog_article_id`, `language_id`, `name`, `title`, `meta_description`, `meta_keyword`, `content`, `tag`) VALUES
(2, 1, 'Nisl cursus sollicitudin paesent ultricies arcu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'tristiqueu,stoporta'),
(2, 2, 'Nisl cursus sollicitudin paesent ultricies arcu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'tristiqueu,stoporta'),
(3, 1, 'Voluptatem accusantium laudantium, totam rem aperia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'deserunt,moll'),
(3, 2, 'Voluptatem accusantium laudantium, totam rem aperia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'deserunt,moll'),
(4, 1, 'Aliquam pulvinar porttitor nulla, et consequat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'dignissimos,ducimus,quiblanditiis,praesentium'),
(4, 2, 'Aliquam pulvinar porttitor nulla, et consequat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', '', '', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'dignissimos,ducimus,quiblanditiis,praesentium'),
(5, 1, 'Tellus volutpat bibendum morbi pretium fringilla nulla a laoreet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'risus,volutpa'),
(5, 2, 'Tellus volutpat bibendum morbi pretium fringilla nulla a laoreet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'risus,volutpa'),
(6, 1, 'Nulla eu velit a enim congue ornare convallis orci quis lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'aliquam,dapibus'),
(6, 2, 'Nulla eu velit a enim congue ornare convallis orci quis lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'aliquam,dapibus'),
(8, 1, 'Donec a interdum ligula fusce convallis orci quis lorem bibendum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'dolorese,tquas'),
(8, 2, 'Donec a interdum ligula fusce convallis orci quis lorem bibendum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'dolorese,tquas'),
(9, 1, 'Voluptatem accusantium laudantium totam rem aperia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'nsectetur,adipiscing'),
(9, 2, 'Voluptatem accusantium laudantium totam rem aperia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis lectus tristique justo porta molestie. Donec venenatis nulla at libero dictum id placerat eros elementum. Aliquam dapibus adipiscing enim vitae tempor', 'bossblog', 'bossblog', '&lt;h1&gt;Class aptent taciti sociosqu ad litora torquent&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;span&gt;Quisque porta felis est ut malesuada lorem dignissim quis ornare libero, ut tristique urna condimentum sit amet &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Aliquam quis risus viverra, ornare ipsum vitae, congue tellus. Vestibulum nunc lorem, scelerisque a tristique non, accumsan ornare eros. Nullam sapien metus, volutpat dictum. Praesent tellus felis, aliquet id augue at, tincidunt vestibulum leo. Aliquam a porttitor nibh, et feugiat enim. Proin consequat ut lectus ac adipiscing. Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis mi. Integer tincidunt diam inisi suscipit luctus. Duis porta varius libero nec rutrum.&lt;br&gt;Nulla facilisi. Donec urna libero, ultricies non placerat nec, sagittis ac mi. Integer tincidunt diam id nisi suscipit luctus. Duis porta varius libero nec rutrum. Mauris laoreet sed massa a interdum. Integer accumsan semper felis sit amet convallis. Phasellus a congue est. In augue sapien, commodo quis rutrum pretium, adipiscing et nibh. Cras convallis, ligula et euismod posuere, purus arcu aliquet nisi, id iaculis sem libero et tellus. Curabitur viverra urna a sagittis mattis. Sed tempus volutpat enim quis tempor. In convallis posuere dignissim. Vivamus pharetra egestas dignissim. Donec adipiscing nisl eu arcu auctor elementum.&lt;/p&gt;', 'nsectetur,adipiscing');";
		$this->db->query($insert_blog_article_descriptions);
		
		
		$create_blog_article_category = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_article_category` (`blog_article_id` int(11) NOT NULL, `blog_category_id` int(11) NOT NULL, PRIMARY KEY  (`blog_article_id`, `blog_category_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article_category);
		$insert_blog_article_category = "INSERT INTO `" . DB_PREFIX . "blog_article_category` (`blog_article_id`, `blog_category_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 8),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6);";
		$this->db->query($insert_blog_article_category);
		
		
		$create_blog_article_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_article_store` (`blog_article_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, PRIMARY KEY  (`blog_article_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article_store);
		$insert_blog_article_store = "INSERT INTO `" . DB_PREFIX . "blog_article_store` (`blog_article_id`, `store_id`) VALUES
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(8, 0),
(9, 0);";
		$this->db->query($insert_blog_article_store);
		
        $create_blog_article_layout = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_article_layout` (`blog_article_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, `layout_id` int(11) NOT NULL, PRIMARY KEY  (`blog_article_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article_layout);
		
        $create_blog_article_related = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_article_related` (`blog_article_id` int(11) NOT NULL, `related_id` int(11) NOT NULL, PRIMARY KEY  (`blog_article_id`, `related_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article_related);
		$insert_blog_article_related = "INSERT INTO `" . DB_PREFIX . "blog_article_related` (`blog_article_id`, `related_id`) VALUES
(2, 3),
(2, 5),
(2, 8),
(3, 2),
(3, 4),
(3, 5),
(3, 8),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(5, 2),
(5, 3),
(5, 4),
(5, 6),
(5, 8),
(6, 4),
(6, 5),
(8, 2),
(8, 3),
(8, 5);";
		$this->db->query($insert_blog_article_related);
		
        $create_blog_article_product = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_product_related` (`blog_article_id` int(11) NOT NULL, `product_id` int(11) NOT NULL, PRIMARY KEY  (`blog_article_id`, `product_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_article_product);
	}	
}
?>