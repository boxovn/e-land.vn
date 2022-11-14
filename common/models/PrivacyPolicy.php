<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "privacy_policy".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created
 */
class PrivacyPolicy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'privacy_policy';
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
            'id' => Yii::t('privacy_policy', 'ID'),
            'title' => Yii::t('privacy_policy', 'Title'),
            'content' => Yii::t('privacy_policy', 'Content'),
            'created' => Yii::t('privacy_policy', 'Created'),
        ];
    }
}
