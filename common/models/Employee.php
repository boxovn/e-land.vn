<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $identity_card
 * @property int $position
 * @property int $status
 * @property string $password_hash
 * @property string $created
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => '{attribute} không được bỏ trống'],
           [['created','email', 'phone', 'address', 'identity_card', 'position', 'status', 'password_hash'], 'safe'],
            [['name', 'email', 'phone', 'address', 'identity_card', 'password_hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'address' => 'Đại chỉ',
            'identity_card' => 'CMND',
            'position' => 'Chức vụ',
            'status' => 'Trạng thái',
            'password_hash' => 'Mật khẩu',
            'created' => 'Ngày tạo',
        ];
    }
}
