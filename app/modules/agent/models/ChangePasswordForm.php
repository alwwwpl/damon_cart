<?php

namespace app\modules\agent\models;

use Yii;
use yii\base\Model;

use app\models\Agent;

class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $password;
    public $confirmPassword;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['oldPassword', 'password', 'confirmPassword'], 'required'],
            [['oldPassword', 'password', 'confirmPassword'], 'string', 'min' => 6, 'max' => 20],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
            ['oldPassword', function(){
                $agent = Yii::$app->agent->identity;
                if(!$agent->validatePassword($this->oldPassword)){
                    $this->addError('oldPassword', '原始密码错误');
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
            'oldPassword' => '原始密码',
            'password' => '新密码',
            'confirmPassword' => '确认密码',
        ];
    }

    public function changePassword()
    {
        if($this->validate()){
            $agent = Yii::$app->agent->identity;

            $agent->password = $this->password;
            return $agent->save();
        }

        return false;
    }
}
