<?php

namespace common\models;
use Yii;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string $last_login_token
 * @property integer $status
 * @property datetime create_date
 */
class Customer extends \yii\db\ActiveRecord{
     /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            
           [['client_id'], 'string','max'=> 255],
            [['address', 'email', 'name', 'website'], 'string', 'max' => 255],
         
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Id',
            'client_id' => 'Client Id',
           
        ];
    }
    public function getCustomerUsers()
    {
        return $this->hasMany(CustomerUser::className(), ['customer_id' => 'id']);
    }
	/**
     * @inheritdoc
     */
    
    
    
}