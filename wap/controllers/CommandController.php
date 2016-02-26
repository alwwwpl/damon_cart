<?php

namespace app\controllers;

use Yii;
use app\models\Collection;
use app\commands\WechatController;

class CommandController extends WechatController
{
    /*
     * 添加收藏
     */
    public function actionAddCollection()
    {
        if (Yii::$app->request->post())
        {
            $data = array();

            $product_id = Yii::$app->request->post('product_id') ? Yii::$app->request->post('product_id') : 0;

            $supplier_id = Yii::$app->request->post('supplier_id') ? Yii::$app->request->post('supplier_id') : 0;

            $distribute_id = Yii::$app->request->post('distribute_id') ? Yii::$app->request->post('distribute_id') : 0;

            $bidding_id = Yii::$app->request->post('bidding_id') ? Yii::$app->request->post('bidding_id') : 0;

            $customer_id = isset(Yii::$app->user->identity->customer_id) ? Yii::$app->user->identity->customer_id : 0;

            if ($customer_id)
            {
                $collectionData = Collection::find()
                    ->andWhere(['product_id' => $product_id, 'supplier_id' => $supplier_id, 'distribute_id' => $distribute_id, 'bidding_id' => $bidding_id , 'customer_id' => $customer_id])
                    ->one();


                if ($collectionData)
                {
                    $data['status'] = 'repeat';
                }
                else
                {
                    $model = new Collection();

                    $model->product_id = $product_id;

                    $model->supplier_id = $supplier_id;

                    $model->distribute_id = $distribute_id;

                    $model->bidding_id = $bidding_id;

                    $model->customer_id = $customer_id;

                    if ($model->save())
                    {
                        $data['status'] = 'success';

                        $data['collection_id'] = Yii::$app->db->getLastInsertID();
                    }
                    else
                    {
                        $data['status'] = 'error';
                    }
                }
            }
            else
            {
                $data['status'] = 'login';
            }

        }
        else
        {
            $data['status'] = 'error';
        }

        echo json_encode($data);
    }


    /*
     * 删除收藏
     */
    public function actionDelCollection()
    {
        if (Yii::$app->request->post())
        {
            $data = array();

            $model = Collection::findOne(Yii::$app->request->post('collection_id'));

            if ($model->delete())
            {
                $data['status'] = 'success';

                $data['collection_id'] = Yii::$app->request->post('collection_id');
            }
            else
            {
                $data['status'] = 'error';
            }
        }
        else
        {
             $data['status'] = 'error';
        }

        echo json_encode($data);
    }


    /*
     * 批量删除
     */
    public function actionDelBatchCollection()
    {
        if (Yii::$app->request->post('collection'))
        {
            $collection = Yii::$app->request->post('collection');

            $keys = substr($collection,0,-1);

            if ($keys)
            {
                $sql = "DELETE FROM oc_collection WHERE collection_id IN (". $keys .")";

                Yii::$app->db->createCommand($sql)->query();

                echo json_encode(array('status' => 'success','keys' => $keys));
            }
            else
            {
                echo json_encode(array('status' => 'error'));
            }

        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }
    }


}
