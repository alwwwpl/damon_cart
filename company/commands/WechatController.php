<?php
namespace app\commands;

use app\models\Bidding;
use Yii;
use app\models\Product;
use yii\web\Controller;

class WechatController extends Controller
{
    public $appid = 'wx99610dc3355e3524';
    public $secret = 'e5ea2d8db69da96086eb7bf15db770f7';
    private $data = array();

    /*
     * GET 微信用记openid
     */
    public function getOpenid($code = null)
    {
        if (!empty($code))
        {
            $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->secret.'&code='.$code.'&grant_type=authorization_code';
            $result = $this->GetData($url);
            if (!empty($result->access_token) && !empty($result->openid))
            {
                Yii::$app->session['openid'] = $result->openid;

                return $result->openid;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }



    /*
     * 判断是否是微信
     */
    function is_weixin()
    {
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false )
        {
            return true;
        }
        return false;
    }



    /****************************************************************************************************************************
     *
     * 以下为微信接口函数
     *
     ****************************************************************************************************************************/

    /*
     * POST数据到微信服务器
     */
    function PostData($value,$url) //得到TOKEN
    {
        if (!empty($value) && !empty($url))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//	        $this->curl_redir_exec($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $value);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
//			$temp=explode("\"",$result);
            return $result;
        }
    }

    /*
     * GET方式取得服务器数据
     */
    function GetData($url)
    {
        if (!empty($url))
        {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_URL, $url);
//		    curl_setopt ($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $appsecret);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $json_string = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($json_string);
            return $result;
        }
    }


    /*
     * 取得access_token
     */
    function Getaccesstoken($user_id=NULL,$exhibition_id=NULL)
    {
        /*
         * user_id,exhibition_id只有在管理后台调用时才可为空
         */
        if (empty($user_id))
        {
            $user_id = Yii::app()->session['user_id'];
        }
        if (empty($exhibition_id))
        {
            $exhibition_id = Yii::app()->session['exhibition_id'];
        }
        $wx_model = WxUser::model();
        $wx_model = $wx_model->find('user_id=:user_id AND exhibition_id=:exhibition_id',array(':user_id'=>$user_id,'exhibition_id'=>$exhibition_id));
        if ($wx_model)
        {
            $time = strtotime("now") - strtotime($wx_model->createtime)- 7200;
            if ($time > 0 || empty($wx_model->access_token))
            {
                //调用Get_Access_Token取得access_token值
                $access_token = $this->Get_Access_Token($wx_model->appid, $wx_model->appsecret);
                $sql = "UPDATE t_ju_wx_user set access_token='".$access_token."' WHERE wx_id='".$wx_model->wx_id."'";
                Yii::$app->db->createcommand($sql)->execute();
            }
            else
            {
                $access_token = $wx_model->access_token;
            }
            return $access_token;
        }
        else
        {
            return "error";
        }
    }

    /*
     * GET用户的微信TOKEN
     */
    function GetToken($user_id=NULL,$exhibition_id=NULL)
    {
        if (!empty($user_id) && !empty($exhibition_id))
        {
            $model = WxUser::model();
            $model = $model->find('user_id=:user_id AND exhibition_id=:exhibition_id',array(':user_id'=>$user_id,':exhibition_id'=>$exhibition_id));
            if ($model->token)
            {
                $result = $model->token;
            }
            else
            {
                $result = "";
            }
        }
        else
        {
            $result = "sucjun";
//    		Yii::app()->user->setFlash('error','请先登录后再操作！');
//    		$this->refresh();
        }
        return $result;
    }

    /*
     * 回复文本格式
     */
    public function ReplyText($fromUsername, $toUsername, $time, $contentStr)
    {
        $textTpl = "<xml>
    					<ToUserName><![CDATA[%s]]></ToUserName>
			            <FromUserName><![CDATA[%s]]></FromUserName>
			            <CreateTime>%s</CreateTime>
			            <MsgType><![CDATA[%s]]></MsgType>
			            <Content><![CDATA[%s]]></Content>
			            <FuncFlag>0</FuncFlag>
			        </xml>";
        $msgType = "text";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        return $resultStr;
    }

    /*
     * 回复新闻格式
     */
    public function ReplyNews($fromUsername, $toUsername, $time, $contentStr)
    {
        if (empty($num))
        {
            $num = 1;
        }
        $textTpl = "<xml>
					    <ToUserName><![CDATA[%s]]></ToUserName>
					    <FromUserName><![CDATA[%s]]></FromUserName>
					    <CreateTime>%s</CreateTime>
					    <MsgType><![CDATA[%s]]></MsgType>
					    <Content><![CDATA[]]></Content>
					    $contentStr
					    <FuncFlag>0</FuncFlag>
					</xml>";
        $msgType = "news";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
        return $resultStr;
    }


    /*
     * 回复音乐格式
     */
    public function ReplyMusic($fromUsername, $toUsername, $time)
    {
        $textTpl = "<xml>
					    <ToUserName><![CDATA[%s]]></ToUserName>
					    <FromUserName><![CDATA[%s]]></FromUserName>
					    <CreateTime>%s</CreateTime>
					    <MsgType><![CDATA[music]]></MsgType>
					    <Music>
					        <Title><![CDATA[最炫民族风]]></Title>
					        <Description><![CDATA[凤凰传奇]]></Description>
					        <MusicUrl><![CDATA[http://zj189.cn/zj/download/music/zxmzf.mp3]]></MusicUrl>
					        <HQMusicUrl><![CDATA[http://zj189.cn/zj/download/music/zxmzf.mp3]]></HQMusicUrl>
					    </Music>
					    <FuncFlag>0</FuncFlag>
					</xml>";
        $msgType = "music";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
        return $resultStr;
    }


    /*
     * 回复地理位置格式
     */
    public function ReplyLocation()
    {

    }

    /*
     * 取得ACCESS_TOKEN
     */
    public function Get_Access_Token($appid,$appsecret)
    {
        if (!empty($appid) && !empty($appsecret))
        {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $appsecret);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $json_string = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($json_string);
            return $result->access_token;
        }
    }


    /*
     * 替换CURL_SETOPT
     */
    function curl_redir_exec($ch,$debug="")
    {
        static $curl_loops = 0;
        static $curl_max_loops = 20;

        if ($curl_loops++ >= $curl_max_loops)
        {
            $curl_loops = 0;
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $debbbb = $data;
        list($header, $data) = explode("\n\n", $data, 2);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code == 301 || $http_code == 302) {
            $matches = array();
            preg_match('/Location:(.*?)\n/', $header, $matches);
            $url = @parse_url(trim(array_pop($matches)));
            //print_r($url);
            if (!$url)
            {
                //couldn't process the url to redirect to
                $curl_loops = 0;
                return $data;
            }
            $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
            /*    if (!$url['scheme'])
             $url['scheme'] = $last_url['scheme'];
             if (!$url['host'])
                 $url['host'] = $last_url['host'];
                 if (!$url['path'])
                $url['path'] = $last_url['path'];*/
            $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query']?'?'.$url['query']:'');
            curl_setopt($ch, CURLOPT_URL, $new_url);
            //    debug('Redirecting to', $new_url);

            return curl_redir_exec($ch);
        } else {
            $curl_loops=0;
            return $debbbb;
        }
    }

    /****************************************************************************************************************************
     *
     * 以上为微信接口函数
     *
     ****************************************************************************************************************************/

    /*
     * GET方式取得服务器数据
     *
     */
    function GetCity($url=null)
    {
        $city = '全国 ';
        if (isset(Yii::$app->user->identity->city))
        {
            $city = Yii::$app->user->identity->city;
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





    /****************************************************************************************************************************
     *
     * 以下为购物车函数
     *
     ****************************************************************************************************************************/

    public function getProducts() {

        Yii::$app->session->open();

        if (!$this->data) {
            foreach ($_SESSION['cart'] as $key => $quantity) {
                $product = unserialize(base64_decode($key));

                $product_id = $product['product_id'];

                $stock = true;

                // Options
                if (!empty($product['option']))
                {
                    $options = $product['option'];
                }
                else
                {
                    $options = array();
                }

                // Profile
                if (!empty($product['recurring_id']))
                {
                    $recurring_id = $product['recurring_id'];
                }
                else
                {
                    $recurring_id = 0;
                }

                //供货
                if (!empty($product['supplier_id']))
                {
                    $supplier_id = $product['supplier_id'];
                }
                else
                {
                    $supplier_id = 0;
                }

                //分销
                if (!empty($product['distribute_id']))
                {
                    $distribute_id = $product['distribute_id'];
                }
                else
                {
                    $distribute_id = 0;
                }

                //抢拍
                if (!empty($product['bidding_id']))
                {
                    $bidding_id = $product['bidding_id'];
                }
                else
                {
                    $bidding_id = 0;
                }

                if (!empty($distribute_id) && !empty($supplier_id))
                {
                    $productData = Product::find()->select(['( SELECT distribute_price FROM oc_product_distribute WHERE product_distribute_id = '.$distribute_id.') as distribute_price', 'oc_product.*', 'oc_product_supplier.agent_id', 'oc_product_description.name'])
                        ->joinWith('supplier',['product_id' => 'supplier.product_id'])
                        ->joinWith('description',['product_id' => 'description.product_id'])
                        ->andWhere(['oc_product.product_id' => $product_id, 'oc_product_supplier.supplier_id' => $supplier_id, 'oc_product.status' => 1])
                        ->andWhere('oc_product_supplier.agent_product_stock > 0')
                        ->one();
                }
                elseif (empty($distribute_id) && !empty($supplier_id))
                {
                    $productData = Product::find()->select(['oc_product.*', 'oc_product_supplier.price as supplier_price', 'oc_product_supplier.vip_price as supplier_vip_price', 'oc_product_supplier.agent_id as agent_id', 'oc_product_description.name'])
                        ->joinWith('supplier',['product_id' => 'supplier.product_id'])
                        ->joinWith('description',['product_id' => 'description.product_id'])
                        ->andWhere(['oc_product.product_id' => $product_id, 'oc_product_supplier.supplier_id' => $supplier_id, 'oc_product.status' => 1])
                        ->andWhere('oc_product_supplier.agent_product_stock > 0')
                        ->one();
                }

                if ($productData)
                {

                    $option_price = 0;
                    $option_points = 0;
                    $option_weight = 0;
                    $option_data = array();

                    //抢拍价
                    if ($bidding_id)
                    {

                        $biddingData = Bidding::find()->andWhere(['product_id' => $product_id, 'bidding_id' => $bidding_id])->one();

                        if ($biddingData)
                        {
                            if (strtotime(date('Y-m-d H:i:s')) >= strtotime($biddingData->start_time) && strtotime(date('Y-m-d H:i:s')) <= strtotime($biddingData->over_time))
                            {
                                $price = $biddingData->start_price - (ceil((strtotime(date('Y-m-d H:i:s')) - strtotime($biddingData->start_time))/60/$biddingData->interval) * (($biddingData->start_price - $biddingData->floor_price)/((strtotime($biddingData->over_time) - strtotime($biddingData->start_time))/60/$biddingData->interval)));
                            }
                            else
                            {
                                $price = $biddingData->start_price;
                            }
                        }
                    }
                    else
                    {
                        if (isset($productData->distribute_price))
                        {
                            $price = $productData->distribute_price;
                        }
                        elseif (!empty(Yii::$app->user->identity->parent_id))
                        {
                            $price = $productData->supplier_vip_price;
                        }
                        else
                        {
                            $price = $productData->supplier_price;
                        }
                    }

                    foreach ($options as $product_option_id => $value)
                    {
                        $sql = "SELECT po.product_option_id, po.option_id, od.name, o.type FROM oc_product_option po
                            LEFT JOIN oc_option o ON (po.option_id = o.option_id)
                            LEFT JOIN oc_option_description od ON (o.option_id = od.option_id)
                            WHERE po.product_option_id = '" . (int)$product_option_id . "'
                            AND po.product_id = '" . (int)$product_id . "' AND od.language_id = 2";

                        $optionData = Yii::$app->db->createCommand($sql)->queryOne();

//                        $option_query = $this->db->query();

                        if ($optionData)
                        {
                            if ($optionData->type == 'select' || $optionData->type == 'radio' || $optionData->type == 'image')
                            {
                                $sql = "SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix
                                    FROM oc_product_option_value pov
                                    LEFT JOIN oc_option_value ov ON (pov.option_value_id = ov.option_value_id)
                                    LEFT JOIN oc_option_value_description ovd ON (ov.option_value_id = ovd.option_value_id)
                                    WHERE pov.product_option_value_id = '" . (int)$value . "'
                                    AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = 2";

                                $optionValueData = Yii::$app->db->createCommand($sql)->queryOne();

//                                $option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$value . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

                                if ($optionValueData)
                                {
                                    if ($optionValueData->price_prefix == '+')
                                    {
                                        $option_price += $optionValueData->price;
                                    }
                                    elseif ($optionValueData->price_prefix == '-')
                                    {
                                        $option_price -= $optionValueData->price;
                                    }

                                    if ($optionValueData->points_prefix == '+')
                                    {
                                        $option_points += $optionValueData->points;
                                    }
                                    elseif ($optionValueData->points_prefix == '-')
                                    {
                                        $option_points -= $optionValueData->points;
                                    }

                                    if ($optionValueData->weight_prefix == '+')
                                    {
                                        $option_weight += $optionValueData->weight;
                                    }
                                    elseif ($optionValueData->weight_prefix == '-')
                                    {
                                        $option_weight -= $optionValueData->weight;
                                    }

                                    if ($optionValueData->subtract && (!$optionValueData->quantity || ($optionValueData->quantity < $quantity)))
                                    {
                                        $stock = false;
                                    }

                                    $option_data[] = array(
                                        'product_option_id'       => $product_option_id,
                                        'product_option_value_id' => $value,
                                        'option_id'               => $optionData->option_id,
                                        'option_value_id'         => $optionValueData->option_value_id,
                                        'name'                    => $optionData->name,
                                        'value'                   => $optionValueData->name,
                                        'type'                    => $optionData->type,
                                        'quantity'                => $optionValueData->quantity,
                                        'subtract'                => $optionValueData->subtract,
                                        'price'                   => $optionValueData->price,
                                        'price_prefix'            => $optionValueData->price_prefix,
                                        'points'                  => $optionValueData->points,
                                        'points_prefix'           => $optionValueData->points_prefix,
                                        'weight'                  => $optionValueData->weight,
                                        'weight_prefix'           => $optionValueData->weight_prefix
                                    );
                                }
                            }
                            elseif ($optionData->type == 'checkbox' && is_array($value))
                            {
                                foreach ($value as $product_option_value_id)
                                {
                                    $sql = "SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix
                                        FROM oc_product_option_value pov
                                        LEFT JOIN oc_option_value ov ON (pov.option_value_id = ov.option_value_id)
                                        LEFT JOIN oc_option_value_description ovd ON (ov.option_value_id = ovd.option_value_id)
                                        WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "'
                                        AND pov.product_option_id = '" . (int)$product_option_id . "'
                                        AND ovd.language_id = 2";

                                    $optionValueData = Yii::$app->db->createCommand($sql)->queryOne();

//                                    $option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

                                    if ($optionValueData)
                                    {
                                        if ($optionValueData->price_prefix == '+') {
                                            $option_price += $optionValueData->price;
                                        } elseif ($optionValueData->price_prefix == '-') {
                                            $option_price -= $optionValueData->price;
                                        }

                                        if ($optionValueData->points_prefix == '+') {
                                            $option_points += $optionValueData->points;
                                        } elseif ($optionValueData->points_prefix == '-') {
                                            $option_points -= $optionValueData->points;
                                        }

                                        if ($optionValueData->weight_prefix == '+') {
                                            $option_weight += $optionValueData->weight;
                                        } elseif ($optionValueData->weight_prefix == '-') {
                                            $option_weight -= $optionValueData->weight;
                                        }

                                        if ($optionValueData->subtract && (!$optionValueData->quantity || ($optionValueData->quantity < $quantity))) {
                                            $stock = false;
                                        }

                                        $option_data[] = array(
                                            'product_option_id'       => $product_option_id,
                                            'product_option_value_id' => $product_option_value_id,
                                            'option_id'               => $optionData->option_id,
                                            'option_value_id'         => $optionValueData->option_value_id,
                                            'name'                    => $optionData->name,
                                            'value'                   => $optionValueData->name,
                                            'type'                    => $optionData->type,
                                            'quantity'                => $optionValueData->quantity,
                                            'subtract'                => $optionValueData->subtract,
                                            'price'                   => $optionValueData->price,
                                            'price_prefix'            => $optionValueData->price_prefix,
                                            'points'                  => $optionValueData->points,
                                            'points_prefix'           => $optionValueData->points_prefix,
                                            'weight'                  => $optionValueData->weight,
                                            'weight_prefix'           => $optionValueData->weight_prefix
                                        );
                                    }
                                }
                            }
                            elseif ($optionData->type == 'text' || $optionData->type == 'textarea' || $optionData->type == 'file' || $optionData->type == 'date' || $optionData->type == 'datetime' || $optionData->type == 'time')
                            {
                                $option_data[] = array(
                                    'product_option_id'       => $product_option_id,
                                    'product_option_value_id' => '',
                                    'option_id'               => $optionData->option_id,
                                    'option_value_id'         => '',
                                    'name'                    => $optionData->name,
                                    'value'                   => $value,
                                    'type'                    => $optionData->type,
                                    'quantity'                => '',
                                    'subtract'                => '',
                                    'price'                   => '',
                                    'price_prefix'            => '',
                                    'points'                  => '',
                                    'points_prefix'           => '',
                                    'weight'                  => '',
                                    'weight_prefix'           => ''
                                );
                            }
                        }

                    }


                    // Product Discounts
                    $discount_quantity = 0;

                    foreach ($_SESSION['cart'] as $key_2 => $quantity_2) {
                        $product_2 = (array)unserialize(base64_decode($key_2));

                        if ($product_2['product_id'] == $product_id) {
                            $discount_quantity += $quantity_2;
                        }
                    }

                    $sql = "SELECT price FROM oc_product_discount
                        WHERE product_id = '" . (int)$product_id . "'
                        AND customer_group_id = '" . (int)Yii::$app->user->identity->customer_group_id . "'
                        AND quantity <= '" . (int)$discount_quantity . "'
                        AND ((date_start = '0000-00-00' OR date_start < NOW())
                        AND (date_end = '0000-00-00' OR date_end > NOW()))
                        ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1";

                    $productDiscountData = Yii::$app->db->createCommand($sql)->queryScalar();

//                    $product_discount_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

                    if ($productDiscountData)
                    {
                        $price = $productDiscountData;
                    }

                    // Product Specials

                    $sql = "SELECT price FROM oc_product_special
                        WHERE product_id = '" . (int)$product_id . "'
                        AND customer_group_id = '" . (int)Yii::$app->user->identity->customer_group_id . "'
                        AND ((date_start = '0000-00-00' OR date_start < NOW())
                        AND (date_end = '0000-00-00' OR date_end > NOW()))
                        ORDER BY priority ASC, price ASC LIMIT 1";

                    $productSpecialData = Yii::$app->db->createCommand($sql)->queryScalar();

//                    $product_special_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

                    if ($productSpecialData)
                    {
                        $price = $productSpecialData;
                    }

                    // Reward Points

                    $sql = "SELECT points FROM oc_product_reward
                        WHERE product_id = '" . (int)$product_id . "'
                        AND customer_group_id = '" . (int)Yii::$app->user->identity->customer_group_id . "'";

                    $productRewardData = Yii::$app->db->createCommand($sql)->queryScalar();

//                    $product_reward_query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

                    if ($productRewardData)
                    {
                        $reward = $productRewardData;
                    }
                    else
                    {
                        $reward = 0;
                    }

                    $this->data[$key] = array(
                        'key'             => $key,
                        'product_id'      => $productData->product_id,
                        'name'           => $productData->name,
                        'model'           => $productData->model,
                        'shipping'        => $productData->shipping,
                        'image'           => $productData->image,
                        'option'          => $option_data,
                        'bidding_id'      => $bidding_id,
                        'distribute_id'   => $distribute_id,
                        'supplier_id'     => $supplier_id,
                        'agent_id'        => $productData->agent_id,
                        'quantity'        => $quantity,
                        'minimum'         => $productData->minimum,
                        'subtract'        => $productData->subtract,
                        'stock'           => $stock,
                        'price'           => ($price + $option_price),
                        'total'           => ($price + $option_price) * $quantity,
                        'reward'          => $reward * $quantity,
                        'points'          => ($productData->points ? ($productData->points + $option_points) * $quantity : 0),
                        'tax_class_id'    => $productData->tax_class_id,
                        'weight'          => ($productData->weight + $option_weight) * $quantity,
                        'weight_class_id' => $productData->weight_class_id,
                        'length'          => $productData->length,
                        'width'           => $productData->width,
                        'height'          => $productData->height,
                        'length_class_id' => $productData->length_class_id
                    );
                }

            }
        }

        return $this->data;
    }

    public function getRecurringProducts()
    {
        $recurring_products = array();

        foreach ($this->getProducts() as $key => $value)
        {
            if ($value['recurring'])
            {
                $recurring_products[$key] = $value;
            }
        }

        return $recurring_products;
    }


    /*
     * supplier_id 分销客户采购ID 根据ID写入不同采购价格
     * distribute_id 小C采购ID 根据ID写入不同采购价格
     * bidding_id 抢拍 根据ID写入不同采购价格
     */

    public function add($product_id, $qty = 1, $option = array(), $recurring_id = 0, $supplier_id = null, $distribute_id = null, $bidding_id = null) {
        Yii::$app->session->open();

        $this->data = array();

        $product['product_id'] = (int)$product_id;

        if ($option) {
            $product['option'] = $option;
        }

        if ($recurring_id) {
            $product['recurring_id'] = (int)$recurring_id;
        }

        if ($supplier_id) {
            $product['supplier_id'] = (int)$supplier_id;
        }

        if ($distribute_id) {
            $product['distribute_id'] = (int)$distribute_id;
        }

        if ($bidding_id) {
            $product['bidding_id'] = (int)$bidding_id;
        }

        $key = base64_encode(serialize($product));

        if ((int)$qty && ((int)$qty > 0))
        {
            if (!isset($_SESSION['cart'][$key]))
            {
                $_SESSION['cart'][$key] = (int)$qty;
            }
            else
            {
                $_SESSION['cart'][$key] += (int)$qty;
            }
        }
    }

    public function update($key, $qty)
    {
        Yii::$app->session->open();

        $this->data = array();

        if ((int)$qty && ((int)$qty > 0) && isset($_SESSION['cart'][$key]))
        {
            $_SESSION['cart'][$key] = (int)$qty;
        }
        else
        {
            $this->remove($key);
        }
    }

    public function remove($key)
    {
        Yii::$app->session->open();

        $this->data = array();

        unset($_SESSION['cart'][$key]);
    }

    public function clear()
    {
        Yii::$app->session->open();

        $this->data = array();

        $_SESSION['cart'] = array();
    }

    public function getSubTotal() {
        $total = 0;

        foreach ($this->getProducts() as $product) {
            $total += $product['total'];
        }

        return $total;
    }

    public function countProducts() {
        $product_total = 0;

        $products = $this->getProducts();

        foreach ($products as $product) {
            $product_total += $product['quantity'];
        }

        return $product_total;
    }

    public function hasProducts()
    {
        Yii::$app->session->open();

        return count($_SESSION['cart']);
    }

    public function hasRecurringProducts() {
        return count($this->getRecurringProducts());
    }

    public function hasStock() {
        $stock = true;

        foreach ($this->getProducts() as $product) {
            if (!$product['stock']) {
                $stock = false;
            }
        }

        return $stock;
    }

    public function hasShipping() {
        $shipping = false;

        foreach ($this->getProducts() as $product) {
            if ($product['shipping']) {
                $shipping = true;

                break;
            }
        }

        return $shipping;
    }

    public function hasDownload() {
        $download = false;

        foreach ($this->getProducts() as $product) {
            if ($product['download']) {
                $download = true;

                break;
            }
        }

        return $download;
    }


    /****************************************************************************************************************************
     *
     * 发送邮件
     *
     ****************************************************************************************************************************/

    public function sendEmail($email,$title,$content,$templete,$data)
    {
        $mail= Yii::$app->mailer->compose($templete,$data);

//        $mail= Yii::$app->mailer->compose();

        $mail->setTo($email);

        $mail->setSubject($title);

        $mail->setTextBody($content);   //发布纯文字文本

//        $mail->setHtmlBody($content);    //发布可以带html标签的文本

        if($mail->send())
        {
            return "success";
        }
        else
        {
            return "failse";
        }
        die();
    }


}
