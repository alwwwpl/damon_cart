<?php
class ModelBossthemesBossRevolutionSlider extends Model { 

	public function createdb(){
	
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."btslider'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="DELETE FROM `".DB_PREFIX."btslider`";
			$query = $this->db->query( $sql );
		}
		
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."btslider_slide'";
		$query = $this->db->query( $sql );
		if( count($query->rows) > 0 ){
			
			$sql="DELETE FROM `".DB_PREFIX."btslider_slide`";
			$query = $this->db->query( $sql );
		}
		
		$sql = array();
		$sql[]  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."btslider` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `setting` text COLLATE utf8_unicode_ci,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;";
		
		$sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."btslider_slide` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`slider_id` int(11) NOT NULL,
			`status` tinyint(4) NOT NULL DEFAULT '0',
			`sort_order` int(3) NOT NULL DEFAULT '0',
			`slideset` text COLLATE utf8_unicode_ci,
			`caption` text COLLATE utf8_unicode_ci,
			PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;";
		
		$setting =  $this->db->escape('{"slider_type":"custom","slider_width":"1920","slider_height":"750","delay":"5000","startWithSlide":"0","stopslider":"off","stopafterloops":"-1","stopatslide":"-1","touchenabled":"on","onhoverstop":"on","timeline":"on","timerlineposition":"top","shadow":"0","navigationtype":"none","navigationarrow":"solo","navigationstyle":"round","navigationhalign":"center","navigationvalign":"bottom","navigationhoffset":"0","navigationvoffset":"10","soloarrowlefthalign":"left","soloarrowleftvalign":"center","soloarrowlefthoffset":"10","soloarrowleftvoffset":"0","soloarrowrighthalign":"right","soloarrowrightvalign":"center","soloarrowrighthoffset":"10","soloarrowrightvoffset":"0","timehidethumbnail":"200","thumbnailwidth":"100","thumbnailheight":"50","thumbamount":"5","hidecapptionatlimit":"2","hideallcapptionatlimit":"2","hideslideratlimit":"2"}');
		
		$slideset2 =  $this->db->escape('{"url":"#","enablelink":"1","type_background":"image_bg","background":"catalog/bt_fashionist/slide1.jpg","transitions":"fade","slotamount":"11","masterspeed":"500","delay":"5000","target":"_blank","kenburns":"off","enablefullvideo":"1"}');
		$caption2 =  $this->db->escape('[{"text_caption":{"1":"Sale up to","2":"Sale up to"},"datax":"1287","type_caption":"text","datay":"72","class_css":"medium_grey","dataspeed":"300","datastart":"500","dataend":"5000","dataafterspeed":"300","incom_animation":"sft","outgo_animation":"stb","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"30 - 50%","2":"30 - 50%"},"datax":"1177","type_caption":"text","datay":"210","class_css":"big_black","dataspeed":"500","datastart":"1000","dataend":"5000","dataafterspeed":"300","incom_animation":"lfl","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeInCirc"},{"text_caption":{"1":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem","2":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem"},"datax":"1147","type_caption":"text","datay":"305","class_css":"small_text","dataspeed":"600","datastart":"1300","dataend":"6700","dataafterspeed":"500","incom_animation":"skewfromleft","outgo_animation":"skewtoright","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"shop now","2":"shop now"},"datax":"1357","type_caption":"text","datay":"385","class_css":"medium_white","dataspeed":"600","datastart":"1300","dataend":"7100","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"accusantium doloremque laudantium","2":"accusantium doloremque laudantium"},"datax":"1247","type_caption":"text","datay":"336","class_css":"small_text","dataspeed":"600","datastart":"1300","dataend":"6700","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"}]');
		$slideset3 =  $this->db->escape('{"url":"#","enablelink":"1","type_background":"image_bg","background":"catalog/bt_fashionist/slide2.jpg","transitions":"fade","slotamount":"10","masterspeed":"500","delay":"5000","target":"_blank","kenburns":"off","enablefullvideo":"0"}');
		$caption3 =  $this->db->escape('[{"text_caption":{"1":"Sed perspicia","2":"Sed perspicia"},"datax":"245","type_caption":"text","datay":"100","class_css":"medium_text_yellow","dataspeed":"600","datastart":"600","dataend":"5900","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"Puvi lorem&lt;br /&gt;Vestibul tempo","2":"Puvi lorem&lt;br /&gt;Vestibul tempo"},"datax":"245","type_caption":"text","datay":"185","class_css":"big_white","dataspeed":"600","datastart":"1000","dataend":"5000","dataafterspeed":"300","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"&lt;span&gt;Sed ut perspiciatis unde omnis iste natus error volupta&lt;/span&gt;","2":"&lt;span&gt;Sed ut perspiciatis unde omnis iste natus error volupta&lt;/span&gt;"},"datax":"245","type_caption":"text","datay":"360","class_css":"small_text","dataspeed":"500","datastart":"1500","dataend":"5000","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"shop now","2":"shop now"},"datax":"245","type_caption":"text","datay":"425","class_css":"medium_white","dataspeed":"600","datastart":"1300","dataend":"7100","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"&lt;span&gt;accusantium doloremque laudantium&lt;/span&gt;","2":"&lt;span&gt;accusantium doloremque laudantium&lt;/span&gt;"},"datax":"245","type_caption":"text","datay":"390","class_css":"small_text","dataspeed":"600","datastart":"1300","dataend":"6700","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"}]');
		$slideset4 =  $this->db->escape('{"url":"#","enablelink":"1","type_background":"image_bg","background":"catalog/bt_fashionist/slide3.jpg","transitions":"fade","slotamount":"7","masterspeed":"500","delay":"5000","target":"_blank","kenburns":"off","enablefullvideo":"0"}');
		$caption4 =  $this->db->escape('[{"text_caption":{"1":"Doloremque laudanti","2":"Doloremque laudanti"},"datax":"855","type_caption":"text","datay":"130","class_css":"large_text","dataspeed":"600","datastart":"600","dataend":"5000","dataafterspeed":"300","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"Huge sale","2":"Huge sale"},"datax":"745","type_caption":"text","datay":"160","class_css":"very_large_text","dataspeed":"600","datastart":"600","dataend":"5400","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"up to 70% off","2":"up to 70% off"},"datax":"800","type_caption":"text","datay":"280","class_css":"very_big_white","dataspeed":"600","datastart":"600","dataend":"5800","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"Sed ut perspiciatis unde omnis iste","2":"Sed ut perspiciatis unde omnis iste"},"datax":"820","type_caption":"text","datay":"360","class_css":"small_text","dataspeed":"600","datastart":"500","dataend":"6200","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"shop now","2":"shop now"},"datax":"900","type_caption":"text","datay":"430","class_css":"medium_white","dataspeed":"600","datastart":"600","dataend":"6600","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"},{"text_caption":{"1":"accusandoloremque laudan","2":"accusandoloremque laudan"},"datax":"850","type_caption":"text","datay":"387","class_css":"small_text","dataspeed":"600","datastart":"600","dataend":"6200","dataafterspeed":"500","incom_animation":"sft","outgo_animation":"stt","easing":"easeOutBack","endeasing":"easeOutBack"}]');
		$sql[] = "INSERT INTO `".DB_PREFIX."btslider` (`id`, `setting`) VALUES
(1, '".$setting."');";
		$sql[] = "INSERT INTO `".DB_PREFIX."btslider_slide` (`id`, `slider_id`, `status`, `sort_order`, `slideset`, `caption`) VALUES
(13, 1, 1, 1, '".$slideset2."', '".$caption2."'),
(16, 1, 1, 2, '".$slideset3."', '".$caption3."'),
(17, 1, 1, 3, '".$slideset4."', '".$caption4."');";
		foreach( $sql as $q ){
			$query = $this->db->query( $q );
		}
	}

	public function addSlide($data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "btslider_slide SET slider_id = '" . (int)$data['slider_id'] . "', status = '" . (int)$data['status'] . "',slideset = '" . $data['slideset'] . "',caption = '" . $data['caption'] . "', sort_order = '" . (int)$data['sort_order'] . "'");
	}
	
	public function addSlide_New($slider_id,$data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "btslider_slide SET slider_id = '" . (int)$slider_id . "', status = '" . (int)$data['status'] . "',slideset = '" . $this->db->escape(json_encode($data['slideset'])) . "',caption = '" . $this->db->escape(json_encode($data['caption'])) . "', sort_order = '" . (int)$data['sort_order'] . "'");
	}
	
	public function editSlide($slide_id,$slider_id,$data){
		$this->db->query("UPDATE " . DB_PREFIX . "btslider_slide SET slider_id = '" . (int)$slider_id . "', slideset = '" . $this->db->escape(json_encode($data['slideset'])) . "',caption = '" . $this->db->escape(json_encode($data['caption'])) . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE id = '" . (int)$slide_id . "'");
	}
	
	public function addSlider($data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "btslider SET setting = '" . $this->db->escape(json_encode($data['setting'])) . "'");
		
		$slider_id = $this->db->getLastId();
		
		return $slider_id;
	}
	
	public function getLastId(){
		$sql = "SELECT * FROM " . DB_PREFIX . "btslider s";
		
		$query = $this->db->query($sql);
		
		$slider_id = $this->db->getLastId();
		
		return $slider_id;
	}
	
	public function editSlider($slider_id,$data){
		
		$this->db->query("UPDATE " . DB_PREFIX . "btslider SET setting = '" . $this->db->escape(json_encode($data['setting'])) . "' WHERE id = '" . (int)$slider_id . "'");
	}
	
	public function getModules($group, $store_id = 0){
		$data = array(); 
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $this->db->escape($group) . "'");
		
		foreach ($query->rows as $result) {
			if (!$result['serialized']) {
				$data[$result['key']] = $result['value'];
			} else {
				$data[$result['key']] = unserialize($result['value']);
			}
		}

		return $data;
	}
	
	public function getSliders(){
		$sql = "SELECT * FROM " . DB_PREFIX . "btslider s";
		
		$sql .= " GROUP BY s.id";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getSlider($slider_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "btslider s WHERE s.id = '" . (int)$slider_id . "'";
		
		$sql .= " GROUP BY s.id";
		
		$query = $this->db->query($sql);

		return $query->row;
	}
	
	public function getSlide($slide_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "btslider_slide ss WHERE ss.id = '" . (int)$slide_id . "'";
		
		$query = $this->db->query($sql);

		return $query->row;
	}
	
	public function getSlides($slider_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "btslider_slide ss WHERE ss.slider_id = '" . (int)$slider_id . "'";
		
		$sql .= " GROUP BY ss.id";
		
		$sql .= " ORDER BY ss.sort_order";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function copySlide($slide_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "btslider_slide WHERE id = '" . (int)$slide_id . "'");

		if ($query->num_rows) {
			$data = array();

			$data = $query->row;
			$this->addSlide($data);
		}
	}
	
	public function deleteSlider($slider_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "btslider WHERE id = '" . (int)$slider_id . "'");
	}
	
	public function deleteSlide($slide_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "btslider_slide WHERE id = '" . (int)$slide_id . "'");
	}
	
	public function updateSortSlide($data){
		$count = 1;
		foreach ($data as $slide_id) {
			$query = "UPDATE " . DB_PREFIX . "btslider_slide SET sort_order = " . $count . " WHERE id = " . $slide_id;
			$this->db->query($query);
			$count ++;	
		}
	}
	
	public function getTotalslidesBySliderId($slider_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "btslider_slide WHERE slider_id = '" . (int)$slider_id . "'");

		return $query->row['total'];
	}
}
?>