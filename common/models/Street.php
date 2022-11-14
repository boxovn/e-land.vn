<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "streets".
 *
 * @property int $street_id
 * @property string $name
 * @property string $type
 * @property string $slug
 * @property int $district_id
 *
 * @property BuildingProjectInfo[] $buildingProjectInfos
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'streets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'slug', 'district_id'], 'required'],
            [['district_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 128],
            [['type'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'street_id' => 'Street ID',
            'name' => 'Name',
            'type' => 'Type',
            'slug' => 'Slug',
            'district_id' => 'District ID',
        ];
    }

    /**
     * Gets query for [[BuildingProjectInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingProjectInfos()
    {
        return $this->hasMany(BuildingProjectInfo::className(), ['street_id' => 'street_id']);
    }
}
