<?php

namespace app\modules\share\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;

use app\models\Extensioner;
use app\models\Customer;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class VipController extends Controller
{

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $customer_id = Yii::$app->extensioner->identity->customer_id;

        $customerData = Customer::find()->where(['parent_id' => $customer_id])->orderBy('customer_id DESC');

        $pages = new Pagination(['totalCount' => $customerData->count(), 'pageSize' => '15']);
        $customerData = $customerData->offset($pages->offset)->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'dataProvider' => $customerData,
            'pages' => $pages
        ]);

    }

}
