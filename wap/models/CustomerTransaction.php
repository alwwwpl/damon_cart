<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_customer_transaction".
 *
 * @property integer $customer_transaction_id
 * @property integer $customer_id
 * @property integer $order_id
 * @property string $description
 * @property string $amount
 * @property string $cash
 * @property string $date_added
 */
class CustomerTransaction extends \yii\db\ActiveRecord
{
    public $balance;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_customer_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'order_id', 'description', 'amount', 'cash', 'date_added'], 'required'],
            [['customer_id', 'order_id'], 'integer'],
            [['description'], 'string'],
            [['amount', 'cash'], 'number'],
            [['date_added'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_transaction_id' => 'Customer Transaction ID',
            'customer_id' => 'Customer ID',
            'order_id' => 'Order ID',
            'description' => 'Description',
            'amount' => 'Amount',
            'cash' => 'Cash',
            'date_added' => 'Date Added',
        ];
    }
}
