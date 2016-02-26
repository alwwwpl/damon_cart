<?php

namespace app\modules\agent\controllers;

use Yii;

use yii\web\Controller;

use app\models\InviteCode;
use app\models\search\InviteCodeSearch;
use yii\data\Pagination;

class ShareController extends Controller
{
    public function actionIndex()
    {
        $agent = Yii::$app->agent->identity;
        $count = $agent->getInviteCodes()->count();
        if($count>0){
            /*$searchModel = new InviteCodeSearch();
            $searchModel->agent_id = $agent->agent_id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'count' => $count,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);*/

            $model = new InviteCode();
            $result = $model->find()->where(['agent_id' => $agent->agent_id]);

            $pages = new Pagination(['totalCount' => $count, 'pageSize' => '15']);
            $dataProvider = $result->offset($pages->offset)->limit($pages->limit)->all();

            return $this->render('index', [
                'count' => $count,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'pages' => $pages
            ]);

        }

        return $this->render('index', ['count' => $count]);
    }

    public function actionGenCodes()
    {
        $agent = Yii::$app->agent->identity;
        for($i = 0; $i<500; $i++){
            $inviteCode = new InviteCode;
            $inviteCode->agent_id = $agent->agent_id;
            $inviteCode->save();
        }

        $this->redirect(['index']);
    }

    public function actionDelete($invite_code_id) {

        $model = InviteCode::findOne($invite_code_id);
        if ($model->delete()){
            $this->redirect(['index']);
        }

    }

}
