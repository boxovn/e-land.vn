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
class CommentUserFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_user_feedbacks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_user_id','user_id','comment','like'], 'safe']
          
        ];
    }
    
    /**
     * @inheritdoc
     */
   public function getVoted($comment_user_id, $user_id){
            $vote= self::findOne(['comment_user_id'=>$comment_user_id,'user_id'=>$user_id]);
            return $vote;
    }
	public function getUser(){
		return $this->hasOne(User::className() ,['id' => 'user_id']);
    }
}
