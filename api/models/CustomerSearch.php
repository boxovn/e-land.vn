<?php
namespace api\models;
use yii\base\Model;
use common\models\Customer;
class CustomerSearch extends Model 
{
    public $id;
    public $client_id;
    
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['client_id', 'string', 'min' => 2, 'max' => 200],            
        ];
    }


 public function search($params){
     
     $filter = new \yii\data\ActiveDataFilter([
    'searchModel' => '\api\models\CustomerSearch'
]);

$filterCondition = null;

// You may load filters from any source. For example,
// if you prefer JSON in request body,
// use Yii::$app->request->getBodyParams() below:
if ($filter->load(\Yii::$app->request->get())) { 
    $filterCondition = $filter->build();
    if ($filterCondition === false) {
        // Serializer would get errors out of it
        return $filter;
    }
}

$query = Customer::find();
if ($filterCondition !== null) {
    $query->andWhere($filterCondition);
}

return new \yii\data\ActiveDataProvider([
    'query' => $query,
]);
 }
 
}
?>