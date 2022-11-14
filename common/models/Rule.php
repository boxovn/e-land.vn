<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rules".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created
 */
class Rule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rule', 'ID'),
            'title' => Yii::t('rule', 'Title'),
            'content' => Yii::t('rule', 'Content'),
            'created' => Yii::t('rule', 'Created'),
        ];
    }
}
