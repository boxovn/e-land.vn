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
class Policies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'amount'], 'required'],
            
        ];
    }

}