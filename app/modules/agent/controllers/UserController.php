<?php

namespace app\modules\agent\controllers;

use Yii;

use yii\web\Controller;

use app\models\Agent;
use app\modules\agent\models\ChangePasswordForm;

class UserController extends Controller
{
    public function actionUpdate()
    {
        $model = Yii::$app->agent->identity;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '个人信息修改成功');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->session->setFlash('success', '密码修改成功');
            $model = new ChangePasswordForm();
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
}
