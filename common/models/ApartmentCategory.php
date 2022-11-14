<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apartment_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property BuildingProjectInfo[] $buildingProjectInfos
 */
class ApartmentCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apartment_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingProjects()
    {
        return $this->hasMany(BuildingProjectInfo::className(), ['apartment_category_id' => 'id']);
    }
}
