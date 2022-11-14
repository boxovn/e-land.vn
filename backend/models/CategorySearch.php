<?php

namespace backend\models;

use common\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category {

    public $page;

    public function rules() {
        // only fields in rules() are searchable
        return [
            [['title','sort','status'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Category::find();
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
        $query->andFilterWhere(['sort' => $this->sort]);
        $query->andFilterWhere(['status' => $this->status]);

        return $dataProvider;
    }

}
