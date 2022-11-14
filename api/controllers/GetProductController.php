<?php
namespace api\controllers;
use yii;
use common\models\User;
use common\models\Article;
use common\models\District;
use common\models\Province;
use common\models\Street;
use common\models\SettingCronjobGetUser;
use yii\web\Controller;
use yii\helpers\Json;
use yii\web\Response;


class GetProductController extends Controller {
    /**
     * 
     */
	 public function actionAddress() {
		 $array =array();
		 $articles = Article::find()->all();
		 foreach($articles as $value){

			$array = explode(',',$value->address);
			$array = array_map('trim',$array);
			$district = District::find()->andWhere(['name' => $array])->one();
			$province = Province::find()->andWhere(['name' => $array])->one();
			$street = Street::find()->andWhere(['name' => $array])->one();
			if($district ){
				$value->district_id =  $district->district_id;
			}
			if($province ){
				$value->province_id =  $province->province_id;
			}
			if($street ){
				$value->street_id =  $street->street_id;
			}
			$value->save(false);
		 }
		 return true;
	}
	public function actionIndex() {
			$message = "";
			$objects = array();
			$error = 0;
			
		if (Yii::$app->request->isGet) {
					$settingCronjobGetUser  =	SettingCronjobGetUser::find()->andWhere('page_total <> page_count')->orderBy('url desc')->one();
					if($settingCronjobGetUser){
						$url =  $settingCronjobGetUser->url;
						$settingCronjobGetUser->page_count = $settingCronjobGetUser->page_count + 1;
						$settingCronjobGetUser->save(false);
					}
					$pages = $this->getUrlPage('https://danhkhoireal.vn/danh-muc/nha-o-xa-hoi/'); 
					var_dump($pages);
					die;
						foreach ($pages as $key => $page) {
							$user_phone = isset($page['phone']) ? $page['phone'] : '';
							$user_email = isset($page['email']) ? $page['email'] : '';
							$user = User::findOne(['email' => $user_email, 'phone' => $user_phone]);
							if(!$user){
									$page_name = $page['page_name']? $page['page_name']:'';
									$page_url = $page['page_url']? $page['page_url']:'';
									$user_name = isset($page['name']) ? $page['name'] : '';
									$user_email = isset($page['email']) ? $page['email'] : '';
									$user_phone = isset($page['phone']) ? $page['phone'] : '';
									$user_province = isset($page['province']) ? $page['province'] : '';
									$user_district = isset($page['district']) ? $page['district']: '';
									$article_type = isset($page['article_type']) ? $page['article_type']: '';
									$address = isset($page['address']) ? $page['address']: '';
									$district = District::find()->andWhere(['name' => $user_province])->one();
									$province = Province::find()->andWhere(['name' => $user_district])->one();
									$user = new User();
									$user->name = trim($user_name);
									$user->email = trim($user_email);
									$user->phone = trim($user_phone);
									$user->page_name = trim($page_name);
									$user->page_url = trim($page_url);
									$user->active= 0;
									$user->article_type = trim($article_type);
									$user->address = trim($address);
									$user->district_id= isset($district->district_id)?$district->district_id:0;
									$user->province_id= isset($province->province_id)?$province->province_id:0;
									$user->save(false);
							}
							
						}
		}
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		return Json::encode([
					'object' => $settingCronjobGetUser
		]);

	}
	public function getCopy($url='', $path=''){
		$fp = fopen ($path, 'w+');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50); //timeout
		curl_setopt($ch, CURLOPT_FILE, $fp); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		return true;
	}
    public function getUrlPage($url, $page=1){
		if($page==1){
			return 	$this->getUrl($url);
		}else{
			$url = $url . '/p'. $page;
		return	$this->getUrl($url);
		}
}
 public function getUrl($url){
	
	$links = [];
	$apar=[];
	//$description[];
     $doc = $this->getDocument($url);
	 $xpath = new \DOMXPath($doc);
	
	//$xpath = $this->getXPath($url);
	$hrefs = $xpath->query('//a[@class="du-an-item-thumb thumb-full item-thumbnail"]');
	//$hrefs = $xpath->query('//img');
	 	
	foreach($hrefs as $key => $li_node){
		$links[]=  $li_node->getAttribute("href");
            //	$links[]=  $li_node->getAttribute("src");
	}
	
	foreach($links as $key => $link){
			
        $apar[]= $this->apartment($link);
	}
 
	return  $apar;
}
 public function getContent($url){
		//$agent= 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.192 Safari/537.36)';
		$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                curl_setopt($ch, CURLOPT_URL,$url);
				$result=curl_exec($ch);
				
                return $result;
}

 public function getDocument($url){
	$document = $this->getContent($url);
	$doc = new \DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML($document);
	return $doc;
}

 /*public function getXPath($url){
	$doc = $this->getDocument($url);
	$xpath = new \DOMXPath($doc);
	return $xpath;
}
*/
public function apartment($url){
	
	$project= array();
     //   $url='https://batdongsan.com.vn/ban-can-ho-chung-cu-duong-nguyen-duc-canh-phuong-tuong-mai-prj-hud3-nguyen-duc-canh/90-4m2-3phong-ngu-60-h-truc-tiep-cdt-lh-0966-593-130-pr18787708';
	//$xpath = $this->getXPath($url);
    $doc = $this->getDocument($url);
    $xpath = new \DOMXPath($doc);
	$project['page_url']= $url;
	$parse = parse_url($url);
	$project['page_name'] = $parse['host'];
	
	$title = $xpath->query('//h1[@class="single-title"]');
	if(!$title ->item(0)){
		$project['name'] = '';
	}else{
		$project['name'] =  trim($title->item(0)->nodeValue);
	} 
	$h2titles = $xpath->query('//section[@class="single-content-wrap single-content"]/h2');
	foreach($h2titles as $key => $li_node){
		$project['title'][]=  $li_node->nodeValue;
	}
	$contents = $xpath->query('//section[@class="single-content-wrap single-content"]/p');
	foreach($contents as $key => $li_node){
		$project['content'][]=  $li_node->nodeValue;
	}
	$uls = $xpath->query('//section[@class="single-content-wrap single-content"]/ul');
	foreach($uls as $key => $li_node){
		$project['ul'][]=  $li_node->nodeValue;
	}
/*
	//$phones =  $xpath->query('//div[@class="phone"]/span[@class="phoneEvent"]/@raw');
	$phones = $xpath->query("//span[@class='phoneEvent']/@raw");
	if(!$phones ->item(0)){
		$project['phone']  = '';
	}else{
		$project['phone']  =trim($phones->item(0)->nodeValue);
	}
	$emails= $xpath->query('//a[@id="email"]/@data-email');
	if(!$emails ->item(0)){
		$project['email']  = '';
	}else{
		$project['email']  = trim($emails->item(0)->nodeValue);
	}

	$provinces= $xpath->query('//a[@level="2"]');
	if(!$provinces ->item(0)){
		$project['province']  = '';
	}else{
		$project['province']  = trim($provinces->item(0)->nodeValue);
	}

	$districts= $xpath->query('//a[@level="3"]');
	if(!$districts->item(0)){
		$project['district']  = '';
	}else{
		$project['district']  = trim($districts->item(0)->nodeValue);
	}

	$districts= $xpath->query('//span[@class="r2"]');
	if(!$districts->item(0)){
		$project['article_type']  = '';
	}else{
		$project['article_type']  = trim($districts->item(0)->nodeValue);
	}

	$districts= $xpath->query('//span[@class="r2"]');
	if(!$districts->item(0)){
		$project['address']  = '';
	}else{
		$project['address']  = trim($districts->item(1)->nodeValue);
	}*/
	return $project;
}


}