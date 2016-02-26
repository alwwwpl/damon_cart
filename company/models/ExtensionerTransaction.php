<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_extensioner_transaction".
 *
 * @property integer $extensioner_transaction_id
 * @property integer $extensioner_id
 * @property integer $order_id
 * @property string $description
 * @property string $amount
 * @property string $cash
 * @property string $date_added
 */
class ExtensionerTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_extensioner_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extensioner_id', 'order_id', 'date_added'], 'required'],
            [['extensioner_id', 'order_id'], 'integer'],
            [['amount', 'cash'], 'number'],
            [['date_added'], 'safe'],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'extensioner_transaction_id' => 'Extensioner Transaction ID',
            'extensioner_id' => 'Extensioner ID',
            'order_id' => 'Order ID',
            'description' => 'Description',
            'amount' => 'Amount',
            'cash' => 'Cash',
            'date_added' => 'Date Added',
        ];
    }
}
