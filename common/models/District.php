<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $district_id
 * @property string $name
 * @property string $type
 * @property string $slug
 * @property string $location
 * @property string $province_id
 *
 * @property BuildingProjectInfo[] $buildingProjectInfos
 * @property Province $province
 * @property Street[] $streets
 * @property Ward[] $wards
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_id', 'name', 'type', 'slug', 'location', 'province_id'], 'required'],
            [['district_id', 'province_id'], 'string', 'max' => 5],
            [['name', 'slug'], 'string', 'max' => 128],
            [['type', 'location'], 'string', 'max' => 32],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'province_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'district_id' => 'District ID',
            'name' => 'Name',
            'type' => 'Type',
            'slug' => 'Slug',
            'location' => 'Location',
            'province_id' => 'Province ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['district_id' => 'district_id']);
    }
	 public function getArticles()
    {
        return $this->hasMany(Article::className(), ['district_id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Street::className(), ['district_id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWards()
    {
        return $this->hasMany(Ward::className(), ['district_id' => 'district_id']);
    }
}
