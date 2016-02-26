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
class Customer extends \yii\db\ActiveRecord
{
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
            [['customer_group_id', 'firstname', 'lastname', 'email', 'telephone', 'fax', 'password', 'salt', 'custom_field', 'ip', 'status', 'approved', 'safe', 'token', 'date_added'], 'required'],
            [['customer_group_id', 'store_id', 'newsletter', 'address_id', 'status', 'approved', 'safe', 'agent_id'], 'integer'],
            [['cart', 'wishlist', 'custom_field'], 'string'],
            [['date_added'], 'safe'],
            [['firstname', 'lastname', 'telephone', 'fax'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 96],
            [['password', 'ip'], 'string', 'max' => 40],
            [['salt'], 'string', 'max' => 9],
            [['token', 'store_name', 'store_logo'], 'string', 'max' => 255]
        ];
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
            'lastname' => 'Lastname',
            'email' => 'Email',
            'telephone' => '电话',
            'fax' => 'Fax',
            'password' => '密码',
            'salt' => 'Salt',
            'cart' => 'Cart',
            'wishlist' => 'Wishlist',
            'newsletter' => 'Newsletter',
            'address_id' => 'Address ID',
            'custom_field' => 'Custom Field',
            'ip' => 'Ip',
            'status' => 'Status',
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
     * @return \app\models\query\CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CustomerQuery(get_called_class());
    }

    public function getAgent()
    {
        return $this->hasOne(Agent::className(), ['agent_id' => 'agent_id']);
    }

    public function getTelephoneHiden()
    {
        return preg_replace('/(\d{3})\d+(\d{3})/', '$1***$2', $this->telephone);
    }

    public function getEmailHiden()
    {
        return preg_replace('/[^@]+@([^@]+)/', '***@$1', $this->email);
    }

    public function getCustomerUsers()
    {
        return $this->hasMany(CustomerUser::className(), ['customer_id' => 'customer_id']);
    }
}
