<?php

namespace app\modules\agent\controllers;

use app\models\Customer;
use Yii;
use app\models\Agent;
use app\models\search\AgentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AgentController implements the CRUD actions for Agent model.
 */
class AgentController extends Controller
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
     * Lists all Agent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $agent = Yii::$app->agent->identity;

        /*$searchModel = new AgentSearch();
        $searchModel->parent_id = $agent->agent_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/


        $agentData = Agent::find()->select(['oc_agent.*', 'oc_area.area_name', 'IFNULL('.Customer::find()->where(["agent_id" => $agent->agent_id])->count().',0) as num'])
            ->joinWith('areas')
            ->andWhere(['oc_agent.parent_id' => $agent->agent_id]);

        $pages = new Pagination(['totalCount' => $agentData->count(), 'pageSize' => '15']);
        $agentData = $agentData->offset($pages->offset)->limit($pages->limit)->asArray()->all();



        return $this->render('index', [
            'dataProvider' => $agentData,
            'pages' => $pages
        ]);
    }


    public function actionChangestatus(){
        if (Yii::$app->request->post('agent_id') && Yii::$app->request->post('status'))
        {
            $agent_id = Yii::$app->request->post('agent_id');
            $status = Yii::$app->request->post('status');

            $model = Agent::findOne($agent_id);

            $model->status = $status;

            if ($model->save()) {
                $data = array(
                    'status' => 'success',
                    'num' => $status
                );
            }
            else{
                $data = array(
                    'status' => 'error'
                );
            }

            echo json_encode($data);
        }



    }


}
