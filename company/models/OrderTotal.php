<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_order_total".
 *
 * @property integer $order_total_id
 * @property integer $order_id
 * @property string $code
 * @property string $title
 * @property string $value
 * @property integer $sort_order
 */
class OrderTotal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_order_total';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'code', 'title', 'sort_order'], 'required'],
            [['order_id', 'sort_order'], 'integer'],
            [['value'], 'number'],
            [['code'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_total_id' => 'Order Total ID',
            'order_id' => 'Order ID',
            'code' => 'Code',
            'title' => 'Title',
            'value' => 'Value',
            'sort_order' => 'Sort Order',
        ];
    }
}
