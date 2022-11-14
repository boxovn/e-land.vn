<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HouseSurvey;
use Yii;
/**
 * HouseSurveySearch represents the model behind the search form of `common\models\HouseSurvey`.
 */
class HouseSurveySearch extends HouseSurvey
{
    /**
     * {@inheritdoc}
     */
    public $partner_name;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['content', 'created','partner_name','status'], 'safe'],
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

        $query = HouseSurvey::find()->joinWith('house')->andWhere(['houses.user_id' =>  Yii::$app->user->identity->id,'house_id' => $params['id']]);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
          $dataProvider->sort->attributes['partner_name'] = [
        'asc' => ['users.name' => SORT_ASC],
        'desc' => ['users.name' => SORT_DESC],
        ];
        $query->joinWith(['partner']); 
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            
          // 'status', $this->status,
           // 'user_id' => $this->user_id,
            //'house_id' => $this->house_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);
        $query->andFilterWhere(['LIKE', 'users.name', $this->partner_name]);
        return $dataProvider;
    }
}
