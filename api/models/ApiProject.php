<?php
namespace api\models;
use Yii;
use common\models\Project;
use common\models\District;
use common\models\Province;
use common\models\User;
use common\models\ImageProject;
use common\models\ProjectBanner;
//use yii\base\Model;
class ApiProject extends Project{
   
  /*   public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }*/
     public function fields()
    {
        return ['id', 'name','status','investor','created'];
    }
   public function extraFields()
    {
        return ['images','banners','district','province','user'];
    }
    
      /**
     * get list status
     * @return type
     */
    public function getImages()
    {
        return $this->hasMany(ImageProject::className(), ['building_project_id' => 'id']);
    }
    public function getBanners()
    {
        return $this->hasMany(ProjectBanner::className(), ['project_id' => 'id']);
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
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
    
}