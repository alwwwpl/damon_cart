<?php

namespace app\modules\share\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;

use app\models\Extensioner;
use app\models\Customer;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {

        $extensionerData = Extensioner::find()->select(['oc_extensioner.*', '(SELECT COUNT(*) FROM oc_customer WHERE parent_id = oc_extensioner.customer_id AND parent_id > 0) as num'])
            ->andWhere(['type' => Extensioner::TYPE_VIP, 'parent_id' => Yii::$app->extensioner->identity->id])
            ->orderBy('extensioner_id DESC');

        $pages = new Pagination(['totalCount' => $extensionerData->count(), 'pageSize' => '15']);
        $extensionerData = $extensionerData->offset($pages->offset)->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'dataProvider' => $extensionerData,
            'pages' => $pages
        ]);

    }


    public function actionExtensioner()
    {
        if (Yii::$app->extensioner->identity->type == Extensioner::TYPE_CUSTOMER)
        {
            $extensionerData = Extensioner::find()
                ->where(['type' => Extensioner::TYPE_SUB, 'parent_id' => Yii::$app->extensioner->identity->id])
                ->orderBy('extensioner_id DESC');

            $pages = new Pagination(['totalCount' => $extensionerData->count(), 'pageSize' => '15']);
            $extensionerData = $extensionerData->offset($pages->offset)->limit($pages->limit)
                ->asArray()
                ->all();

            return $this->render('extensioner', [
                'dataProvider' => $extensionerData,
                'pages' => $pages
            ]);
        }
        else
        {
            Yii::$app->session->setFlash('error','权限不足!');

            return $this->redirect('/share/default');
        }

    }


    public function actionUpgrade()
    {
        if (Yii::$app->extensioner->identity->type == Extensioner::TYPE_CUSTOMER)
        {
            $extensionerData = Extensioner::find()
                ->where(['type' => Extensioner::TYPE_VIP, 'parent_id' => Yii::$app->extensioner->identity->id])
                ->orderBy('extensioner_id DESC');

            $pages = new Pagination(['totalCount' => $extensionerData->count(), 'pageSize' => '15']);
            $extensionerData = $extensionerData->offset($pages->offset)->limit($pages->limit)
                ->asArray()
                ->all();

            return $this->render('upgrade', [
                'dataProvider' => $extensionerData,
                'pages' => $pages
            ]);
        }
        else
        {
            Yii::$app->session->setFlash('error','权限不足!');

            return $this->redirect('/share/default');
        }

    }


    public function actionEdit($extensioner_id, $extensioner_customer_id)
    {

        $model = Extensioner::findOne($extensioner_id);

        if ($model->load(Yii::$app->request->post()) && $model->update())
        {

            Yii::$app->session->setFlash('success', '信息修改成功');

            return $this->redirect('./index');
        }

        return $this->render('edit',[
            'model' => $model
        ]);


    }

    public function actionUpdate($extensioner_id, $extensioner_customer_id)
    {
        $model = Extensioner::findOne($extensioner_id);

        if ($model->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->post('Extensioner')['status'] == 1)
            {
                $model->type = 3;
            }

            if (isset(Yii::$app->request->post('Extensioner')['percent']))
            {
                $model->percent = Yii::$app->request->post('Extensioner')['percent'];
            }

            if ($model->save())
            {
                Yii::$app->session->setFlash('success', '信息修改成功');

                return $this->redirect('./extensioner');
            }

        }

        return $this->render('edit',[
            'model' => $model
        ]);
    }


    public function actionDel()
    {
        if (Yii::$app->request->post('extensioner_customer_id'))
        {
            $extension_customer_id = Yii::$app->request->post('extensioner_customer_id');
        }
        if (Yii::$app->request->post('extensioner_id'))
        {
            $extension_id = Yii::$app->request->post('extensioner_id');
        }

        if (!empty($extension_customer_id))
        {
            $model = ExtensionerCustomer::findOne($extension_customer_id);
        }
        elseif (!empty($extension_id))
        {
            $model = Extensioner::findOne($extension_id);

            $model_customer = ExtensionerCustomer::find()->where(['extensioner_id' => $extension_id])->all();

            $model_customer->delete();
        }

        if ($model->delete())
        {
            echo 'success';
        }
        else
        {
            echo 'error';
        }


    }
}
