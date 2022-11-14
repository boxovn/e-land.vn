<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectContact;

/**
 * ProjectContactSearch represents the model behind the search form of `common\models\ProjectContact`.
 */
class ProjectContactSearch extends ProjectContact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'user_id'], 'integer'],
            [['email', 'phone', 'address', 'zalo', 'facebook', 'webiste', 'description'], 'safe'],
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
        $query = ProjectContact::find();

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
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zalo', $this->zalo])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'webiste', $this->webiste])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
