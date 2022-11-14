<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property string $created
 * @property int $download
 * @property int $view
 * @property int $status
 */
class Tool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tools';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'url', 'created', 'download', 'view', 'status'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['download', 'view', 'status'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tool', 'ID'),
            'title' => Yii::t('tool', 'Title'),
            'content' => Yii::t('tool', 'Content'),
            'url' => Yii::t('tool', 'Url'),
            'created' => Yii::t('tool', 'Created'),
            'download' => Yii::t('tool', 'Download'),
            'view' => Yii::t('tool', 'View'),
            'status' => Yii::t('tool', 'Status'),
        ];
    }
}
