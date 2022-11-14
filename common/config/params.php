<?php

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
//$actual_link = "http://$_SERVER[HTTP_HOST]/";
return [
    'url-page-chat' =>  'https://chat.e-land.vn/',
    'url-page' => $actual_link,
	'elandUrl'=> $actual_link,
	'elandUrlProject'=> $actual_link .'du-an',
    'adminEmail' => 'duongtranha.vnit@gmail.com',
    'supportEmail' => 'batdongsaneland@gmail.com',
    'user.passwordResetTokenExpire' => 3600,
    'timeZone' => 'Asia/Ho_Chi_Minh',

    'UrlShop' => $actual_link .'shop',
    'PathShop' => dirname(dirname(dirname(__FILE__)))."/shop/web/",

    'PathProducts' => dirname(dirname(dirname(__FILE__)))."/frontend/web/products/",
    'url-products'  =>  $actual_link . 'products/',
		'PathChannels' => dirname(dirname(dirname(__FILE__)))."/frontend/web/channels/",
		'url-channels'  =>  $actual_link . 'channels/',
	

	'PathChannels' => dirname(dirname(dirname(__FILE__)))."/frontend/web/channels/",
	'PathImageArticle' => dirname(dirname(dirname(__FILE__)))."/frontend/web/images/article/",
	'url-images-article' =>  $actual_link . '/images/article/',
    'PathFrontend' => dirname(dirname(dirname(__FILE__)))."/frontend/web/",

	'PathImageArticleSmall' => dirname(dirname(dirname(__FILE__)))."/frontend/web/images/article/small/",
	'path-article-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/article/image/',
	
	'url-images-article-small' =>  $actual_link . '/images/article/small/',
	'url-article-image-small' =>   $actual_link . '/article/image/small/',
    'path-building-project-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/',
    
    'path-building-project-large-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/large_image/',
    'path-building-project-medium-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/medium_image/',
    'path-building-project-small-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/small_image/',
    
    'path-building-project-large-rectangle-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/large_rectangle_image/',
    'path-building-project-medium-rectangle-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/medium_rectangle_image/',
    'path-building-project-small-rectangle-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/small_rectangle_image/',
  
    'path-building-project-large-square-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/large_square_image/',
    'path-building-project-medium-square-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/medium_square_image/',
    'path-building-project-small-square-image' =>  dirname(dirname(dirname(__FILE__))) . '/frontend/web/images/building_project/small_square_image/',
  
	
    'url-image' =>   $actual_link . '/images/',
    'url-building-project-image' =>  $actual_link . '/images/building_project/',
    
    'url-building-project-large-image' =>  $actual_link .  '/images/building_project/large_image/',
    'url-building-project-medium-image' =>  $actual_link .  '/images/building_project/medium_image/',
    'url-building-project-small-image' =>   $actual_link .  '/images/building_project/small_image/',
    
    
    'url-building-project-large-rectangle-image' =>  $actual_link .  '/images/building_project/large_rectangle_image/',
    'url-building-project-medium-rectangle-image' =>  $actual_link .  '/images/building_project/medium_rectangle_image/',
    'url-building-project-small-rectangle-image' =>  $actual_link .  '/images/building_project/small_rectangle_image/',
    
    
    'url-building-project-large-square-image' =>  $actual_link .  '/images/building_project/large_square_image/',
    'url-building-project-medium-square-image' =>  $actual_link .  '/images/building_project/medium_square_image/',
    'url-building-project-small-square-image' =>  $actual_link .  '/images/building_project/small_square_image/',
    
    'passDefault' => 'elandvn',
    'elandEmail' => 'batdongsaneland@gmail.com',
    'elandPhone' => '035-9696-234',
	'elandFacebook' => 'https://www.facebook.com/groups/batdongsan.e.land.vietnam',
	'elandZalo' => 'https://zalo.me/g/retrxr426',
    'elandAddress' => 'Phòng 4.01, Tòa nhà The Prince Residence, 17-19 Nguyễn Văn Trỗi, Phường 11, Quận Phú Nhuận',
    'elandCompany' => '© 2020 - Bản quyền của Công Ty TNHH EAGLE SKY TECHNOLOGY - Giấy chứng nhận Đăng ký Kinh doanh số 0314954021',
    
    
	
];
