<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductSupplier;

/**
 * AgentSearch represents the model behind the search form about `app\models\Agent`.
 */
class ProductSupplierSearch extends ProductSupplier
{
    public $image;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductSupplier::find()->select(['oc_product_supplier.agent_id','oc_product_supplier.supplier_id','oc_product_supplier.product_id','oc_product_supplier.agent_product_stock','oc_product_supplier.agent_product_name','oc_product_supplier.agent_product_model','oc_product_supplier.cost_price','oc_product.image'])
            ->joinWith('product',['product_id' => 'product.product_id']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'agent_id'            => $this->agent_id,
            'product_id'          => $this->product_id,
            'image'               => $this->image,
            'supplier_id'         => $this->supplier_id,
            'agent_product_stock' => $this->agent_product_stock,
            'agent_product_name'  => $this->agent_product_name,
            'agent_product_model' => $this->agent_product_model,
            'cost_price'          => $this->cost_price,
        ]);

        $query->andFilterWhere(['like', 'agent_product_stock', $this->agent_product_stock])
            ->andFilterWhere(['like', 'agent_id', $this->agent_id])
            ->andFilterWhere(['like', 'product_id', $this->product_id])
            ->andFilterWhere(['like', 'supplier_id', $this->supplier_id])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'agent_product_name', $this->agent_product_name])
            ->andFilterWhere(['like', 'agent_product_model', $this->agent_product_model])
            ->andFilterWhere(['like', 'cost_price', $this->cost_price]);

        return $dataProvider;
    }
}
