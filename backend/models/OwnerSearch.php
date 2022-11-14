<?php

namespace backend\models;

use common\models\Owner;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OwnerSearch extends Owner {

    public $page;

    public function rules() {
        // only fields in rules() are searchable
        return [
           [['name','phone', 'address', 'price','unit','area','home','direction','alley','deposit_date','sub_district' ,'note','street','owner','status'], 'safe'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Owner::find();
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
        $query->andFilterWhere(['like','name', $this->name]);
		  $query->andFilterWhere(['like','phone', $this->phone]);
		    $query->andFilterWhere(['like','address', $this->address]);
			  $query->andFilterWhere(['=','price', $this->price]);
			    $query->andFilterWhere(['like','unit', $this->unit]);
				  $query->andFilterWhere(['like','area', $this->area]);
				    $query->andFilterWhere(['like','home', $this->home]);
					  $query->andFilterWhere(['like','direction', $this->direction]);
					    $query->andFilterWhere(['like','alley', $this->alley]);
						  $query->andFilterWhere(['like','deposit_date', $this->deposit_date]);
						    $query->andFilterWhere(['like','sub_district', $this->sub_district]);
							  $query->andFilterWhere(['like','note', $this->note]);
							    $query->andFilterWhere(['like','owner', $this->owner]);
								  $query->andFilterWhere(['=','status', $this->status]);
     
        return $dataProvider;
    }

}
