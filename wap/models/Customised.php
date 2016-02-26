<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_customised".
 *
 * @property integer $customised_id
 * @property integer $customer_id
 * @property string $product_name
 * @property string $product_type
 * @property string $product_brand
 * @property integer $number
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property string $datetime
 */
class Customised extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_customised';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_name', 'product_type', 'product_brand', 'description', 'image'], 'required'],
            [['customer_id', 'number', 'status'], 'integer'],
            [['description'], 'string'],
            [['datetime'], 'safe'],
            [['product_name', 'product_type', 'product_brand', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customised_id' => 'Customised ID',
            'customer_id' => 'Customer ID',
            'product_name' => 'Product Name',
            'product_type' => 'Product Type',
            'product_brand' => 'Product Brand',
            'number' => 'Number',
            'description' => 'Description',
            'image' => 'Image',
            'status' => 'Status',
            'datetime' => 'Datetime',
        ];
    }
}
