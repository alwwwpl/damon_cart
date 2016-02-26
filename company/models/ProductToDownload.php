<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_product_to_download".
 *
 * @property integer $product_id
 * @property integer $download_id
 */
class ProductToDownload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_product_to_download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'download_id'], 'required'],
            [['product_id', 'download_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'download_id' => 'Download ID',
        ];
    }
}
