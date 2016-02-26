<?php

namespace app\controllers;

use Yii;
use app\commands\WechatController;

class SpecialController extends WechatController
{
    public function actionIndex()
    {

        return $this->render('index');
    }

}