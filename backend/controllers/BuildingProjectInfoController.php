<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use common\models\ImageProject;
use common\models\Ward;
use common\models\Street;
use common\models\District;
use common\models\Province;
use common\models\ServiceCategory;
use common\models\CategoryType;
use common\models\BuildingProjectInfo;
use common\models\MultipleUploadForm;
use backend\models\BuildingProjectInfoSearch;
use yii\imagine\Image;
class BuildingProjectInfoController extends AppController
{
    /**
     * Displays building project infomations.
     *
     * @return string
     */
    public function actionIndex()
    {
    	$objectData = Yii::$app->request->get('BuildingProjectInfoSearch');
        
    	$provinceID = isset($objectData['province_id']) && $objectData['province_id']!==null ? $objectData['province_id'] : 0;
    	$districtID = isset($objectData['district_id']) && $objectData['district_id']!==null ? $objectData['district_id'] : 0;
    	$wardID = isset($objectData['ward_id']) && $objectData['ward_id']!==null ? $objectData['ward_id'] : 0;
    	$name = isset($objectData['name']) && $objectData['name']!==null ? $objectData['name'] : '';
    	$email = isset($objectData['email']) && $objectData['email']!==null ? $objectData['email'] : '';
    	 
    	$uriParam = '&BuildingProjectInfoSearch[province_id]='.$provinceID;
    	$uriParam .= '&BuildingProjectInfoSearch[district_id]='.$districtID;
    	$uriParam .= '&BuildingProjectInfoSearch[ward_id]='.$wardID;
    	$uriParam .= '&BuildingProjectInfoSearch[name]='.$name;
    	$uriParam .= '&BuildingProjectInfoSearch[email]='.$email;
    	  
    	$searchModel = new BuildingProjectInfoSearch();
    	$dataProvider = $searchModel->search(\Yii::$app->request->get());
    	$urlDataParams = \Yii::$app->request->get();
        
    	return $this->render('index', [
    						'dataProvider' => $dataProvider,
    					 	'uriParam' => $uriParam,
    						'searchModel' => $searchModel,
    						'provinceID' => $provinceID,
    						'districtID' => $districtID,
    						'wardID' => $wardID,
    						'pageBack' => isset($urlDataParams['page'])?$urlDataParams['page']:1
    				]);
    }

    
    /**
     * Add new 
     *
     * @return string
     */
    public function actionAdd() 
    {
    	$serviceCategory = ServiceCategory::find()->orderBy(['name' => 'ASC'])->asArray()->all();
    	$form = new MultipleUploadForm();    	
    	$this->getView()->title = "Add building project";
    	$model = new BuildingProjectInfo();
    	
    	if (Yii::$app->request->isPost) { 
    		$model->attributes = Yii::$app->request->post('BuildingProjectInfo');
    		
    		$model->created = date('Y-m-d H:i:s');
    		$model->updated = date('Y-m-d H:i:s');
    		$model->status = BuildingProjectInfo::STATUS_ACTIVE;
    		
    		$model->ogirinal_price_from = str_replace(',', '', $model->ogirinal_price_from);
    		$model->market_price_from = str_replace(',', '', $model->market_price_from);
    		$model->hire_price_from = str_replace(',', '', $model->hire_price_from);
    		$model->ogirinal_price_to = str_replace(',', '', $model->ogirinal_price_to);
    		$model->market_price_to = str_replace(',', '', $model->market_price_to);
    		$model->hire_price_to = str_replace(',', '', $model->hire_price_to);
    		
    		if ($model->validate()) {  
    			if (Yii::$app->user->identity->is_admin != 1) {
    				$model->updated_status = 1;
    			} else {
    				$model->updated_status = 0;
    			}
    			$model->save(false);
    			$sID = Yii::$app->request->post('upload_image_id');
    			$arrTemp = !empty($sID) ? explode(';', $sID) : array(); 
    			$arrTemp = array_unique($arrTemp); 
    			foreach ($arrTemp as $id) {
    				if(!empty($id)) {
    					$image = Image::findOne(['id' => $id]);
    					$ImageProject->building_project_id = $model->id;
    					$ImageProject->save();
    				}
    			} 
    			Yii::$app->session->setFlash('success', "Tạo thành công "); 
    			Yii::$app->getResponse()->redirect(['building-project-info/index']);
    			Yii::$app->end();
    		} else {
    			// Delete image upload on server and in DB
    			$sID = Yii::$app->request->post('upload_image_id');
    			$arrTemp = !empty($sID) ? explode(';', $sID) : array(); 
    			$arrTemp = array_unique($arrTemp);
    			foreach ($arrTemp as $id) {
    				if(!empty($id)) {
	    				$image = ImageProject::findOne(['id' => $id]);
	    				if (!empty($image)) {
		    				$imgUrl = Yii::$app->params['images-building-project'].$image->url;
		    				$this->deleteFilesFolder($imgUrl);
		    				$image->delete();
	    				}
	    			}
    			}
    		}
    		if (!empty($model->ogirinal_price_from) && $model->ogirinal_price_from != 0) {
    			$model->ogirinal_price_from = number_format($model->ogirinal_price_from);
    		}
    		if (!empty($model->market_price_from) && $model->market_price_from != 0) {
    			$model->market_price_from = number_format($model->market_price_from);
    		}
    		if (!empty($model->hire_price_from) && $model->hire_price_from != 0) {
    			$model->hire_price_from = number_format($model->hire_price_from);
    		}
    		if (!empty($model->ogirinal_price_to) && $model->ogirinal_price_to != 0) {
    			$model->ogirinal_price_to = number_format($model->ogirinal_price_to);
    		}
    		if (!empty($model->market_price_to) && $model->market_price_to != 0) {
    			$model->market_price_to = number_format($model->market_price_to);
    		}
    		if (!empty($model->hire_price_to) && $model->hire_price_to != 0) {
    			$model->hire_price_to = number_format($model->hire_price_to);
    		}
    	}
    	
    	$objectData = Yii::$app->request->post('BuildingProjectInfo');
    	$provinceID = isset($objectData['province_id']) && $objectData['province_id']!==null ? $objectData['province_id'] : 0;
    	$districtID = isset($objectData['district_id']) && $objectData['district_id']!==null ? $objectData['district_id'] : 0;
    	$wardID = isset($objectData['ward_id']) && $objectData['ward_id']!==null ? $objectData['ward_id'] : 0;
    	 
    	return $this->render('add', ['model' => $model, 
    								'serviceCategory' => $serviceCategory,
    								'uploadForm' => $form,
    								'provinceID' => $provinceID,
    								'districtID' => $districtID,
    								'wardID' => $wardID,
    							]);
    	
    }
    
    /**
     * Update info
     *
     * @return string
     */
    public function actionEdit($id = 0) 
    {
    	$serviceCategory = ServiceCategory::find()->orderBy(['name' => 'ASC'])->asArray()->all();
    	$form = new MultipleUploadForm();
    	$urlDataParams = \Yii::$app->request->get();
    	 
    	$this->getView()->title = "Update building project";
    	$model = BuildingProjectInfo::findOne(['id' => $id, 'status' => BuildingProjectInfo::STATUS_ACTIVE]);
		if (!empty($model->ogirinal_price_from) && $model->ogirinal_price_from != 0) {
			$model->ogirinal_price_from = number_format($model->ogirinal_price_from);
		}
		if (!empty($model->market_price_from) && $model->market_price_from != 0) {
			$model->market_price_from = number_format($model->market_price_from);
		}
		if (!empty($model->hire_price_from) && $model->hire_price_from != 0) {
			$model->hire_price_from = number_format($model->hire_price_from);
		}
		if (!empty($model->ogirinal_price_to) && $model->ogirinal_price_to != 0) {
			$model->ogirinal_price_to = number_format($model->ogirinal_price_to);
		}
		if (!empty($model->market_price_to) && $model->market_price_to != 0) {
			$model->market_price_to = number_format($model->market_price_to);
		}
		if (!empty($model->hire_price_to) && $model->hire_price_to != 0) {
			$model->hire_price_to = number_format($model->hire_price_to);
		}
		
    	if (!$model) {
            Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
            Yii::$app->getResponse()->redirect(['building-project-info/index']);
            Yii::$app->end();
        }
        
        if (Yii::$app->request->isPost) {
    		$model->attributes = Yii::$app->request->post('BuildingProjectInfo');
    
    		$model->updated = date('Y-m-d H:i:s');
    		$model->status = BuildingProjectInfo::STATUS_ACTIVE;
    		
    		$model->ogirinal_price_from = str_replace(',', '', $model->ogirinal_price_from);
    		$model->market_price_from = str_replace(',', '', $model->market_price_from);
    		$model->hire_price_from = str_replace(',', '', $model->hire_price_from);
    		$model->ogirinal_price_to = str_replace(',', '', $model->ogirinal_price_to);
    		$model->market_price_to = str_replace(',', '', $model->market_price_to);
    		$model->hire_price_to = str_replace(',', '', $model->hire_price_to);
    		
    		if ($model->validate()) {
    			if (Yii::$app->user->identity->is_admin != 1) {
    				$model->updated_status = 1;
    			} else {
    				$model->updated_status = 0;
    			}
    			
    			$model->save(false);
    			$sID = Yii::$app->request->post('upload_image_id');
    			$arrTemp = !empty($sID) ? explode(';', $sID) : array(); 
    			$arrTemp = array_unique($arrTemp);
    			foreach ($arrTemp as $idImg) {
    				if(!empty($idImg)) {
    					$image = ImageProject::findOne(['id' => $idImg]);
    					$image->building_project_id = $model->id;
    					$image->save();
    				}
    			} 
    			Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
    			Yii::$app->getResponse()->redirect(['building-project-info/index', 'page' => isset($urlDataParams['pageBack'])?$urlDataParams['pageBack']:1]);
    			Yii::$app->end();
    		} else {
    			// Delete image upload on server and in DB
    			$sID = Yii::$app->request->post('upload_image_id');
    			$arrTemp = !empty($sID) ? explode(';', $sID) : array(); 
    			$arrTemp = array_unique($arrTemp);
    			foreach ($arrTemp as $idImg) {
    				if(!empty($idImg)) {
	    				$image = ImageProject::findOne(['id' => $idImg]);
	    				$image->building_project_id = $model->id;
	    				$image->save();
    					/*if (!empty($image)) {
		    				$imgUrl = Yii::getAlias('@backend') .'/web/'.$image->url;
		    				$this->deleteFilesFolder($imgUrl);
		    				$image->delete();
	    				}*/
	    			}
    			}
    		}
    	}
    	   	 
    	$imageData = ImageProject::find()->select(['id', 'url'])
        				->where(['building_project_id' => $id])
        				->asArray()
        				->all();
        $dropzoneImage = array();
        if (!empty($imageData)) {
        	foreach ($imageData as $item) {
                 
        		$expUrl = explode('/', $item['url']);
        		$temp['name'] = !empty($expUrl) ? $expUrl[1] : '';
                        $temp['id'] = $item['id'];
        		$temp['url'] =Yii::$app->params['url-building-project-medium-square-image']. $item['url'];
        		$temp['type'] = 'image/*';
        		$dropzoneImage[] = $temp;
        	}
        } 
        
        $provinceID = $model->province_id;
    	$districtID = $model->district_id;
    	$wardID = $model->ward_id;
    
    	return $this->render('edit', ['model' => $model,
    			'serviceCategory' => $serviceCategory,
    			'uploadForm' => $form,
    			'provinceID' => $provinceID,
    			'districtID' => $districtID,
    			'wardID' => $wardID,
    			'dropzoneImage' => $dropzoneImage,
    			'pageBack' => isset($urlDataParams['pageBack'])?$urlDataParams['pageBack']:1
    	]);   	 
    }
    
    /**
     * View info
     *
     * @return 
     */
    public function actionView($id = 0) 
    {
    	$urlDataParams = \Yii::$app->request->get();
    	$infos = BuildingProjectInfo::findOne(['id' => $id, 'status' => BuildingProjectInfo::STATUS_ACTIVE]);
    	if (!$infos) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại");
    		Yii::$app->getResponse()->redirect(['building-project-info/index']);
    		Yii::$app->end();
    	}
    	$apartmentCatalog = CategoryType::findOne(['id' => $infos->category_id]);
    	$province = Province::findOne(['province_id' => isset($infos->province_id)?$infos->province_id:0]);
    	$district = District::findOne(['district_id' => isset($infos->district_id)?$infos->district_id:0]);
    	$ward = Ward::findOne(['ward_id' => isset($infos->ward_id)?$infos->ward_id:0]);
    	$street = Street::findOne(['street_id' => isset($infos->street_id)?$infos->street_id:0]);
    	$imageData = ImageProject::find()->select(['id', 'url'])->where(['building_project_id' => $id])->asArray()->all();
    	
    	// Get internal service data
    	$seviceData = array();
    	if (!empty($infos->internal_service_code)) {
    		$codeTemp = explode(';', $infos->internal_service_code);
			    		$seviceData = ServiceCategory::find()
			    		->select([ServiceCategory::tableName().'.name'])
			    		->where([ServiceCategory::tableName().'.id' => $codeTemp])
			    		->asArray()
			    		->all();
    	}
    	
    	return $this->render('view', [
    			'infos' => $infos, 
    			'apartmentCatalog' => $apartmentCatalog, 
    			'province' => $province, 
    			'district' => $district, 
    			'ward' => $ward,
    			'street' => $street, 
    			'imageData' => $imageData,
    			'seviceData' => $seviceData,
    			'pageBack' => isset($urlDataParams['pageBack'])?$urlDataParams['pageBack']:1
    	]);
    }
    
    /**
     * Delete function
     *
     * @return 
     */
    public function actionDelete($id = 0) 
    {
    	$this->getView()->title = "Danh sách dự án";
    	$infos = BuildingProjectInfo::findOne(['id' => $id, 'status' => BuildingProjectInfo::STATUS_ACTIVE]);
    	if (!$infos) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
    		Yii::$app->getResponse()->redirect(['building-project-info/index']);
    		Yii::$app->end();
    	}
    	$infos->status = BuildingProjectInfo::STATUS_INACTIVE;
    	$infos->save(false);
    	Yii::$app->session->setFlash('success', "Dữ liệu đã được xóa khỏi hệ thống ");
    	Yii::$app->getResponse()->redirect(['building-project-info/index']);
    	Yii::$app->end();
    }
    
    /**
     * Check valid building info sfunction
     *
     * @return
     */
    public function actionChecked()
    {
    	if (Yii::$app->request->isPost) {
    		$id = Yii::$app->request->post('id');
    		$status = Yii::$app->request->post('status');
    		$pageBack = Yii::$app->request->post('pageBack');
    		$infos = BuildingProjectInfo::findOne(['id' => $id, 'status' => BuildingProjectInfo::STATUS_ACTIVE]);
    		if (!$infos) {
    			Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
    			Yii::$app->getResponse()->redirect(['building-project-info/index', 'page' => isset($pageBack)?$pageBack:1]);
    			Yii::$app->end();
    		}
    		$infos->checked_status = $status;
    		if (Yii::$app->user->identity->is_admin == 1) {
    			$infos->updated_status = 0;
    		}
    		$infos->save(false);
    		Yii::$app->session->setFlash('success', "Dữ liệu đã được cập nhật ");
    	}		
    	
    	Yii::$app->getResponse()->redirect(['building-project-info/index', 'page' => isset($pageBack)?$pageBack:1]);
    	Yii::$app->end();
    }
    
    /**
     * Delete old images info
     *
     * @return void
     */
    private function deleteOldImages($buildingProjectID) 
    {
    	$path = Yii::$app->params['images-building-project'];
    	if (!empty($buildingProjectID)) {
    		$arrayImages = ImageProject::find()
    						->where(['building_project_id' => $buildingProjectID])
    						->asArray()
    						->all(); 
    		
    		// Example: uploads/20170329060038/avatar.png
    		/* if (!empty($image)) {
    			$pos = strpos($image[0]['url'], '/', 8);
    			$dir = $path.substr($image[0]['url'], 0, $pos);
    			$this->deleteFilesFolder($dir);
    		} */
    		
    		// Delete old image record data
    		foreach ($arrayImages as $item) {
    			$dir = $path.$item['url'];
    			$this->deleteFilesFolder($dir);
    			$model = ImageProject::findOne(['id' => $item['id']]);
	    		$model->delete();
    		}
    	}    	
    }
    
    /**
     * Function delete files and folders
     *
     * @param
     * @return void
     */
    private function deleteFilesFolder($dir) {
    	if (is_dir($dir)) {
    		$objects = scandir($dir);
    		foreach ($objects as $object) {
    			if ($object != "." && $object != "..") {
    				if (filetype($dir."/".$object) == "dir")
    					$this->delete_files($dir."/".$object);
    				else unlink($dir."/".$object);
    			}
    		}
    		reset($objects);
    		rmdir($dir);
    	} else {
    		if (file_exists($dir)) unlink($dir);
    		if ($this->isDirEmpty(dirname($dir))) {
    			rmdir(dirname($dir));
    		}
    	}
    }
    
    /**
     * Function check directory empty
     *
     * @param
     * @return boolean
     */
    private function isDirEmpty($dir) 
    {
  		if (!is_readable($dir)) return null; 
  		$handle = opendir($dir);
  		while (false !== ($entry = readdir($handle))) {
    		if ($entry != "." && $entry != "..") {
      			return false;
    		}
  		}
  		return true;
	}
	
	/**
	 * Action upload image to server
	 *
	 * @return string
	 */
	public function actionUpload()
	{
		$form = new MultipleUploadForm();
		$saveFolder = date('YmdHis') . gettimeofday()['usec'];
		$arrResponse = array();
		if (Yii::$app->request->isPost) {
			$form->files = UploadedFile::getInstances($form, 'files');
				 
			if ($form->files && $form->validate()) {
				$arrResponse['url'] = array();
				$arrResponse['id'] = array();
				foreach ($form->files as $file) {
					$image = new ImageProject();
					$saveUrl = $saveFolder.'/';
					$path = Yii::$app->params['path-building-project-image'];// Yii::getAlias('@common') .'/images/building-project/';
					
                                        $pathLargeSquare = Yii::$app->params['path-building-project-large-square-image'];
                                        $pathMediumSquare = Yii::$app->params['path-building-project-medium-square-image'];
                                        $pathSmallSquare = Yii::$app->params['path-building-project-small-square-image'];
                                        
                                        $pathLargeRectangle = Yii::$app->params['path-building-project-large-rectangle-image'];
                                        $pathMediumRectangle = Yii::$app->params['path-building-project-medium-rectangle-image'];
                                        $pathSmallRectangle = Yii::$app->params['path-building-project-small-rectangle-image'];
                                      
                                       
                                        
                                        $imgDir = $path.$saveUrl;
                                        $imgLargeSquareDir = $pathLargeSquare.$saveUrl;
                                        $imgMediumSquareDir = $pathMediumSquare.$saveUrl;
                                        $imgSmallSquareDir =  $pathSmallSquare.$saveUrl;
                                      
                                        
                                        $imgLargeRectangleDir = $pathLargeRectangle.$saveUrl;
                                         $imgMediumRectangleDir = $pathMediumRectangle.$saveUrl;
                                        $imgSmallRectangleDir = $pathSmallRectangle.$saveUrl;
                                       
                                        
					$image->url = $saveUrl.$file->name;
                                        $image->large_square_image = $saveUrl.$file->name;
                                        $image->medium_square_image = $saveUrl.$file->name;
                                        $image->small_square_image = $saveUrl.$file->name;
                                        
                                        $image->large_rectangle_image = $saveUrl.$file->name;
                                        $image->medium_rectangle_image = $saveUrl.$file->name;
                                        $image->small_rectangle_image = $saveUrl.$file->name;
					// Create directory
					if (!is_dir($imgLargeSquareDir)) mkdir($imgLargeSquareDir, 0755);
                                        if (!is_dir($imgMediumSquareDir)) mkdir($imgMediumSquareDir, 0755);
                                        if (!is_dir($imgSmallSquareDir)) mkdir($imgSmallSquareDir, 0755);
                                        
                                        if (!is_dir($imgLargeRectangleDir)) mkdir($imgLargeRectangleDir, 0755);
                                        if (!is_dir($imgMediumRectangleDir)) mkdir($imgMediumRectangleDir, 0755);
                                        if (!is_dir($imgSmallRectangleDir)) mkdir($imgSmallRectangleDir, 0755);
                                        if (!is_dir($imgDir)) mkdir($imgDir, 0755);
                                        
					if ($image->save()) {
                                            //$file->saveAs($imgDir. $file->name, false);
                                            if ($file->saveAs($imgDir . $file->name, false)) {
                                                Image::thumbnail($imgDir . $file->name, 235, 68)->save($imgSmallRectangleDir . $file->name, ['quality' => 90]);
                                                Image::thumbnail($imgDir . $file->name, 210, 118)->save($imgMediumRectangleDir . $file->name, ['quality' => 90]);
                                                Image::thumbnail($imgDir . $file->name, 700, 450)->save($imgLargeRectangleDir . $file->name, ['quality' => 90]);

                                                Image::thumbnail($imgDir . $file->name, 80, 80)->save($imgSmallSquareDir . $file->name, ['quality' => 90]);
                                                Image::thumbnail($imgDir . $file->name, 200, 200)->save($imgMediumSquareDir . $file->name, ['quality' => 90]);
                                                Image::thumbnail($imgDir . $file->name, 700, 700)->save($imgLargeSquareDir . $file->name, ['quality' => 90]);
                                            }
                                        }
                                        $arrResponse['url'][] = $image->url;
					$arrResponse['id'][] = $image->id;
				}
				$arrResponse['sID'] = implode(';', $arrResponse['id']);
				$arrResponse['total'] = count($form->files);
			}
		}
		echo json_encode($arrResponse);
    	exit();
	}
        function generateThumbnail($img, $width, $height, $quality = 90,$new)
{
    if (is_file($img)) {
        $imagick = new Imagick(realpath($img));
        $imagick->setImageFormat('jpeg');
        $imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
        $imagick->setImageCompressionQuality($quality);
        $imagick->thumbnailImage($width, $height, false, false);
       
        if (file_put_contents($new, $imagick) === false) {
            throw new Exception("Could not put contents.");
        }
        return true;
    }
    else {
        throw new Exception("No valid image provided with {$img}.");
    }
}

	
	/**
	 * Action delete image on server
	 *
	 * @return string
	 */
	public function actionDelimage() {
        $arrResponse = array();
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $image = ImageProject::findOne(['id' => $id]);
            if (!empty($image)) {
                $path = Yii::$app->params['path-building-project-image'] . $image->url; // Yii::getAlias('@common') .'/images/building-project/';
                $pathLargeSquare = Yii::$app->params['path-building-project-large-square-image'] . $image->large_square_image;
                $pathMediumSquare = Yii::$app->params['path-building-project-medium-square-image'] . $image->medium_square_image;
                $pathSmallSquare =  Yii::$app->params['path-building-project-small-square-image'] . $image->small_square_image;
                
                $pathLargeRectangle = Yii::$app->params['path-building-project-large-rectangle-image'] . $image->large_rectangle_image;
                $pathMediumRectangle = Yii::$app->params['path-building-project-medium-rectangle-image'] . $image->medium_rectangle_image;
                $pathSmallRectangle = Yii::$app->params['path-building-project-small-rectangle-image'] . $image->small_rectangle_image;
                
                //$imgUrl = Yii::getAlias('@backend') .'/web/'.$image->url;
                $this->deleteFilesFolder($path);
                $this->deleteFilesFolder($pathLargeSquare);
                $this->deleteFilesFolder($pathMediumSquare);
                $this->deleteFilesFolder($pathSmallSquare);
                $this->deleteFilesFolder($pathLargeRectangle);
                $this->deleteFilesFolder($pathMediumRectangle);
                $this->deleteFilesFolder($pathSmallRectangle);
                $image->delete();
            }
        }
        echo json_encode($arrResponse);
        exit();
    }

}
