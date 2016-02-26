<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_coupons_code".
 *
 * @property integer $coupons_code_id
 * @property integer $coupons_id
 * @property integer $order_id
 * @property string $code
 * @property integer $status
 */
class CouponsCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_coupons_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupons_id', 'order_id', 'status'], 'integer'],
            [['code'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupons_code_id' => 'Coupons Code ID',
            'coupons_id' => 'Coupons ID',
            'order_id' => 'Order ID',
            'code' => 'Code',
            'status' => 'Status',
        ];
    }
}
