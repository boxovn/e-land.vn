<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property integer $class_id
 * @property string $start_date
 * @property integer $status
 * @property integer $max_student
 * @property integer $counting_student
 * @property integer $teacher_id
 * @property integer $type
 * @property integer $special
 * @property integer $finished
 * @property integer $hide
 * @property integer $count_finished
 * @property string $created
 * @property string $comment
 * @property string $link
 *
 * @property Teachers $teacher
 */
class Province extends \yii\db\ActiveRecord {
   
            /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'provinces';
    }

    /**
     * @inheritdoc
     */
     public function rules() {
        return [
            [['name','lat', 'lng', 'slug','type','location','province_id','image','keyword','description'], 'safe'],
           
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => 'Tên',
            'slug' => 'Slug',
            'type' => 'Kiểu',
            'location' => 'Vị Trí',
            
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts() {
        return $this->hasMany(District::className(), ['province_id' => 'province_id']);
    }
	 public function getArticles()
    {
        return $this->hasMany(Article::className(), ['province_id' => 'province_id']);
    }
     public function getProjects() {
        return $this->hasMany(Project::className(), ['province_id' => 'province_id']);
    }
   /*  public function getArticles() {
        return $this->hasMany(Article::className(), ['province_id' => 'province_id']);
    }*/

    

    /**
     * get list status
     * @return type
     */
    
    
    
}
