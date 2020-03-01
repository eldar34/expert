<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BusinessTrip;

/**
 * BusinessTripSearch represents the model behind the search form of `app\models\BusinessTrip`.
 */
class BusinessTripSearch extends BusinessTrip
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_count', 'user_amount', 'user_total', 'status', 'created_by', 'updated_by'], 'integer'],
            [['full_name', 'user_post', 'company', 'begin_date', 'end_date', 'user_object', 'user_project', 'user_direction', 'trip_target', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BusinessTrip::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
            'date_count' => $this->date_count,
            'user_amount' => $this->user_amount,
            'user_total' => $this->user_total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_post', $this->user_post])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'user_object', $this->user_object])
            ->andFilterWhere(['like', 'user_project', $this->user_project])
            ->andFilterWhere(['like', 'user_direction', $this->user_direction])
            ->andFilterWhere(['like', 'trip_target', $this->trip_target]);

        return $dataProvider;
    }
}
