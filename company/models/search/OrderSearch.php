<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_number', 'invoice_no', 'store_id', 'customer_id', 'customer_group_id', 'payment_country_id', 'payment_zone_id', 'shipping_country_id', 'shipping_zone_id', 'order_status_id', 'affiliate_id', 'marketing_id', 'language_id', 'currency_id'], 'integer'],
            [['invoice_prefix', 'store_name', 'store_url', 'firstname', 'lastname', 'email', 'telephone', 'fax', 'custom_field', 'payment_firstname', 'payment_lastname', 'payment_company', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_postcode', 'payment_country', 'payment_zone', 'payment_address_format', 'payment_custom_field', 'payment_method', 'payment_code', 'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_country', 'shipping_zone', 'shipping_address_format', 'shipping_custom_field', 'shipping_method', 'shipping_code', 'comment', 'tracking', 'currency_code', 'ip', 'forwarded_ip', 'user_agent', 'accept_language', 'date_added', 'date_modified'], 'safe'],
            [['total', 'commission', 'currency_value'], 'number'],
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
        $query = Order::find();

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
            'order_id' => $this->order_id,
            'order_number' => $this->order_number,
            'invoice_no' => $this->invoice_no,
            'store_id' => $this->store_id,
            'customer_id' => $this->customer_id,
            'customer_group_id' => $this->customer_group_id,
            'payment_country_id' => $this->payment_country_id,
            'payment_zone_id' => $this->payment_zone_id,
            'shipping_country_id' => $this->shipping_country_id,
            'shipping_zone_id' => $this->shipping_zone_id,
            'total' => $this->total,
            'order_status_id' => $this->order_status_id,
            'affiliate_id' => $this->affiliate_id,
            'commission' => $this->commission,
            'marketing_id' => $this->marketing_id,
            'language_id' => $this->language_id,
            'currency_id' => $this->currency_id,
            'currency_value' => $this->currency_value,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'invoice_prefix', $this->invoice_prefix])
            ->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'store_url', $this->store_url])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'custom_field', $this->custom_field])
            ->andFilterWhere(['like', 'payment_firstname', $this->payment_firstname])
            ->andFilterWhere(['like', 'payment_lastname', $this->payment_lastname])
            ->andFilterWhere(['like', 'payment_company', $this->payment_company])
            ->andFilterWhere(['like', 'payment_address_1', $this->payment_address_1])
            ->andFilterWhere(['like', 'payment_address_2', $this->payment_address_2])
            ->andFilterWhere(['like', 'payment_city', $this->payment_city])
            ->andFilterWhere(['like', 'payment_postcode', $this->payment_postcode])
            ->andFilterWhere(['like', 'payment_country', $this->payment_country])
            ->andFilterWhere(['like', 'payment_zone', $this->payment_zone])
            ->andFilterWhere(['like', 'payment_address_format', $this->payment_address_format])
            ->andFilterWhere(['like', 'payment_custom_field', $this->payment_custom_field])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'payment_code', $this->payment_code])
            ->andFilterWhere(['like', 'shipping_firstname', $this->shipping_firstname])
            ->andFilterWhere(['like', 'shipping_lastname', $this->shipping_lastname])
            ->andFilterWhere(['like', 'shipping_company', $this->shipping_company])
            ->andFilterWhere(['like', 'shipping_address_1', $this->shipping_address_1])
            ->andFilterWhere(['like', 'shipping_address_2', $this->shipping_address_2])
            ->andFilterWhere(['like', 'shipping_city', $this->shipping_city])
            ->andFilterWhere(['like', 'shipping_postcode', $this->shipping_postcode])
            ->andFilterWhere(['like', 'shipping_country', $this->shipping_country])
            ->andFilterWhere(['like', 'shipping_zone', $this->shipping_zone])
            ->andFilterWhere(['like', 'shipping_address_format', $this->shipping_address_format])
            ->andFilterWhere(['like', 'shipping_custom_field', $this->shipping_custom_field])
            ->andFilterWhere(['like', 'shipping_method', $this->shipping_method])
            ->andFilterWhere(['like', 'shipping_code', $this->shipping_code])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'tracking', $this->tracking])
            ->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'forwarded_ip', $this->forwarded_ip])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'accept_language', $this->accept_language]);

        return $dataProvider;
    }
}
