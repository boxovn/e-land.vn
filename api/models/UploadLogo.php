<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadLogo extends Model
{
	/**
	 * @var UploadedFile[] files uploaded
	 */
	public $logo;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
				[['logo'], 'file', 'skipOnEmpty' => false,'extensions' => 'png, jpg'],
		];
	}
	public function upload()
    {
        if ($this->validate()) {

            $this->logo->saveAs(Yii::$app->params['PathChannels']  . 'logo/' . $this->logo->baseName . '.' . $this->logo->extension);
            return true;
        } else {
            return false;
        }
    }
}