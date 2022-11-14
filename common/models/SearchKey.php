<?php

namespace common\models;

use Yii;

class SearchKey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'search_key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key_text', 'user_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key',
            'user_id' => 'user id',
        ];
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
