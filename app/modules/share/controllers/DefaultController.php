<?php

namespace app\modules\share\controllers;


use Yii;
use yii\web\Controller;
use app\models\ExtensionerTransaction;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $extensioner = Yii::$app->extensioner->identity;

        $agentTransaction = ExtensionerTransaction::find()->select(['SUM(amount) as amount', 'SUM(cash) as cash'])
            ->andWhere(['extensioner_id' => $extensioner->extensioner_id])->asArray()->all();

        $transactionRecord = ExtensionerTransaction::find()->andWhere(['extensioner_id' => $extensioner->extensioner_id])->all();

        return $this->render('index',[
            'total'  => $agentTransaction[0]['amount'],
            'amount' => $agentTransaction[0]['amount'],
            'cash'   => $agentTransaction[0]['cash'],
            'record' => $transactionRecord
        ]);
    }
}

