<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $title
 * @property string $description
 * @property string $created
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'title', 'description'], 'required'],
            [['description'], 'string'],
            [['created'], 'safe'],
            [['name', 'email', 'phone', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('contact', 'ID'),
            'name' => Yii::t('contact', 'Name'),
            'email' => Yii::t('contact', 'Email'),
            'phone' => Yii::t('contact', 'Phone'),
            'title' => Yii::t('contact', 'Title'),
            'description' => Yii::t('contact', 'Description'),
            'created' => Yii::t('contact', 'Created'),
        ];
    }
}
