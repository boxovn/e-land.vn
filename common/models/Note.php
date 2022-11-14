<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $created
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'content'], 'required'],
            [['content'], 'string'],
            [['created','status'], 'safe'],
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
            'name' => 'Tên đầu chủ',
            'content' => 'Nội dung',
            'created' => 'Ngày tạo',
			'status' => 'Trạng thái',
            'employee_id' => 'Nhân viên'
        ];
    }
	public function getNoteInfo(){
    
    return $this->hasOne(NoteInfo::className() ,['note_id' => 'id']);
    }
	public function getEmployee(){
    
    return $this->hasOne(Employee::className() ,['id' => 'employee_id']);
    }
	  public function getImages()
    {
        return $this->hasMany(ArticleImage::className(), ['note_id' => 'id']);
    }
}
