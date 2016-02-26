<?php
class ModelBossblogComment extends Model {
	public function addComment($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "blog_comment SET author = '" . $this->db->escape($data['author']) . "', blog_article_id = '" . $this->db->escape($data['blog_article_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "',  email = '" . $this->db->escape($data['email']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	
		$this->cache->delete('blog_article');
	}
	
	public function editComment($blog_comment_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog_comment SET author = '" . $this->db->escape($data['author']) . "', blog_article_id = '" . $this->db->escape($data['blog_article_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "',  email = '" . $this->db->escape($data['email']) . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE blog_comment_id = '" . (int)$blog_comment_id . "'");
	
		$this->cache->delete('blog_article');
	}
	
	public function deleteComment($blog_comment_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_comment WHERE blog_comment_id = '" . (int)$blog_comment_id . "'");
		
		$this->cache->delete('blog_article');
	}
	
	public function getComment($blog_comment_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT bad.name FROM " . DB_PREFIX . "blog_article_description bad WHERE bad.blog_article_id = bc.blog_article_id AND bad.language_id = '" . (int)$this->config->get('config_language_id') . "') AS article FROM " . DB_PREFIX . "blog_comment bc WHERE bc.blog_comment_id = '" . (int)$blog_comment_id . "'");
		
		return $query->row;
	}

	public function getComments($data = array()) {
		$sql = "SELECT bc.blog_comment_id, bad.name, bc.author, bc.email, bc.text, bc.status, bc.date_added FROM " . DB_PREFIX . "blog_comment bc LEFT JOIN " . DB_PREFIX . "blog_article_description bad ON (bc.blog_article_id = bad.blog_article_id) WHERE bad.language_id = '" . (int)$this->config->get('config_language_id') . "'";																																					  
		
		$sort_data = array(
			'bad.name',
			'bc.author',
			'bc.email',
            'bc.text',
			'bc.status',
			'bc.date_added'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY bc.date_added";	
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
	}
	
	public function getTotalComments() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_comment");
		
		return $query->row['total'];
	}
	
	public function getTotalCommentsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_comment WHERE status = '0'");
		
		return $query->row['total'];
	}	
    
    public function checkBlogComment() {       
		$create_blog_comment = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "blog_comment` (`blog_comment_id` int(11) NOT NULL auto_increment, `blog_article_id` int(11) NOT NULL , `customer_id` int(11) NOT NULL , `author` varchar(64) collate utf8_unicode_ci NOT NULL default '', `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL, `text` text collate utf8_unicode_ci NOT NULL, `status` tinyint(1) NOT NULL default '0', `date_added` datetime default NULL, `date_modified` datetime default NULL, PRIMARY KEY  (`blog_comment_id`, `blog_article_id`, `customer_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($create_blog_comment);
		$insert_blog_comment = "INSERT INTO `" . DB_PREFIX . "blog_comment` (`blog_comment_id`, `blog_article_id`, `customer_id`, `author`, `email`, `text`, `status`, `date_added`, `date_modified`) VALUES
(1, 4, 0, 'Phan Huynh', 'admin@a.com', 'Worries about this possibility pushed United States stocks to one of their worst weekly losses of the year last week after voters re-elected President Obama and a deeply divided Congress. Mr. Obama met on Tuesday with labor leaders and others who advocate higher taxes on the wealthy and want to protect health benefits for seniors and other government programs. The president will meet with business leaders Wednesday', 1, '2012-11-14 13:59:54', NULL),
(15, 2, 0, 'Phan Huynh', 'a@a.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-14 15:14:51', '2014-09-23 15:04:53'),
(16, 1, 0, 'tvlgiao', 'a@a.com', ' contacted Sesame Workshop in June with his claims.', 1, '2012-11-14 15:22:10', NULL),
(17, 1, 0, 'tvlgiao', 'a@a.com', 'he is very good good, he is very good', 1, '2012-11-14 15:31:17', NULL),
(18, 1, 0, 'tvlgiao', 'a@a.com', 'phải là thành tích quá cao khi vẫn còn nhiều VĐV gặp vấn đề về tâm lý. Giải VĐ cử tạ trẻ châu Á 2012 được coi là bước chuẩn bị cho Olympic trẻ châu Á ở Uzbekistan và SEA Games 27 tại Myanmar năm tới nên thành tích giành 3 HCV, 2 HCB được coi là kết quả đáng mừng với cử tạ Việt Na', 1, '2012-11-14 15:33:25', NULL),
(19, 1, 0, 'Pham Le', 'admin@a.com', 'phải là thành tích quá cao khi vẫn còn nhiều VĐV gặp vấn đề về tâm lý. Giải VĐ', 1, '2012-11-14 15:51:31', NULL),
(20, 1, 0, 'admin', 'admin@a.com', 'contacted Sesame Workshop in June with his claims.', 0, '2012-11-14 16:05:53', NULL),
(21, 1, 0, 'Phan Huynh', 'admin@a.com', 'đoạt HCB đến 12kg (6kg cử giật, 6kg cử đẩy)', 0, '2012-11-14 16:07:23', NULL),
(22, 1, 0, 'demo', 'admin@a.com', 'he is very good good, he is very good.', 0, '2012-11-14 16:08:21', NULL),
(23, 1, 0, 'tvlgiao', 'admin@a.com', 'he is very good good, he is very good.', 1, '2012-11-14 16:08:49', NULL),
(24, 2, 0, 'Phan Huynh', 'admin@a.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 0, '2012-11-14 16:09:36', '2014-09-23 15:04:59'),
(25, 2, 0, 'Phan Huynh', 'admin@a.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-14 16:10:46', '2014-09-23 15:05:09'),
(26, 2, 0, 'demo', 'a@a.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-14 16:11:39', '2014-09-23 15:05:14'),
(27, 2, 0, 'admin', 'a@a.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-14 16:12:37', '2014-09-23 15:05:23'),
(28, 5, 0, 'ngan', 'kimngan2099@yahoo.com', 'Using your iPhone 5 as a personal hot spot for a laptop or other device produces some of the same strong results as the third-gen iPad...and it''s smaller. Of course, make sure you check on your tethering charges and data usage fees, but my MacBook Air did a fine job running off the LTE data connection at midday.', 1, '2012-11-22 13:54:57', NULL),
(29, 5, 0, 'abc', 'abc@yahoo.com', 'Of course, make sure you check on your tethering charges and data usage fees, but my MacBook Air did a fine job running off the LTE data connection at midday. ', 1, '2012-11-22 14:08:41', NULL),
(30, 5, 0, 'ngan', 'kimngan2099@yahoo.com', ' Of course, make sure you check on your tethering charges and data usage fees, but my MacBook Air did a fine job running off the LTE data connection at midday. ', 1, '2012-11-22 14:09:12', NULL),
(31, 8, 0, 'ngan', 'kimngan2099@yahoo.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-27 16:31:30', '2014-09-23 15:05:29'),
(32, 6, 0, 'quynh', 'kimngan2099@yahoo.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-28 08:25:59', '2014-09-23 15:05:39'),
(33, 8, 0, 'dung', 'dung@ymail.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-28 09:04:36', '2014-09-23 15:05:44'),
(34, 8, 0, 'quynh', 'dung@ymail.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2012-11-28 09:05:00', '2014-09-23 15:05:52'),
(35, 6, 1, 'quynh', 'admin@demo.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2014-03-11 10:20:08', '2014-09-23 15:05:59'),
(36, 6, 0, 'Admin', 'admin@aaa.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2014-03-11 10:20:52', '2014-10-29 16:15:26'),
(37, 8, 5, 'Admin', 'abc@yahoo.com', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis suscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibususcipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti. Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2014-08-05 13:44:34', '2014-10-29 16:15:16'),
(38, 8, 0, 'user', 'user@test.com', 'Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2015-01-09 15:23:44', NULL),
(39, 8, 0, 'test', 'test@yahoo.com', ' Morbi gravida risus sed quam adipiscing placerat. Pellentesque a mauris a tsuscipit est vitae orci mollis eu lacinia velit varius. Nam a metus aenean metus nisl, tristique in rhoncus non, lacinia a neque. Mauris tempus dapibus nunc sagittis feugiat. Nam ut eros metus, ut porta magna. Suspendisse potenti.', 1, '2015-01-09 15:25:17', NULL),
(40, 4, 0, 'test', 'test@admin.com', 'Worries about this possibility pushed United States stocks to one of their worst weekly losses of the year last week after voters re-elected President Obama and a deeply divided Congress. Mr. Obama met on Tuesday with labor leaders and others who advocate higher taxes on the wealthy and want to ', 1, '2015-01-09 16:19:03', NULL);";
		$this->db->query($insert_blog_comment);
	}	
}
?>