<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Event;

/**
 * EventSearch represents the model behind the search form of `common\models\Event`.
 */
class EventSearch extends Event
{
    public $cities;
    public $from;
    public $to;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'min_age', 'place_id', 'user_id'], 'integer'],
            [['name', 'start_datetime', 'end_datetime', 'address', 'information', 'flayer', 'outfit', 'cities', 'drinks', 'hashtags', 'from', 'to'], 'safe'],
            [['price', 'longitude', 'latitude'], 'number'],
        ];
    }

    public function load($data, $formName = null)
    {
        if(!parent::load($data, $formName)){
            return false;
        }
        if(!empty($this->cities) && !is_array($this->cities)){
            $this->cities = explode(',', $this->cities);
        }
        return true;
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
        $query = Event::find();

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
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'price' => $this->price,
            'min_age' => $this->min_age,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'place_id' => $this->place_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'information', $this->information])
            ->andFilterWhere(['like', 'flayer', $this->flayer])
            ->andFilterWhere(['like', 'drinks', $this->flayer])
            ->andFilterWhere(['like', 'hashtags', $this->flayer])
            ->andFilterWhere(['like', 'outfit', $this->outfit]);

        if(!empty($this->cities)){
            $query->innerJoin("place", "place.id=place_id")
                ->andWhere(['place.city_id' => $this->cities]);
        }

        if(!empty($this->from)){
            $query->andWhere(['>=','DATE(start_datetime)', $this->from]);
        }

        if(!empty($this->to)){
            $query->andWhere(['<','DATE(start_datetime)', $this->to]);
        }


        return $dataProvider;
    }
}
