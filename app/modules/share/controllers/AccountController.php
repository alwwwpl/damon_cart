<?php

namespace app\modules\share\controllers;

use Yii;

use yii\web\Controller;
use app\models\Extensioner;

use app\modules\share\models\LoginForm;
use app\modules\share\models\FindPasswordForm;
use app\modules\share\models\ResetPasswordForm;

class AccountController extends Controller
{
    public function actionCreate()
    {
        $code = Yii::$app->request->get('code');

        $model = new Extensioner();

        if(!$code)
        {
            Yii::$app->session->setFlash('error', '没有注册码不能注册');
        }
        elseif (is_numeric(base64_decode(Yii::$app->request->get('code'))) && base64_decode(Yii::$app->request->get('code')) - 888888 > 0)
        {
            $extensioner_id = base64_decode(Yii::$app->request->get('code')) - 888888;

            if (Extensioner::findOne($extensioner_id))
            {
                if ($model->load(Yii::$app->request->post())) {

                    $model->parent_id = $extensioner_id;

                    $model->type = Extensioner::TYPE_SUB;

                    if ($model->save()) {

                        Yii::$app->session->setFlash('success', '注册成功，等待后台审核');

                        return $this->redirect(['account/login']);
                    }
                }

            }
            else
            {
                Yii::$app->session->setFlash('error', '注册码不正确');
            }
        }
        else
        {
            Yii::$app->session->setFlash('error', '注册码不正确');
        }

        $this->layout = 'register';
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        Yii::$app->extensioner->logout();

        $model = new LoginForm();
        
        if($model->load(Yii::$app->request->post())){

            if($model->login()){
                return $this->redirect('/share/');
            } else {
                return $this->render('login',['model'=>$model]);
            }
        }

        $this->layout = "main-login";

        return $this->render('login',['model'=>$model]);

    }

    public function actionLogout()
    {
        Yii::$app->extensioner->logout();

        return $this->redirect(array('/share/account/login'));
    }

    public function actionFindPassword()
    {
        $model = new FindPasswordForm();
        
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->sendMail();

            Yii::$app->session->setFlash('success', '重置密码邮件已经发送到您的邮箱，请注意查收');
        }

        $this->layout = "main-login";
        
        return $this->render('find-password',['model'=>$model]);
    }

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


    public function actionSendmessage(){
      if(Yii::$app->request->post()){

      $phone = Yii::$app->request->post('phone');
//        $phone = '13916749985';

        $code = rand(1000,9999);

        $datas = array($code,'10');

        $temp = 50269;

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

//        global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
        $rest = new \Rest($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        // 发送模板短信
//        echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);

        return $result;
        /*if($result == NULL )
        {
            echo "result error!";
            exit();
        }

        if($result->statusCode!=0) {

            echo "error code :" . $result->statusCode . "<br>";
            echo "error msg :" . $result->statusMsg . "<br>";

        }
        else
        {
//            echo "Sendind TemplateSMS success!<br/>";
            // 获取返回信息
            echo $smsmessage = $result->TemplateSMS;
//            echo "dateCreated:".$smsmessage->dateCreated."<br/>";
//            echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        }*/
    }
}
