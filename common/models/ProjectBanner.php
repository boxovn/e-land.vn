<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_banners".
 *
 * @property int $id
 * @property string $name
 * @property string $file_name
 * @property int $project_id
 * @property string $created
 * @property int $user_id
 * @property string $size File size
 * @property string $type
 */
class ProjectBanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'file_name', 'project_id', 'user_id', 'size', 'type'], 'required'],
            [['project_id', 'user_id'], 'integer'],
            [['created'], 'safe'],
            [['name', 'file_name', 'size', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'file_name' => 'File Name',
            'project_id' => 'Project ID',
            'created' => 'Created',
            'user_id' => 'User ID',
            'size' => 'Size',
            'type' => 'Type',
        ];
    }
}
