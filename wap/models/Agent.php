<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * 代理商
 *
 * @property integer $agent_id
 * @property string $username
 * @property string $password
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $phone
 * @property string $email
 * @property string $contact
 * @property string $id_code
 * @property string $id_file
 * @property integer $agent_province_id
 * @property integer $agent_city_id
 * @property integer $agent_area_id
 * @property string $company_short_name
 * @property string $company_name
 * @property string $business_license
 * @property string $business_license_file
 * @property integer $status
 * @property integer $parent_id
 * @property integer $type
 * @property string $date_added
 * @property string $date_modified
 */
class Agent extends \yii\db\ActiveRecord implements IdentityInterface
{
    // 省代
    const TYPE_PROVINCE = 1;

    // 市代
    const TYPE_CITY = 2;

    // 待审核
    const STATUS_PENDING = 0;

    // 已通过
    const STATUS_PASSED = 1;

    // 已拒绝
    const STATUS_REFUSED = 2;

    public static $types = [
        self::TYPE_PROVINCE => '省代',
        self::TYPE_CITY => '市代',
    ];

    public static $statuses = [
        self::STATUS_PENDING => '待审核',
        self::STATUS_PASSED => '已通过',
        self::STATUS_REFUSED => '已拒绝',
    ];

    public $file1;

    public $file2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_agent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'contact', 'id_code', 'company_short_name', 'company_name', 'business_license', 'address'], 'required'],
            [['file1', 'file2'], 'file', 'extensions'=>'jpg, gif, png'],
            ['email', 'email'],
            [['province_id', 'city_id', 'area_id', 'agent_province_id', 'agent_city_id', 'agent_area_id', 'status', 'parent_id', 'type'], 'integer'],
            [['username', 'email', 'id_code', 'company_name', 'business_license', 'phone'], 'unique'],
            [['username', 'email', 'contact', 'company_short_name', 'company_name', 'business_license', 'address'], 'string', 'max' => 32],
            [['province_id', 'city_id', 'area_id', 'agent_province_id'], 'required'],
            ['phone', 'string', 'length' => 11],
            ['id_code', 'string', 'length' => 18],
            [['agent_city_id'], 'required', 'when' => function(){
                return $this->type == self::TYPE_CITY;
            }],
            ['status', 'default', 'value' => self::STATUS_PENDING],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agent_id' => '编号',
            'username' => '用户名',
            'password' => '密码',
            'province_id' => '省',
            'city_id' => '市',
            'area_id' => '区',
            'phone' => '电话',
            'email' => 'Email',
            'contact' => '联系人',
            'id_code' => '身份证号码',
            'id_file' => '身份证文件',
            'file1' => '身份证文件',
            'agent_province_id' => '代理省',
            'agent_city_id' => '代理市',
            'agent_area_id' => '代理区',
            'company_short_name' => '公司简称',
            'company_name' => '公司名',
            'business_license' => '营业执照号码',
            'business_license_file' => '营业执照文件',
            'file2' => '营业执照文件',
            'status' => '状态',
            'parent_id' => '父代理',
            'type' => '类型',
            'date_added' => '添加时间',
            'date_modified' => '修改时间',
            'address' => '地址',
            'customer_number' => '从业人员数量'
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_added',
                'updatedAtAttribute' => 'date_modified',
                'value' => function(){
                    return date('Y-m-d H:i:s');
                },
            ],
        ]);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AgentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AgentQuery(get_called_class());
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
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->one();
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

    public function afterDelete()
    {
        $this->deleteImage();
    }

    public function getFile1() 
    {
        return isset($this->id_file) ? Yii::$app->basePath . '/web/' . $this->id_file : null;
    }

    public function getFile2() 
    {
        return isset($this->business_license_file) ? Yii::$app->basePath . '/web/' . $this->business_license_file : null;
    }

    public function uploadImage1() {
        $file = UploadedFile::getInstance($this, 'file1');

        // if no image was uploaded abort the upload
        if (empty($file)) {
            return false;
        }

        // store the source file name
        $ext = end((explode(".", $file->name)));

        // generate a unique file name
        $this->id_file =  '/uploads/agent/' . Yii::$app->security->generateRandomString().".{$ext}";

        if(!file_exists(Yii::$app->basePath . '/web/uploads/agent')){
            mkdir(Yii::$app->basePath . '/web/uploads/agent', 0777, true);
        }

        // the uploaded image instance
        return $file;
    }

    public function uploadImage2() {
        $file = UploadedFile::getInstance($this, 'file2');

        if (empty($file)) {
            return false;
        }

        // store the source file name
        $ext = end((explode(".", $file->name)));

        // generate a unique file name
        $this->business_license_file =  '/uploads/agent/' . Yii::$app->security->generateRandomString().".{$ext}";

        if(!file_exists(Yii::$app->basePath . '/web/uploads/agent')){
            mkdir(Yii::$app->basePath . '/web/uploads/agent', 0777, true);
        }

        // the uploaded image instance
        return $file;
    }

    public function deleteImage() {
        $file1 = $this->getFile1();

        // check if file exists on server
        if (empty($file1) || !file_exists($file1)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file1)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->id_file = null;

        $file2 = $this->getFile2();

        // check if file exists on server
        if (empty($file2) || !file_exists($file2)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file2)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->business_license_file = null;

        return true;
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if(strlen($this->password)!=32){
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }

            return true;
        }

        return false;
    }

    public function getProvince()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'province_id']);
    }

    public function getCity()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'province_id']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'area_id']);
    }


    public function getAreas()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'agent_province_id']);
    }

    public function getAgentProvince()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'agent_province_id']);
    }

    public function getAgentCity()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'agent_city_id']);
    }

    public function getAgentArea()
    {
        return $this->hasOne(Area::className(), ['area_id' => 'agent_area_id']);
    }

    public function getParent()
    {
        return $this->hasOne(Agent::className(), ['agent_id' => 'parent_id']);
    }

    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['agent_id' => 'agent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(Agent::className(), ['parent_id' => 'agent_id']);
    }

    public function getTypeName()
    {
        return self::$types[$this->type];
    }

    public function pass()
    {
        $this->status = self::STATUS_PASSED;
        return $this->save();
    }

    public function refuse()
    {
        $this->status = self::STATUS_REFUSED;
        $this->save();
    }

    public function getInviteCodes()
    {
        return $this->hasMany(InviteCode::className(), ['agent_id' => 'agent_id']);
    }
}
