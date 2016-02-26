<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use app\commands\WechatController;

class ProductController extends WechatController
{
    public function actionIndex($product_id, $supplier_id = null, $distribute_id = null, $bidding_id = null)
    {
        $city = '合肥市';

        $productData = Product::getProduct($product_id, $supplier_id, $city, $distribute_id, $bidding_id);

        return $this->render('index',[
            'productData' => $productData
        ]);
    }



    public function actionList($category, $order = null, $sort = null)
    {
        $data['category'] = $category;
        $data['city'] = '合肥市';
        $data['order'] = $order;

        if (empty($sort))
        {
            $data['sort'] = 'DESC';
        }
        else
        {
            $data['sort'] = $sort;
        }

        $productsData = Product::getProducts($data);

        return $this->render('list',[
            'productsData' => $productsData
        ]);

    }

    public function actionSearch($search, $order = null, $sort = null)
    {
        $data['search'] = $search;
        $data['city'] = '合肥市';
        $data['order'] = $order;

        if (empty($sort))
        {
            $data['sort'] = 'DESC';
        }
        else
        {
            $data['sort'] = $sort;
        }

        $productsData = Product::getProducts($data);

        return $this->render('search',[
            'productsData' => $productsData
        ]);


    }



}
