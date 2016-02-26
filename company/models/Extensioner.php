<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "oc_extensioner".
 *
 * @property integer $extensioner_id
 * @property string $username
 * @property string $password
 * @property integer $parent_id
 * @property integer $type
 * @property string $lastname
 * @property string $email
 * @property string $phone
 * @property integer $province_id
 * @property integer $city_id
 * @property string $address
 * @property string $id_number
 * @property string $id_files
 * @property string $company_number
 * @property string $company_files
 * @property string $company_short
 * @property string $company_name
 * @property string $payment_password
 * @property integer $status
 * @property string $create_time
 */
class Extensioner extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    const TYPE_ADMIN = 0;

    const TYPE_CUSTOMER = 1;

    const TYPE_VIP = 2;

    const TYPE_SUB = 3;

    // 待审核
    const STATUS_PENDING = 0;

    // 已通过
    const STATUS_PASSED = 1;

    // 已拒绝
    const STATUS_REFUSED = 2;

    public static $types = [
        self::TYPE_CUSTOMER => '推广人',
        self::TYPE_SUB => '下级推广人',
        self::TYPE_VIP => '大C',
    ];

    public static $statuses = [
        self::STATUS_PENDING => '待审核',
        self::STATUS_PASSED => '已通过',
        self::STATUS_REFUSED => '已拒绝',
    ];

    public static function tableName()
    {
        return 'oc_extensioner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['parent_id', 'type', 'province_id', 'city_id', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['username', 'password', 'lastname', 'email', 'phone', 'address', 'id_files', 'company_files', 'company_name', 'payment_password'], 'string', 'max' => 255],
            [['id_number'], 'string', 'max' => 20],
            [['company_number'], 'string', 'max' => 30],
            [['company_short'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'extensioner_id' => '推广人ID',
            'username' => '用户名',
            'password' => '密码',
            'parent_id' => 'Parent ID',
            'type' => '用户类型',
            'lastname' => '姓名',
            'email' => '邮箱',
            'phone' => '手机',
            'province_id' => '省份',
            'city_id' => '城市',
            'address' => '详细地址',
            'id_number' => '身份证号码',
            'id_files' => '身份证扫描件',
            'company_number' => '营业执照号码',
            'company_files' => '营业执照扫描件',
            'company_short' => '公司简称',
            'company_name' => '公司全称',
            'payment_password' => '支付密码',
            'status' => '状态',
            'create_time' => '创建时间',
        ];
    }


    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if(strlen($this->password) < 32){
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
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
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->one();
    }



}
