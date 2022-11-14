<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $question_text
 * @property string $answer_text
 * @property string $created
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_text', 'answer_text'], 'required'],
            [['question_text', 'answer_text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('question', 'ID'),
            'question_text' => Yii::t('question', 'Question Text'),
            'answer_text' => Yii::t('question', 'Answer Text'),
            'created' => Yii::t('question', 'Created'),
            
        ];
    }
    public function behaviors()
{
    return [
        'slug' => [
            'class' => 'skeeks\yii2\slug\SlugBehavior',
            'slugAttribute' => 'slug',                      //The attribute to be generated
            'attribute' => 'question_text',                          //The attribute from which will be generated
            // optional params
            'maxLength' => 64,                              //Maximum length of attribute slug
            'minLength' => 3,                               //Min length of attribute slug
            'ensureUnique' => true,
            'slugifyOptions' => [
                'lowercase' => true,
                'separator' => '-',
                'trim' => true
                //'regexp' => '/([^A-Za-z0-9]|-)+/',
                //'rulesets' => ['russian'],
                //@see all options https://github.com/cocur/slugify
            ]
        ]
    ];
}
}