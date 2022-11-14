<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sliders".
 *
 * @property int $id
 * @property string $url
 * @property string $image
 * @property string $title
 * @property string $description
 * @property int $user_id
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sliders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'image', 'title', 'description', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['url', 'image', 'title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('slider', 'ID'),
            'url' => Yii::t('slider', 'Url'),
            'image' => Yii::t('slider', 'Image'),
            'title' => Yii::t('slider', 'Title'),
            'description' => Yii::t('slider', 'Description'),
            'user_id' => Yii::t('slider', 'User ID'),
        ];
    }
}
