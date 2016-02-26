<?php

namespace app\modules\agent\controllers;

use Yii;
use yii\web\Controller;
use app\models\OrderProduct;
use app\models\AgentTransaction;




class DefaultController extends Controller
{
    public function actionIndex()
    {
        $agent = Yii::$app->agent->identity;

        $orderProductData = OrderProduct::find()->select(['oc_order_product.quantity', 'oc_product_supplier.cost_price'])
            ->joinWith('supplier',['supplier_id' => 'supplier.supplier_id'])
            ->andWhere(['agent_id' => $agent->agent_id])
            ->asArray()->all();

        $total = '';
        if ($orderProductData)
        {
            foreach ($orderProductData as $val){
                $total += $val['quantity'] * $val['cost_price'];
            }
        }

        $agentTransaction = AgentTransaction::find()->select(['SUM(amount) as amount', 'SUM(cash) as cash'])
            ->andWhere(['agent_id' => $agent->agent_id])->asArray()->all();

        $transactionRecord = AgentTransaction::find()->andWhere(['agent_id' => $agent->agent_id])->all();

        return $this->render('index',[
            'total'  => $total,
            'amount' => $agentTransaction[0]['amount'],
            'cash'   => $agentTransaction[0]['cash'],
            'record' => $transactionRecord
        ]);
    }
}
