<?php

namespace backend\models;

use common\models\Buyer;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BuyerSearch extends Buyer {

    public $page;

    public function rules() {
        // only fields in rules() are searchable
        return [
           [['name','phone', 'address', 'finance','region','area','home','direction','alley','ask_date','purpose_of_purchase' ,'note','status'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Buyer::find();
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
        $query->andFilterWhere(['name' => $this->name]);
        $query->andFilterWhere(['page' => $this->page]);

        return $dataProvider;
    }

}
