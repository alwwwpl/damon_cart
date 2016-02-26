<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_bank_card".
 *
 * @property integer $bank_card_id
 * @property integer $customer_id
 * @property integer $agent_id
 * @property string $username
 * @property string $card_number
 * @property string $bank
 * @property string $create_time
 */
class BankCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_bank_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'],'required', 'message' => '请输入持卡人姓名'],
            [['card_number'],'required', 'message' => '请输入银行卡号'],
            [['bank'],'required', 'message' => '请输入所属银行'],
            [['subbranch'],'required', 'message' => '请输入所属支行'],

            [['customer_id', 'agent_id'], 'integer'],
            [['create_time'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['card_number', 'bank'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bank_card_id' => 'Bank Card ID',
            'customer_id' => 'Customer ID',
            'agent_id' => 'Agent ID',
            'username' => 'Username',
            'card_number' => 'Card Number',
            'bank' => 'Bank',
            'create_time' => 'Create Time',
        ];
    }
}
