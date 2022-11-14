<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property integer $building_project_id
 * @property string $url
 * @property string $create_date
 * @property string $update_date
 */
class ImageProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
        	[['building_project_id'], 'integer'],
            [['created', 'update'], 'safe'],
            [['url'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

}
