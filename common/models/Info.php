<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "infos".
 *
 * @property int $id
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $website
 * @property string $description
 * @property string $title
 * @property string $hdLat
 * @property string $hdLong
 * @property string $content
 * @property int $user_id
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'infos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'email', 'phone', 'website', 'description', 'title', 'hdLat', 'hdLong', 'content', 'user_id'], 'required'],
            [['description', 'content'], 'string'],
            [['user_id'], 'integer'],
            [['address', 'email', 'phone', 'website', 'title', 'hdLat', 'hdLong'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('info', 'ID'),
            'address' => Yii::t('info', 'Address'),
            'email' => Yii::t('info', 'Email'),
            'phone' => Yii::t('info', 'Phone'),
            'website' => Yii::t('info', 'Website'),
            'description' => Yii::t('info', 'Description'),
            'title' => Yii::t('info', 'Title'),
            'hdLat' => Yii::t('info', 'Hd Lat'),
            'hdLong' => Yii::t('info', 'Hd Long'),
            'content' => Yii::t('info', 'Content'),
            'user_id' => Yii::t('info', 'User ID'),
        ];
    }
}
