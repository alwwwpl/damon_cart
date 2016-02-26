<?php

namespace app\controllers;

use Yii;
use app\models\Area;
use app\models\Order;
use app\models\Setting;
use app\models\Address;
use app\models\Product;
use app\models\BankCard;
use app\models\Customer;
use app\models\Extension;
use app\models\OrderTotal;
use app\models\Customised;
use app\models\Collection;
use app\models\Extensioner;
use app\models\OrderProduct;
use app\models\ProductToCategory;
use app\commands\WechatController;
use app\models\ExtensionerCustomer;
use app\models\CustomerTransaction;
use app\models\ExtensionerAccounting;

class AccountController extends WechatController
{
    //待付款
    const OrderStatus_WiatPay = '1';

    //处理中
    const OrderStatus_Processing = '2';

    //已发货
    const OrderStatus_Delivered = '3';

    //已完成
    const OrderStatus_Completed = '5';

    //已过期 已关闭
    const OrderStatus_Close = '14';

    //无效
    const OrderStatus_Void = '16';

    //已退款
    const OrderStatus_Refund = '11';

    public $customer_id = '';

    public $orderStatus = [
        self::OrderStatus_WiatPay => '待付款',
        self::OrderStatus_Processing => '处理中',
        self::OrderStatus_Delivered => '已发货',
        self::OrderStatus_Completed => '已完成',
        self::OrderStatus_Close => '已关闭',
        self::OrderStatus_Refund => '已退款',
        self::OrderStatus_Void => '已作废',
        0 => '待付款'
    ];

    public function __construct($id,$model=null)
    {
        if (empty(Yii::$app->user->identity->customer_id))
        {
            Yii::$app->session->setFlash('error', '您还没有登录!');
            $this->redirect('/login');
        }
        else
        {
            $this->customer_id = Yii::$app->user->identity->customer_id;
        }
        parent::__construct($id,$model);
    }

    public function actionIndex()
    {
        $customer = Yii::$app->user->identity->customer_id;

        //待支付
        $waitPayOrder = Order::find()->andWhere(['order_status_id' => Self::OrderStatus_WiatPay, 'customer_id' => $customer])->all();

        $waitPayOrderNum = count($waitPayOrder);


        //待收货
        $deliveredOrder = Order::find()->andWhere(['order_status_id' => Self::OrderStatus_Delivered, 'customer_id' => $customer])->all();

        $deliveredOrderNum = count($deliveredOrder);


        $orderData = Order::find()->andWhere(['customer_id' => $customer])->all();

        $orderDataNum = count($orderData);


        return $this->render('index',[
            'orderDataNum' => $orderDataNum,
            'waitPayOrderNum' => $waitPayOrderNum,
            'deliveredOrderNum' => $deliveredOrderNum
        ]);
    }

    /*
     * 全部订单
     */
    public function actionOrder($status = null)
    {
        $orderData = array();

        if ($status == 'wait')
        {
            $orderDatas = Order::find()->andWhere(['customer_id' => $this->customer_id, 'distribute_id' => 0, 'order_status_id' => Self::OrderStatus_WiatPay])->orderBy('date_added DESC')->asArray()->all();
        }
        elseif ($status == 'delivered')
        {
            $orderDatas = Order::find()->andWhere(['customer_id' => $this->customer_id, 'distribute_id' => 0, 'order_status_id' => Self::OrderStatus_Delivered])->orderBy('date_added DESC')->asArray()->all();
        }
        else
        {
            $orderDatas = Order::find()->andWhere(['customer_id' => $this->customer_id, 'distribute_id' => 0])->orderBy('date_added DESC')->asArray()->all();
        }

        if (!empty($orderDatas))
        {
            foreach ($orderDatas as $key => $order)
            {
                $orderData[$key]['order_id']           = $order['order_id'] + 131311921 .date('YmdHis', strtotime($order['date_added']));
                $orderData[$key]['date_added']         = $order['date_added'];
                $orderData[$key]['total']              = $order['total'];
                $orderData[$key]['payment_code']       = $order['payment_code'];
                $orderData[$key]['status']             = $this->orderStatus[$order['order_status_id']];
                $orderData[$key]['order_status_id']    = $order['order_status_id'];
                $orderData[$key]['product']            = OrderProduct::find()->select(['oc_order_product.*', 'oc_product.image as image'])
                    ->joinWith('product')
                    ->andWhere(['oc_order_product.order_id' => $order['order_id']])->asArray()->all();
            }
        }

        return $this->render('order',[
            'orderData' => $orderData
        ]);
    }


    /*
     * 订单详细
     */
    public function actionOrderDetail($order_id)
    {
        $order_id = substr($order_id,0,9) - 131311921;

        $orderData = Order::find()->andWhere(['order_id' => $order_id])->one();

        $orderProducts = OrderProduct::find()->select(['oc_order_product.*','oc_product.image'])
            ->joinWith('product')
            ->andWhere(['oc_order_product.order_id' => $order_id])
            ->asArray()->all();

        $orderTotals = OrderTotal::find()->andWhere(['order_id' => $order_id])->asArray()->all();

        return $this->render('order_detail',[
            'orderData' => $orderData,
            'orderProducts' => $orderProducts,
            'orderTotals' => $orderTotals,
            'orderStatus' => $this->orderStatus
        ]);
    }


    /*
     * 我的钱包
     */
    public function actionWallet()
    {
        $balance = CustomerTransaction::find()->select(['sum(amount) as balance'])
            ->andWhere(['customer_id' => $this->customer_id])
            ->one();

        $bankCard = BankCard::find()->andWhere(['customer_id' => $this->customer_id])->asArray()->all();

        $bankCardNum = count($bankCard);


        return $this->render('wallet',[
            'balance' => $balance,
            'bankCardNum' => $bankCardNum
        ]);
    }

    /*
     * 帐户余额
     */
    public function actionBalance()
    {

        return $this->render('balance');
    }


    /*
     * 提现
     */
    public function actionCash()
    {
        $cash = 0;

        $cashDatas = CustomerTransaction::find()
            ->andWhere(['customer_id' => $this->customer_id])
            ->asArray()->all();

        if ($cashDatas)
        {

            foreach ($cashDatas as $cashData)
            {
                $cash += $cashData['cash'];
            }
        }

        $cardDatas = BankCard::find()
            ->andWhere(['customer_id' => $this->customer_id])
            ->asArray()->all();

        return $this->render('cash',[
            'cardDatas' => $cardDatas,
            'cash' => $cash
        ]);
    }

    /*
     * 明细
     */
    public function actionBalanceDetailed()
    {

        $transactionDatas = CustomerTransaction::find()
            ->andWhere(['customer_id' => $this->customer_id])
            ->asArray()->all();

        return $this->render('balancedetailed',[
            'transactionDatas' => $transactionDatas
        ]);
    }



    /*
     * 我的银行卡
     */
    public function actionBank()
    {
        $bankCardDatas = BankCard::find()
            ->andWhere(['customer_id' => $this->customer_id])
            ->asArray()->all();

        return $this->render('bank',[
            'bankCardDatas' => $bankCardDatas
        ]);
    }

    /*
     * 添加银行卡
     */
    public function actionBankAdd()
    {
        $model = new BankCard();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->customer_id = $this->customer_id;
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','添加成功！');
                return $this->redirect('/account/bank');
            }
        }

        return $this->render('bank_add',[
            'model' => $model
        ]);
    }

    /*
     * 编辑银行卡
     */
    public function actionBankEdit($id)
    {
        $model = BankCard::find()->andWhere(['bank_card_id' => $id])->one();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','修改成功！');
                return $this->redirect('/account/bank');
            }
        }

        return $this->render('bank_add',[
            'model' => $model
        ]);
    }


    /*
     * 我的优惠券
     */
    public function actionCoupon()
    {

        return $this->render('coupon');
    }





    /*
     * 个人资料
     */
    public function actionPersonal()
    {
        $customerData = Customer::findOne($this->customer_id);

        return $this->render('personal',[
            'customerData' => $customerData
        ]);
    }

    /*
     * 地址管理
     */
    public function actionAddress()
    {
        $addressData = Address::find()->andWhere(['customer_id' => $this->customer_id])->all();

        $address_id = Yii::$app->user->identity->address_id;

        return $this->render('address',[
            'addressData' => $addressData,
            'address_id' => $address_id
        ]);
    }


    /*
     * 设置默认地址
     */
    public function actionAjaxSetdefaultAddress()
    {
        $status = 'error';
        if (Yii::$app->request->post())
        {
            $address_id = Yii::$app->request->post('key');

            if ($address_id)
            {
                $model = Customer::find()->andWhere(['customer_id' => $this->customer_id])
                    ->one();

                $model->address_id = $address_id;

                if ($model->save())
                {
                    $status = 'success';
                }
            }
        }
        echo $status;
    }

    /*
     * 地址编辑
     */
    public function actionAddressEdit($id)
    {
        $model = Address::findOne($id);

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','编辑成功！');
                return $this->redirect('/account/address');
            }
        }

        $provinces = Area::find()->where(['level'=>1])->all();

        $citys = '';
        if ($model->province_id)
        {
            $citys = Area::find()->where(['level' => 2, 'parent_id' => $model->province_id])->all();
        }

        return $this->render('address_edit',[
            'model' => $model,
            'provinces' => $provinces,
            'citys' => $citys
        ]);
    }

    /*
     * 地址添加
     */
    public function actionAddressAdd()
    {
        $model = new Address();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','添加成功！');
                return $this->redirect('/account/address');
            }
        }

        $provinces = Area::find()->where(['level'=>1])->all();

        return $this->render('address_add',[
            'model' => $model,
            'provinces' => $provinces
        ]);
    }


    /*
     * 我的收藏
     */
    public function actionCollection()
    {
        $collectionDatas = Collection::find()->andWhere(['customer_id' => $this->customer_id])->asArray()->all();

        if (!empty($collectionDatas))
        {
            foreach ($collectionDatas as $key => $value)
            {
                $collectionData[$key]['collection_id']       = $value['collection_id'];
                $collectionData[$key]['customer_id']         = $value['customer_id'];
                $collectionData[$key]['product_id']          = $value['product_id'];
                $collectionData[$key]['supplier_id']         = $value['supplier_id'];
                $collectionData[$key]['distribute_id']       = $value['distribute_id'];
                $collectionData[$key]['bidding_id']          = $value['bidding_id'];
                $collectionData[$key]['create_time']         = $value['create_time'];
                $collectionData[$key]['product']             = Product::getProduct($value['product_id'], $value['supplier_id'], $city = null, $value['distribute_id'], $value['bidding_id']);
            }
        }

        return $this->render('collection',[
            'collectionData' => $collectionData
        ]);
    }


    /*
     * 设置
     */
    public function actionSetting()
    {
        $model = Customer::findOne($this->customer_id);

        $model->setScenario('updatepassword');

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','密码修改成功！');
                return $this->redirect('/account');
            }
        }

        return $this->render('setting',[
            'model' => $model
        ]);
    }


    /*
     * 私人定制
     */
    public function actionCustomised()
    {

        $model = new Customised();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','定制成功！');
                return $this->redirect('/account');
            }
        }

        return $this->render('customised',[
            'model' => $model
        ]);
    }



    public function actionAjaxPaymentPassword()
    {
        if (Yii::$app->request->post())
        {
            $model = Customer::find()
                ->andWhere(['customer_id' => $this->customer_id])->one();

            $model->setScenario('paymentpassword');

            $oldPaymentPassword = Yii::$app->request->post('oldPaymentPassword');

            $paymentPassword = Yii::$app->request->post('paymentPassword');

            $confirmPaymentPassword = Yii::$app->request->post('confirmPaymentPassword');

            if (!empty(Yii::$app->user->identity->payment_password) && Yii::$app->user->identity->payment_password == md5($oldPaymentPassword))
            {
                $model->payment_password = md5($paymentPassword);

                if ($model->save())
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
            }
            elseif (empty(Yii::$app->user->identity->payment_password))
            {
                $model->payment_password = md5($paymentPassword);

                if ($model->save())
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
            }
            else
            {
                echo 'error';
            }
        }
        else
        {
            echo 'error';
        }
    }



    /*
     * 订单付款
     * Order_id
     * product_name
     * total
     */
    public function actionPayment($order_id)
    {
        Yii::$app->session->open();

        $order_id = substr($order_id,0,9) - 131311921;

        $orderData = Order::find()->andWhere(['order_id' => $order_id])->one();

        $orderProductData = OrderProduct::find()
            ->select(['oc_order_product.*','oc_product.image'])
            ->joinWith('product')
            ->andWhere(['oc_order_product.order_id' => $order_id])
            ->asArray()->all();

        if (!empty($orderData))
        {
            $_SESSION['total'] = round($orderData->total,2)*100;

            if (!empty($orderProductData))
            {
                foreach ($orderProductData as $orderProduct)
                {
                    $_SESSION['ProductName'] = $orderProduct['name'];
                }
            }

            $_SESSION['OrderId'] = 'DMG_'.$order_id.'_GMD';
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

        return $this->render('payment',[
            'paymentDatas' => $paymentDatas,
            'orderProductData' => $orderProductData
        ]);
    }


    /*
     * AJAX PAYMENT
     */
    public function actionAjaxConfirm()
    {
        Yii::$app->session->open();

        if (Yii::$app->request->post())
        {
            $url = '';

            /*
             *$OrderId 订单ID
             * $_SESSION['total'] 订单金额
             */

            $paymentCode = explode('_', $_SESSION['cart-payment'])[0];

            if ($paymentCode == 'qrcodeweipay')
            {
                $url =  'http://wap.iddmall.com/cart/wx-pay';

//                $url =  'http://wap.iddmall.com/cart/wx-pay?total='.$total.'&OrderId='.$OrderId.'&ProductName='.$ProductName;

//                header("Location:http://wap.iddmall.com/cart/wx-pay");
//                exit;

            }
            elseif ($paymentCode == 'upop')
            {
                $url =  'http://wap.iddmall.com/cart/success';
            }
            elseif ($paymentCode == 'cod')
            {
                $url =  'http://wap.iddmall.com/cart/create-success';
            }
            elseif ($paymentCode == 'tonglianpay')
            {
                $url =  'http://wap.iddmall.com/cart/tl-pay';
            }
            elseif ($paymentCode == 'alipay_direct')
            {
                $url =  'http://wap.iddmall.com/cart/success';
            }

            echo json_encode(array('status' => 'success', 'url' => $url));
        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }
    }





    /*
     * AJAX UPDATE ORDER STATUS
     */
    public function actionAjaxUpdateStatus()
    {
        $status = 'error';

        $val = '';

        if (Yii::$app->request->post())
        {

            $order_id = substr(Yii::$app->request->post('order_id'),0,9) - 131311921;

            $status_id = Yii::$app->request->post('status_id');

            if (!empty($order_id) && !empty($status_id))
            {
                $model = Order::find()->andWhere(['order_id' => $order_id])->one();

                if ($model)
                {
                    $model->order_status_id = $status_id;

                    if ($model->save())
                    {
                        $status = 'success';

                        switch($status_id)
                        {
                            case 16:
                                $val = '订单关闭';
                                break;
                            case 5:
                                $val = '订单完成';
                                $this->Complete($order_id, $status_id);
                                break;

                        }
                    }

                }

            }
        }

        echo json_encode(array('status' => $status, 'val' => $val));
    }



    /*
     * 完成订单 分账
     */
    public function Complete($order_id, $status)
    {
        if (!empty($order_id) && !empty($status))
        {
            $orderModel = Order::find()->andWhere(['order_id' => $order_id])->one();

            $orderModel->order_status_id = $status;

            //订单状态改变成功
            if ($orderModel->save())
            {
                //订单完成
                if ((int)$status === 5)
                {
                    $extensionerCustomerModel = ExtensionerCustomer::find()->select(['oc_extensioner.extensioner_id','oc_extensioner.parent_id'])
                        ->joinWith('extensioner')
                        ->andWhere(['oc_extensioner_customer.customer_id' => $this->customer_id])
                        ->one();

                    //产品列表
                    $productDatas = OrderProduct::find()
                        ->andWhere(['order_id' => $order_id])
                        ->asArray()->all();

                    //有上级推广人
                    if ($extensionerCustomerModel->parent_id)
                    {
                        //分帐参数
                        $extensionerAccountModel = ExtensionerAccounting::find()
                            ->andWhere(['extensioner_id' => $extensionerCustomerModel->parent_id])
                            ->asArray()->all();

                        if ($extensionerAccountModel && $productDatas)
                        {
                            foreach ($productDatas as $product)
                            {
                                $productToCategoryModel = ProductToCategory::find()
                                    ->andWhere(['product_id' => $product['product_id']])
                                    ->asArray()->all();

                                foreach ($extensionerAccountModel as $extensionerAccount)
                                {
                                    foreach ($productToCategoryModel as $productToCategory)
                                    {
                                        if ($productToCategory['category_id'] == $extensionerAccount['type'])
                                        {
                                            //分帐按%比
                                            if ($extensionerAccount['each'] == '%')
                                            {
                                                $amount = $product['total'] * ($extensionerAccount['price'] / 100);
                                            }
                                            //分帐按G
                                            elseif ($extensionerAccount['each'] == 'g')
                                            {
                                                $amount = $product['quantity'] * ($extensionerAccount['price'] / 100);
                                            }

                                            $date_added = date('Y-m-d H:i:s');

                                            $extensionerModel = Extensioner::find()->andWhere(['extensioner_id' => $extensionerCustomerModel->extensioner_id])->one();

                                            $amount_parent = $amount * $extensionerModel->percent;

                                            $amount = $amount - $amount_parent;

                                            Yii::$app->db->createCommand("INSERT INTO oc_extensioner_transaction SET extensioner_id = '" . $extensionerCustomerModel->extensioner_id . "', order_id = '" . $order_id . "', description = '订单分帐', amount = '" . $amount_parent . "', cash = '" . $amount_parent . "', date_added = '" . $date_added . "'")->query();

                                            Yii::$app->db->createCommand("INSERT INTO oc_extensioner_transaction SET extensioner_id = '" . $extensionerCustomerModel->parent_id . "', order_id = '" . $order_id . "', description = '订单分帐', amount = '" . $amount . "', cash = '" . $amount . "', date_added = '" . $date_added . "'")->query();
                                        }
                                    }

                                }

                            }
                        }
                    }

                    //无上级
                    else
                    {
                        $extensionerAccountModel = ExtensionerAccounting::find()
                            ->andWhere(['extensioner_id' => $extensionerCustomerModel->extensioner_id])
                            ->asArray()->all();

                        if ($extensionerAccountModel && $productDatas)
                        {
                            foreach ($productDatas as $product)
                            {
                                $productToCategoryModel = ProductToCategory::find()
                                    ->andWhere(['product_id' => $product['product_id']])
                                    ->asArray()->all();

                                foreach ($extensionerAccountModel as $extensionerAccount)
                                {

                                    foreach ($productToCategoryModel as $productToCategory)
                                    {
                                        if ($productToCategory['category_id'] == $extensionerAccount['type'])
                                        {
                                            //分帐按%比
                                            if ($extensionerAccount['each'] == '%')
                                            {
                                                $amount = $product['total'] * ($extensionerAccount['price'] / 100);
                                            }
                                            //分帐按G
                                            elseif ($extensionerAccount['each'] == 'g')
                                            {
                                                $amount = $product['quantity'] * ($extensionerAccount['price'] / 100);
                                            }

                                            $date_added = date('Y-m-d H:i:s');

                                            Yii::$app->db->createCommand("INSERT INTO oc_extensioner_transaction SET extensioner_id = '" . $extensionerCustomerModel->extensioner_id . "', order_id = '" . $order_id . "', description = '订单分帐', amount = '" . $amount . "', cash = '" . $amount . "', date_added = '" . $date_added . "'")->query();

                                        }
                                    }

                                }

                            }

                        }

                    }

                }

                return 'success';

            }

        }

    }



    /*
     * ajax-security-phone
     */
    public function actionAjaxSecurityPhone()
    {
        if (Yii::$app->request->post('telephone'))
        {
            $telephone = Yii::$app->request->post('telephone');

            $model = Customer::find()->andWhere(['customer_id' => $this->customer_id])->one();

            $model->security_phone = $telephone;

            if ($model->save())
            {
                echo 'success';
            }
            else
            {
                echo 'error';
            }

        }
        else
        {
            echo 'error';
        }
    }




    /*
     * ajax-security-email
     */
    public function actionAjaxSecurityEmail()
    {
        if (Yii::$app->request->post('email'))
        {
            $email = Yii::$app->request->post('email');

            $model = Customer::find()->andWhere(['customer_id' => $this->customer_id])->one();

            $model->security_email = $email;

            if ($model->save())
            {
                echo 'success';
            }
            else
            {
                echo 'error';
            }

        }
        else
        {
            echo 'error';
        }
    }

    /*
     * ajax-send-emal
     */
    public function actionAjaxSendEmail()
    {
        if (Yii::$app->request->post())
        {
            $email = Yii::$app->request->post('email');

            $title = '达蒙珠宝-系统邮件';

            $templete = 'security';

            $code = rand(1000,9999);

            $data = array(
                'name' => Yii::$app->user->identity->lastname,
                'html' => '您的帐号正在绑定密保邮箱，邮箱验证码为 '.$code.' ，请在一小时内正确输入。'
            );

            $content = '';

            $result = $this->sendEmail($email,$title,$content,$templete,$data);

            echo json_encode(array('status' => 'success','code' => $code));
        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }


    }

}
