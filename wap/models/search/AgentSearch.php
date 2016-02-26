<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agent;

/**
 * AgentSearch represents the model behind the search form about `app\models\Agent`.
 */
class AgentSearch extends Agent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agent_id', 'province_id', 'city_id', 'area_id', 'agent_province_id', 'agent_city_id', 'agent_area_id', 'status', 'parent_id', 'type'], 'integer'],
            [['username', 'password', 'phone', 'email', 'contact', 'id_code', 'id_file', 'company_short_name', 'company_name', 'business_license', 'business_license_file', 'date_added', 'date_modified'], 'safe'],
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
        $query = Agent::find();

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
            'agent_id' => $this->agent_id,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'agent_province_id' => $this->agent_province_id,
            'agent_city_id' => $this->agent_city_id,
            'agent_area_id' => $this->agent_area_id,
            'status' => $this->status,
            'parent_id' => $this->parent_id,
            'type' => $this->type,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'id_code', $this->id_code])
            ->andFilterWhere(['like', 'id_file', $this->id_file])
            ->andFilterWhere(['like', 'company_short_name', $this->company_short_name])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'business_license', $this->business_license])
            ->andFilterWhere(['like', 'business_license_file', $this->business_license_file]);

        return $dataProvider;
    }
}
