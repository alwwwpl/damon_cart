<?php
abstract class Controller {
	protected $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}

    /*
     * GET方式取得服务器数据
     */
    function GetCity($url=null)
    {
        // Session
//        $session = new Session();
//
//        $db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $city = '全国 ';
        if (isset($this->session->data['customer_id']))
        {
            $query = $this->db->query("SELECT city FROM " . DB_PREFIX . "customer WHERE customer_id = '". $this->session->data['customer_id'] ."'");

            if ($query->row['city']){

                $city = $query->row['city'].' ';

            }
        }
        /*
        else
        {
            $host = explode('.',$_SERVER['HTTP_HOST']);

            if ($host[0] == 'www' || $host[0] == 'iddmall')
            {
                if (empty($url))
                {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
                }
                $ch = curl_init();
                $timeout = 5;
                curl_setopt ($ch, CURLOPT_URL, $url);
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $json_string = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($json_string);
                if (!empty($result) && $result->code == 0)
                {
                    $city = $result->data->city;
                }
                else
                {
                    $city = '全国 ';
                }
            }
            elseif ($host[0] !== 'localhost')
            {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE pinyin = '".$host[0]."' AND status = '1'");
                $city_data = $query->row;
                if($city_data){
                    $city = $city_data['name'];
                }
            }
            else
            {
                $city = '全国 ';
            }
        }
        */
        return $city;
    }

}