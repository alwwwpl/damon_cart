<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Customer;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $email;
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
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => '帐号',
            'password' => '密码'
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
//            $user = Customer::findByUsername($this->email,$this->password);
//            var_dump($user);
            $user = $this->getUser();
              if(!$user)
              {
                  $this->addError($attribute, '用户名或密码不正确!');
              }

//            if (!$user || !Customer::findByUsername($this->email,$this->password)->validatePassword($this->password,$user->password,$user->salt)) {
//                $this->addError($attribute, 'Incorrect username or password.');
//            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Customer::findByUsername($this->email,$this->password);
        }

        return $this->_user;
    }
}
