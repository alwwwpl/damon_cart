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
class AgentTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_agent_transaction';
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
