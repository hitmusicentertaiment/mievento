<?php

namespace common\models;

use yii\data\ActiveDataProvider;

class StateSearch extends State
{

    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['name', 'code_2', 'code_3'], 'string', 'max' => 255],
            [['longitude', 'latitude'], 'string', 'max' => 12],];
    }

    public function search($params, $loadFilterForm = false){
        $query = State::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $loadFilterForm ? $this->load($params, 'filter') : $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }
        $query->andFilterWhere([
            'name' => $this->name,
            'code_2' => $this->code_2,
            'code_3' => $this->code_3,
        ]);

        if(isset($this->country_id)){
            $query->andWhere(['country_id' => $this->country_id]);
        }
        return $dataProvider;
    }
}
