<?php

namespace app\models;

use Yii;

/**
 * 订单
 *
 * @property integer $order_id
 * @property integer $order_number
 * @property integer $invoice_no
 * @property string $invoice_prefix
 * @property integer $store_id
 * @property string $store_name
 * @property string $store_url
 * @property integer $customer_id
 * @property integer $customer_group_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $custom_field
 * @property string $payment_firstname
 * @property string $payment_lastname
 * @property string $payment_company
 * @property string $payment_address_1
 * @property string $payment_address_2
 * @property string $payment_city
 * @property string $payment_postcode
 * @property string $payment_country
 * @property integer $payment_country_id
 * @property string $payment_zone
 * @property integer $payment_zone_id
 * @property string $payment_address_format
 * @property string $payment_custom_field
 * @property string $payment_method
 * @property string $payment_code
 * @property string $shipping_firstname
 * @property string $shipping_lastname
 * @property string $shipping_company
 * @property string $shipping_address_1
 * @property string $shipping_address_2
 * @property string $shipping_city
 * @property string $shipping_postcode
 * @property string $shipping_country
 * @property integer $shipping_country_id
 * @property string $shipping_zone
 * @property integer $shipping_zone_id
 * @property string $shipping_address_format
 * @property string $shipping_custom_field
 * @property string $shipping_method
 * @property string $shipping_code
 * @property string $comment
 * @property string $total
 * @property integer $order_status_id
 * @property integer $affiliate_id
 * @property string $commission
 * @property integer $marketing_id
 * @property string $tracking
 * @property integer $language_id
 * @property integer $currency_id
 * @property string $currency_code
 * @property string $currency_value
 * @property string $ip
 * @property string $forwarded_ip
 * @property string $user_agent
 * @property string $accept_language
 * @property string $date_added
 * @property string $date_modified
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'invoice_prefix', 'store_name', 'store_url', 'firstname', 'lastname', 'email', 'telephone', 'fax', 'custom_field', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_postcode', 'payment_country', 'payment_country_id', 'payment_zone', 'payment_zone_id', 'payment_address_format', 'payment_custom_field', 'payment_method', 'payment_code', 'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_country', 'shipping_country_id', 'shipping_zone', 'shipping_zone_id', 'shipping_address_format', 'shipping_custom_field', 'shipping_method', 'shipping_code', 'comment', 'affiliate_id', 'commission', 'marketing_id', 'tracking', 'language_id', 'currency_id', 'currency_code', 'ip', 'forwarded_ip', 'user_agent', 'accept_language', 'date_added', 'date_modified'], 'required'],
            [['order_number', 'invoice_no', 'store_id', 'customer_id', 'customer_group_id', 'payment_country_id', 'payment_zone_id', 'shipping_country_id', 'shipping_zone_id', 'order_status_id', 'affiliate_id', 'marketing_id', 'language_id', 'currency_id'], 'integer'],
            [['custom_field', 'payment_address_format', 'payment_custom_field', 'shipping_address_format', 'shipping_custom_field', 'comment'], 'string'],
            [['total', 'commission', 'currency_value'], 'number'],
            [['date_added', 'date_modified'], 'safe'],
            [['invoice_prefix'], 'string', 'max' => 26],
            [['store_name', 'tracking'], 'string', 'max' => 64],
            [['store_url', 'user_agent', 'accept_language'], 'string', 'max' => 255],
            [['firstname', 'lastname', 'telephone', 'fax', 'payment_firstname', 'payment_lastname', 'shipping_firstname', 'shipping_lastname'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 96],
            [['payment_company', 'shipping_company', 'ip', 'forwarded_ip'], 'string', 'max' => 40],
            [['payment_address_1', 'payment_address_2', 'payment_city', 'payment_country', 'payment_zone', 'payment_method', 'payment_code', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_country', 'shipping_zone', 'shipping_method', 'shipping_code'], 'string', 'max' => 128],
            [['payment_postcode', 'shipping_postcode'], 'string', 'max' => 10],
            [['currency_code'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'order_number' => '订单号',
            'invoice_no' => 'Invoice No',
            'invoice_prefix' => 'Invoice Prefix',
            'store_id' => 'Store ID',
            'store_name' => 'Store Name',
            'store_url' => 'Store Url',
            'customer_id' => 'Customer ID',
            'customer_group_id' => 'Customer Group ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'custom_field' => 'Custom Field',
            'payment_firstname' => 'Payment Firstname',
            'payment_lastname' => 'Payment Lastname',
            'payment_company' => 'Payment Company',
            'payment_address_1' => 'Payment Address 1',
            'payment_address_2' => 'Payment Address 2',
            'payment_city' => 'Payment City',
            'payment_postcode' => 'Payment Postcode',
            'payment_country' => 'Payment Country',
            'payment_country_id' => 'Payment Country ID',
            'payment_zone' => 'Payment Zone',
            'payment_zone_id' => 'Payment Zone ID',
            'payment_address_format' => 'Payment Address Format',
            'payment_custom_field' => 'Payment Custom Field',
            'payment_method' => '支付方法',
            'payment_code' => 'Payment Code',
            'shipping_firstname' => 'Shipping Firstname',
            'shipping_lastname' => 'Shipping Lastname',
            'shipping_company' => 'Shipping Company',
            'shipping_address_1' => 'Shipping Address 1',
            'shipping_address_2' => 'Shipping Address 2',
            'shipping_city' => '发货城市',
            'shipping_postcode' => 'Shipping Postcode',
            'shipping_country' => 'Shipping Country',
            'shipping_country_id' => 'Shipping Country ID',
            'shipping_zone' => 'Shipping Zone',
            'shipping_zone_id' => 'Shipping Zone ID',
            'shipping_address_format' => 'Shipping Address Format',
            'shipping_custom_field' => 'Shipping Custom Field',
            'shipping_method' => 'Shipping Method',
            'shipping_code' => 'Shipping Code',
            'comment' => 'Comment',
            'total' => '总价',
            'order_status_id' => 'Order Status ID',
            'affiliate_id' => 'Affiliate ID',
            'commission' => 'Commission',
            'marketing_id' => 'Marketing ID',
            'tracking' => 'Tracking',
            'language_id' => 'Language ID',
            'currency_id' => 'Currency ID',
            'currency_code' => 'Currency Code',
            'currency_value' => 'Currency Value',
            'ip' => 'Ip',
            'forwarded_ip' => 'Forwarded Ip',
            'user_agent' => 'User Agent',
            'accept_language' => 'Accept Language',
            'date_added' => '下单时间',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\OrderQuery(get_called_class());
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'order_id']);
    }


    //优惠券
    public function getCoupons(&$totalDatas, &$total)
    {
        $model = Coupons::find()->andWhere(['coupons_id' => explode(',', Yii::$app->session['coupons'])[0]])->one();

        $totalDatas[] = array(
            'code'       => 'coupons',
            'codestr'    => explode(',', Yii::$app->session['coupons'])[1],
            'title'      => $model->coupons_name,
            'value'      => -$model->discount,
            'sort_order' => 4
        );

        $total -= $model->discount;

    }


    //抵用金
    public function getCredit(&$totalDatas, &$total)
    {

        $balance = Customer::getBalance();

        if ((float)$balance)
        {
            if ($balance > $total)
            {
                $credit = $total;
            }
            else
            {
                $credit = $balance;
            }

            if ($credit > 0)
            {
                $totalDatas[] = array(
                    'code'       => 'credit',
                    'title'      => '购物抵用金',
                    'value'      => -$credit,
                    'sort_order' => 7
                );

                $total -= $credit;
            }
        }
    }


    //运费
    public function getShipping(&$totalDatas, &$total, $code)
    {
        $shipping = Setting::getKeyVal($code.'_cost');

        switch($code)
        {
            case 'flat':
                $title = '普通快递';
                break;
            case 'item':
                $title = '按件计算';
                break;
            case 'free':
                $title = '免费配送';
                break;
            case 'pickup':
                $title = '到商店自提';
                break;
            default :
                $title = '系统默认';
                break;
        }

        $totalDatas[] = array(
            'code'       => 'shipping',
            'title'      => $title,
            'value'      => $shipping,
            'sort_order' => 2
        );

        $total += $shipping;
    }


    //商品总额
    public function getSub_total(&$totalDatas, &$total)
    {

        $totalDatas[] = array(
            'code'       => 'sub_total',
            'title'      => '商品总额',
            'value'      => $total,
            'sort_order' => 1
        );

        $total = $total;
    }

    //订单总额
    public function getTotal(&$totalDatas, &$total)
    {
        $totalDatas[] = array(
            'code'       => 'total',
            'title'      => '订单总额',
            'value'      => max(0, $total),
            'sort_order' => 9
        );
    }

    public function getReward(&$totalDatas, &$total)
    {

    }

    public function getCoupon(&$totalDatas, &$total)
    {

    }

    public function getTax(&$totalDatas, &$total)
    {

    }

    public function getVoucher(&$totalDatas, &$total)
    {

    }

    public function getDiscount(&$totalDatas, &$total)
    {

    }



    public function addOrder($productDatas, $paymentDatas, $customerDatas, $systemDatas, $shippingDatas, $total, $orderTotals)
    {
        Yii::$app->session->open();

        $status = true;

        if(is_array($productDatas))
        {

            $model = new Order();

            foreach ($paymentDatas as $key => $payment)
            {
                $model->$key = $payment;
            }

            foreach ($customerDatas as $key => $customer)
            {
                $model->$key = $customer;
            }

            foreach ($systemDatas as $key => $system)
            {
                $model->$key = $system;
            }

            foreach ($shippingDatas as $key => $shipping)
            {
                $model->$key = $shipping;
            }

            $model->total = $total;

            if($model->save())
            {
                $orderId = Yii::$app->db->getLastInsertID();

                $_SESSION['OrderId'] .= $orderId.'_';

                foreach ($productDatas as $key => $value)
                {
                    $modelProduct = new OrderProduct();

                    $_SESSION['ProductName'] = $value['model'];

                    $modelProduct->product_id = $value['product_id'];
                    $modelProduct->model = $value['model'];
                    $modelProduct->name = $value['name'];
                    $modelProduct->distribute_id = $value['distribute_id'];
                    $modelProduct->customer_id = 0;
                    $modelProduct->supplier_id = $value['supplier_id'];
                    $modelProduct->order_id = $orderId;
                    $modelProduct->quantity = $value['quantity'];
                    $modelProduct->price = $value['price'];
                    $modelProduct->tax = '0.00';
                    $modelProduct->status = '0';
                    $modelProduct->reward = '0';
                    $modelProduct->express = '0';

                    if ($modelProduct->save())
                    {

                    }
                    else
                    {
                        $status = false;
                    }

                }

                foreach ($orderTotals as $val)
                {
                    $modelTotals = new OrderTotal();
                    if ($val['value'])
                    {
                        $modelTotals->order_id = $orderId;

                        $modelTotals->code = $val['code'];

                        $modelTotals->title = $val['title'];

                        $modelTotals->value = $val['value'];

                        $modelTotals->sort_order = $val['sort_order'];

                        if ($modelTotals->save())
                        {

                        }
                        else
                        {
                            $status = false;
                        }

                    }

                }

            }
            else
            {
                $status = false;
            }
        }

        return $status;
    }






}
