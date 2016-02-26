<?php

namespace app\models;

use Yii;

/**
 * 订单商品
 *
 * @property integer $supplier_id
 * @property integer $agent_id
 * @property integer $product_id
 * @property string $agent_name
 * @property string $agent_area
 * @property string $cost_price
 * @property string $price
 * @property string $vip_price
 */
class ProductSupplier extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_product_supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['order_id', 'product_id', 'name', 'model', 'quantity', 'reward'], 'required'],
//            [['order_id', 'product_id', 'quantity', 'reward'], 'integer'],
//            [['price', 'total', 'tax'], 'number'],
//            [['name'], 'string', 'max' => 255],
//            [['model'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agent_id' => '编号',
            'supplier_id' => '编号',
            'image' => '产品图片',
            'agent_product_name' => '产品名称',
            'agent_product_model' => '产品编码',
            'agent_product_stock' => '产品库存',
            'cost_price' => '供货价'
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }

}
