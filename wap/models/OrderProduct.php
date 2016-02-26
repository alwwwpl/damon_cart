<?php

namespace app\models;

use Yii;

/**
 * 订单商品
 *
 * @property integer $order_product_id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property string $model
 * @property integer $quantity
 * @property string $price
 * @property string $total
 * @property string $tax
 * @property integer $reward
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name', 'model', 'quantity', 'reward'], 'required'],
            [['order_id', 'product_id', 'quantity', 'reward'], 'integer'],
            [['price', 'total', 'tax'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['model'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_product_id' => 'Order Product ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'model' => 'Model',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
            'tax' => 'Tax',
            'reward' => 'Reward',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\OrderProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\OrderProductQuery(get_called_class());
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }

    public function getSupplier() {
        return $this->hasOne(ProductSupplier::className(),['supplier_id' => 'supplier_id']);
    }

    public function getOrder() {
        return $this->hasOne(Order::className(),['order_id' => 'order_id']);
    }

    public function getAddress() {
        return $this->hasOne(OrderAddress::className(),['order_id' => 'order_id']);
    }

}
