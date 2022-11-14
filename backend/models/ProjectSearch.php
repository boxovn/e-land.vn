<?php
namespace backend\models;
use Yii;
use common\models\Project;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProjectSearch extends Project{
	
    public function rules()
    {
        // Only fields in rules() are searchable
        return [
            [['status','email', 'name', 'checked_status', 'province_id', 'district_id', 'ward_id','version'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // Bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Project::find();
        //$query->andWhere('status = :status')->addParams([':status' => Project::STATUS_ACTIVE]);
    //    $query->andWhere(['user_id' => Yii::$app->user->identity->id]);
       // $query->orderBy(['created' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
            'created' => SORT_DESC,
             ]
            ],
            'pagination' => array( 
                'pageSize' => Project::ROW_PER_PAGE,
            ),
        ]);
        
      //  if (Yii::$app->user->identity->is_admin != 1) {
        //	$query->andFilterWhere(['checked_status' => [BuildingProjectInfo::WAITING, BuildingProjectInfo::UNCHECKED]]);
       // }
        // Load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // Adjust the query by adding the filters
        $query->andFilterWhere(['like', 'checked_status', $this->checked_status])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'name', $this->name])  
              ->andFilterWhere(['id' => $this->id]);
        if ($this->province_id != 0) {
        	$query->andFilterWhere(['like', 'province_id', $this->province_id]);
        }
        if ($this->district_id != 0) {
        	$query->andFilterWhere(['like', 'district_id', $this->district_id]);
        }
        if ($this->ward_id != 0) {
        	$query->andFilterWhere(['like', 'ward_id', $this->ward_id]);
        }
        
        return $dataProvider;
    }
}