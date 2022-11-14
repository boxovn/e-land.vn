<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Landings".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $description
 */
class Landing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'landings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'address'], 'required', 'message' => '{attribute} không được để trống'],
            [['name', 'email', 'phone', 'address', 'description'], 'string', 'max' => 255],
            [['address'], 'unique'],
            [['description'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'address' => 'Địa chỉ',
            'description' => 'Mô tả',
        ];
    }
}
