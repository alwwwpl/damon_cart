<?php

namespace app\modules\share;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\share\controllers';

    public $layout = 'main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        if(Yii::$app->extensioner->isGuest && $action->controller->id!='account'){
            $action->controller->redirect(array('/share/account/login'));
        }

        return parent::beforeAction($action);
    }
}
