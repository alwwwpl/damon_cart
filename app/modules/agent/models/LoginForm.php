<?php

namespace app\modules\agent\models;

use Yii;
use yii\base\Model;

use app\models\Agent;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'rememberMe' => '记住我',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {

        if (!$this->hasErrors()) {
            $user = $this->getUser();  
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '账号或密码错误.');
            }

            if($user && $user->validatePassword($this->password) && $user->status!=Agent::STATUS_PASSED){
                $this->addError($attribute, '你的账户未通过审核，请联系管理后重试.');
            }
        }
    }

    /**n
     * 登录
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            Yii::$app->agent->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Agent::findByUsername($this->username);
        }
        return $this->_user;
    }
}
