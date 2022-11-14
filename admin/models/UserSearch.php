<?php

namespace admin\models;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User {

    public $page;

    public function rules() {
        // only fields in rules() are searchable
        return [
            [['name','phone', 'email'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ]);


        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // adjust the query by adding the filters
        $query->andFilterWhere(['title' => $this->title]);
        $query->andFilterWhere(['page' => $this->page]);

        return $dataProvider;
    }

}
