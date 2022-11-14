<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_infos".
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
 * @property string $logo
 */
class CustomerInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_infos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'email', 'phone', 'title'], 'required'],
            [['description', 'content'], 'string'],
            [['customer_id'], 'integer'],
            [['address', 'email', 'phone', 'website', 'title', 'hdLat', 'hdLong', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer_info', 'ID'),
            'address' => Yii::t('customer_info', 'Address'),
            'email' => Yii::t('customer_info', 'Email'),
            'phone' => Yii::t('customer_info', 'Phone'),
            'website' => Yii::t('customer_info', 'Website'),
            'description' => Yii::t('customer_info', 'Description'),
            'title' => Yii::t('customer_info', 'Title'),
            'hdLat' => Yii::t('customer_info', 'Hd Lat'),
            'hdLong' => Yii::t('customer_info', 'Hd Long'),
            'content' => Yii::t('customer_info', 'Content'),
            'user_id' => Yii::t('customer_info', 'User ID'),
            'logo' => Yii::t('customer_info', 'Logo'),
        ];
    }
}