<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile[] files uploaded
	 */
	public $file;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
				[['file'], 'file', 'skipOnEmpty' => false],
		];
	}
}