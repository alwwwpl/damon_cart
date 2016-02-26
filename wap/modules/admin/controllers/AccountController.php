<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\modules\admin\models\LoginForm;
use app\models\Finance;

class AccountController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {

        $model = new LoginForm();

        if($model->load(Yii::$app->request->post())){

            if($model->login()){
                return $this->redirect('/admin/');
            } else {
                return $this->render('login',['model'=>$model]);
            }
        }

        $this->layout = 'main-login';

        return $this->render('login',['model'=>$model]);

    }

    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->redirect(array('account/login'));
    }
}