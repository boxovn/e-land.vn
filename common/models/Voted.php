<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $comment_id
 * @property integer $class_student_id
 * @property string $lession
 * @property string $begin_level
 * @property string $current_level
 * @property string $content
 * @property integer $student_id
 * @property integer $teacher_id
 * @property string $created
 */
class Voted extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'voted';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id'], 'safe']
          
        ];
    }
    
    /**
     * @inheritdoc
     */
   public function getVoted($id, $student_id){
            $vote= self::findOne(['id'=>$id,'student_id'=>$student_id]);
            return $vote;
    }
}
