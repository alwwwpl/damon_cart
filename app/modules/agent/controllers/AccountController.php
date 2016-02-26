<?php

namespace app\modules\agent\controllers;

use Yii;

use yii\web\Controller;
use app\models\Agent;
use app\models\InviteCode;

use app\modules\agent\models\LoginForm;
use app\modules\agent\models\FindPasswordForm;
use app\modules\agent\models\ResetPasswordForm;

class AccountController extends Controller
{
    public function actionCreate()
    {
        $code = Yii::$app->request->get('code');
        if(!$code){
            Yii::$app->session->setFlash('error', '没有邀请码不能注册');

            return $this->redirect(['default/index']);
        }

        $inviteCode = InviteCode::findOne(['code' => $code]);
        if(!$inviteCode){
            Yii::$app->session->setFlash('error', '没有邀请码不能注册');

            return $this->redirect(['default/index']);
        }

        if($inviteCode->status!=InviteCode::STATUS_UNUSED){
            Yii::$app->session->setFlash('error', '邀请码已经失效');

            return $this->redirect(['default/index']);
        }

        $agent = $inviteCode->agent;

        $model = new Agent();
        $model->parent_id = $agent->agent_id;
        $model->type = Agent::TYPE_CITY;
        $model->agent_province_id = $agent->agent_province_id;

        if ($model->load(Yii::$app->request->post())) {
            $image1 = $model->uploadImage1();
            $image2 = $model->uploadImage2();
 
            if ($model->save()) {
                if ($image1 !== false) {
                    $path1 = $model->getFile1();
                    $image1->saveAs($path1);
                }
                if ($image2 !== false) {
                    $path2 = $model->getFile2();
                    $image2->saveAs($path2);
                }

                $inviteCode->status = InviteCode::STATUS_USED;
                $inviteCode->save();

                Yii::$app->session->setFlash('success', '注册成功，等待后台审核');

                return $this->redirect(['default/index']);
            }
        }

        $this->layout = 'register';
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        
        if($model->load(Yii::$app->request->post())){

            if($model->login()){
                return $this->redirect('/agent/');
            } else {
                return $this->render('login',['model'=>$model]);
            }
        }

        $this->layout = "main-login";

        return $this->render('login',['model'=>$model]);

    }

    public function actionLogout()
    {
        Yii::$app->agent->logout();

        return $this->redirect(array('/agent/account/login'));
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
            $this->redirect(['/agent/account/login']);
        }

        $agent = Agent::findOne(['reset_password_token' => $token]);
        if(!$agent || time() - strtotime($agent->reset_password_send_date) > 3600){
            Yii::$app->session->setFlash('success', '重置密码链接已失效');
            $this->redirect(['/agent/account/login']);
        }

        $model = new ResetPasswordForm();
        
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $agent->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $agent->reset_password_token = null;
            $agent->save(true, ['password', 'reset_password_token']);
            Yii::$app->session->setFlash('success', '修改密码成功');

            $this->redirect(['/agent/account/login']);
        }

        $this->layout = "main-login";
        
        return $this->render('reset-password',['model'=>$model]);
    }


    public function actionSendmessage()
    {
        if (Yii::$app->request->post()){

            $phone = Yii::$app->request->post('phone');
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