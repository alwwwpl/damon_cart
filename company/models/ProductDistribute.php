<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_product_distribute".
 *
 * @property integer $product_distribute_id
 * @property integer $customer_id
 * @property integer $product_id
 * @property integer $supplier_id
 * @property double $distribute_price
 * @property string $date_added
 * @property string $date_modified
 */
class ProductDistribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_product_distribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'supplier_id'], 'integer'],
            [['distribute_price'], 'number'],
            [['date_added', 'date_modified'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_distribute_id' => 'Product Distribute ID',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'supplier_id' => 'Supplier ID',
            'distribute_price' => 'Distribute Price',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
        ];
    }
}
