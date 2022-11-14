<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ProjectUploadSectionImage extends Model
{
	/**
	 * @var UploadedFile[] files uploaded
	 */
	public $imageFile;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
				[['imageFile'], 'file',	
					 /*'extensions' => ['jpg', 'jpeg', 'png'], 
					 'mimeTypes' => ['image/jpg', 'image/jpeg', 'image/png'], */ 
					//'maxFiles' => 10,
					'skipOnEmpty' => false],
		];
		
	}
}