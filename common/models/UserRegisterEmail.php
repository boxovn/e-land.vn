<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_register_email".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $province_id
 * @property int $district_id
 * @property int $category_type_id
 * @property string $created
 * @property int $user_id
 * @property int $status
 */
class UserRegisterEmail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_register_email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'province_id', 'district_id', 'category_type_id'], 'required','message' => '{attribute} đang để trống'],
            [['province_id', 'district_id', 'category_type_id', 'user_id', 'status'], 'integer'],
            [['created'], 'safe'],
            [['name', 'phone', 'email','ip'], 'string', 'max' => 255],
            [['email'], 'unique','message' => '{attribute} đã có người sử dụng'],
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
            'phone' => 'Điện thoại',
            'email' => 'Email',
            'province_id' => 'Tỉnh/Thành',
            'district_id' => 'Quận/Huyện',
            'category_type_id' => 'Loại hình',
            'created' => 'Ngày tạo',
            'user_id' => 'Người dùng',
            'status' => 'Trạng thái',
        ];
    }
}
