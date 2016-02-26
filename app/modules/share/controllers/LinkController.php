<?php
/**
 * Created by PhpStorm.
 * User: sucjun
 * Date: 15/11/22
 * Time: 16:23
 */

namespace app\modules\share\controllers;

use Yii;

use yii\web\Controller;
use app\models\Extensioner;


class LinkController extends Controller {

    public function actionIndex() {

        $id = Yii::$app->extensioner->identity->id;

        $customer_id = Yii::$app->extensioner->identity->customer_id;

        $type = Yii::$app->extensioner->identity->type;

        $data = '';

        if ($type == Extensioner::TYPE_CUSTOMER)
        {
            $code = base64_encode($id + 888888);

            $url = 'http://iddmall.com/index.php?route=account/register&agent_id=0&code='.$code;

            $data[0]['title'] = '大C推广链接';

            $data[0]['url'] = $url;

            $data[0]['urlcode'] = urlencode($url);

            $data[1]['title'] = '子推广人链接';

            $data[1]['url'] = 'http://agent.iddmall.com/share/account/create?code='.$code;

            $data[1]['urlcode'] = urlencode('http://agent.iddmall.com/share/account/create?code='.$code);
        }
        elseif ($type == Extensioner::TYPE_SUB)
        {
            $code = base64_encode($id + 888888);

            $url = 'http://iddmall.com/index.php?route=account/register&agent_id=0&code='.$code;

            $data[0]['title'] = '大C推广链接';

            $data[0]['url'] = $url;

            $data[0]['urlcode'] = urlencode($url);

        }
        elseif ($type == Extensioner::TYPE_VIP)
        {
            $code = dechex($customer_id + 100000);

            $url = 'http://iddmall.com/index.php?route=account/register&code='.$code;

            $data[0]['title'] = '小C推广链接';

            $data[0]['url'] = $url;

            $data[0]['urlcode'] = urlencode($url);
        }


        $href = 'http://b.bshare.cn/barCode?site=weixin&url=';
        return $this->render('index',[
            'data' => $data,
            'href' => $href
        ]);
    }

}