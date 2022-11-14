<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_contacts".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $title
 * @property string $description
 * @property string $created
 * @property int $customer_id
 */
class CustomerContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['customer_id'], 'integer'],
            [['name', 'email', 'phone', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer_contact', 'ID'),
            'name' => Yii::t('customer_contact', 'Name'),
            'email' => Yii::t('customer_contact', 'Email'),
            'phone' => Yii::t('customer_contact', 'Phone'),
            'title' => Yii::t('customer_contact', 'Title'),
            'description' => Yii::t('customer_contact', 'Description'),
            'created' => Yii::t('customer_contact', 'Created'),
            'customer_id' => Yii::t('customer_contact', 'Customer ID'),
        ];
    }
}