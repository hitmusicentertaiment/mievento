<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;
use yii\db\ActiveQuery;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    public $userId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'business_profile_id', 'userId'], 'integer'],
            [['bio', 'status'], 'safe'],
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
        $query = Post::find();

        if(isset($this->userId)){
            $query->innerJoinWith(['businessProfile' => function(ActiveQuery $q){
                $q->andWhere(['user_id' => $this->userId]);
            }]);
        }

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
            'type_id' => $this->type_id,
            'business_profile_id' => $this->business_profile_id,
        ]);

        $query->andFilterWhere(['ilike', 'bio', $this->bio])
            ->andFilterWhere(['ilike', 'status', $this->status]);

        return $dataProvider;
    }
}
