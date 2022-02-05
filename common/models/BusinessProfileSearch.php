<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusinessProfile;

/**
 * BusinessProfileSearch represents the model behind the search form of `common\models\BusinessProfile`.
 */
class BusinessProfileSearch extends BusinessProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'age', 'city_id'], 'integer'],
            [['name', 'gender', 'ethnicity', 'hair_color', 'eye_color', 'measurements', 'affiliation', 'available_to', 'aviability'], 'safe'],
            [['height'], 'number'],
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
        $query = BusinessProfile::find();

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
            'user_id' => $this->user_id,
            'age' => $this->age,
            'height' => $this->height,
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'gender', $this->gender])
            ->andFilterWhere(['ilike', 'ethnicity', $this->ethnicity])
            ->andFilterWhere(['ilike', 'hair_color', $this->hair_color])
            ->andFilterWhere(['ilike', 'eye_color', $this->eye_color])
            ->andFilterWhere(['ilike', 'measurements', $this->measurements])
            ->andFilterWhere(['ilike', 'affiliation', $this->affiliation])
            ->andFilterWhere(['ilike', 'available_to', $this->available_to])
            ->andFilterWhere(['ilike', 'aviability', $this->aviability]);

        return $dataProvider;
    }
}
