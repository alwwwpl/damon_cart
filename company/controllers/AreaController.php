<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\filters\ContentNegotiator;
use yii\web\Response;

use app\models\Area;

class AreaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    }

    public function actionRoot()
    {
        return Area::find()->roots()->all();
    }

    public function actionOptions()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                $area = Area::findOne($id);
                if($area){
                    $areas = $area->children(1)->all();
                }else{
                    $areas = '';
                }
                
                return ['output'=>$areas, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}