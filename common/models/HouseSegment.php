<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "house_segments".
 *
 * @property int $id
 * @property string $title
 * @property int $min
 * @property int $max
 */
class HouseSegment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house_segments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'min', 'max'], 'required'],
            [['min', 'max'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'min' => 'Min',
            'max' => 'Max',
        ];
    }
}
