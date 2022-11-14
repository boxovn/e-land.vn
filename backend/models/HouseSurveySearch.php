<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HouseSurvey;

/**
 * HouseSurveySearch represents the model behind the search form of `common\models\HouseSurvey`.
 */
class HouseSurveySearch extends HouseSurvey
{
    /**
     * {@inheritdoc}
     */

    public $user_name; 

    public function rules()
    {
        return [
            [['id', 'user_id', 'house_id', 'status'], 'integer'],
            [['content', 'created', 'user_name'], 'safe'],
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

        $query = HouseSurvey::find()->andWhere(['house_id' => $params['id']]);
       // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['user_name'] = [
            'asc' => ['u.name' => SORT_ASC],
            'desc' => ['u.name' => SORT_DESC],
        ];
        $query->joinWith(['user u']); 
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
            'house_id' => $this->house_id,
            'created' => $this->created,
        ]);
         $query->andFilterWhere(['like', 'u.name', $this->user_name]);
        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
