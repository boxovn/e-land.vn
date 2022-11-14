<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property int $title
 * @property string $content
 * @property string $created
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title'], 'string','max' => 255],
            [['created','content','address','lat','lng','description','email','phone','facebook','zalo','youtube','company'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('about', 'ID'),
            'title' => Yii::t('about', 'Title'),
            'content' => Yii::t('about', 'Content'),
            'created' => Yii::t('about', 'Created'),
        ];
    }
}