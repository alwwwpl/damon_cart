<?php

namespace app\controllers;

use app\models\ProductDistribute;
use Yii;
use app\models\Order;
use app\models\Address;
use app\models\Product;
use app\models\Setting;
use app\models\Extension;
use app\models\OrderProduct;
use app\commands\WechatController;

class CartController extends WechatController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        Yii::$app->session->open();
        /*
        $productData = Product::find()->select(['( SELECT distribute_price FROM oc_product_distribute WHERE product_distribute_id = 23) as distribute_price', 'oc_product.*'])
            ->joinWith('supplier',['product_id' => 'supplier.product_id'])
            ->andWhere(['oc_product.product_id' => 67, 'oc_product_supplier.supplier_id' => 24, 'oc_product.status' => 1])
            ->andWhere('oc_product.quantity > 0')
            ->one();

        echo $productData->price;
        */

        $productDatas = array();

        /*
        if (!empty(Yii::$app->session['cart']))
        {
            foreach (Yii::$app->session['cart'] as $key => $quantity)
            {
                $product = unserialize(base64_decode($key));

                $productDatas[$product['product_id']] = Product::getProduct($product['product_id'], isset($product['supplier_id']) ? $product['supplier_id'] : 0, '', isset($product['distribute_id']) ? $product['distribute_id'] : 0, isset($product['bidding_id']) ? $product['bidding_id'] : 0);
            }
        }
        */
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart']))
        {
            $productDatas = $this->getProducts();
        }

        return $this->render('index',[
            'productDatas' => $productDatas
        ]);
    }


    public function actionCheckOut()
    {
        if (!empty(Yii::$app->user->identity->customer_id))
        {
            $checkOutDatas = array();

            $shippingDatas = array();

            $paymentDatas = array();

            $addressData = array();

            if (isset(Yii::$app->session['cart-key']) && !empty(Yii::$app->session['cart-key']) && !empty(Yii::$app->session['cart']))
            {

                $productDatas = $this->getProducts();

                $keys = explode('@',substr(Yii::$app->session['cart-key'],0,-1));

                foreach ($productDatas as $key => $product)
                {
                    if (in_array($key, $keys))
                    {
                        $checkOutData[$key] = $productDatas[$key];
                    }
                }

                foreach ($checkOutData as $checkOut)
                {
                    $distribute = 0;

                    if ($checkOut['distribute_id'] > 0)
                    {
                        $distribute = ProductDistribute::find()->andWhere(['product_distribute_id' => $checkOut['distribute_id']])->one();

                        if ($distribute)
                        {
                            $distribute = $distribute->customer_id;
                        }
                    }

                    $checkOutDatas[$distribute][$checkOut['agent_id']][] = $checkOut;
                }

                //取用户地址
                $addressData = Address::find()->andWhere(['customer_id' => Yii::$app->user->identity->customer_id])->asArray()->all();

                //取配送方式
                $extensionDatas = Extension::find()->andWhere(['type' => 'shipping'])->asArray()->all();

                if (!empty($extensionDatas))
                {
                    foreach ($extensionDatas as $extension)
                    {
                        $settingDatas = Setting::find()->andWhere(['code' => $extension['code'], 'key' => $extension['code'].'_status', 'value' => 1])->asArray()->all();

                        foreach ($settingDatas as $setting)
                        {
                            $str = 'get'.ucfirst($setting['code']);

                            $shippingDatas[] = Setting::$str();
                        }
                    }
                }

                //取支付方式
                $extensionDatas = Extension::find()->andWhere(['type' => 'payment'])->asArray()->all();

                if (!empty($extensionDatas))
                {
                    foreach ($extensionDatas as $extension)
                    {
                        $settingDatas = Setting::find()->andWhere(['code' => $extension['code'], 'key' => $extension['code'].'_status', 'value' => 1])->asArray()->all();

                        foreach ($settingDatas as $setting)
                        {
                            $str = 'get'.ucfirst($setting['code']);

                            $paymentDatas[] = Setting::$str();
                        }

                    }
                }

            }


            return $this->render('checkout',[
                'checkOutDatas' => $checkOutDatas,
                'addressData'   => $addressData,
                'paymentDatas'  => $paymentDatas,
                'shippingDatas' => $shippingDatas
            ]);
        }
        else
        {
            Yii::$app->session->setFlash('error','请先登录！');

            return $this->redirect('/account/login&url=checkout');
        }

    }




    public function actionAddCart()
    {
        if (Yii::$app->request->post())
        {
            $product_id = Yii::$app->request->post('product_id');

            $qty = Yii::$app->request->post('qty');

            $supplier_id = Yii::$app->request->post('supplier_id');

            $distribute_id = Yii::$app->request->post('distribute_id');

            $bidding_id = Yii::$app->request->post('bidding_id');

            $recurring_id = Yii::$app->request->post('recurring_id');

            $this->add($product_id, $qty, $option = array(), $recurring_id, $supplier_id, $distribute_id, $bidding_id);

            $data['status'] = 'success';

        }
        else
        {
            $data['status'] = 'error';
        }

        echo json_encode($data);
    }

    public function actionSetKey()
    {
        if (Yii::$app->request->post('key'))
        {
            Yii::$app->session['cart-key'] = Yii::$app->request->post('key');

            echo 'success';
        }
    }


    public function actionAjaxConfirm()
    {
        Yii::$app->session->open();

        $result_status = true;

        $_SESSION['OrderId'] = '';

        if (Yii::$app->request->post())
        {
            if (!empty($_SESSION['cart-checkout']) && $_SESSION['address_id'])
            {

                $addressData = Address::find()->andWhere(['address_id' => $_SESSION['address_id']])->one();

                $orderDatas = array();

                $paymentDatas = array();

                $customerDatas = array();

                $systemDatas = array();

                $shippingDatas = array();

                $orderTotals = array();

                $customerDatas['date_added'] = date('Y-m-d H:i:s');
                $customerDatas['date_modified'] = date('Y-m-d H:i:s');
                $customerDatas['comment'] = '0';
                $customerDatas['order_number'] = 0;

                $customerDatas['invoice_no'] = 0;
                $customerDatas['invoice_prefix'] = 'INV-2013-00';
                $customerDatas['store_id'] = 0;
                $customerDatas['store_name'] = '达蒙商城';
                $customerDatas['store_url'] = 'http://wap.iddmall.com';

                $customerDatas['customer_id'] = Yii::$app->user->identity->customer_id;
                $customerDatas['customer_group_id'] = Yii::$app->user->identity->customer_group_id;
                $customerDatas['firstname'] = Yii::$app->user->identity->firstname;
                $customerDatas['lastname'] = Yii::$app->user->identity->lastname;
                $customerDatas['email'] = Yii::$app->user->identity->email;
                $customerDatas['telephone'] = Yii::$app->user->identity->telephone;
                $customerDatas['fax'] = empty(Yii::$app->user->identity->fax) ? '0' : Yii::$app->user->identity->fax;
                $customerDatas['custom_field'] = '0';

                $paymentDatas['payment_firstname'] = $addressData->firstname;
                $paymentDatas['payment_lastname'] = $addressData->lastname;
                $paymentDatas['payment_company'] = $addressData->company;
                $paymentDatas['payment_address_1'] = $addressData->address_1;
                $paymentDatas['payment_address_2'] = $addressData->address_2;
                $paymentDatas['payment_city'] = $addressData->city;
                $paymentDatas['payment_postcode'] = $addressData->postcode;
                $paymentDatas['payment_zone'] = $addressData->province;
                $paymentDatas['payment_zone_id'] = $addressData->province_id;
                $paymentDatas['payment_country'] = '中国';
                $paymentDatas['payment_country_id'] = $addressData->country_id;
                $paymentDatas['payment_address_format'] = '0';
                $paymentDatas['payment_custom_field'] = 'b:0;';
                $paymentDatas['payment_method'] = explode('_', $_SESSION['cart-payment'])[1];
                //支付
                $paymentDatas['payment_code'] = explode('_', $_SESSION['cart-payment'])[0];

                //配送
                $shippingDatas['shipping_firstname'] = $addressData->firstname;
                $shippingDatas['shipping_lastname'] = $addressData->lastname;
                $shippingDatas['shipping_company'] = $addressData->company;
                $shippingDatas['shipping_address_1'] = $addressData->address_1;
                $shippingDatas['shipping_address_2'] = $addressData->address_2;
                $shippingDatas['shipping_city'] = $addressData->city;
                $shippingDatas['shipping_postcode'] = $addressData->postcode;
                $shippingDatas['shipping_zone'] = $addressData->province;
                $shippingDatas['shipping_zone_id'] = $addressData->province_id;
                $shippingDatas['shipping_country'] = '中国';
                $shippingDatas['shipping_country_id'] = $addressData->country_id;
                $shippingDatas['shipping_address_format'] = '0';
                $shippingDatas['shipping_custom_field'] = 'b:0;';


                //系统
                $systemDatas['affiliate_id'] = 0;
                $systemDatas['commission'] = 0;
                $systemDatas['marketing_id'] = 0;
                $systemDatas['tracking'] = '0';
                $systemDatas['language_id'] = 2;
                $systemDatas['currency_id'] = 4;
                $systemDatas['currency_code'] = 'CNY';
                $systemDatas['currency_value'] = '1.00000000';
                $systemDatas['ip'] = Yii::$app->request->userIP;
                $systemDatas['forwarded_ip'] = '0';
                $systemDatas['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $systemDatas['accept_language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

                foreach ($_SESSION['cart-checkout'] as $key => $checkOutDatas)
                {
                    $customerDatas['distribute_id'] = $key;

                    if (is_array($checkOutDatas))
                    {
                        foreach ($checkOutDatas as $k => $productDatas)
                        {
                            $code = explode('_', $_SESSION['cart-shipping'][$key.'_'.$k])[0];

                            switch($code)
                            {
                                case 'flat':
                                    $shippingDatas['shipping_method'] = '普通快递';
                                    break;
                                case 'item':
                                    $shippingDatas['shipping_method'] = '按件计算';
                                    break;
                                case 'free':
                                    $shippingDatas['shipping_method'] = '免费配送';
                                    break;
                                case 'pickup':
                                    $shippingDatas['shipping_method'] = '到商店自提';
                                    break;
                                default :
                                    $shippingDatas['shipping_method'] = '';
                                    break;
                            }
                            $shippingDatas['shipping_code'] = $code.'.'.$code;

                            $total = 0;

                            foreach ($productDatas as $product)
                            {
                                $total += $product['total'];
//                            var_dump($product);
//                            echo '<br><br>';
                            }

                            $results = Extension::find()->andWhere(['type' => 'total'])->asArray()->all();

                            foreach ($results as $kk => $value)
                            {
                                $sort_order[$kk] = Setting::getKeyVal($value['code'] . '_sort_order');
                            }

                            array_multisort($sort_order, SORT_ASC, $results);

                            foreach ($results as $result)
                            {
                                $status = Setting::getKeyVal($result['code'] . '_status');

                                if ($status)
                                {
                                    $str = 'get'.ucfirst($result['code']);

                                    if ($result['code'] == 'shipping')
                                    {
                                        Order::$str($orderTotals, $total, $code);
                                    }
                                    else
                                    {
                                        Order::$str($orderTotals, $total);
                                    }

                                }
                            }

                            $result = Order::addOrder($productDatas, $paymentDatas, $customerDatas, $systemDatas, $shippingDatas, $total, $orderTotals);

                            if (!$result)
                            {
                                $result_status = false;
                            }


                            $orderTotals = '';
                        }
                    }
                }
            }
            else
            {
                $result_status = false;
            }
        }
        else
        {
            $result_status = false;
        }

        if ($result_status)
        {
            $url = '';

            $_SESSION['total'] = round($_SESSION['total'],2)*100;

            $_SESSION['OrderId'] = 'DMG_'.$_SESSION['OrderId'].'GMD';

            $_SESSION['ProductName'] = $_SESSION['ProductName'];

            /*
             *$OrderId 订单ID
             * $_SESSION['total'] 订单金额
             */

            $paymentCode = explode('_', $_SESSION['cart-payment'])[0];
            //微信支付
            if ($paymentCode == 'qrcodeweipay')
            {
                $url =  'http://company.iddmall.com/cart/wx-pay';

//                $url =  'http://wap.iddmall.com/cart/wx-pay?total='.$total.'&OrderId='.$OrderId.'&ProductName='.$ProductName;

//                header("Location:http://wap.iddmall.com/cart/wx-pay");
//                exit;

            }
            //银联支付
            elseif ($paymentCode == 'upop')
            {
                $url =  'http://company.iddmall.com/cart/success';
            }
            //银联在线支付
            elseif ($paymentCode == 'chinapay')
            {
                $url =  '/cart/china-pay';
            }
            //货到付款
            elseif ($paymentCode == 'cod')
            {
                $url =  'http://company.iddmall.com/cart/create-success';
            }
            //通联支付
            elseif ($paymentCode == 'tonglianpay')
            {
                $url =  'http://wap.iddmall.com/cart/tl-pay';
            }
            //支付宝
            elseif ($paymentCode == 'alipay_direct')
            {
                $url =  'http://compny.iddmall.com/cart/success';
            }

            $keys = explode('@',substr($_SESSION['cart-key'],0,-1));

            if (is_array($keys) && is_array($_SESSION['cart']))
            {
                foreach ($keys as $key => $v)
                {
                    unset($_SESSION['cart'][$v]);
                }
            }



            echo json_encode(array('status' => 'success', 'url' => $url));
        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }



    }

    public function actionCreateSuccess()
    {
        return $this->render('create_success');
    }


    public function actionSuccess()
    {

        return $this->render('success');
    }


    /*
     * 微信支付------------------
     */
    public function actionWxPay($code = null)
    {
        /*
         * $OrderId = 'DMG_180_1538193829'
         */

        return $this->renderPartial('wxpay');

    }

    public function actionWxNotifyUrl()
    {
        return $this->renderPartial('wxnotifyurl');
    }

    /*
     * 银联电子支付
     */
    public function actionChinaPay()
    {
        return $this->render('chinapay');
    }

    public function actionChinaPaySign()
    {
        return $this->render('chinapaysign');
    }

    public function actionChinaPaySend()
    {
        return $this->render('chinapaysend');
    }

    public function actionChinaPayPgReturn()
    {
        return $this->render('chinapaypgreturn');
    }

    public function actionChinaPayBgReturn()
    {
        return $this->render('chinapaybgreturn');
    }

    /*
     * 通联支付------------------
     */
    public function actionTlPay()
    {
        return $this->render('tlpay');
    }

    public function actionTlReceive()
    {
        return $this->renderPartial('tlreceive');
    }




    public function actionUpdateCart()
    {
        if (Yii::$app->request->post())
        {
            $key = Yii::$app->request->post('key');

            $qty = Yii::$app->request->post('num');

            $this->update($key, $qty);
        }
    }



    /*
     * 设置session
     */
    public function actionAjaxSession()
    {
        Yii::$app->session->open();

        if (Yii::$app->request->post())
        {
            $key = Yii::$app->request->post('key');

            $val = Yii::$app->request->post('val');

            $keys = Yii::$app->request->post('keys');

            //
            if (!empty($keys))
            {
                $_SESSION['total'] = $_SESSION['total'] - explode('_', $_SESSION[$key][$keys])[1];

                $_SESSION[$key][$keys] = $val;

                $_SESSION['total'] += explode('_', $val)[1];

                echo $_SESSION['total'];
            }
            else
            {
                $_SESSION[$key] = $val;

                echo $_SESSION[$key];
            }


        }
    }


    /*
     * 批量删除
     */
    public function actionDelBatchCart()
    {
        if (Yii::$app->request->post())
        {
            $keys = Yii::$app->request->post('cart');

            $keyData = explode(',', $keys);

            if (is_array($keyData))
            {
                foreach ($keyData as $val)
                {
                    $this->remove($val);
                }

                echo json_encode(array('status' => 'success', 'keys' => $keys));
            }
            else
            {
                echo json_encode(array('status' => 'error'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }
    }


}
