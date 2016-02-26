<?php

namespace app\modules\agent\controllers;

use Yii;
use app\models\Order;
use app\models\OrderProduct;
use app\models\search\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use app\models\Agent;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $agent = Yii::$app->agent->identity;

        /*
         * $agent->type 1:省代，2:市代
         */
        $searchModel = new OrderSearch();
//        IF 省代
//        if($agent->type==Agent::TYPE_PROVINCE){
//            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//            $query = $dataProvider->query;
//            $query->joinWith('customer')->leftJoin('oc_agent', 'oc_agent.agent_id=oc_customer.agent_id')->andWhere(['oc_agent.parent_id' => $agent->agent_id]);
//        }else{
//            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//            $query = $dataProvider->query;
//            $query->joinWith('customer')->andWhere(['agent_id' => $agent->agent_id]);
//        }
        $orderData = OrderProduct::find()->select(['oc_order_product.order_id', 'oc_order_product.status', 'date_added', 'SUM(quantity) as number', 'SUM(quantity*cost_price) as total', 'oc_order_address.username', 'oc_order_address.phone', 'oc_order_address.country', 'oc_order_address.province', 'oc_order_address.city', 'oc_order_address.remarks', 'oc_order.shipping_lastname', 'oc_order.shipping_address_1', 'oc_order.shipping_city', 'oc_order.shipping_zone', 'oc_order.shipping_postcode'])
            ->joinWith('supplier',['supplier_id' => 'supplier.supplier_id'])
            ->joinWith('order',['order.order_id' => 'order_id'])
            ->joinWith('address',['address.order_id' => 'order_id'])
            ->andWhere(['oc_product_supplier.agent_id' => $agent->agent_id])
            ->groupBy('order_id');

        $pages = new Pagination(['totalCount' => $orderData->count(), 'pageSize' => '15']);
        $orderData = $orderData->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        /*foreach ($orderData as $key=>$val)
        {
            $productData = OrderProduct::find()->select(['oc_product.product_id', 'oc_product_supplier.cost_price', 'oc_product_supplier.agent_product_name', 'oc_product_supplier.agent_product_model', 'oc_product_supplier.agent_product_stock', 'oc_order_product.express', 'oc_order_product.quantity', 'oc_product.image', '(oc_order_product.quantity*oc_product_supplier.cost_price) as total'])
                ->joinWith('product',['product.product_id' => 'product_id'])->joinWith('supplier',['supplier.supplier_id' => 'supplier_id'])
                ->andWhere(['order_id' => $val['order_id'], 'oc_product_supplier.agent_id' => $agent->agent_id])
                ->asArray()->all();
            $orderData[$key]['products'] = $productData;
        }*/

        return $this->render('index', [
            'orderData' => $orderData,
            'pages' => $pages
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionInfo($order_id) {
        if (!empty($order_id))
        {
            $agent = Yii::$app->agent->identity;

            $orderData = OrderProduct::find()->select(['oc_order_product.order_id', 'oc_order_product.status', 'date_added', 'SUM(quantity) as number', 'SUM(quantity*cost_price) as total', 'oc_order_address.username', 'oc_order_address.phone', 'oc_order_address.country', 'oc_order_address.province', 'oc_order_address.city', 'oc_order_address.remarks'])
                ->joinWith('supplier',['supplier_id' => 'supplier.supplier_id'])
                ->joinWith('order',['order.order_id' => 'order_id'])
                ->joinWith('address',['address.order_id' => 'order_id'])
                ->andWhere(['oc_product_supplier.agent_id' => $agent->agent_id, 'oc_order.order_id' => $order_id])
                ->groupBy('order_id')->asArray()->one();

            $productData = OrderProduct::find()->select(['oc_product.product_id', 'oc_product_supplier.cost_price', 'oc_product_supplier.agent_product_name', 'oc_product_supplier.agent_product_model', 'oc_product_supplier.agent_product_stock', 'oc_order_product.express', 'oc_order_product.quantity', 'oc_product.image', '(oc_order_product.quantity*oc_product_supplier.cost_price) as total'])
                ->joinWith('product',['product.product_id' => 'product_id'])->joinWith('supplier',['supplier.supplier_id' => 'supplier_id'])
                ->andWhere(['order_id' => $order_id, 'oc_product_supplier.agent_id' => $agent->agent_id])
                ->asArray()->all();

            return $this->render('info',[
                'productData' => $productData,
                'orderData' => $orderData
            ]);
        }

    }


    public function actionDeliver(){
        if (Yii::$app->request->post('order_id') && Yii::$app->request->post('express')){
            $order_id = Yii::$app->request->post('order_id');
            $express = Yii::$app->request->post('express');

            $agent = Yii::$app->agent->identity;
            $orderProductData = OrderProduct::find()->select(['oc_order_product.order_product_id'])
                ->joinWith('supplier',['supplier_id' => 'supplier.supplier_id'])
                ->andWhere(['oc_order_product.order_id' => $order_id, 'oc_product_supplier.agent_id' => $agent->agent_id])
                ->asArray()->all();
            foreach ($orderProductData as $val) {
                $model = OrderProduct::findOne($val['order_product_id']);
                if ($model){
                    $model->express = $express;
                    $model->status = '已发货';
                    $model->save();
                }
            }
            echo 'success';
        }
        else {
            echo 'error';
        }
    }
}
