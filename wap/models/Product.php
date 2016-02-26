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
    public $supplier_price;
    public $supplier_vip_price;
    public $agent_id;
    public $name;

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

    public function getSupplier()
    {
        return $this->hasOne(ProductSupplier::className(), ['product_id' => 'product_id']);
    }

    public function getDescription()
    {
        return $this->hasOne(ProductDescription::className(), ['product_id' => 'product_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ProductToCategory::className(), ['product_id' => 'product_id']);
    }

    public function updateViewed($product_id)
    {

        $model = Product::find($product_id);

        $model->viewed = $model->viewed + 1;

        $model->save();
    }

    public function getProductCategory($product_id)
    {
        $categoryData = array();

        $category = ProductToCategory::find()->andWhere(['product_id' => $product_id])->asArray()->all();

        foreach ($category as $val)
        {
            $categoryData[] = $val['category_id'];
        }
        if (in_array("120", $categoryData) || in_array("127", $categoryData) || in_array("137", $categoryData) || in_array("132", $categoryData))
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    public function getProducts($data = array())
    {
        $connection = \Yii::$app->db;

        $product_data = array();

        $model = Product::find();

        if (isset($data['city']))
        {
            if (!empty($data['city']))
            {
                $citys = mb_substr($data['city'],0,-1,'utf-8');

                $command = $connection->createCommand("SELECT area_name FROM `oc_area` WHERE area_id = (SELECT parent_id FROM `oc_area` WHERE area_name = '" . $citys . "' AND level = 2) AND level = 1");

                $area = $command->queryScalar();
            }
            else
            {
                $citys = '全国';

                $area = '全国';
            }
        }

        $model->select(['oc_product.product_id', 'oc_product_supplier.supplier_id', 'oc_product_supplier.price', '(SELECT SUM(oc_order_product.quantity) FROM oc_order_product WHERE oc_order_product.product_id = oc_product.product_id) as num'])
            ->joinWith('supplier',['product_id' => 'supplier.product_id']);

        if (isset($data['category']))
        {
            $model->joinWith('category',['product_id' => 'category.product_id'])
                ->andWhere(['oc_product_to_category.category_id' => $data['category']]);
        }

        $model->andWhere(['oc_product.status' => 1])
            ->andWhere(["or", "oc_product_supplier.agent_area = '". $area ."'", "oc_product_supplier.agent_area = '". $citys ."'", "oc_product_supplier.agent_area = '全国'"]);

        if (isset($data['search']))
        {
            $model->joinWith('description')
                ->andWhere(['like', 'oc_product_description.name', $data['search']]);
        }


        if (isset($data['order']))
        {
            if ($data['order'] == 'sale')
            {
                $model->orderBy('num '.$data['sort']);
            }
            elseif ($data['order'] == 'price')
            {
                $model->orderBy('oc_product_supplier.price '.$data['sort']);
            }

        }

        $productData = $model->asArray()->all();

        foreach ($productData as $result)
        {
            if (isset(Yii::$app->user->identity->parent_id))
            {
                $parent_id = Yii::$app->user->identity->parent_id;
            }
            else
            {
                $parent_id = 0;
            }
            if (isset($result['supplier_id']) && !empty($result['supplier_id'])){
                $product_data[$result['product_id'].'_'.$result['supplier_id']] = self::getProduct($result['product_id'],$result['supplier_id'],'',$parent_id,'');
            }
            else{
                $product_data[$result['product_id']] = self::getProduct($result['product_id'],'','',$parent_id,'');
            }
        }

        return $product_data;

    }

    public function getProduct($product_id, $supplier_id = null, $city = null, $distribute_id = null, $bidding_id = null)
    {
        $area_sql = '';
        $area_where = '';
        $supplier = '';
        $distribute_sql = '';

        $connection = \Yii::$app->db;

        if ($supplier_id){
            $area_sql = " LEFT JOIN `oc_product_supplier` ps ON p.product_id = ps.product_id ";
            $area_where = " AND ps.supplier_id = '" . $supplier_id . "' ";
            $supplier = " ps.cost_price as supplier_cost_price, ps.agent_id as agent_id, ps.price as supplier_price, ps.vip_price as supplier_vip_price, ps.supplier_id,";
        }else {

            if ($distribute_id)
            {
                $distribute_sql = "(SELECT distribute_price FROM `oc_product_distribute` pd WHERE pd.product_distribute_id = '" . $distribute_id . "') as distribute_price,";
            }
            elseif (!empty($city))
            {
                $citys = mb_substr($city,0,-1,'utf-8');

                $area_sql = "SELECT area_name FROM `oc_area` WHERE area_id = (SELECT parent_id FROM `oc_area` WHERE area_name = '" . $citys . "' AND level = 2) AND level = 1";
                $command = $connection->createCommand($area_sql);
                $area = $command->queryScalar();

                $area_sql = " LEFT JOIN `oc_product_supplier` ps ON p.product_id = ps.product_id ";
                $area_where = " AND (ps.agent_area = '" . $area . "' OR ps.agent_area = '" . $citys . "' OR ps.agent_area = '全国')";
                $supplier = " ps.cost_price as supplier_cost_price, ps.agent_id as agent_id, ps.price as supplier_price, ps.vip_price as supplier_vip_price, ps.supplier_id, ";
            }
        }

        $sql = "SELECT DISTINCT *, " . $supplier . " pd.name AS name, p.image, m.name AS manufacturer,
		    (SELECT price FROM `oc_product_discount` pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '1' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,
		    (SELECT price FROM `oc_product_special` ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '1' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special,
		    (SELECT points FROM `oc_product_reward` pr WHERE pr.product_id = p.product_id AND customer_group_id = '1') AS reward,
		    (SELECT ss.name FROM `oc_stock_status` ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '2') AS stock_status,
		    (SELECT wcd.unit FROM `oc_weight_class_description` wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '2') AS weight_class,
		    (SELECT lcd.unit FROM `oc_length_class_description` lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '2') AS length_class,
		    (SELECT AVG(rating) AS total FROM `oc_review` r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, " . $distribute_sql ."
		    (SELECT COUNT(*) AS total FROM `oc_review` r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order
		    FROM `oc_product` p LEFT JOIN `oc_product_description` pd ON (p.product_id = pd.product_id)
		    LEFT JOIN `oc_product_to_store` p2s ON (p.product_id = p2s.product_id)
		    LEFT JOIN `oc_manufacturer` m ON (p.manufacturer_id = m.manufacturer_id) " . $area_sql . "
		    WHERE p.product_id = '" . (int)$product_id . "' " . $area_where . " AND pd.language_id = '2'
		    AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '0'";

        $command = $connection->createCommand($sql);
        $query = $command->queryOne();

        if ($query) {
            if (isset($query['distribute_price'])) {
                $price = $query['distribute_price'];
            }elseif ($distribute_id > 0) {
                if (isset($query['supplier_price']))
                {
                    $price = $query['supplier_price'];
                }else{
                    $price = $query['vip_price'];
                }
            }elseif ($query['discount']) {
                $price = $query['discount'];
            }else {
                $price = $query['price'];
            }

            if (empty($supplier_id)) {
                if (isset($query['supplier_id'])) {
                    $supplier_id = $query['supplier_id'];
                }
            }

            return array(
                'product_id'       => $query['product_id'],
                'distribute_id'    => $distribute_id,
                'supplier_id'      => $supplier_id,
                'bidding_id'       => $bidding_id,
                'agent_id'         => isset($query['agent_id']) ? $query['agent_id'] : 0,
                'name'             => $query['name'],
                'description'      => $query['description'],
                'meta_title'       => $query['meta_title'],
                'meta_description' => $query['meta_description'],
                'meta_keyword'     => $query['meta_keyword'],
                'tag'              => $query['tag'],
                'model'            => $query['model'],
                'sku'              => $query['sku'],
                'upc'              => $query['upc'],
                'ean'              => $query['ean'],
                'jan'              => $query['jan'],
                'isbn'             => $query['isbn'],
                'mpn'              => $query['mpn'],
                'location'         => $query['location'],
                'quantity'         => $query['quantity'],
                'stock_status'     => $query['stock_status'],
                'image'            => $query['image'],
                'manufacturer_id'  => $query['manufacturer_id'],
                'manufacturer'     => $query['manufacturer'],
                'price'            => round($price,2),
                'special'          => $query['special'],
                'reward'           => $query['reward'],
                'points'           => $query['points'],
                'tax_class_id'     => $query['tax_class_id'],
                'date_available'   => $query['date_available'],
                'weight_range'     => $query['weight_range'],
                'weight'           => $query['weight'],
                'weight_class_id'  => $query['weight_class_id'],
                'length'           => $query['length'],
                'width'            => $query['width'],
                'height'           => $query['height'],
                'length_class_id'  => $query['length_class_id'],
                'subtract'         => $query['subtract'],
                'rating'           => round($query['rating']),
                'reviews'          => $query['reviews'] ? $query['reviews'] : 0,
                'minimum'          => $query['minimum'],
                'sort_order'       => $query['sort_order'],
                'status'           => $query['status'],
                'date_added'       => $query['date_added'],
                'date_modified'    => $query['date_modified'],
                'viewed'           => $query['viewed']
            );
        } else {
            return false;
        }
    }



}
