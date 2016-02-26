<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_setting".
 *
 * @property integer $setting_id
 * @property integer $store_id
 * @property string $code
 * @property string $key
 * @property string $value
 * @property integer $serialized
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'serialized'], 'integer'],
            [['code', 'key', 'value', 'serialized'], 'required'],
            [['value'], 'string'],
            [['code'], 'string', 'max' => 32],
            [['key'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => 'Setting ID',
            'store_id' => 'Store ID',
            'code' => 'Code',
            'key' => 'Key',
            'value' => 'Value',
            'serialized' => 'Serialized',
        ];
    }


    public function getKeyVal($key)
    {
        $result = Setting::find()->andWhere(['key' => $key])->asArray()->one();

        return $result['value'];
    }


    public function getFlat()
    {

        $method_data = array(
            'code'          => 'flat',
            'codes'         => 'flat.flat',
            'title'         => '普通快递',
            'cost'          => round(self::getKeyVal('flat_cost'), 2),
            'tax_class_id'  => 0,
            'text'          => self::getKeyVal('flat_cost'),
            'sort_order'    => self::getKeyVal('flat_sort_order'),
            'error'         => false
        );

        return $method_data;

    }

    public function getFree()
    {
        $method_data = array(
            'code'         => 'free',
            'codes'        => 'free.free',
            'title'        => '免费配送',
            'cost'         => round(0.00, 2),
            'tax_class_id' => 0,
            'text'         => '0.00',
            'sort_order'   => self::getKeyVal('free_sort_order'),
            'error'        => false
        );


        return $method_data;
    }


    public function getItem()
    {
        $method_data = array(
            'code'       => 'item',
            'codes'      => 'item.item',
            'title'      => '按件计算',
            'cost'         => round(self::getKeyVal('item_cost'), 2),
            'tax_class_id' => self::getKeyVal('item_tax_class_id'),
            'text'         => self::getKeyVal('flat_cost'),
            'sort_order' => self::getKeyVal('item_sort_order'),
            'error'      => false
        );


        return $method_data;
    }

    public function getPickup()
    {

        $method_data = array(
            'code'       => 'pickup',
            'codes'      => 'pickup.pickup',
            'title'      => '到商店自提',
            'cost'         => round(0.00, 2),
            'tax_class_id' => 0,
            'text'         => '0.00',
            'sort_order' => self::getKeyVal('pickup_sort_order'),
            'error'      => false
        );

        return $method_data;
    }



    public function getTonglianpay()
    {
        $method_data = array(
            'code'       => 'tonglianpay',
            'title'      => '通联支付',
            'terms'      => '',
            'sort_order' => self::getKeyVal('tonglianpay_sort_order')
        );

        return $method_data;
    }


    public function getUpop()
    {

        $method_data = array(
            'code'       => 'upop',
            'title'      => '银联支付',
            'terms'      => '',
            'sort_order' => self::getKeyVal('upop_sort_order')

        );

        return $method_data;
    }

    public function getChinapay()
    {
        $method_data = array(
            'code'       => 'chinapay',
            'title'      => '银联电子支付',
            'terms'      => '',
            'sort_order' => self::getKeyVal('chinapay_sort_order')
        );

        return $method_data;
    }

    public function getCod()
    {

        $method_data = array(
            'code'       => 'cod',
            'title'      => '货到付款',
            'terms'      => '',
            'sort_order' => self::getKeyVal('cod_sort_order')
        );

        return $method_data;
    }

    public function getAlipay_direct()
    {

        $method_data = array(
            'code'       => 'alipay_direct',
            'title'      => '支付宝',
            'terms'      => '',
            'sort_order' => self::getKeyVal('alipay_direct_sort_order')
        );

        return $method_data;
    }



    public function getQrcodeweipay()
    {
        $method_data = array(
            'code'       => 'qrcodeweipay',
            'title'      => '微信支付',
            'terms'      => '',
            'sort_order' => self::getKeyVal('qrcodeweipay_sort_order')
        );

        return $method_data;
    }




}
