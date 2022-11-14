<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_contacts".
 *
 * @property int $id
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $zalo
 * @property string $facebook
 * @property string $webiste
 * @property string $description
 * @property int $project_id
 * @property int $user_id
 */
class ProjectContact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email', 'phone'], 'required', 'message' => '{attribute} không được bỏ trống'],
            [['project_id', 'user_id'], 'integer'],
            [['email', 'phone', 'address', 'zalo', 'facebook', 'webiste', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Địa chỉ',
            'zalo' => 'Zalo',
            'facebook' => 'Facebook',
            'webiste' => 'Webiste',
            'description' => 'Mô tả',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
        ];
    }
}