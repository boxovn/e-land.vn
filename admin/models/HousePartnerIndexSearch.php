<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Partner;
use Yii;
/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HousePartnerIndexSearch extends Partner
{
    /**
     * {@inheritdoc}
     */
     public $description;
      public $permission;
        public $exclusive;
        
        public $created;
        public $contract_date;
        public $contract_end_date;

    public function rules()
    {
        return [
            [['id', 'status', 'exclusive', 'permission'], 'integer'],
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
        $query = Partner::find()->andWhere(['partners.user_id' => Yii::$app->user->identity->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['partner_name'] = [
             'asc' => ['partners.name' => SORT_ASC],
             'desc' => ['partners.name' => SORT_DESC],
        ];
         $query->joinWith(['partner']); 
     //    $query->joinWith(['house']); 
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
      /*  $query->andFilterWhere([
          //  'id' => $this->id,
            'created' => $this->created,
            'status' => $this->status,
            'exclusive' => $this->exclusive,
            'employee_id' => $this->employee_id,
            'contract_date' => $this->contract_date,
            'contract_end_date' => $this->contract_end_date,
            'permission' => $this->permission
        ]);
*/
    //    $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
