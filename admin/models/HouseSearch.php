<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;
use Yii;
/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HouseSearch extends House
{
    /**
     * {@inheritdoc}
     */
    public $count_post;
    public function rules()
    {
        return [
            [['ask'], 'double'],
            [['house_segment_id','ward_id','id', 'status', 'exclusive', 'permission','district_id', 'province_id'], 'integer'],
            [['ask','description', 'created', 'contract_date', 'contract_end_date','street'], 'safe'],
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
        $query = House::find()->select('houses.*, (SELECT COUNT(*) FROM articles AS a WHERE a.house_id = houses.id) as count_post')->andWhere(['<>', 'status', House::DELETE_STATUS])->andWhere(['user_id' => Yii::$app->user->identity->id]);
        //->select('houses.*, (SELECT COUNT(*) FROM articles AS a WHERE a.house_id = houses.id) as total')->andWhere(['<>', 'status', House::DELETE_STATUS])->andWhere(['user_id' => Yii::$app->user->identity->id]);
      //  $query->leftJoin(['articles' => \common\models\Article::find()->select('house_id, count(house_id) as count_post')->groupBy('house_id')], 'articles.house_id = houses.id');
        // add conditions that should always apply here
       //  $query->groupBy('house_id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                
                'defaultOrder' => ['created'=>SORT_DESC]]
        ]);
            
            /*    $dataProvider->sort->attributes['count_post'] = [
            'asc' => ['articles.count_post' => SORT_ASC],
            'desc' => ['articles.count_post' => SORT_DESC],
        ];
        */

       
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
         if(!is_null($this->count_post)){
            $query->andHaving(['=','count_post', $this->count_post]);
        }
        $query->andFilterWhere(['=','created', $this->created]);
        $query->andFilterWhere(['=','permission', $this->permission]);
        $query->andFilterWhere(['=','status' , $this->status]);
        $query->andFilterWhere(['=','district_id' , $this->district_id]);
        $query->andFilterWhere(['=','province_id', $this->province_id]);
        $query->andFilterWhere(['=','employee_id' , $this->employee_id]);
        $query->andFilterWhere(['=','contract_date' , $this->contract_date]);
        $query->andFilterWhere(['=', 'ask', $this->ask]);
        $query->andFilterWhere(['house_segment_id' => $this->house_segment_id]);
        $query->andFilterWhere(['like', 'street', $this->street]);
        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}