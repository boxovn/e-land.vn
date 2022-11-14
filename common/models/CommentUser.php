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
class CommentUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['user_id', 'article_id','created','rating','like'], 'safe'],
          
        ];
    }
    public function getUser(){
    
    return $this->hasOne(User::className() ,['id' => 'user_id']);
    }
	public function getCommentUserVotes()
    {
        return $this->hasMany(CommentUserVote::className(), ['comment_user_id' => 'id']);
    }
	public function getCommentUserFeedbacks()
    {
        return $this->hasMany(CommentUserFeedback::className(), ['comment_user_id' => 'id']);
    }
  //  public function getSender(){
      //  return $this->hasOne(User::className(), ['id'=>'sender_id']);
   // }
  //   public function getReceiver(){
   //     return $this->hasOne(User::className(), ['id'=>'receiver_id']);
   // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Comment ID',
            'teacher_id' => 'Class Student ID',
            'star' => 'Star',
            'like' => 'Like',
            'created' => 'Created',
            'comment' => 'Comment'
        ];
    }
}
