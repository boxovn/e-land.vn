<?php

namespace admin\models;

use common\models\Admin;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminSearch extends Admin {
	
    public function rules()
    {
        // Only fields in rules() are searchable
        return [
            [['email', 'username'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Admin::find();
        $query->andWhere('status = :status')->addParams([':status' => Admin::STATUS_ACTIVE]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array ( 
                'pageSize' => Admin::ROW_PER_PAGE,
            ),
        ]);

        // Load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // Adjust the query by adding the filters
        $query->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}