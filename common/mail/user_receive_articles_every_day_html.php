<?php
use yii\helpers\Html;
use Yii;
use yii\helpers\Url;
Yii::setAlias('@web', Yii::$app->params['elandUrl']);
/* @var $this yii\web\View */
/* @var $user common\models\User */
$settingEmail =  Yii::$app->params['elandUrl']. 'kenh/' . $user->id. '/cai-dat';
?>
<html lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <title>Tin rao bán</title>
  </head>
  <div
    style="
      margin-bottom: 30px;
      background-color: rgb(204, 204, 204);
      border-radius: 5px;
      padding: 10px;
      font-size: 11pt;
    "
  >
    <table
      width="100%"
      align="center"
      bgcolor="white"
      cellpadding="0"
      cellspacing="0"
      style="margin: 0 auto; width: 100%; max-width: 550px; border-radius: 5px"
    >
      <tbody>
        <tr>
          <td style="padding: 10px">
            <table
              style="
                float: left;
                width: 100%;
                height: 70px;
                border-bottom: 1px solid #c00;
              "
            >
              <tr>
                <td>
                  <a
                    title="Kênh rao bán bất động sản"
                    href="<?php echo Yii::$app->params['elandUrl'];?>"
                  >
                    <img
                      style="width: 130px"
                      src="<?php echo Yii::$app->params['elandUrl'];?>e-land/img/logo.png"
                    />
                  </a>
                </td>
					<td><center>NỀN TẢNG BẤT ĐỘNG SẢN <br/>SẢN PHẨM THẬT</center></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <div style="width: 150px; float: right">
              <label style="float: left; margin-right: 5px; font-weight: bold">
                Nhóm |
              </label>
              <a
                title="Nhóm facebok"
                href="<?php echo Yii::$app->params['elandFacebook'];?>"
                target="_blank"
              >
                <img
                  style="
                    width: 30px;
                    height: 30px;
                    float: left;
                    margin-right: 10px;
                  "
                  src="<?php echo Yii::$app->params['elandUrl'];?>/images/icon_facebook.png"
                />
              </a>
              <a title="Nhóm zalo" href="<?php echo Yii::$app->params['elandZalo'];?>">
                <img
                  style="
                    width: 30px;
                    height: 30px;
                    float: left;
                    margin-right: 10px;
                  "
                  src="<?php echo Yii::$app->params['elandUrl'];?>/images/icon_zalo.png"
                />
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 10px">
            <p>Chào <?php echo Html::encode($user->name) ?>,</p>
            <ul>
              <li>
                <p>
                  Eland xin gửi tới bạn <?php echo count($articles);?> tin rao vừa được đăng mà bạn muốn quan
                  tâm.
                </p>
              </li>
              <li>
                <p>
                  Những tin rao mới này được hệ thống Eland tự động phân loại
                  thông qua thuật toán tìm kiếm theo nhu cầu của bạn.
                </p>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <tr>
              <td style="padding: 10px">
                <div style="float: left">
                  <strong><?php echo $title;?></strong>
                </div>
              </td>
            </tr>
          </td>
        </tr>
         <?php foreach ($articles as $key => $value) { ?>
        <tr>
          <td style="padding: 10px">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="border: 1px solid #ddd;padding: 5px;border-radius: 4px;margin-bottom: 15px;">
                  <div style="float: left; width: calc(100% - 100px)">
                    <div style="padding: 10px; width: calc(100% - 20px); float: left">
                      <a style="padding: 0px; font-size: 11pt; color: #111; font-weight: 600; text-decoration: none; width: 100%;"
                        title="<?php echo $value->title; ?>"
						
                        href="<?php echo Yii::$app->params['elandUrl'];?><?php echo (isset($value->category) && $value->category->slug=="mua-ban")? 'mua-ban':'cho-thue';?>/<?php echo  isset($value->province)?$value->province->slug:'';?>/<?php echo isset($value->district)?$value->district->slug:'';?>/<?php echo $value->slug;?>"
                        target="_blank"><?php echo $value->title; ?></a>
                      <div style="border-bottom: 1px solid #ddd; margin-top: 5px"></div>
                      <div style=" width: 100%; padding: 3px 0; margin-top: 5px; float: left; font-size: 11pt;">
                        <a style="padding: 0px; font-size: 11pt; color: #999; font-weight: bold; text-decoration: none;
                            width: 100%;"
                          title="<?php echo $value->user->name;?>"
                          href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $value->user->id;?>"   target="_blank">
                          <img
                            alt="<?php echo $value->user->name;?>"
                            style="width: 38px; height: 38px; float: left; border: 1px solid #ddd; border-radius: 100px;
                              margin-right: 10px;"
                            onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                            src="<?php echo Url::to( ($value->user &&  $value->user->image!="no-image.png")? '@web/channels/avatar/' .  $value->user->image: '@web/images/no-image200x200.png', true)?>"
                          />
                        </a>
                        <div style="width: calc(100% - 60px); float: left">
                          <div style="width: 100%; float: left">
                            <span style="display: block"><strong>Giá: </strong><?php echo $value->price_text; ?></span>
                            <span style="display: block"><strong>Diện tích : </strong><?php echo $value->area_text; ?></span>
                            <div style="width: 100%; float: left">
                              <div>
                                  <?php if(isset($value->district) && isset($value->province)){?>
                                <a
                                  style="text-decoration: none; color: #111"
                                  title="<?php echo isset($value->district)?($value->district->type . ' ' . $value->district->name):'';?>"
                                  href="<?php echo Yii::$app->params['elandUrl'];?><?php echo $value->province->slug;?>/<?php echo $value->district->slug;?>"
                                  target="_blank">
                                 <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                                </a>
                                <a
                                  style="text-decoration: none; color: #111"
                                  title="<?php echo isset($value->province)?$value->province->name:'';?>"
                                  href="<?php echo Yii::$app->params['elandUrl'];?><?php echo $value->province->slug;?>"
                                  target="_blank">
                                  ,  <?php echo isset($value->province)?$value->province->name:'';?>
                                </a>
                                 <?php }?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <a title="<?php echo $value->title; ?>" href="<?php echo Yii::$app->params['elandUrl'];?><?php echo (isset($value->category) && $value->category->slug=="mua-ban")? 'mua-ban':'cho-thue';?>/<?php echo  isset($value->province)?$value->province->slug:'';?>/<?php echo isset($value->district)?$value->district->slug:'';?>/<?php echo $value->slug;?>">
                  <img
                    width="80"
                    style="margin: 10px; float: right; border-radius: 4px"
                    alt="<?php echo $value->title;?>"

                    onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                    src="<?php echo Url::to('@web/channels/article/745x510/' .  $value->images[0]->image, true);?>"
                  />
				  
                  </a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
         <?php } ?>
         <tr>
            <td style="text-align: center; padding: 10px 0px;">
                        <a style="color: #fff;background-color: #c00; border-color: #c00;text-decoration: none; display: inline-block; padding: 5px 15px; border-radius: 2px; margin: 0px auto"
                            title="Xem chi tiết" href="<?php echo Yii::$app->params['elandUrl'];?>">Xem thêm</a>
                    </td>
        </tr>
        <tr>
          <td style="padding: 30px">
            <div
              style="
                width: 100%;
                border-radius: 1px;
                float: left;
                font-size: 13pt;
              "
            >
              <p>Chúc anh/chị tìm được sản phẩm bất động sản ưng ý từ E-land.VN</p>
              <p>Trân trọng!</p>
              <div style="font-size: 11pt; color: #5c5c5c; font-style: italic">
                <ul>
                  <li>
                    <p>
                      Tìm kiếm nhiều sản phẩm hơn:
                      <a
                        title="Tìm kiếm"
                        href="<?php echo Yii::$app->params['elandUrl'];?>"
                        target="_blank"
                        >Tìm kiếm</a
                      >
                    </p>
                  </li>
                  <li>
                    <p>
                      Đăng tin rao bán sản phẩm :
                      <a
                        title="Đăng tin rao"
                        href="<?php echo Yii::$app->params['elandUrl'];?>dang-ky"
                        target="_blank"
                        >Đăng ký &amp; Đăng tin</a
                      >
                    </p>
                  </li>
                </ul>

                <p>Mọi thắc mắc xin vui lòng liên hệ:</p>
                <p>
                  Email: <?php echo Yii::$app->params['elandEmail'];?>
                </p>
                <p>Phone: <?php echo Yii::$app->params['elandPhone'];?> </p>
                <p>
                  Địa chỉ: <?php echo Yii::$app->params['elandAddress'];?>
                </p>
              </div>
            </div>
          </td>
        </tr>
       
      </tbody>
    </table>
  </div>
</html>

