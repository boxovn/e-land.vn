<?php

namespace backend\models;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User {

    public $page;

    public function rules() {
        // only fields in rules() are searchable
        return [
            [['name','phone', 'email','active','created_at'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = User::find()->andWhere(['page_name' => '']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array(
                'pageSize' => 20,
            ),
             'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ]
                ],
        ]);
        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // adjust the query by adding the filters
        $query->andFilterWhere(['created_at' => $this->created_at]);
        $query->andFilterWhere(['active' => $this->active]);
        $query->andFilterWhere(['name' => $this->name]);
        $query->andFilterWhere(['page' => $this->page]);

        return $dataProvider;
    }
    public function batdongsan_search($params) {
        $query = User::find()->andWhere(['page_name' => 'batdongsan.com.vn']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array(
                'pageSize' => 20,
            ),
             'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ]
                ],
        ]);
        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // adjust the query by adding the filters
        $query->andFilterWhere(['created_at' => $this->created_at]);
        $query->andFilterWhere(['active' => $this->active]);
        $query->andFilterWhere(['name' => $this->name]);
        $query->andFilterWhere(['page' => $this->page]);

        return $dataProvider;
    }

}