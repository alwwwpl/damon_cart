<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_extensioner_accounting".
 *
 * @property integer $extensioner_accounting_id
 * @property integer $extensioner_id
 * @property integer $type
 * @property integer $price
 * @property string $each
 * @property string $createtime
 */
class ExtensionerAccounting extends \yii\db\ActiveRecord
{

    //黄金
    const TYPE_GOLD = 1;

    //钻石
    const TYPE_DIAMONDS = 2;


    public static $types = [
        self::TYPE_GOLD => '黄金',
        self::TYPE_DIAMONDS => '钻石'
    ];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_extensioner_accounting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extensioner_id'], 'required'],
            [['extensioner_id', 'type', 'price'], 'integer'],
            [['createtime'], 'safe'],
            [['each'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'extensioner_accounting_id' => 'Extensioner Accounting ID',
            'extensioner_id' => 'Extensioner ID',
            'type' => 'Type',
            'price' => 'Price',
            'each' => 'Each',
            'createtime' => 'Createtime',
        ];
    }


}
