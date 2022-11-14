<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;
use Yii;
/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HousePartnerSearch extends House
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'exclusive', 'permission','district_id','province_id','street'], 'integer'],
            [['description', 'created', 'contract_date', 'contract_end_date'], 'safe'],
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
        $query = House::find()->andWhere(['user_id' => $params['partner_id']])
          ->andWhere('status!= :status',[':status' => 9]);

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
            'created' => $this->created,
            'status' => $this->status,
            'exclusive' => $this->exclusive,
            'employee_id' => $this->employee_id,
            'contract_date' => $this->contract_date,
            'contract_end_date' => $this->contract_end_date,
            'permission' => $this->permission,
            'province_id' => $this->province_id,
        ]);
          $query->andFilterWhere(['like', 'street', $this->street]);
        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
