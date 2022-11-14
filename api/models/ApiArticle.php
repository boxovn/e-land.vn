<?php
namespace api\models;
use Yii;
use common\models\Article;
use common\models\District;
use common\models\Province;
use common\models\User;
//use yii\base\Model;
class ApiArticle extends Article{
   
  /*   public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }*/
     public function fields()
    {
        return ['id', 'street','title','slug','user_id','district_id','category_id','type_id','province_id','description','content','area_text','price_text','created'];
    }
   public function extraFields()
    {
        return ['images','district','province','user'];
    }
    
      /**
     * get list status
     * @return type
     */
    public function getImages()
    {
        return $this->hasMany(ApiArticleImage::className(), ['article_id' => 'id']);
    }
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'district_id']);
    }
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
}