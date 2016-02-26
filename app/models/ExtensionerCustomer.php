<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_extensioner_customer".
 *
 * @property integer $extensioner_customer_id
 * @property integer $extensioner_id
 * @property integer $customer_id
 * @property string $percent
 * @property string $create_time
 */
class ExtensionerCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_extensioner_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extensioner_id', 'customer_id'], 'required'],
            [['extensioner_id', 'customer_id'], 'integer'],
            [['create_time'], 'safe'],
            [['percent'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'extensioner_customer_id' => 'Extensioner Customer ID',
            'extensioner_id' => 'Extensioner ID',
            'customer_id' => 'Customer ID',
            'percent' => 'Percent',
            'create_time' => 'Create Time',
        ];
    }



    public function CustomerNum($extension_id)
    {
        $extensionerData = ExtensionerCustomer::findOne($extension_id);

        return Customer::find()->where(['parent_id' => $extensionerData->customer_id])->count();
    }


}
