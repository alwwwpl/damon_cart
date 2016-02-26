<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_bidding".
 *
 * @property integer $bidding_id
 * @property integer $product_id
 * @property string $start_time
 * @property string $over_time
 * @property string $start_price
 * @property string $floor_price
 * @property integer $interval
 * @property integer $status
 * @property integer $stock
 */
class Bidding extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_bidding';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'start_time', 'over_time', 'status'], 'required'],
            [['product_id', 'interval', 'status', 'stock'], 'integer'],
            [['start_time', 'over_time'], 'safe'],
            [['start_price', 'floor_price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bidding_id' => 'Bidding ID',
            'product_id' => 'Product ID',
            'start_time' => 'Start Time',
            'over_time' => 'Over Time',
            'start_price' => 'Start Price',
            'floor_price' => 'Floor Price',
            'interval' => 'Interval',
            'status' => 'Status',
            'stock' => 'Stock',
        ];
    }
}
