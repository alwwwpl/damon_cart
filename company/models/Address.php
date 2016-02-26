<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_address".
 *
 * @property integer $address_id
 * @property integer $customer_id
 * @property string $firstname
 * @property string $lastname
 * @property string $company
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $postcode
 * @property integer $country_id
 * @property integer $zone_id
 * @property string $custom_field
 * @property string $phone
 * @property string $province
 * @property integer $province_id
 * @property integer $city_id
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'firstname', 'lastname', 'company', 'address_1', 'address_2', 'city', 'postcode', 'custom_field'], 'required'],
            [['customer_id', 'country_id', 'zone_id', 'province_id', 'city_id'], 'integer'],
            [['custom_field'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 32],
            [['company'], 'string', 'max' => 40],
            [['address_1', 'address_2', 'city'], 'string', 'max' => 128],
            [['postcode'], 'string', 'max' => 10],
            [['phone', 'province'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'Address ID',
            'customer_id' => 'Customer ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'company' => 'Company',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'city' => 'City',
            'postcode' => 'Postcode',
            'country_id' => 'Country ID',
            'zone_id' => 'Zone ID',
            'custom_field' => 'Custom Field',
            'phone' => 'Phone',
            'province' => 'Province',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
        ];
    }
}
