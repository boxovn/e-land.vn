<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Partner;
use Yii;
/**
 * PartnerSearch represents the model behind the search form of `common\models\Partner`.
 */
class PartnerSearch extends Partner
{
    /**
     * {@inheritdoc}
     */
    public $partner_name;
      public $partner_phone;
        public $partner_email;
    public function rules()
    {
        return [
            [['user_id', 'partner_id', 'status'], 'integer'],
            [['created','partner_name','partner_phone','partner_email'], 'safe'],
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
        $query = Partner::find()->andWhere(['user_id' => Yii::$app->user->identity->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
         $dataProvider->sort->attributes['partner_name'] = [
        'asc' => ['users.name' => SORT_ASC],
        'desc' => ['users.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['partner_phone'] = [
        'asc' => ['users.phone' => SORT_ASC],
        'desc' => ['users.phone' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['partner_email'] = [
        'asc' => ['users.email' => SORT_ASC],
        'desc' => ['users.email' => SORT_DESC],
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
            'user_id' => $this->user_id,
            'partner_id' => $this->partner_id,
            'status' => $this->status,
            'created' => $this->created,
        ]);
          $query->andFilterWhere(['LIKE', 'users.name', $this->partner_name]);
          $query->andFilterWhere(['LIKE', 'users.phone', $this->partner_phone]);
          $query->andFilterWhere(['LIKE', 'users.email', $this->partner_email]);

        return $dataProvider;
    }
}
