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
use app\models\Extensioner;
use app\models\ExtensionerAccounting;
use app\models\Category;
use app\models\CategoryDescription;

use yii\data\Pagination;


class ExtensionerController extends Controller
{

    public function actionIndex() {

        if (Yii::$app->extensioner->identity->type == Extensioner::TYPE_ADMIN)
        {
            $extensionerData = Extensioner::find()->where(['type' => Extensioner::TYPE_CUSTOMER])->orderBy('extensioner_id DESC');

            $pages = new Pagination(['totalCount' => $extensionerData->count(), 'pageSize' => '15']);
            $extensionerData = $extensionerData->offset($pages->offset)->limit($pages->limit)->asArray()->all();

            return $this->render('index', [
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


    public function actionAdd() {

        $model = new Extensioner();

//        $model_type = new ExtensionerAccounting();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', '信息添加成功');
//            if ($model_type->load(Yii::$app->request->post()) && $model_type->save())
//            {
                return $this->redirect('./index');
//            }
        }

        return $this->render('add',[
            'model' => $model,
//            'model_type' => $model_type
        ]);

    }


    public function actionInfo($extensioner_id) {

        $model = Extensioner::findOne($extensioner_id);

        $model_type = ExtensionerAccounting::find()->where(['extensioner_id' => $extensioner_id])->orderBy('createtime DESC')->all();

        return $this->render('info',[
            'model' => $model,
            'model_type' => $model_type
        ]);

    }


    public function actionPlus($extensioner_id) {

        $model = new ExtensionerAccounting();

        $model->extensioner_id = $extensioner_id;

        $categorys = Category::find()->select(['oc_category_description.name','oc_category.category_id'])
            ->joinWith('description')
            ->where(['oc_category.parent_id' => 0, 'oc_category_description.language_id' => 1])
            ->asArray()->all();

        $categoryData = array();
        foreach ($categorys as $category)
        {
            $categoryData[$category['category_id']] = $category['name'];
        }

        $each = array(
            '%' => '%',
            'g' => 'g'
        );

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', '信息添加成功');

            return $this->redirect('./info?extensioner_id='.$extensioner_id);
        }

        return $this->render('plus',[
            'model' => $model,
            'extensioner_id' => $extensioner_id,
            'categoryData' => $categoryData,
            'each' => $each
        ]);

    }


    public function actionEdit($extensioner_id, $extensioner_accounting_id = null) {

        if (!empty($extensioner_accounting_id))
        {
            $model = ExtensionerAccounting::findOne($extensioner_accounting_id);

            $categorys = Category::find()->select(['oc_category_description.name','oc_category.category_id'])
                ->joinWith('description')
                ->where(['oc_category.parent_id' => 0, 'oc_category_description.language_id' => 1])
                ->asArray()->all();

            $categoryData = array();
            foreach ($categorys as $category)
            {
                $categoryData[$category['category_id']] = $category['name'];
            }

            $each = array(
                '%' => '%',
                'g' => 'g'
            );

            if ($model->load(Yii::$app->request->post()) && $model->update())
            {
                Yii::$app->session->setFlash('success', '信息修改成功');

                return $this->redirect('./info?extensioner_id='.$extensioner_id);
            }

            return $this->render('plus',[
                'model' => $model,
                'categoryData' => $categoryData,
                'each' => $each
            ]);
        }
        else
        {
            $model = Extensioner::findOne($extensioner_id);

            if ($model->load(Yii::$app->request->post()) && $model->update())
            {
                Yii::$app->session->setFlash('success', '信息修改成功');

                return $this->redirect('./index');
            }

            return $this->render('add',[
                'model' => $model,
            ]);
        }




    }



    public function actionDel()
    {
        if (Yii::$app->request->post('extensioner_accounting_id'))
        {
            $extension_accounting_id = Yii::$app->request->post('extensioner_accounting_id');
        }
        if (Yii::$app->request->post('extensioner_id'))
        {
            $extension_id = Yii::$app->request->post('extensioner_id');
        }

        if (!empty($extension_accounting_id))
        {
            $model = ExtensionerAccounting::findOne($extension_accounting_id);
        }
        elseif (!empty($extension_id))
        {
            $model = Extensioner::findOne($extension_id);
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