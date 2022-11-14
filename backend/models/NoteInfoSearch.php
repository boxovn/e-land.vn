<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NoteInfo;

/**
 * NoteInfoSearch represents the model behind the search form of `common\models\NoteInfo`.
 */
class NoteInfoSearch extends NoteInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id','area', 'width', 'lenth', 'price', 'direction', 'alley', 'district_id', 'province_id', 'status'], 'integer'],
            [['title', 'name', 'phone', 'street', 'home', 'content', 'created', 'deposit_date'], 'safe'],
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
        $query = NoteInfo::find();

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
            'area' => $this->area,
            'width' => $this->width,
            'lenth' => $this->lenth,
            'price' => $this->price,
            'direction' => $this->direction,
            'alley' => $this->alley,
            'district_id' => $this->district_id,
            'province_id' => $this->province_id,
            'status' => $this->status,
            'created' => $this->created,
          //  'deposit_date' => $this->deposit_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'home', $this->home])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
