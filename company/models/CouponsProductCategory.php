<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_coupons_product_category".
 *
 * @property integer $coupons_id
 * @property integer $category_id
 */
class CouponsProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_coupons_product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupons_id', 'category_id'], 'required'],
            [['coupons_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupons_id' => 'Coupons ID',
            'category_id' => 'Category ID',
        ];
    }
}
