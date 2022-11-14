<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_users".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property string $created
 *
 * @property Customers $customer
 * @property Users $user
 */
class CustomerUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'customer_id'], 'required'],
            [['user_id', 'customer_id'], 'integer'],
            [['created'], 'safe'],
         //   [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
          //  [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'user_id' => Yii::t('blog', 'User ID'),
            'customer_id' => Yii::t('blog', 'Customer ID'),
            'created' => Yii::t('blog', 'Created'),
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}