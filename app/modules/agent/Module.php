<?php

namespace app\modules\agent;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\agent\controllers';

    public $layout = 'main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        if(Yii::$app->agent->isGuest && $action->controller->id!='account'){
            $action->controller->redirect(array('/agent/account/login'));
        }

        return parent::beforeAction($action);
    }
}
