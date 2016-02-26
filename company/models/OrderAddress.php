<?php

namespace app\models;

use Yii;

/**
 * 订单商品
 *
 * @property integer $order_address_id
 * @property integer $customer_id
 * @property integer $order_id
 * @property string $phone
 * @property string $username
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $remarks
 */
class OrderAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_order_address';
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

}
