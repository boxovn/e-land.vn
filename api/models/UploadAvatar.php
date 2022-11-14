<?php

namespace api\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
class UploadAvatar extends Model
{
	/**
	 * @var UploadedFile[] files uploaded
	 */
	public $image;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
				[['image'], 'file', 'skipOnEmpty' => false,'extensions' => 'png, jpg'],
		];
	}
	public function upload()
    {
        if ($this->validate()) {

            $this->image->saveAs(Yii::$app->params['PathChannels']  . 'avatar/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}