<?php

namespace app\controllers;

use Yii;
use app\models\OrderProduct;
use app\models\Product;
use app\commands\WechatController;

class IndexController extends WechatController
{
    public function actionIndex($order = null, $sort = null)
    {
        //精选产品ID
        $orderProductId = OrderProduct::find()->select(['oc_order_product.product_id', 'count(oc_order_product.product_id) as num', 'oc_order_product.supplier_id'])
            ->joinWith('product')
            ->andWhere(['oc_product.status' => 1])
            ->andWhere(['>', 'oc_order_product.supplier_id', 0])
            ->groupBy('oc_order_product.product_id')
            ->orderBy('num DESC')
            ->limit(4)
            ->asArray()->all();

        $orderData['product'] = $orderProductId;

//        var_dump($orderProductId);

        $orderData['city'] = '合肥市';

//      $orderData['city'] = Yii::$app->user->identity->city;

        $orderData['order'] = $order;

        $orderData['sort'] = $sort;

        foreach ($orderProductId as $product)
        {
            $orderProductData[$product['product_id'].'_'.$product['supplier_id']] = Product::getProduct($product['product_id'], '', $orderData['city']);
        }

        //最新上传ID
        $newProductId = Product::find()->select(['oc_product.product_id', 'oc_product_supplier.supplier_id'])
            ->joinWith('supplier')
            ->andWhere(['oc_product.status' => 1])
            ->andWhere(['status' => 1])
            ->orderBy('date_added DESC')
            ->limit(3)
            ->asArray()->all();

        foreach ($newProductId as $product)
        {
            $newProductData[$product['product_id'].'_'.$product['supplier_id']] = Product::getProduct($product['product_id'], '', $orderData['city']);
        }

        //平台推荐ID
        $recommendProductId = Product::find()->select(['oc_product.product_id', 'oc_product_supplier.supplier_id'])
            ->joinWith('supplier')
            ->andWhere(['status' => 1])
            ->orderBy('viewed DESC')
            ->limit(3)
            ->asArray()->all();

        foreach ($recommendProductId as $product)
        {
            $recommendProductData[$product['product_id'].'_'.$product['supplier_id']] = Product::getProduct($product['product_id'], '', $orderData['city']);
        }

        return $this->render('index',[
            'orderProductData' => $orderProductData,
            'newProductData' => $newProductData,
            'recommendProductData' => $recommendProductData
        ]);
    }

    public function actionHeader()
    {
        return $this->renderPartial('header');
    }

}
