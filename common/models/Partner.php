<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property int $user_id
 * @property int $partner_id
 * @property int $status
 * @property string $created
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id',], 'required'],
            [['user_id', 'partner_id', 'status'], 'integer'],
            [['created'], 'safe'],
            [['comfirm_token'], 'unique', 'targetAttribute' => ['comfirm_token'],'message' => 'Mã kích hoạt đã tạo'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Đầu chủ',
            'partner_id' => 'Đối tác',
            'status' => 'Trạng thái',
            'created' => 'Ngày tạo',
        ];
    }
     public function getPartner()
    {
        return $this->hasOne(User::className(), ['id' => 'partner_id']);
    }
     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
