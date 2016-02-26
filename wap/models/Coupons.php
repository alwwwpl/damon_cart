<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_coupons".
 *
 * @property integer $coupons_id
 * @property string $coupons_name
 * @property integer $agent_id
 * @property string $condition
 * @property string $discount
 * @property string $agent_percent
 * @property string $system_percent
 * @property string $start_time
 * @property string $over_time
 */
class Coupons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_coupons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agent_id'], 'integer'],
            [['condition', 'discount'], 'number'],
            [['start_time', 'over_time'], 'required'],
            [['start_time', 'over_time'], 'safe'],
            [['coupons_name'], 'string', 'max' => 50],
            [['agent_percent', 'system_percent'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupons_id' => 'Coupons ID',
            'coupons_name' => 'Coupons Name',
            'agent_id' => 'Agent ID',
            'condition' => 'Condition',
            'discount' => 'Discount',
            'agent_percent' => 'Agent Percent',
            'system_percent' => 'System Percent',
            'start_time' => 'Start Time',
            'over_time' => 'Over Time',
        ];
    }
}
