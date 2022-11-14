<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apartment_room_type".
 *
 * @property integer $id
 * @property integer $building_project_id
 * @property string $name
 * @property string $area
 * @property string $price
 * @property string $detail
 * @property string $image_data
 * @property string $create_date
 * @property string $update_date
 *
 * @property BuildingProjectInfo $buildingProject
 */
class ApartmentRoomType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apartment_room_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_project_id', 'name', 'area', 'price', 'detail', 'image_data'], 'required'],
            [['building_project_id'], 'integer'],
            [['detail'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['area', 'price'], 'string', 'max' => 32],
            [['image_data'], 'string', 'max' => 1024],
            [['building_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingProjectInfo::className(), 'targetAttribute' => ['building_project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'building_project_id' => 'Building Project ID',
            'name' => 'Name',
            'area' => 'Area',
            'price' => 'Price',
            'detail' => 'Detail',
            'image_data' => 'Image Data',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingProject()
    {
        return $this->hasOne(BuildingProjectInfo::className(), ['id' => 'building_project_id']);
    }
}
