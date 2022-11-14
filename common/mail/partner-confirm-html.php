<?php

use yii\helpers\Html;
use  yii\helpers\Url;

?>
<html>
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
    style="margin: 0 auto; width: 100%; max-width: 800px; border-radius: 5px"
  >
    <tbody>
      <tr>
        <td style="padding: 10px">
          <table style="border-bottom: 1px solid #c00">
            <tr>
              <td>
                <a
                  title="Kênh rao bán bất động sản"
                  href="https://e-land.vn/"
                >
                  <img
                    width="100%"
                    src="https://e-land.vn/img-mail/mail-banner.png"
                  />
                </a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      
      <tr>
        <td>
          <table
            cellpadding="0"
            cellspacing="0"
            border="0"
            width="100%"
            align="center"
            bgcolor="#ffffff"
            style="
              padding: 0px;
              line-height: 1px;
              font-size: 1px;
              margin: 0px auto;
            "
          >
            <tbody>
              <tr>
                <td
                  style="
                    padding: 0px;
                    margin: 0px auto;
                    font-size: 0px;
                    line-height: 1px;
                    padding: 0px;
                  "
                >
                  <table
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    width="100%"
                    align="center"
                    style="
                      padding: 0px;
                      line-height: 1px;
                      font-size: 1px;
                      margin: 0px auto;
                    "
                  >
                    <tbody>
                      <tr>
                        <td
                          width="24"
                          style="
                            padding: 10px 20px 10px 10px;
                            margin: 0px auto;
                            font-size: 0px;
                            line-height: 1px;
                          "
                        >
                         
                        </td>
                        <td
                          align="center"
                          style="
                            padding: 0px;
                            margin: 0px auto;
                            font-size: 0px;
                            line-height: 1px;
                            padding: 0px;
                          "
                        >
                         
                         
                         
                         <table>
                          <tbody>
                              
                              <tr>
                                  <td>
                                  <p style="font-size:17px;font-weight:bold;color:#444;margin:20px 0px">Chào bạn <?php echo $userPartner->name;?>,</p>
                                  <p style="margin:7px 0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal">
								   <strong><?php echo $user->name;?></strong> mời bạn trở thành đối tác kênh rao bán bất động sản E-land.VN,
									Để trở thành đối tác chính thức của E-land.VN, bạn cần thực hiện các bước sau:
								  </p>
								 
                                  
                                  </td>
                              </tr>
                              
                             
                              <tr>
                                  <td style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px">
								  <a style="text-decoration: none; border-style: none; border: 0px;padding: 0px; margin: 0px; font-size: 14px; font-family: 'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 50px; padding: 5px 18px; background-color: #c00; border: 1px solid #c00; display: inline-block; font-weight: bold;"
												title="Xem chi tiết" href="<?=$comfirmLink;?>" target="_blank">
										Xác nhận</a>
									Kích hoạt tài khoản đối tác
									
                                  </td>
                              </tr>
                              
                             
                          </tbody>
                      </table>
                         </td>
                        <td
                          width="24"
                          style="
                            padding: 0px;
                            margin: 0px auto;
                            font-size: 0px;
                            line-height: 1px;
                            padding: 0px;
                          "
                        ></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

        
        </td>
      </tr>
	  <tr>
          <td style="padding: 30px">
            <div style="
                width: 100%;
                border-radius: 1px;
                float: left;
                font-size: 13pt;
              ">
              <p style="margin:0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal">
				<a href="<?=$benefitLink;?>" title="Quyền lợi khi trở thành đối tác E-land.VN" target="_blank"> <strong>Quyền lợi khi trở thành đối tác E-land.VN</strong>.</a>
				</p>
             
              <div style="font-size: 11pt; color: #5c5c5c; font-style: italic">
                <p style="margin:10px 0 0 0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal">
					Bạn cần được hỗ trợ ngay? gọi số điện thoại <strong style="color:#099202"><?php echo $about->phone;?></strong> (8-21h cả T7,CN). Đội ngũ E-land.VN Care luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
				<p>
                  Địa chỉ: <?php echo $about->address;?>
                </p>
              </div>
            </div>
          </td>
        </tr>
    </tbody>
  </table>
</div>
</html>

