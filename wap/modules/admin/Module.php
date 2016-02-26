<?php

namespace app\modules\admin;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    
    public $layout = 'main';

    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        if(Yii::$app->admin->isGuest && $action->id!='login' && $action->id!='create'){
            $action->controller->redirect(array('/admin/account/login'));
        }

        return parent::beforeAction($action);
    }
}
