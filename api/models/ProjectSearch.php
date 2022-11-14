<?php 
namespace api\models;
use Yii;
use yii\base\Model;
use api\models\ApiProject;

class ProjectSearch extends ApiProject 
{
  
    public $name;
    public function rules()
    {
        return [
            [['name'], 'string'],
                    
        ];
    }
 
    public function search($params)
    {
        $query = ApiProject::find();
        $dataProvider =  new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
           
        // load the search form data and validate
        if (!($this->load($params,'') && $this->validate())) {
            return $dataProvider;
        }
       
        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'name', $this->name]);
     

        return $dataProvider;
    }
}