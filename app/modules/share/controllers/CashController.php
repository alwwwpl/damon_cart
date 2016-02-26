<?php
/**
 * Created by PhpStorm.
 * User: sucjun
 * Date: 15/11/22
 * Time: 16:23
 */

namespace app\modules\share\controllers;

use Yii;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\ExtensionerTransaction;


class CashController extends Controller {

    public function actionIndex() {

        $id = Yii::$app->extensioner->identity->id;

        $cashData = ExtensionerTransaction::find()->where(['extensioner_id' => $id])->orderBy('date_added DESC');

        $pages = new Pagination(['totalCount' => $cashData->count(), 'pageSize' => '15']);
        $cashData = $cashData->offset($pages->offset)->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'dataProvider' => $cashData,
            'pages' => $pages
        ]);
    }

}