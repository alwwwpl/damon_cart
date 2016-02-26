<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_product".
 *
 * @property integer $product_id
 * @property string $model
 * @property string $sku
 * @property string $upc
 * @property string $ean
 * @property string $jan
 * @property string $isbn
 * @property string $mpn
 * @property string $location
 * @property integer $quantity
 * @property integer $stock_status_id
 * @property string $image
 * @property integer $manufacturer_id
 * @property integer $shipping
 * @property string $price
 * @property integer $points
 * @property integer $tax_class_id
 * @property string $date_available
 * @property string $weight
 * @property integer $weight_class_id
 * @property string $length
 * @property string $width
 * @property string $height
 * @property integer $length_class_id
 * @property integer $subtract
 * @property integer $minimum
 * @property integer $sort_order
 * @property integer $status
 * @property integer $viewed
 * @property string $date_added
 * @property string $date_modified
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'sku', 'upc', 'ean', 'jan', 'isbn', 'mpn', 'location', 'stock_status_id', 'manufacturer_id', 'tax_class_id', 'date_added', 'date_modified'], 'required'],
            [['quantity', 'stock_status_id', 'manufacturer_id', 'shipping', 'points', 'tax_class_id', 'weight_class_id', 'length_class_id', 'subtract', 'minimum', 'sort_order', 'status', 'viewed'], 'integer'],
            [['price', 'weight', 'length', 'width', 'height'], 'number'],
            [['date_available', 'date_added', 'date_modified'], 'safe'],
            [['model', 'sku', 'mpn'], 'string', 'max' => 64],
            [['upc'], 'string', 'max' => 12],
            [['ean'], 'string', 'max' => 14],
            [['jan'], 'string', 'max' => 13],
            [['isbn'], 'string', 'max' => 17],
            [['location'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'model' => 'Model',
            'sku' => 'Sku',
            'upc' => 'Upc',
            'ean' => 'Ean',
            'jan' => 'Jan',
            'isbn' => 'Isbn',
            'mpn' => 'Mpn',
            'location' => 'Location',
            'quantity' => 'Quantity',
            'stock_status_id' => 'Stock Status ID',
            'image' => 'Image',
            'manufacturer_id' => 'Manufacturer ID',
            'shipping' => 'Shipping',
            'price' => 'Price',
            'points' => 'Points',
            'tax_class_id' => 'Tax Class ID',
            'date_available' => 'Date Available',
            'weight' => 'Weight',
            'weight_class_id' => 'Weight Class ID',
            'length' => 'Length',
            'width' => 'Width',
            'height' => 'Height',
            'length_class_id' => 'Length Class ID',
            'subtract' => 'Subtract',
            'minimum' => 'Minimum',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'viewed' => 'Viewed',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ProductQuery(get_called_class());
    }

    public function getImageUrl()
    {
        return getenv('CDN_URL') . $this->image;
    }
}
