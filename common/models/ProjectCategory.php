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
class ProjectCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 const show = 1;
    const hiden = 0;
	
    public static function tableName()
    {
        return 'project_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'slug'], 'required', 'message' => '{attribute} không được bỏ trống'],
            [['name', 'status', 'slug', 'sort'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Danh mục tòa nhà',
            'status' => 'Trạng thái',
            'slug' => 'Slug',
            'sort' => 'Sắp xếp',
            'id' => 'Id',
        ];
    }
	  public static function getStatus($html=0) {
        if ($html) {
            return [
                self::show => '<span class="status text-danger">Hiển thị</span>',
                self::hiden => '<span class="status text-warning">Ẩn</span>',
            ];
        } else {

            return [
                self::show => 'Hiển thị',
                self::hiden => 'Ẩn',
            ];
        }
    }

    public static function getListStatus($status=0, $html=0){
        $getStatus= self::getStatus($html);
        if($status){
            return $getStatus[$status];
        }
        return $getStatus[self::hiden];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingProjectInfos()
    {
        return $this->hasMany(BuildingProjectInfo::className(), ['district_id' => 'district_id']);
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
