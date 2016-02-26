<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Area;
use app\models\Agent;
use app\models\Customer;
use app\models\Extensioner;
use app\models\ExtensionerCustomer;
use app\models\LoginForm;
use app\commands\WechatController;

class LoginController extends WechatController
{
    public function actionIndex($code = null, $url = null)
    {
        // $url = urlencode('http://company.iddmall.com/login');
        // if ($this->is_weixin() && empty($code))
        // {
        //     $http = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$url.'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';

        //     return $this->redirect($http);
        // }
        // else
        // {

            $model = new LoginForm();

            $this->layout = 'login-main';

            Yii::$app->user->logout();

            $openid = $this->getOpenid($code);
//            $openid = 'ok6S_szTaJ0dybtYPcOouUHYmBvkasdfs';

            if (!empty($openid))
            {

                $customerData = Customer::findByOpenid($openid);

                if ($customerData)
                {
                    $model->email = $customerData['telephone'];
                    $model->password = $customerData['password'];
                    if($model->login()){
//                        return $this->redirect('/damon_cart/wap/web/index.php/index');
                        if ($url == 'checkout')
                        {
                            return $this->redirect('/cart/checkout');
                        }
                        else
                        {
                            return $this->redirect('./index');
                        }

                    }
                }
            }

            if($model->load(Yii::$app->request->post())){

                if($model->login()){
                    if (isset(Yii::$app->session['openid']) && !empty(Yii::$app->session['openid']))
                    {
                        $customer_model = Customer::findByCustomerId(Yii::$app->user->identity->customer_id);

                        $customer_model->openid = Yii::$app->session['openid'];

                        $customer_model->save();
                    }

//                    return $this->redirect('/damon_cart/wap/web/index.php/index');
                    if ($url == 'checkout')
                    {
                        return $this->redirect('/cart/checkout');
                    }
                    else
                    {
                        return $this->redirect('/index');
                    }
                }
            }

            return $this->render('index',['model'=>$model]);
        // }

    }

    /*
     * 注册
     */
    public function actionRegister($code = null, $agent_id = null)
    {
        $model = new Customer();

        $model->setScenario('register');

        $data = array();

        /*
         * agent_id 有值 为代理商推大C
         */
        if (!empty($agent_id))
        {
            $data['agent_city'] = Agent::find()->select(['oc_area.area_name'])
                ->joinWith('agentCity',['area_id' => 'agent_city_id'])
                ->where(['oc_agent.agent_id' => $agent_id])->asArray()->all();

            $data['agent_province'] = Agent::find()->select(['oc_area.area_name'])
                ->joinWith('agentProvince',['area_id' => 'agent_province_id'])
                ->where(['oc_agent.agent_id' => $agent_id])->asArray()->all();

            $data['agent_id'] = $agent_id;

            $data['customer_group_id'] = 1;

            $data['parent_id'] = 0;
        }

        if (!empty($code))
        {
            /*
             * CODE  有值且is_numeric 为推广人推大C
             */
            if (is_numeric(base64_decode($code)) && base64_decode($code) - 888888 > 0)
            {
                $data['extensioner_id'] = base64_decode($code) - 888888;

                $data['customer_group_id'] = 1;

                $data['parent_id'] = 0;
            }
            /*
             * 小C注册
             */
            else
            {
                $data['parent_id'] = hexdec($code) - 100000;

                $data['customer_group_id'] = 5;
            }
        }

        $model->parent_id = isset($data['parent_id']) ? $data['parent_id'] : 0;

        $model->customer_group_id = isset($data['customer_group_id']) ? $data['customer_group_id'] : 5;

        $model->agent_id = isset($data['agent_id']) ? $data['agent_id'] : 0;

        $model->firstname = isset($data['firstname']) ? $data['firstname'] : 0;

        $model->lastname = isset($data['lastname']) ? $data['lastname'] : 0;

        $model->salt = substr(md5(uniqid(rand(), true)), 0, 9);

        $model->fax = isset($data['fax']) ? $data['fax'] : 0;

        $model->date_added = date('Y-m-d H:i:s');

        $model->approved = 1;

        $model->custom_field = 0;

        $model->safe = 1;

        $model->token = '';

        $model->id_number = '';

        $model->status = 1;

        $model->ip = $_SERVER["REMOTE_ADDR"];


        if ($model->load(Yii::$app->request->post()))
        {
            $model->email = $model->telephone;

            if ($model->save())
            {
                /*
                 * IF Extensioner_id 存在 写入
                 */
                if (isset($data['extensioner_id']) && !empty($data['extensioner_id']))
                {
                    $customer_id = Yii::$app->db->getLastInsertID();

                    /*
                     * 写入ExtensionerCustomer表
                     */
                    $extensionerCustomer = new ExtensionerCustomer();

                    $extensionerCustomer->customer_id = $customer_id;

                    $extensionerCustomer->extensioner_id = $data['extensioner_id'];

                    $extensionerCustomer->save();


                    /*
                     * 写入Extensioner表
                     */
                    $extensioner = new Extensioner();

                    $extensioner->username = $model->telephone;

                    $extensioner->password = $model->telephone;

                    $extensioner->email = $model->telephone;

                    $extensioner->phone = $model->telephone;

                    $extensioner->type = 2;

                    $extensioner->lastname = $model->lastname;

                    $extensioner->parent_id = $data['extensioner_id'];

                    $extensioner->id_number = $model->id_number;

                    $extensioner->id_files = 0;

                    $extensioner->company_number = 0;

                    $extensioner->company_files = 0;

                    $extensioner->company_short = 0;

                    $extensioner->company_name = 0;

                    $extensioner->address = 0;

                    $extensioner->save();

                }

                Yii::$app->session->setFlash('success', '注册成功');
                return $this->redirect('./index');
            }
        }

        $provinces = Area::find()->where(['level'=>1])->all();

        $this->layout = 'login-main';

        return $this->render('register',[
            'model' => $model,
            'provinces' => $provinces,
            'data' => $data
        ]);
    }

    /*
     * 退出
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(array('/login'));
    }

    /*
     * GETCITY
     */
    public function actionGetcity()
    {
        if (Yii::$app->request->post())
        {
            $province_id = Yii::$app->request->post('province_id');

            $citys = Area::find()->where(['level' => 2, 'parent_id' => $province_id])->asArray()->all();

            echo json_encode(array('citys' => $citys,'status' => 'success'));
        }
    }


    /*
     * 修改密码
     */
    public function actionUpdate()
    {
        if (Yii::$app->request->post())
        {
            $telephone = Yii::$app->request->post('telephone');

            $model = Customer::findByTelephone($telephone);

            $model->setScenario('find');

            if ($model)
            {
                $model->password = Yii::$app->request->post('password');

                $model->save();
            }

        }
    }


    /*
     * 找回密码
     */
    public function actionFind()
    {
        $model = new Customer();

        $model->setScenario('find');

        if (Yii::$app->request->post())
        {

            $telephone = Yii::$app->request->post('Customer')['telephone'];

            $model = Customer::find()->where(['telephone' => $telephone])->one();

            $model->password = Yii::$app->request->post('Customer')['password'];

            if ($model->save())
            {
                return $this->redirect('./index');
            }

        }

        $this->layout = "login-main";

        return $this->render('find',[
            'model' => $model
        ]);
    }



    /*
     * 重置密码
     */
    public function actionResetPassword()
    {
        $token = Yii::$app->request->get('token');
        if(!$token){
            Yii::$app->session->setFlash('success', '重置密码链接已失效');
            $this->redirect(['/share/account/login']);
        }

        $agent = Agent::findOne(['reset_password_token' => $token]);
        if(!$agent || time() - strtotime($agent->reset_password_send_date) > 3600){
            Yii::$app->session->setFlash('success', '重置密码链接已失效');
            $this->redirect(['/share/account/login']);
        }

        $model = new ResetPasswordForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $agent->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $agent->reset_password_token = null;
            $agent->save(true, ['password', 'reset_password_token']);
            Yii::$app->session->setFlash('success', '修改密码成功');

            $this->redirect(['/share/account/login']);
        }

        $this->layout = "main-login";

        return $this->render('reset-password',['model'=>$model]);
    }


    /*
     * AJAX LOGIN
     */
    public function actionAjaxLogin()
    {
         if (Yii::$app->request->get())
         {
             $model = new LoginForm();

             $model->email = base64_decode(Yii::$app->request->get('email'));

             $model->password = base64_decode(Yii::$app->request->get('password'));

             if($model->login())
             {
                echo json_encode(array('status' => 'success'));
             }
             else
             {
                 echo json_encode(array('status' => 'error'));
             }
         }
         else
         {
             echo json_encode(array('status' => 'error'));
         }

    }

    /*
     * ajax GET CUSTOMER
     */
    public function actionAjaxGetCustomer()
    {
        if (Yii::$app->request->get())
        {
            $telephone = base64_decode(Yii::$app->request->get('email'));
            $model = Customer::find()->andWhere(['telephone' => $telephone])->one();
            if ($model)
            {
                echo json_encode(array('status' => 'success'));
            }
            else
            {
                echo json_encode(array('status' => 'error'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }
    }


    public function actionAjaxRegister()
    {
        if (Yii::$app->request->get())
        {
            $model = new Customer();

            $model->setScenario('register');

            $data = array();

            $model->parent_id = 0;

            $model->customer_group_id = 5;

            $model->agent_id = 0;

            $model->firstname = 0;

            $model->lastname = 0;

            $model->salt = substr(md5(uniqid(rand(), true)), 0, 9);

            $model->fax = 0;

            $model->date_added = date('Y-m-d H:i:s');

            $model->approved = 1;

            $model->custom_field = 0;

            $model->safe = 1;

            $model->token = '0';

            $model->id_number = '0';

            $model->status = 1;

            $model->province = '安徽';

            $model->city = '合肥';

            $model->password = base64_decode(Yii::$app->request->get('password'));

            $model->email = base64_decode(Yii::$app->request->get('email'));

            $model->ip = $_SERVER["REMOTE_ADDR"];

            $model->telephone = $model->email;

            if ($model->save())
            {
                echo json_encode(array('status' => 'success'));
            }
            else
            {
//                var_dump($model->errors);
                echo json_encode(array('status' => 'error'));
            }

        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }
    }



    /*
     * 发送短信
     */
    public function actionSendmessage(){
        if(Yii::$app->request->post()){

            $phone = Yii::$app->request->post('phone');
//          $phone = '13916749985';

            $code = rand(1000,9999);

            $datas = array($code,'10');

            $temp =  50271;

            $result = $this->sendTemplateSMS($phone, $datas, $temp);
            if($result == NULL ) {
                echo json_encode(array('status' => 'error'));
            }
            else {
                if ($result->statusCode != 0) {
                    echo json_encode(array('status' => 'error'));
                }
                else {
                    echo json_encode(array('status' => 'success','code' => $code));
                }
            }
            /**
             * 发送模板短信
             * @param to 手机号码集合,用英文逗号分开
             * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
             * @param $tempId 模板Id
             */
        }
    }




    function sendTemplateSMS($to,$datas,$tempId)
    {
        require str_replace('\\','/',\Yii::$app->basePath.'/vendor/CCPRestSDK/CCPRestSDK.php');

        //主帐号
        $accountSid = 'aaf98f89506fc2f001507e08f7de0ab8';

        //主帐号Token
        $accountToken = '4bf16fef5d80423cbef177c54ce3a37e';

        //应用Id
        $appId = 'aaf98f89510df96101510e03e3fd0027';

        //请求地址，格式如下，不需要写https://
        $serverIP = 'app.cloopen.com';

        //请求端口
        $serverPort='8883';

        //REST版本号
        $softVersion='2013-12-26';

        // 初始化REST SDK

//      global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
        $rest = new \Rest($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        // 发送模板短信
//      echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);

        return $result;
    }

}
