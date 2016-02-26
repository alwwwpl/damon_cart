<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InviteCode;

/**
 * InviteCodeSearch represents the model behind the search form about `app\models\InviteCode`.
 */
class InviteCodeSearch extends InviteCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invite_code_id', 'agent_id', 'status'], 'integer'],
            [['code', 'date_added'], 'safe'],
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
        $query = InviteCode::find();

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
            'invite_code_id' => $this->invite_code_id,
            'agent_id' => $this->agent_id,
            'status' => $this->status,
            'date_added' => $this->date_added,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}