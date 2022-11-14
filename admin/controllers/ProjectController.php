<?php
namespace admin\controllers;
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
use common\models\ApartmentCategory;
use common\models\Project;
use common\models\MultipleUploadForm;
use admin\models\ProjectUploadSectionImage;
use admin\models\ProjectUploadFile;
use admin\models\ProjectUploadBanner;
use common\models\ProjectSection;
use common\models\ProjectContact;
use common\models\ProjectInvestor;
use admin\models\ProjectSearch;
use common\models\ProjectPriceList;
use common\models\ProjectBanner;
use admin\models\ProjectUploadLogo;
use yii\imagine\Image;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\base\Model;
use yii\web\NotFoundHttpException;
class ProjectController extends AppController
{
    /**
     * Displays building project infomations.
     *
     * @return string
     */

	 /**
     * Add new 
     *
     * @return string
     */
	
	public $menu="project";

	public function actionMap($id) 
    {	
		 $model = Project::findOne(['id' => $id]);
		 return $this->render('map',['model' => $model]);
	}
	public function actionProjectSection($id) 
    {
		$model = Project::findOne(['id' => $id]);
		// $count =1;
		
		if($id &&  $model ){  
				$sections = ProjectSection::find()->andWhere(['project_id' => $id])->all();
				if(!$sections){
				
							$sections= [
										new ProjectSection(['title' => 'Giới tiệu','sort' => 0]),
										new ProjectSection(['title' => 'Tổng quan','sort' => 0]),
										new ProjectSection(['title' => 'Vị Trí','sort' => 0]),
										new ProjectSection(['title' => 'Tiện ích','sort' => 0]),
										new ProjectSection(['title' => 'Thiết kế','sort' => 0])
										];
							if (Model::loadMultiple($sections, Yii::$app->request->post())) {
									foreach ($sections as $key => $section) {
												$form = new ProjectUploadSectionImage();
												$form->imageFile = UploadedFile::getInstance($section,'[' . $key . ']imageFile');
												if (!empty($form->imageFile->name) && $form->validate()) {
														$path = Yii::$app->params['PathChannels']. 'projects/section/';// Yii::getAlias('@common') .'/images/building-project/';
														$section->image =  $form->imageFile->name;
														if (!is_dir($path)) mkdir($path, 0755);
															$form->imageFile->saveAs($path  . $form->imageFile->name, false);
																if(in_array($form->imageFile->extension, ['jpg', 'png','jpeg'])){
																	Image::thumbnail($path  . $form->imageFile->name, 120, 120)->save($path  . 'thumb_' . $form->imageFile->name, ['quality' => 90]);
																}
												}
										$section->project_id= $id;
										//Try to save the models. Validation is not needed as it's already been done.
										$section->save(false);

									}
										Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
										//Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1,'menu' => $this->menu]);
										//Yii::$app->end();
								}
					}else{
						
					if (Model::loadMultiple($sections, Yii::$app->request->post())) {
										foreach ($sections as $key => $section) {
												$form = new ProjectUploadSectionImage();
												$form->imageFile = UploadedFile::getInstance($section,'[' . $key . ']imageFile');
												
												if (!empty($form->imageFile->name) && $form->validate()) {
														$path = Yii::$app->params['PathChannels']. 'projects/section/';// Yii::getAlias('@common') .'/images/building-project/';
														$section->image =  $form->imageFile->name;
														if (!is_dir($path)) mkdir($path, 0755);
															$form->imageFile->saveAs($path  . $form->imageFile->name, false);
																if(in_array($form->imageFile->extension, ['jpg', 'png','jpeg'])){
																	Image::thumbnail($path  . $form->imageFile->name, 120, 120)->save($path  . 'thumb_' . $form->imageFile->name, ['quality' => 90]);
																}
												}
												$section->save(false);
											}
											
										
						
							Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
							//Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1, 'menu' => $this->menu]);
							//Yii::$app->end();
						}else{
								
									array_push($sections,(new ProjectSection(['sort' => 0])));
								if (Model::loadMultiple($sections, Yii::$app->request->post())) {
								
									foreach ($sections as $key => $section) {
												$form = new ProjectUploadSectionImage();
												$form->imageFile = UploadedFile::getInstance($section,'[' . $key . ']imageFile');
												if (!empty($form->imageFile->name) && $form->validate()) {
														$path = Yii::$app->params['PathChannels']. 'projects/section/';// Yii::getAlias('@common') .'/images/building-project/';
														$section->image =  $form->imageFile->name;
														if (!is_dir($path)) mkdir($path, 0755);
															$form->imageFile->saveAs($path  . $form->imageFile->name, false);
																if(in_array($form->imageFile->extension, ['jpg', 'png','jpeg'])){
																	Image::thumbnail($path  . $form->imageFile->name, 120, 120)->save($path  . 'thumb_' . $form->imageFile->name, ['quality' => 90]);
																}
												}
										$section->project_id= $id;
										//Try to save the models. Validation is not needed as it's already been done.
										$section->save(false);

									}
										Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
										//Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1,'menu' => $this->menu]);
										//Yii::$app->end();
								}
									
						}
						
							

				}

					}else{
								Yii::$app->session->setFlash('warning', "Ban cần tạo dự án trước khi cập nhập chủ đầu tư"); //exit;
								Yii::$app->getResponse()->redirect(['project/index', 'menu' => $this->menu]);
								Yii::$app->end();
					}
						return $this->render('project_section',[
							'menu' => $this->menu,
							'models' => $sections,
							'model' => $model,
							'index' => count($sections),
							'dropzoneBanners' => $this->dropzoneBanners($id),
							'dropzoneFiles' => $this->dropzoneFiles($id),
							//'dropzoneLogo' => $this->dropzoneLogo($id)
				]);
}
    public function actionProjectSection_bk($id) 
    {
		$model = Project::findOne(['id' => $id]);
		// $count =1;
		
		if($id &&  $model ){  
				$sections = ProjectSection::find()->andWhere(['project_id' => $id])->all();
				
				if(!$sections){
				
							$sections= [
										new ProjectSection(['title' => 'Giới tiệu','sort' => 0]),
										new ProjectSection(['title' => 'Tổng quan','sort' => 0]),
										new ProjectSection(['title' => 'Vị Trí','sort' => 0]),
										new ProjectSection(['title' => 'Tiện ích','sort' => 0]),
										new ProjectSection(['title' => 'Thiết kế','sort' => 0])
										];
									//var_dump(Yii::$app->request->post());
									//die;
							 //Send at least one model to the form
       						//Find out how many products have been submitted by the form
							$count  = count(Yii::$app->request->post('ProjectSection',[]));
										//Create an array of the products submitted
										for($i = 1; $i < $count; $i++) {
											$sections[] = new ProjectSection(['sort' => 0]);
							}
					//	echo '<pre>';	var_dump(Model::validateMultiple($sections));	echo '<pre/>';
					//	die;
							//Load and validate the multiple models
								//if (Model::loadMultiple($sections, Yii::$app->request->post()) && Model::validateMultiple($sections)) {
									if (Model::loadMultiple($sections, Yii::$app->request->post()) && Model::validateMultiple($sections)) {
										var_dump($sections);
								die;
									foreach ($sections as $key => $section) {
												$form = new ProjectUploadSectionImage();
												$form->imageFile = UploadedFile::getInstance($section,'[' . $key . ']imageFile');
												if (!empty($form->imageFile->name) && $form->validate()) {
														$path = Yii::$app->params['PathChannels']. 'projects/section/';// Yii::getAlias('@common') .'/images/building-project/';
														$section->image =  $form->imageFile->name;
														if (!is_dir($path)) mkdir($path, 0755);
															$form->imageFile->saveAs($path  . $form->imageFile->name, false);
																if(in_array($form->imageFile->extension, ['jpg', 'png','jpeg'])){
																	Image::thumbnail($path  . $form->imageFile->name, 120, 120)->save($path  . 'thumb_' . $form->imageFile->name, ['quality' => 90]);
																}
												}
										$section->project_id= $id;
										//Try to save the models. Validation is not needed as it's already been done.
										$section->save(false);

									}
										Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
										//Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1,'menu' => $this->menu]);
										//Yii::$app->end();
								}
					}else{
							
							var_dump($sections);
								die;
					if (Model::loadMultiple($sections, Yii::$app->request->post()) && Model::validateMultiple($sections)) {
										foreach ($sections as $key => $section) {
												$form = new ProjectUploadSectionImage();
												$form->imageFile = UploadedFile::getInstance($section,'[' . $key . ']imageFile');
												var_dump(UploadedFile::getInstance($section,'[' . $key . ']imageFile'));
												die;
												if (!empty($form->imageFile->name) && $form->validate()) {
														$path = Yii::$app->params['PathChannels']. 'projects/section/';// Yii::getAlias('@common') .'/images/building-project/';
														$section->image =  $form->imageFile->name;
														if (!is_dir($path)) mkdir($path, 0755);
															$form->imageFile->saveAs($path  . $form->imageFile->name, false);
																if(in_array($form->imageFile->extension, ['jpg', 'png','jpeg'])){
																	Image::thumbnail($path  . $form->imageFile->name, 120, 120)->save($path  . 'thumb_' . $form->imageFile->name, ['quality' => 90]);
																}
												}
												$section->save(false);
											}
											
										
						
							Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
							//Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1, 'menu' => $this->menu]);
							//Yii::$app->end();
						}else{
								array_push($sections,(new ProjectSection(['sort' => 0])));
								var_dump($sections);
								die;
								if (Model::loadMultiple($sections, Yii::$app->request->post()) && Model::validateMultiple($sections)) {
									foreach ($sections as $key => $section) {
												$form = new ProjectUploadSectionImage();
												$form->imageFile = UploadedFile::getInstance($section,'[' . $key . ']imageFile');
												if (!empty($form->imageFile->name) && $form->validate()) {
														$path = Yii::$app->params['PathChannels']. 'projects/section/';// Yii::getAlias('@common') .'/images/building-project/';
														$section->image =  $form->imageFile->name;
														if (!is_dir($path)) mkdir($path, 0755);
															$form->imageFile->saveAs($path  . $form->imageFile->name, false);
																if(in_array($form->imageFile->extension, ['jpg', 'png','jpeg'])){
																	Image::thumbnail($path  . $form->imageFile->name, 120, 120)->save($path  . 'thumb_' . $form->imageFile->name, ['quality' => 90]);
																}
												}
										$section->project_id= $id;
										//Try to save the models. Validation is not needed as it's already been done.
										$section->save(false);

									}
										Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
										//Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1,'menu' => $this->menu]);
										//Yii::$app->end();
								}
									
						}
						
							

				}

					}else{
								Yii::$app->session->setFlash('warning', "Ban cần tạo dự án trước khi cập nhập chủ đầu tư"); //exit;
								Yii::$app->getResponse()->redirect(['project/index', 'menu' => $this->menu]);
								Yii::$app->end();
					}
						return $this->render('project_section',[
							'menu' => $this->menu,
							'models' => $sections,
							'model' => $model,
							'index' => count($sections),
							'dropzoneBanners' => $this->dropzoneBanners($id),
							'dropzoneFiles' => $this->dropzoneFiles($id),
							//'dropzoneLogo' => $this->dropzoneLogo($id)
				]);
}
public function actionAddSection($id, $index) 
{	
		$this->layout= 'main-mini';
		$project = Project::findOne(['id' => $id]);
		if($project){
			$model = new ProjectSection(['sort' => 0]);
			return $this->render('add_section',[
				'model' => $model,
				'project' => $project,
				'index' => (int)$index,
				'title' => 'Thêm đoạn'
			//	'dropzoneBanners' => $this->dropzoneBanners($id),
			//	'dropzoneFiles' => $this->dropzoneFiles($id),
				//'dropzoneLogo' => $this->dropzoneLogo($id)
				]);

		}else{
			return $this->render('add_section_error',[
					'message' => 'Không tồn tai'
				]);
		}
		
}
/*
private function projectSection($id) 
    {	
		 $sections = ProjectSection::find()->andWhere(['project_id' => $id])->all();
		 if(!$sections){
			$sections = [
						new ProjectSection(['title' => 'Giới thiệu','sort' => 0]),
						new ProjectSection(['title' => 'Tổng quan','sort' => 0]),
						new ProjectSection(['title' => 'Vị Trí','sort' => 0]),
						new ProjectSection(['title' => 'Tiện ích','sort' => 0]),
						new ProjectSection(['title' => 'Thư viện','sort' => 0]),
						
				];
			
		 //Send at least one model to the form
       
		//Find out how many products have been submitted by the form
		$count = count(Yii::$app->request->post('ProjectSection', []));
		
		//Create an array of the products submitted
        for($i = 1; $i < $count; $i++) {
            $sections[] = new ProjectSection();
		}
		
		//Load and validate the multiple models
        if (Model::loadMultiple($sections, Yii::$app->request->post()) && Model::validateMultiple($sections)) {
			
            foreach ($sections as $model) {
				$model->project_id= $id;
                //Try to save the models. Validation is not needed as it's already been done.
                $model->save(false);

            }
            return $this->redirect('index');
        }
    	}else{
			
			if (Model::loadMultiple($sections, Yii::$app->request->post()) && Model::validateMultiple($sections)) {
            foreach ($sections as $model) {
                $model->save(false);
            }
            return $this->redirect('index');
        }

		}

    	return  $sections;
	}
*/
	public function actionContact($id){
		$model = Project::findOne(['id' => $id]);
		$user = Yii::$app->user->identity;
		if($model && $id){
			if($model->getProjectContacts()->one()){
				$projectContact = $model->getProjectContacts()->one();
			}else{
				
				$projectContact = new ProjectContact();
				$projectContact->name = $user->name;
				$projectContact->phone = $user->phone;
				$projectContact->email = $user->email;
				$projectContact->address = $user->address;

			}
			if (Yii::$app->request->isPost) { 
					$projectContact->attributes = Yii::$app->request->post('ProjectContact');
					$projectContact->project_id= $model->id;
					if($projectContact->save(false)){
						Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
						Yii::$app->getResponse()->redirect(['project/index', 'id' => isset($id)?$id:1, 'menu' => $this->menu]);
						Yii::$app->end();
					}
				}
		}else{
						Yii::$app->session->setFlash('warning', "Ban cần tạo dự án trước khi cập nhập chủ đầu tư"); //exit;
						Yii::$app->getResponse()->redirect(['project/index', 'menu' => $this->menu]);
						Yii::$app->end();
		}
		return $this->render('contact', [
				'menu' =>'project',
				'model' => $model,
			
				'projectContact' =>  $projectContact
				 ]);
	}
	//'dropzoneBanners' => $this->dropzoneBanners($id),
		//			'dropzoneFiles' => $this->dropzoneFiles($id),
		//			'dropzoneLogo' => $this->dropzoneLogo($id),
	public function actionProjectBanner($id){
		$model = Project::findOne(['id' => $id]);
		if($model && $id){
			$dropzoneBanners = $this->dropzoneBanners($id);
		}else{
						Yii::$app->session->setFlash('warning', "Ban cần tạo dự án trước khi cập nhập chủ đầu tư"); //exit;
						Yii::$app->getResponse()->redirect(['project/index','menu' => $this->menu]);
						Yii::$app->end();
			}
			
		return $this->render('project_banner', [
				'menu' =>'project',
				'model' => $model,
				'dropzoneBanners' => $dropzoneBanners]);
	}
  	public function actionInvestor($id){
		  $model = Project::findOne(['id' => $id]);
			if($id &&   $model ){  
			
			if($model->getProjectInvestors()->one())
			{
				$projectInvestor = $model->getProjectInvestors()->one();
			}else{
				$projectInvestor = new ProjectInvestor();
			}
			if (Yii::$app->request->isPost) { 
				$projectInvestor->attributes = Yii::$app->request->post('ProjectInvestor');
				$form = new ProjectUploadLogo();
				
				$form->file = UploadedFile::getInstance($projectInvestor, 'logo');
				
				if ($form->file && $form->validate()) {
				
						$path = Yii::$app->params['PathChannels']. 'projects/logo_investor/';// Yii::getAlias('@common') .'/images/building-project/';
						$logo = gettimeofday()['sec'] .'.'. $form->file->extension;
						$projectInvestor->logo = $logo;// $form->file->name;
						if (!is_dir($path)) mkdir($path, 0755);
							$form->file->saveAs($path  .  $logo, false);
							// With file image type. Create thumbnail image.
								if(in_array($form->file->extension, ['jpg', 'png','jpeg'])){
									Image::thumbnail($path  . $logo, 120, 120)->save($path  . 'thumb_' . $logo, ['quality' => 100]);
								}
				}
				$projectInvestor->project_id=$model->id;
				if($projectInvestor->save(false)){
				//	Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
				//	Yii::$app->getResponse()->redirect(['project/contact', 'id' => isset($id)?$id:1, 'menu' => $this->menu]);
				//	Yii::$app->end();
				}
			}
		}else{
					Yii::$app->session->setFlash('warning', "Ban cần tạo dự án trước khi cập nhập chủ đầu tư"); //exit;
					Yii::$app->getResponse()->redirect(['project/index','menu' => $this->menu]);
					Yii::$app->end();
		}
		return $this->render('investor', [
					'menu' => $this->menu,
					'model' => $model,
					'projectInvestor' => $projectInvestor]);
	}
    public function actionIndex($id=0)
    {
		
		$model= Project::findOne(['id' => $id]);	
		if(!$model){
			$model= new Project();	
		}
		if (Yii::$app->request->isPost) { 
				$model->attributes = Yii::$app->request->post('Project');
				$form = new ProjectUploadLogo();
				
				$form->file = UploadedFile::getInstance($model, 'logo');
				if ($form->file && $form->validate()) {
						$path = Yii::$app->params['PathChannels']. 'projects/logo/';// Yii::getAlias('@common') .'/images/building-project/';
						$logo = gettimeofday()['sec'] .'.'. $form->file->extension;
						$model->logo = $logo;// $form->file->name;
						if (!is_dir($path)) mkdir($path, 0755);
							$form->file->saveAs($path  .  $logo, false);
							// With file image type. Create thumbnail image.
								if(in_array($form->file->extension, ['jpg', 'png','jpeg'])){
									Image::thumbnail($path  . $logo, 120, 120)->save($path  . 'thumb_' . $logo, ['quality' => 100]);
								}
				}
				$model->updated = date('Y-m-d H:i:s');
				$model->status = Project::STATUS_INACTIVE;
				$model->version = 1;
				$model->user_id= Yii::$app->user->identity->id;
				if ($model->save(false)) {  
					Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
						Yii::$app->getResponse()->redirect(['project/project-section', 'id' => $model->getPrimaryKey()]);
						Yii::$app->end();
					
				} 
    		
    	}
    	$searchModel = new ProjectSearch();
    	$dataProvider = $searchModel->search(\Yii::$app->request->get());
    	$urlDataParams = \Yii::$app->request->get();
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
							return $province->type.' '. $province->name;
					});
		$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $model->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
								return $district->type.' '.$district->name;
					});
		$wards = ArrayHelper::map(Ward::find()->andWhere(['district_id' => $model->district_id])->orderBy(['type' => 'desc', 'name' => 'asc'])->all(),'ward_id', function ($district) {
								return $district->type.' '.$district->name;
					}); 
		$categories =	ArrayHelper::map(ApartmentCategory::find()->orderBy(['name' => 'ASC'])->all(),'id','name');
		return $this->render('index', [
							'menu' => 'project',
							'model' => $model,
    						'dataProvider' => $dataProvider,
							 'searchModel' => $searchModel,
							 'categories' => $categories,
    						//'provinceID' => $provinceID,
    						//'districtID' => $districtID,
							//'wardID' => $wardID,
							'provinces' => $provinces,
							'districts' => $districts,
							'wards' => $wards,
    						'pageBack' => isset($urlDataParams['page'])?$urlDataParams['page']:1
    				]);
    }

    
    /**
     * Add new 
     *
     * @return string
     */
	/*
    public function actionAdd() 
    {
    	$serviceCategory = ServiceCategory::find()->orderBy(['name' => 'ASC'])->asArray()->all();
    	$form = new MultipleUploadForm();    	
    	$this->getView()->title = "Add building project";
    	$model = new Project();
    	
    	if (Yii::$app->request->isPost) { 
    		$model->attributes = Yii::$app->request->post('Project');
    		
    		$model->created = date('Y-m-d H:i:s');
    		$model->updated = date('Y-m-d H:i:s');
    		$model->status = Project::STATUS_ACTIVE;
    		
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
    					$imageProject = ImageProject::findOne(['id' => $id]);
    					$imageProject->building_project_id = $model->id;
    					$imageProject->save();
    				}
    			} 
    			Yii::$app->session->setFlash('success', "Tạo thành công "); 
    			Yii::$app->getResponse()->redirect(['project/index','menu' => $this->menu]);
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
    	
    	$objectData = Yii::$app->request->post('Project');
    	$provinceID = isset($objectData['province_id']) && $objectData['province_id']!==null ? $objectData['province_id'] : 0;
    	$districtID = isset($objectData['district_id']) && $objectData['district_id']!==null ? $objectData['district_id'] : 0;
    	$wardID = isset($objectData['ward_id']) && $objectData['ward_id']!==null ? $objectData['ward_id'] : 0;
    	 
    	return $this->render('add', [
									'menu' =>'project',
									'model' => $model, 
    								'serviceCategory' => $serviceCategory,
    								'uploadForm' => $form,
    								'provinceID' => $provinceID,
    								'districtID' => $districtID,
    								'wardID' => $wardID,
    							]);
    	
    }
    */
    /**
     * Update info
     *
     * @return string
     */
	
	/* public function actionEdit($id = 0) 
    {
    	$urlDataParams = \Yii::$app->request->get();
    	$this->getView()->title = "Cập nhật thông tin dự án";
    		$model = Project::findOne(['id' => $id, 'status' => Project::STATUS_ACTIVE]);
			if (Yii::$app->request->isPost) {
				$model->attributes = Yii::$app->request->post('Project');
				$model->updated = date('Y-m-d H:i:s');
				$model->status = Project::STATUS_ACTIVE;
				$model->version = 1 ;  // 1 new templeate, 0 old templeate
				if ($model->validate()) {
					$model->save(false);
					Yii::$app->session->setFlash('success', "Cập nhật thành công "); //exit;
					Yii::$app->getResponse()->redirect(['project/investor', 'id' => isset($id)?$id:1,'menu' => $this->menu]);
					Yii::$app->end();
				} 
			}
			$serviceCategory = ServiceCategory::find()->orderBy(['name' => 'ASC'])->asArray()->all();
    	
			$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
							return $province->type.' '. $province->name;
					});
			$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $model->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
								return $district->type.' '.$district->name;
					});
			$wards = ArrayHelper::map(Ward::find()->andWhere(['district_id' => isset($model->district_id)?$model->district_id:0])->orderBy(['type' => 'desc', 'name' => 'asc'])->all(),'ward_id', function ($district) {
								return $district->type.' '.$district->name;
					}); 
					$categories =	ArrayHelper::map(ApartmentCategory::find()->orderBy(['name' => 'ASC'])->all(),'id','name');
			
			return $this->render('edit', [
					'menu' =>'project',
					'model' => $model,
					'categories' => $categories,
					'serviceCategory' => $serviceCategory,
					'provinces' => $provinces,
					'districts' =>  $districts,
					'wards' => 	$wards,
					'user' => Yii::$app->user->identity,
					'dropzoneBanners' => $this->dropzoneBanners($id),
					'dropzoneFiles' => $this->dropzoneFiles($id),
					'dropzoneLogo' => $this->dropzoneLogo($id),
					'pageBack' => isset($urlDataParams['pageBack'])?$urlDataParams['pageBack']:1
			]);
	}
	*/
	/*private function dropzoneLogo($id){
		
		$project = Project::find()
        				->where(['id' => $id])
						->all();
		$dropzoneFile = array();
        if ($project) {
        	foreach ($project as  $item) {
                $dropzoneFile[] =[
					'name' => $item->logo,
					'file_name' =>  $item->logo,
                	'id' => $item->id,
        			'url_file_name' => Yii::$app->params['url-channels'].'projects/logo/'. $item->logo,
					'type' => 100,
					'size' => 100,
				];
        	}
		} 
		return  $dropzoneFile;
	}*/
	private function dropzoneBanners($id){
		
		$projectBanner = ProjectBanner::find()
        				->where(['project_id' => $id])
						->all();
		$dropzoneFile = array();
        if ($projectBanner) {
        	foreach ($projectBanner as  $item) {
                $dropzoneFile[] =[
					'name' => $item->name,
					'file_name' =>  $item->file_name,
                	'id' => $item->id,
        			'url_file_name' => Yii::$app->params['url-channels'].'projects/banner/'. $item->file_name,
					'type' => $item->type,
					'size' => $item->size,
				];
        	}
		} 
		return  $dropzoneFile;
	}
	private function dropzoneFiles($id){
		
		$projectPriceList = ProjectPriceList::find()
        				->where(['project_id' => $id])
						->all();
		$dropzoneFile = array();
        if ($projectPriceList) {
        	foreach ($projectPriceList as  $item) {
                $dropzoneFile[] =[
					'name' => $item->name,
					'file_name' =>  $item->file_name,
                	'id' => $item->id,
        			'url_file_name' => Yii::$app->params['url-channels'].'projects/price_list/'. $item->file_name,
					'type' => $item->type,
					'size' => $item->size,
				];
        	}
		} 
		return  $dropzoneFile;
  }

				/**
				* View info
				*
				* @return
				*/
	public function actionView($id = 0)
	{
				$urlDataParams = \Yii::$app->request->get();
				$infos = Project::findOne(['id' => $id, 'status' => Project::STATUS_ACTIVE]);
				if (!$infos) {
				Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại");
				Yii::$app->getResponse()->redirect(['project/index','menu'=> $this->menu]);
				Yii::$app->end();
				}
				$apartmentCatalog = ApartmentCategory::findOne(['id' => $infos->apartment_category_id]);
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
						$infos = Project::findOne(['id' => $id, 'status' => Project::STATUS_ACTIVE]);
						if (!$infos) {
						Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
						Yii::$app->getResponse()->redirect(['project/index']);
						Yii::$app->end();
						}
						$infos->status = Project::STATUS_INACTIVE;
						$infos->save(false);
						Yii::$app->session->setFlash('success', "Dữ liệu đã được xóa khỏi hệ thống ");
						Yii::$app->getResponse()->redirect(['project/index']);
						Yii::$app->end();
						}

						/**
						* Check valid building info sfunction
						*
						* @return
						*/
					/*	public function actionChecked()
						{
						if (Yii::$app->request->isPost) {
						$id = Yii::$app->request->post('id');
						$status = Yii::$app->request->post('status');
						$pageBack = Yii::$app->request->post('pageBack');
						$infos = Project::findOne(['id' => $id, 'status' => Project::STATUS_ACTIVE]);
						if (!$infos) {
						Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
						Yii::$app->getResponse()->redirect(['project/index', 'page' => isset($pageBack)?$pageBack:1]);
						Yii::$app->end();
						}
						$infos->checked_status = $status;
						if (Yii::$app->user->identity->is_admin == 1) {
						$infos->updated_status = 0;
						}
						$infos->save(false);
						Yii::$app->session->setFlash('success', "Dữ liệu đã được cập nhật ");
						}

						Yii::$app->getResponse()->redirect(['project/index', 'page' => isset($pageBack)?$pageBack:1]);
						Yii::$app->end();
	}*/

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
	public function  actionMultipleUploadFile($id){
								$form = new ProjectUploadFile();
								$arrResponse = array();
								$user = Yii::$app->user->identity;
									if (Yii::$app->request->isPost) {
										 $form->file = UploadedFile::getInstanceByName('file');
										//$form->files = UploadedFile::getInstances($form, 'files');
										if ($form->file && $form->validate()) {
												$projectPriceList = new ProjectPriceList();
												$path = Yii::$app->params['PathChannels']. 'projects/price_list/';// Yii::getAlias('@common') .'/images/building-project/';
												$projectPriceList->name =  $form->file->name;
												$projectPriceList->user_id= $user->id;
												$projectPriceList->project_id= $id;
												$projectPriceList->size = $form->file->size;
												$projectPriceList->type = $form->file->type;
												$projectPriceList->file_name = gettimeofday()['usec'] . '.' . $form->file->extension;
												if ($projectPriceList->save(false)) {
													if (!is_dir($path)) mkdir($path, 0755);
														$form->file->saveAs($path  . $projectPriceList->file_name, false);
															if(in_array($form->file->extension, ['jpg', 'png','jpeg'])){
																Image::thumbnail($path  . $projectPriceList->file_name, 120, 120)->save($path  . 'thumb_' . $projectPriceList->file_name, ['quality' => 90]);
														}
													}
												
											$arrResponse=[
												'name' => $projectPriceList->name,
												'file_name' =>  $projectPriceList->file_name,
												'url_file_name' =>  Yii::$app->params['url-channels'].'projects/price_list/' . $projectPriceList->file_name,
												'id' => $projectPriceList->id
											];	
											
									}
								
							}
							Yii::$app->response->format = Response::FORMAT_JSON;
								return Json::encode($arrResponse);
	}

	public function  actionMultipleUploadBanner($id){
								$form = new ProjectUploadBanner();
								$arrResponse = array();
								$user = Yii::$app->user->identity;
									if (Yii::$app->request->isPost) {
										 $form->file = UploadedFile::getInstanceByName('file');
										//$form->files = UploadedFile::getInstances($form, 'files');
										if ($form->file && $form->validate()) {
												$projectBanner = new ProjectBanner();
												$path = Yii::$app->params['PathChannels']. 'projects/banner/';// Yii::getAlias('@common') .'/images/building-project/';
												$projectBanner->name =  $form->file->name;
												$projectBanner->user_id= $user->id;
												$projectBanner->project_id= $id;
												$projectBanner->size = $form->file->size;
												$projectBanner->type = $form->file->type;
												$projectBanner->file_name = gettimeofday()['sec'] . '.' . $form->file->extension;
												if ($projectBanner->save(false)) {
													if (!is_dir($path)) mkdir($path, 0755);
														$form->file->saveAs($path  . $projectBanner->file_name, false);
															if(in_array($form->file->extension, ['jpg', 'png','jpeg'])){
																Image::thumbnail($path  . $projectBanner->file_name, 120, 120)->save($path  . 'thumb_' . $projectBanner->file_name, ['quality' => 90]);
														}
													}
												
											$arrResponse=[
												'name' => $projectBanner->name,
												'file_name' =>  $projectBanner->file_name,
												'url_file_name' =>  Yii::$app->params['url-channels'].'projects/banner/' . $projectBanner->file_name,
												'id' => $projectBanner->id
											];	
											
									}
								
							}
							Yii::$app->response->format = Response::FORMAT_JSON;
								return Json::encode($arrResponse);
	}
public function  actionUploadLogo($id){
								$form = new ProjectUploadLogo();
								$arrResponse = array();
								//$user = Yii::$app->user->identity;
									if (Yii::$app->request->isPost) {
										 $form->file = UploadedFile::getInstanceByName('file');
										//$form->files = UploadedFile::getInstances($form, 'files');
										
										if ($form->file && $form->validate()) {
										
												$project = Project::findOne(['id' => $id]);
												$path = Yii::$app->params['PathChannels']. 'projects/logo/';// Yii::getAlias('@common') .'/images/building-project/';
												//$project->logo =  $form->file->name;
												$project->logo = gettimeofday()['usec'] . '.' . $form->file->extension;
												if ($project->save(false)) {
													if (!is_dir($path)) mkdir($path, 0755);
														$form->file->saveAs($path  . $project->logo, false);
															if(in_array($form->file->extension, ['jpg', 'png','jpeg'])){
																Image::thumbnail($path  . $project->logo, 120, 120)->save($path  . 'thumb_' . $project->logo, ['quality' => 90]);
														}
													}
												
											$arrResponse=[
												'name' => $project->logo,
												'file_name' =>  $project->logo,
												'url_file_name' =>  Yii::$app->params['url-channels'].'projects/logo/' . $project->logo,
												'id' => $project->id
											];	
											
									}
								
							}
							Yii::$app->response->format = Response::FORMAT_JSON;
								return Json::encode($arrResponse);
	}
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
									$imgSmallSquareDir = $pathSmallSquare.$saveUrl;


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



					/*	function generateThumbnail($img, $width, $height, $quality = 90,$new)
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
						*/


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
						$path = Yii::$app->params['path-building-project-image'] . $image->url; // Yii::getAlias('@common').'/images/building-project/';
						$pathLargeSquare = Yii::$app->params['path-building-project-large-square-image'] . $image->large_square_image;
						$pathMediumSquare = Yii::$app->params['path-building-project-medium-square-image'] . $image->medium_square_image;
						$pathSmallSquare = Yii::$app->params['path-building-project-small-square-image'] . $image->small_square_image;

						$pathLargeRectangle = Yii::$app->params['path-building-project-large-rectangle-image'] . $image->large_rectangle_image;
						$pathMediumRectangle = Yii::$app->params['path-building-project-medium-rectangle-image'] .
						$image->medium_rectangle_image;
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
						public function actionRemoveFile() {
									$arrResponse = array();
									if (Yii::$app->request->isPost) {
												$id = Yii::$app->request->post('id');
												$image = ProjectPriceList::findOne(['id' => $id]);
												if ($image) {
													$path = Yii::$app->params['PathChannels']. 'projects/price_list/' . $image->file_name; // Yii::getAlias('@common').'/images/building-project/';
													$pathThumb = Yii::$app->params['PathChannels']. 'projects/price_list/thumb_' . $image->file_name; // Yii::getAlias('@common').'/images/building-project/';
													if (file_exists($path)) unlink($path);
													if (file_exists($pathThumb)) unlink($pathThumb);
													$image->delete();
											}
									}
									echo json_encode($arrResponse);
									exit();
						}
							public function actionRemoveBanner() {
									$arrResponse = array();
									if (Yii::$app->request->isPost) {
												$id = Yii::$app->request->post('id');
												$projectBanner = ProjectBanner::findOne(['id' => $id]);
												if ($projectBanner) {
													$path = Yii::$app->params['PathChannels']. 'projects/banner/' . $projectBanner->file_name; // Yii::getAlias('@common').'/images/building-project/';
													$pathThumb = Yii::$app->params['PathChannels']. 'projects/banner/thumb_' . $projectBanner->file_name; // Yii::getAlias('@common').'/images/building-project/';
													if (file_exists($path)) unlink($path);
													if (file_exists($pathThumb)) unlink($pathThumb);
													if($projectBanner->delete()){
														Yii::$app->response->format = Response::FORMAT_JSON;
														$arrResponse = "Xoá thành công";
														return Json::encode($arrResponse);
													}
											}
									}
									$arrResponse = "Xoá thành công";
									return Json::encode($arrResponse);
						}
						public function actionRemoveLogo() {
									$arrResponse = array();
									if (Yii::$app->request->isPost) {
												$id = Yii::$app->request->post('id');
												$project = Project::findOne(['id' => $id]);
												if ($project) {
													$path = Yii::$app->params['PathChannels']. 'projects/logo/' . $project->logo; // Yii::getAlias('@common').'/images/building-project/';
													$pathThumb = Yii::$app->params['PathChannels']. 'projects/logo/thumb_' . $project->logo; // Yii::getAlias('@common').'/images/building-project/';
													if (file_exists($path)) unlink($path);
													if (file_exists($pathThumb)) unlink($pathThumb);
													$project->logo="";
													if($project->save(false)){
														Yii::$app->response->format = Response::FORMAT_JSON;
														$arrResponse = [ 
																"message" => "Xoá thành công",
																'url' => Yii::$app->params['url-channels'] . '/projects/no-image.png'
															];
														
														return Json::encode($arrResponse);
													}
											}
									}
									$arrResponse = "Xoá không thành công";
									return Json::encode($arrResponse);
					}
					public function actionInvestorLogoRemove() {
									$arrResponse = array();
									if (Yii::$app->request->isPost) {
												$id = Yii::$app->request->post('id');
												$project = ProjectInvestor::findOne(['id' => $id]);
												if ($project) {
													$path = Yii::$app->params['PathChannels']. 'projects/logo_investor/' . $project->logo; // Yii::getAlias('@common').'/images/building-project/';
													$pathThumb = Yii::$app->params['PathChannels']. 'projects/logo_investor/thumb_' . $project->logo; // Yii::getAlias('@common').'/images/building-project/';
													if (file_exists($path)) unlink($path);
													if (file_exists($pathThumb)) unlink($pathThumb);
													$project->logo="";
													if($project->save(false)){
														Yii::$app->response->format = Response::FORMAT_JSON;
														$arrResponse = [ 
																"message" => "Xoá thành công",
																'url' => Yii::$app->params['url-channels'] . '/projects/no-image.png'
															];
														
														return Json::encode($arrResponse);
													}
											}
									}
									$arrResponse = "Xoá không thành công";
									return Json::encode($arrResponse);
					}
					public function actionSectionImageRemove() {
									$arrResponse = array();
									if (Yii::$app->request->isPost) {
												$id = Yii::$app->request->post('id');
												$project = ProjectSection::findOne(['id' => $id]);
												
												if ($project) {
													$path = Yii::$app->params['PathChannels']. 'projects/section/' . $project->image; // Yii::getAlias('@common').'/images/building-project/';
													$pathThumb = Yii::$app->params['PathChannels']. 'projects/section/thumb_' . $project->image; // Yii::getAlias('@common').'/images/building-project/';
													if (file_exists($path)) unlink($path);
													if (file_exists($pathThumb)) unlink($pathThumb);
													$project->image="";
													if($project->save(false)){
														Yii::$app->response->format = Response::FORMAT_JSON;
														$arrResponse = [ 
																"message" => "Xoá thành công",
																'url' => Yii::$app->params['url-channels'] . '/projects/no-image.png'
															];
														
														return Json::encode($arrResponse);
													}
											}
									}
									$arrResponse = "Xoá không thành công";
									return Json::encode($arrResponse);
					}
	public function actionChecked() {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            $model = Project::find()->andWhere(['id' => $id])->one();
            $model->status = $status;
			if ($model->save(false)) {
                $data = [
                    'id' => $model->id,
					'status' => (int) $model->status,
                    'text' => Project::getListStatus($model->status,true),
                    'message' => "Cập nhập thành công"
                ];
                return \yii\helpers\Json::encode($data);
            }
        }
	}
	/**
     * Deletes an existing house model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProjectSectionDelete($id,$project_id)
    {
        $model = $this->findModel($id);
       	$model->delete();
       	Yii::$app->session->setFlash('warning', "Xoá thành công"); //exit;
		Yii::$app->getResponse()->redirect(['project/project-section','id'=> $project_id,'menu' => $this->menu]);
		Yii::$app->end();
	}
	protected function findModel($id)
    {
        
        if (($model = ProjectSection::findOne(['id' => $id]))!== null) {
            return $model;
        }
            
        throw new NotFoundHttpException('The requested page does not exist.');
    }

		

}