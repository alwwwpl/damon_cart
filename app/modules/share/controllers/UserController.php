<?php

namespace app\modules\share\controllers;

use Yii;

use yii\web\Controller;

use app\models\Extensioner;
use app\modules\share\models\ChangePasswordForm;

class UserController extends Controller
{
    public function actionUpdate()
    {
        $id = Yii::$app->extensioner->identity->id;

        $model = Extensioner::findOne($id);

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
