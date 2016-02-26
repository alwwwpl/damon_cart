<?php

namespace app\modules\agent\controllers;

use Yii;
use app\models\Customer;
use app\models\search\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use app\models\Agent;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$agent = Yii::$app->agent->identity;

        $searchModel = new CustomerSearch();

        if($agent->type==Agent::TYPE_PROVINCE){
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $query = $dataProvider->query;
            $query->joinWith('agent')->andWhere(['parent_id' => $agent->agent_id]);
        }else{
            $searchModel->agent_id = $agent->agent_id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $agent = Yii::$app->agent->identity;

        $customerData = Customer::find()
            ->andWhere(['oc_customer.agent_id' => $agent->agent_id])
            ->orderBy('oc_customer.customer_id DESC');

        $pages = new Pagination(['totalCount' => $customerData->count(), 'pageSize' => '15']);
        $customerData = $customerData->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        if ($customerData){
            foreach ($customerData as $key => $val){
                $customerData[$key]['num'] = Customer::find()->where(['parent_id' => $val['customer_id']])->count();
            }
        }

        return $this->render('index', [
            'customerData' => $customerData,
            'pages' => $pages
        ]);




    }
}
