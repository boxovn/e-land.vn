<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;
use common\models\Partner;
use yii\helpers\ArrayHelper;

use Yii;
/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HouseIndexSearch extends House
{
    /**
     * {@inheritdoc}
     */
    public $user_name;
    public function rules()
    {
        return [
            [['id', 'status', 'exclusive', 'permission','district_id', 'province_id'], 'integer'],
            [['description', 'created', 'contract_date', 'contract_end_date','user_id','user_name','street'], 'safe'],
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
        $partners = Partner::find()->andWhere(['user_id' => Yii::$app->user->identity->id])->select('partner_id')->asArray()->all();
        $ids = ArrayHelper::getColumn($partners, function ($element) {
                    return (int)$element['partner_id'];
                });
        array_push($ids, Yii::$app->user->identity->id);
       $query = House::find()->alias('h')->andWhere(['<>', 'h.status', House::DELETE_STATUS])->andWhere(['user_id' => $ids]);

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
            'h.district_id' => $this->district_id,
            'h.province_id' => $this->province_id,
            'exclusive' => $this->exclusive,
            'employee_id' => $this->employee_id,
            'contract_date' => $this->contract_date,
            'contract_end_date' => $this->contract_end_date,
            'permission' => $this->permission
        ]);
        $query->andFilterWhere(['like', 'u.name', $this->user_name]);
        $query->andFilterWhere(['like', 'h.street', $this->street]);
        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
