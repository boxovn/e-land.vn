<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $updated
 * @property int $created
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'updated', 'created','price'], 'required'],
            [['status', 'updated', 'created'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'status' => 'Trạng thái',
            'updated' => 'Ngày cập nhập',
            'created' => 'Ngày Tạo',
			'price' => 'Giá'
        ];
    }
}