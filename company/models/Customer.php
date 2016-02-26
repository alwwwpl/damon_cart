<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_customer".
 *
 * @property integer $customer_id
 * @property integer $customer_group_id
 * @property integer $store_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $password
 * @property string $salt
 * @property string $cart
 * @property string $wishlist
 * @property integer $newsletter
 * @property integer $address_id
 * @property string $custom_field
 * @property string $ip
 * @property integer $status
 * @property integer $approved
 * @property integer $safe
 * @property string $token
 * @property string $date_added
 * @property string $store_name
 * @property string $store_logo
 * @property integer $agent_id
 */
class Customer extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password_confirm;
    public $oldpassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_group_id', 'firstname', 'lastname', 'email', 'telephone', 'fax', 'password', 'salt', 'custom_field', 'ip', 'status', 'approved', 'safe', 'token', 'date_added'], 'required', 'on' => ['create']],
            [['customer_group_id', 'store_id', 'newsletter', 'address_id', 'status', 'approved', 'safe', 'agent_id'], 'integer', 'on' => ['create']],
            [['cart', 'wishlist', 'custom_field'], 'string', 'on' => ['create']],
            [['date_added'], 'safe', 'on' => ['create']],
            [['firstname', 'lastname', 'telephone', 'fax'], 'string', 'max' => 32, 'on' => ['create']],
            [['email'], 'string', 'max' => 96, 'on' => ['create']],
            [['password', 'ip'], 'string', 'max' => 40, 'on' => ['create']],
            [['salt'], 'string', 'max' => 9, 'on' => ['create']],
            [['token', 'store_name', 'store_logo'], 'string', 'max' => 255, 'on' => ['create']],

            [['telephone','password','province','city'],'required', 'on' => ['register']],
            [['password'], 'string', 'max' => 18, 'on' => ['register','find']],
            [['password'], 'string', 'min' => 6, 'on' => ['register','find']],
            [['telephone'],'unique', 'message'=>'手机号码已经被注册！', 'on' => ['register']],

            [['oldpassword', 'password', 'password_confirm'],'required', 'on' => ['updatepassword'], 'message' => '请输入密码'],
            [['oldpassword', 'password', 'password_confirm'], 'string', 'min' => 6, 'max' => 18, 'on' => ['updatepassword'], 'tooLong'=>'密码请输入长度为6-18位字符', 'tooShort'=>'密码请输入长度为6-18位字符'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'on' => ['updatepassword'], 'message' => '确认密码与新密码不一至'],
            ['oldpassword', 'authenticate', 'on' => ['updatepassword']],

            [['telephone','password'],'required', 'on' => ['find']],

            [['payment_password'],'required', 'on' => ['paymentpassword']],
//            [['password'], 'compare','compareAttribute'=>'password_confirm', 'on' => ['register']],
        ];
    }

    public function authenticate()
    {

        $passwordmd5 = Yii::$app->user->identity->password;
        $salt = Yii::$app->user->identity->salt;
        if (md5($this->oldpassword) == $passwordmd5 || sha1($salt.sha1($salt.sha1($this->oldpassword))) == $passwordmd5)
        {
            return true;
        }
        else
        {
            $this->addError('oldpassword', '原始密码错误');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => '编号',
            'customer_group_id' => 'Customer Group ID',
            'store_id' => 'Store ID',
            'firstname' => 'Firstname',
            'lastname' => '姓名',
            'email' => 'Email',
            'telephone' => '电话',
            'fax' => '传真',
            'password' => '密码',
            'salt' => 'Salt',
            'cart' => 'Cart',
            'wishlist' => 'Wishlist',
            'newsletter' => 'Newsletter',
            'address_id' => 'Address ID',
            'custom_field' => 'Custom Field',
            'ip' => 'Ip',
            'status' => '状态',
            'approved' => 'Approved',
            'safe' => 'Safe',
            'token' => 'Token',
            'date_added' => '添加时间',
            'store_name' => 'Store Name',
            'store_logo' => 'Store Logo',
            'agent_id' => 'Agent ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByCustomerId($customer_id)
    {
        return static::find()->where(['customer_id' => $customer_id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if(strlen($this->password) < 20){

                $this->password = sha1($this->salt . sha1($this->salt . sha1($this->password)));
            }

            return true;
        }

        return false;
    }



    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        // return $this->accessToken;
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
        // return $this->accessToken() === $authKey;
    }


    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     * $passwordmd5,$salt
     */
//    public function validatePassword($password)
//    {
//        $passwordmd5 = $this->password;
//        $salt = $this->salt;
//        if (md5($password) == $passwordmd5 || sha1($salt,sha1($salt,sha1($password))) == $passwordmd5)
//        {
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//
////        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
//    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($email,$password)
    {
        if (strlen($password) == 40 || strlen($password) == 32)
        {
            return static::find()
                ->andWhere(["or","email='".$email."'", "telephone='".$email."'"])
                ->one();
        }
        else
        {
            return static::find()
                ->andWhere(["or","password=SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $password . "')))))", "password=md5('" . $password . "')"])
                ->andWhere(["or","email='".$email."'", "telephone='".$email."'"])
                ->one();
        }

    }


    /*
     * findByTelephone
     */
    public static function findByTelephone($telephone)
    {
        return static::find()
            ->andWhere(['telephone' => $telephone])
            ->one();
    }

    /*
     * findByOpenid
     */
    public static function findByOpenid($openid)
    {
        return static::find()
            ->andWhere(['openid' => $openid])
            ->one();
    }


    public function getBalance()
    {
        $model = CustomerTransaction::find()->select(['SUM(amount) as amount'])->andWhere(['customer_id' => Yii::$app->user->identity->customer_id])->one();

        return $model->amount;
    }


}
