<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ward".
 *
 * @property string $ward_id
 * @property string $name
 * @property string $type
 * @property string $slug
 * @property string $location
 * @property string $district_id
 *
 * @property BuildingProjectInfo[] $buildingProjectInfos
 * @property District $district
 */
class Ward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ward_id', 'name', 'type', 'slug', 'location', 'district_id'], 'required'],
            [['ward_id', 'district_id'], 'string', 'max' => 5],
            [['name', 'slug'], 'string', 'max' => 128],
            [['type', 'location'], 'string', 'max' => 32],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'district_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ward_id' => 'Ward ID',
            'name' => 'Name',
            'type' => 'Type',
            'slug' => 'Slug',
            'location' => 'Location',
            'district_id' => 'District ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingProjectInfos()
    {
        return $this->hasMany(BuildingProjectInfo::className(), ['ward_id' => 'ward_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'district_id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['ward_id' => 'ward_id']);
    }
}