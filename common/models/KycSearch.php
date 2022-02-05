<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kyc;

/**
 * KycSearch represents the model behind the search form of `common\models\Kyc`.
 */
class KycSearch extends Kyc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'business_profile_id'], 'integer'],
            [['document_picture', 'self_picture', 'self_picture_with_doc', 'status'], 'safe'],
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
        $query = Kyc::find();

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
            'business_profile_id' => $this->business_profile_id,
        ]);

        $query->andFilterWhere(['ilike', 'document_picture', $this->document_picture])
            ->andFilterWhere(['ilike', 'self_picture', $this->self_picture])
            ->andFilterWhere(['ilike', 'self_picture_with_doc', $this->self_picture_with_doc])
            ->andFilterWhere(['ilike', 'status', $this->status]);

        return $dataProvider;
    }
}
