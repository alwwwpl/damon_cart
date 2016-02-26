<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_group_id', 'store_id', 'newsletter', 'address_id', 'status', 'approved', 'safe', 'agent_id'], 'integer'],
            [['firstname', 'lastname', 'email', 'telephone', 'fax', 'password', 'salt', 'cart', 'wishlist', 'custom_field', 'ip', 'token', 'date_added', 'store_name', 'store_logo'], 'safe'],
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
        $query = Customer::find();

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
            'customer_id' => $this->customer_id,
            'customer_group_id' => $this->customer_group_id,
            'store_id' => $this->store_id,
            'newsletter' => $this->newsletter,
            'address_id' => $this->address_id,
            'status' => $this->status,
            'approved' => $this->approved,
            'safe' => $this->safe,
            'date_added' => $this->date_added,
            'agent_id' => $this->agent_id,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'salt', $this->salt])
            ->andFilterWhere(['like', 'cart', $this->cart])
            ->andFilterWhere(['like', 'wishlist', $this->wishlist])
            ->andFilterWhere(['like', 'custom_field', $this->custom_field])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'store_logo', $this->store_logo]);

        return $dataProvider;
    }
}
