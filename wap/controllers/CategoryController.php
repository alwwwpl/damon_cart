<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\commands\WechatController;

class CategoryController extends WechatController
{
    public function actionIndex()
    {
        $categoryParentData = Category::find()->select(['oc_category.category_id','oc_category.parent_id','oc_category.sort_order','oc_category_description.name'])
            ->joinWith('description',['category_id' => 'description.category_id'])
            ->andWhere(['oc_category.parent_id' => 0, 'oc_category_description.language_id' => 2, 'oc_category.status' => 1])->asArray()->all();

        $categoryData = Category::find()->select(['oc_category.category_id','oc_category.image','oc_category.parent_id','oc_category.sort_order','oc_category_description.name'])
            ->joinWith('description',['category_id' => 'description.category_id'])
            ->andWhere('oc_category.parent_id > 0')
            ->andWhere(['oc_category_description.language_id' => 2, 'oc_category.status' => 1])->asArray()->all();

        return $this->render('index',[
            'categoryParentData' => $categoryParentData,
            'categoryData' => $categoryData
        ]);
    }

}
