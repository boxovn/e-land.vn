<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ProductImage;
use backend\models\ProductUploadFile;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use yii\web\Response;
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AppController
{
   /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post())){
            if($model->save(false)){
                $stringImageId= Yii::$app->request->post('upload_product_image_id');
                $arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
                $arrTemp = array_unique($arrTemp); 
                // Image thumbnail
                        foreach ($arrTemp as $image_id) {
                            if(!empty($image_id)) {
                                $articleImage = ProductImage::findOne(['id' => $image_id]);
                                $articleImage->product_id = $model->getPrimaryKey();
                                $articleImage->save(false);
                            }
                        } 
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }
        $maxId = Product::find()->count() + 1;
        $code = 'A-' . $maxId;
        $model->code =   $code;
       return $this->render('create', [
            'model' => $model,
         
            
        ]);
    }
    public function  actionMultipleUploadImages(){
                                $id = Yii::$app->request->get('id',0);
								$form = new ProductUploadFile();
								$arrResponse = array();
								$user = Yii::$app->user->identity;
									if (Yii::$app->request->isPost) {
										 $form->file = UploadedFile::getInstanceByName('file');
										//$form->files = UploadedFile::getInstances($form, 'files');
										if ($form->file && $form->validate()) {
												$productImage = new ProductImage();
												$path = Yii::$app->params['PathProducts']. 'images/';// Yii::getAlias('@common') .'/images/building-project/';
												$productImage->name =  $form->file->name;
												$productImage->user_id= $user->id;
												$productImage->product_id= $id;
												$productImage->size = $form->file->size;
												$productImage->type = $form->file->type;
												$productImage->file_name = gettimeofday()['usec'] . '.' . $form->file->extension;
												if ($productImage->save(false)) {
													if (!is_dir($path)) mkdir($path, 0755);
														$form->file->saveAs($path  . $productImage->file_name, false);
															if(in_array($form->file->extension, ['jpg', 'png','jpeg','gif'])){
																Image::thumbnail($path  . $productImage->file_name, 200, 200)->save($path  . 'thumb_' . $productImage->file_name,['quality' => 100]);
														}
													}
												    $arrResponse=[
                                                    'name' => $productImage->name,
                                                    'file_name' =>  $productImage->file_name,
                                                    'url_file_name' =>  Yii::$app->params['url-products'].'images/' . $productImage->file_name,
                                                    'id' => $productImage->id
                                                ];	
                                                
									}
								
							}
							Yii::$app->response->format = Response::FORMAT_JSON;
								return Json::encode($arrResponse);
	}
    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {   
            $model->updated = date('Y-m-d H:i:s');
           
            $model->save();
            return $this->redirect(['index']);
        }
       
        return $this->render('update', [
            'model' => $model,
            'dropzoneImage' => $this->dropzoneProductImages($id),
        ]);
    }
    private function dropzoneProductImages($id){
       $productImages = ProductImage::find()
        				->where(['product_id' => $id])
                        ->all();
                        
		$dropzoneFile = array();
        if ($productImages) {
        	foreach ($productImages as  $item) {
                $dropzoneFile[] =[
					'name' => $item->name,
					'file_name' =>  $item->file_name,
                	'id' => $item->id,
        			'url_file_name' => Yii::$app->params['url-products'].'images/thumb_'. $item->file_name,
					'type' =>'image/*',
					'size' => '100',//$item->size,
				];
        	}
		} 
		return  $dropzoneFile;
	}

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)){
           $productImages = $this->findModel($id)->productImages;
            foreach( $productImages  as $key => $productImage){
           
              $this->removeProductImage($productImage);
            $productImage->delete();
            }
            $this->findModel($id)->delete();
        }
         return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRemoveFile() {
        $arrResponse = array();
        if (Yii::$app->request->isPost) {
                    $id = Yii::$app->request->post('id');
                    $productImage = ProductImage::findOne(['id' => $id]);
                    if ($productImage) {
                        $this->removeProductImage($productImage);
                        $productImage->delete();
                    }
        }
        echo json_encode($arrResponse);
        exit();
    }
    protected function removeProductImage($productImage){
       
       if ($productImage) {
            $path = Yii::$app->params['PathProducts']. 'images/' . $productImage->file_name; 
            $pathThumb = Yii::$app->params['PathProducts']. 'images/thumb_' . $productImage->file_name; 
            if (file_exists($path)) unlink($path);
            if (file_exists($pathThumb)) unlink($pathThumb);
           return true;
        }
        return false;
    }


}