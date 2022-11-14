<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "house_surveys".
 *
 * @property int $id
 * @property int $user_id
 * @property int $house_id
 * @property string $content
 * @property string $created
 */
class HouseSurvey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house_surveys';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['user_id', 'house_id', 'content'], 'required'],
            [['user_id', 'house_id','status'], 'integer'],
            [['content'], 'string'],
            [['created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Nhân viên',
            'house_id' => 'Nguồn nhà',
            'content' => 'Nội dung',
            'created' => 'Ngày tạo',
        ];
    }
    public function getEmployee(){
    
    return $this->hasOne(Employee::className() ,['id' => 'user_id']);
    }
    public function getPartner(){
    
    return $this->hasOne(User::className() ,['id' => 'user_id']);
    }
     public function getUser(){
    
    return $this->hasOne(User::className() ,['id' => 'user_id']);
    }
    public function getHouse(){
    
    return $this->hasOne(House::className() ,['id' => 'house_id']);
    }
    public function getImages()
    {
        return $this->hasMany(ArticleImage::className(), ['house_survey_id' => 'id']);
    }
}
