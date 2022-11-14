<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;

/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HouseSearch extends House
{
    /**
     * {@inheritdoc}
     */
    public $user_name;
    public function rules()
    {
        return [
            [['id', 'status', 'exclusive', 'user_id','district_id', 'province_id'], 'integer'],
            [['description', 'user_name','created', 'contract_date', 'contract_end_date','street'], 'safe'],
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
        $query = House::find()
        ->alias('h')
        /*->select([
            'h.district_id'=>'district_id',
            'h.province_id' => 'province_id',
            'h.status' => 'status',
        ])*/
        ->andWhere(['<>','h.status', House::DELETE_STATUS]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created'=>SORT_DESC]]
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
            'created' => $this->created,
            'h.status' => $this->status,
            'exclusive' => $this->exclusive,
            'employee_id' => $this->employee_id,
            'h.province_id' => $this->province_id,
            'h.district_id' => $this->district_id,
            'contract_date' => $this->contract_date,
            'contract_end_date' => $this->contract_end_date,
            'u.name' => $this->user_name,
        ]);
        $query->andFilterWhere(['like', 'h.street', $this->street]);
        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
