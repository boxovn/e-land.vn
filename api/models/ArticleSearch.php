<?php 
namespace api\models;
use Yii;
use yii\base\Model;
use api\models\ApiArticle;

class ArticleSearch extends ApiArticle 
{
  
    public $min_price;
    public $max_price;
    public $min_area;
    public $max_area;
    public function rules()
    {
        return [
            [['district_id','type_id','category_id'], 'integer'],
                    
        ];
    }
 
    public function search($params,$users)
    {
        $query = ApiArticle::find()->andWhere(['user_id' => $users]);
        $dataProvider =  new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
          
        // load the search form data and validate
        if (!($this->load($params,'') && $this->validate())) {
            return $dataProvider;
        }
        // adjust the query by adding the filters
        $query->andFilterWhere(['=', 'district_id', $this->district_id]);
        $query->andFilterWhere(['=', 'category_id', $this->category_id]);
        $query->andFilterWhere(['=', 'type_id', $this->type_id]);
        $query->andFilterWhere(['>', 'price', $this->min_price]);
        $query->andFilterWhere(['<', 'price', $this->max_price]);
        $query->andFilterWhere(['>', 'area', $this->min_area]);
        $query->andFilterWhere(['<', 'area', $this->max_area]);
        return $dataProvider;
    }
}