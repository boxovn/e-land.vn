<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_price_lists".
 *
 * @property int $id
 * @property string $name
 * @property string $file_name
 * @property int $project_id
 * @property string $created
 */
class ProjectPriceList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_price_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'file_name', 'project_id'], 'required'],
            [['project_id'], 'integer'],
            [['created','type','size'], 'safe'],
            [['name', 'file_name'], 'string', 'max' => 255],
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
        ];
    }
}