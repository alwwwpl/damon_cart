<?php

namespace app\modules\agent\controllers;

use app\models\Product;
use app\models\search\ProductSupplierSearch;
use Yii;
use app\models\ProductSupplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;


class ProductController extends Controller
{
    public function actionIndex() {
        /*$agent = Yii::$app->agent->identity;

        $searchModel = new ProductSupplierSearch();
        $searchModel->agent_id = $agent->agent_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $agent = Yii::$app->agent->identity;

        $productData = ProductSupplier::find()->select(['oc_product_supplier.product_id', 'oc_product_supplier.agent_product_name', 'oc_product_supplier.cost_price', 'oc_product_supplier.agent_product_stock', 'oc_product_supplier.agent_product_model', 'oc_product.image'])
            ->joinWith('product')
            ->andWhere(['oc_product_supplier.agent_id' => $agent->agent_id]);

        $pages = new Pagination(['totalCount' => $productData->count(), 'pageSize' => '15']);
        $productData = $productData->offset($pages->offset)->limit($pages->limit)->asArray()->all();


        return $this->render('index', [
            'productData' => $productData,
            'pages' => $pages
        ]);
    }

}
