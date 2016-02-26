<?php

namespace app\modules\agent\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

use app\models\Agent;

class FindPasswordForm extends Model
{
    public $email;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'email'],
            ['email', 'required'],
            ['email', function($attribute, $params){
                $agent = Agent::findOne(['email' => $this->email]);
                if(!$agent){
                    $this->addError('email', '这个用户不存在');
                    return false;
                }
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => '邮箱',
        ];
    }

    public function sendMail()
    {
        $agent = Agent::findOne(['email' => $this->email]);
        $token = Yii::$app->getSecurity()->generateRandomString();

        $params = [
            'agent' => $agent,
            'url' => Yii::$app->request->hostInfo . Url::to(['account/reset-password', 'token' => $token]),
        ];

        $agent->reset_password_token = $token;
        $agent->reset_password_send_date = date('Y-m-d H:i:s');
        $agent->save(true, ['reset_password_token', 'reset_password_send_date']);

        Yii::$app->mailer->compose('find-password', $params)
            ->setFrom(getenv('MAIL_FROM'))
            ->setTo($agent->email)
            ->setSubject('找回密码')
            ->send();
    }
}
