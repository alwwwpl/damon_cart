<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_collection".
 *
 * @property integer $collection_id
 * @property integer $customer_id
 * @property integer $product_id
 * @property integer $supplier_id
 * @property integer $distribute_id
 * @property integer $bidding_id
 * @property string $create_time
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id'], 'required'],
            [['customer_id', 'product_id', 'supplier_id', 'distribute_id', 'bidding_id'], 'integer'],
            [['create_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'collection_id' => 'Collection ID',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'supplier_id' => 'Supplier ID',
            'distribute_id' => 'Distribute ID',
            'bidding_id' => 'Bidding ID',
            'create_time' => 'Create Time',
        ];
    }


    public function getCollection($customer_id, $product_id, $supplier_id, $distribute_id = null, $bidding_id = null)
    {
        $model = Collection::find()->andWhere(['customer_id' => $customer_id, 'product_id' => $product_id, 'supplier_id' => $supplier_id, 'distribute_id' => $distribute_id, 'bidding_id' => $bidding_id])
            ->one();
        if ($model)
        {
            return $model->collection_id;
        }
        else
        {
            return false;
        }
    }
}
