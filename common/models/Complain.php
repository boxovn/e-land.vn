<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "complains".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created
 */
class Complain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'complains';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('complain', 'ID'),
            'title' => Yii::t('complain', 'Title'),
            'content' => Yii::t('complain', 'Content'),
            'created' => Yii::t('complain', 'Created'),
        ];
    }
}
