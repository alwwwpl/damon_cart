<?php

namespace app\modules\agent\models;

use Yii;
use yii\base\Model;

use app\models\Agent;

class ResetPasswordForm extends Model
{
    public $password;
    public $confirm_password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            [['password', 'confirm_password'], 'string', 'min' => 6, 'max' => 20],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => '新密码',
            'confirm_password' => '确认密码',
        ];
    }
}
