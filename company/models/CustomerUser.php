<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_customer_user".
 *
 * @property integer $customer_user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $telephone
 * @property string $date_added
 * @property string $date_modified
 * @property integer $customer_id
 */
class CustomerUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_customer_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_added', 'date_modified'], 'safe'],
            [['customer_id'], 'integer'],
            [['username', 'password', 'email', 'telephone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_user_id' => 'Customer User ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\CustomerUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CustomerUserQuery(get_called_class());
    }
}
