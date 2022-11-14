<?php
use yii\helpers\Html;
use Yii;
use yii\helpers\Url;
Yii::setAlias('@web', 'https://batdongsaneland.com');
$settingEmail =  Yii::$app->params['elandUrl']. 'kenh/' . $user->id. '/cai-dat';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <title>Thư mời</title>
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
            <table style="border-bottom: 1px solid #c00">
              <tr>
                <td>
                  <a
                    title="Kênh rao bán bất động sản"
                    href="<?php echo Yii::$app->params['elandUrl'];?>"
                  >
                    <img
                      width="100%"
                      src="<?php echo Url::to('@web/img-mail/mail-banner.png', true)?>"
                    />
                  </a>
                </td>
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
                href="https://www.facebook.com/groups/batdongsan.e.land.vietnam"
                target="_blank"
              >
                <img
                  style="
                    width: 30px;
                    height: 30px;
                    float: left;
                    margin-right: 10px;
                  "
                  src="https://batdongsaneland.com/images/icon_facebook.png"
                />
              </a>
              <a title="Nhóm zalo" href="https://zalo.me/g/yxpkti032">
                <img
                  style="
                    width: 30px;
                    height: 30px;
                    float: left;
                    margin-right: 10px;
                  "
                  src="https://batdongsaneland.com/images/icon_zalo.png"
                />
              </a>
            </div>
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
            >
              <tbody>
                <tr>
                  <td>
                    <table
                      cellpadding="0"
                      cellspacing="0"
                      border="0"
                      width="100%"
                      align="center"
                    >
                      <tbody>
                        <tr>
                          <td
                            width="100"
                            style="
                              padding: 10px 20px 10px 10px;
                              margin: 0px auto;
                              font-size: 0px;
                              line-height: 1px;
                            "
                          >
                            <a
                              href="#"
                              style="
                                text-decoration: none;
                                border-style: none;
                                border: 0px;
                                padding: 0px;
                                margin: 0px;
                              "
                              target="_blank"
                            >
                              <img
                                src="<?php echo Url::to('@web/images/loudspeaker.png',true)?>"
                                width="100"
                                style="
                                  margin: 0px;
                                  padding: 0px;
                                  display: inline-block;
                                  border: none;
                                  outline: none;
                                  border-radius: 100px;
                                "
                              />
                            </a>
                          </td>
                          <td>
                            <table
                              cellpadding="0"
                              cellspacing="0"
                              border="0"
                              align="center"
                              width="100%"
                            >
                              <tbody>
                                <tr>
                                  <td>
                                    
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p><strong><?php echo $user->name;?> ơi!,</strong></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                   
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p
                                      align="left"
                                      style="
                                        padding: 0px;
                                        margin: 0px auto;
                                        color: #292f33;
                                        font-family: 'Helvetica Neue', Helvetica,
                                          Arial, sans-serif;
                                        font-size: 32px;
                                        padding: 0px;
                                        margin: 0px;
                                        font-weight: bold;
                                        line-height: 36px;
                                      "
                                    >
                                      Đến giờ đăng tin rao trên Eland rồi! :))
                                    </p>
                                   <p style="
                                        font-weight: bold;
                                        font-style: italic;
                                        font-size: 11pt;
                                      "
                                      >Theo nghiên cứu thời gian khách hàng tìm
                                      kiếm bất động sản online là:</p>
                                  </p>
                                     <p style="font-style: italic; font-size: 11pt;">
                                      - trước 9h sáng, </p>
                                      <p style="font-style: italic;font-size: 11pt;">
                                      - sau 11h30 trưa, </p>
                                      <p style="font-style: italic;font-size: 11pt;">
                                      - 16h30 chiều và 20h tối.
                                      </p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    &nbsp;
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <table
                                      border="0"
                                      cellspacing="0"
                                      cellpadding="0"
                                      align="left"
                                      >
                                      <tbody>
                                        <tr>
                                          <td
                                            align="center"
                                            bgcolor="#c00"
                                            style="
                                              padding: 0px;
                                              margin: 0px auto;
                                              border-radius: 50px;
                                              line-height: 18px;
                                            "
                                          >
                                            <a
                                              href=""
                                              style="
                                                text-decoration: none;
                                                border-style: none;
                                                border: 0px;
                                                padding: 0px;
                                                margin: 0px;
                                                font-size: 14px;
                                                font-family: 'HelveticaNeue',
                                                  'Helvetica Neue', Helvetica,
                                                  Arial, sans-serif;
                                                color: #ffffff;
                                                text-decoration: none;
                                                border-radius: 50px;
                                                padding: 8px 18px;
                                                border: 1px solid #c00;
                                                display: inline-block;
                                                font-weight: bold;
                                              "
                                              target="_blank"
                                            >
                                              Đăng tin rao
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" align="center">
              <tbody>
                <tr>
                  <td>
                    <table
                      cellpadding="0"
                      cellspacing="0"
                      border="0"
                      align="center"
                      width="100%"
                    >
                      <tbody>
                        <tr>
                          <td>
                          </td>
                        </tr>
                        <tr>
                          <td
                            align="center"
                            style="
                              padding: 0px;
                              margin: 0px auto;
                              color: #8899a6;
                              font-family: 'Helvetica Neue Light', Helvetica,
                                Arial, sans-serif;
                              font-size: 12px;
                              padding: 0px;
                              margin: 0px;
                              font-weight: normal;
                              line-height: 16px;
                              font-weight: bold;
                            "
                          >
                            <a
                              href="https://twitter.com/i/redirect?url=https%3A%2F%2Fsupport.twitter.com%2F&amp;t=1+1605402562260&amp;cn=YWN0aXZpdHlfZGlnZXN0X3dpdGhfaGVhZGxpbmVfY2hhbmdl&amp;sig=f909a44306d50a93a2463efb26218a175dc2764b&amp;iid=3610b930adcf4d37adeebf609a766f8a&amp;uid=533793245&amp;nid=296+4"
                              style="
                                text-decoration: none;
                                border-style: none;
                                border: 0px;
                                padding: 0px;
                                margin: 0px;
                                color: #c00;
                              "
                            >
                              Hướng dẫn đăng tin
                            </a>
                            &nbsp;|&nbsp;
                            <a
                              href="https://twitter.com/i/redirect?url=https%3A%2F%2Ftwitter.com%2Faccount%2Fbegin_password_reset%3Faccount_identifier%3Dduongtranha&amp;t=1+1605402562261&amp;cn=YWN0aXZpdHlfZGlnZXN0X3dpdGhfaGVhZGxpbmVfY2hhbmdl&amp;sig=92d12d0f28923ebbb98f3ce8750b6fae206c91fb&amp;iid=3610b930adcf4d37adeebf609a766f8a&amp;uid=533793245&amp;nid=296+7"
                              style="
                                text-decoration: none;
                                border-style: none;
                                border: 0px;
                                padding: 0px;
                                margin: 0px;
                                color: #c00;
                              "
                              target="_blank"
                            >
                              Tại sao đăng tin đúng giờ?
                            </a>
                            &nbsp;|&nbsp;
                            <a
                              href="https://twitter.com/i/redirect?url=https%3A%2F%2Ftwitter.com%2Fdownload&amp;t=1+1605402562263&amp;cn=YWN0aXZpdHlfZGlnZXN0X3dpdGhfaGVhZGxpbmVfY2hhbmdl&amp;sig=29a07ce9f78be0847042ca8ab142b0fd2fc82c00&amp;iid=3610b930adcf4d37adeebf609a766f8a&amp;uid=533793245&amp;nid=296+8"
                              style="
                                text-decoration: none;
                                border-style: none;
                                border: 0px;
                                padding: 0px;
                                margin: 0px;
                                color: #c00;
                              "
                              target="_blank"
                              data-saferedirecturl="https://www.google.com/url?q=https://twitter.com/i/redirect?url%3Dhttps%253A%252F%252Ftwitter.com%252Fdownload%26t%3D1%2B1605402562263%26cn%3DYWN0aXZpdHlfZGlnZXN0X3dpdGhfaGVhZGxpbmVfY2hhbmdl%26sig%3D29a07ce9f78be0847042ca8ab142b0fd2fc82c00%26iid%3D3610b930adcf4d37adeebf609a766f8a%26uid%3D533793245%26nid%3D296%2B8&amp;source=gmail&amp;ust=1605488965521000&amp;usg=AFQjCNFIATuy0ej0pa9uqUZd6nEzGYCB-w"
                            >
                              Tải app
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                          </td>
                        </tr>
                        <tr>
                          <td
                            align="center"
                            style="
                              padding: 0px;
                              margin: 0px auto;
                              color: #8899a6;
                              font-family: 'Helvetica Neue Light', Helvetica,
                                Arial, sans-serif;
                              font-size: 12px;
                              padding: 0px;
                              margin: 0px;
                              font-weight: normal;
                              line-height: 16px;
                            "
                          >
                            Eland gửi tin nhắc đến @duongtranha.
                            <br />
                            <a
                              href="https://twitter.com/i/u?t=1&amp;cn=YWN0aXZpdHlfZGlnZXN0X3dpdGhfaGVhZGxpbmVfY2hhbmdl&amp;sig=a429952f71ff326abd5b5ef32f619158f86911bd&amp;iid=3610b930adcf4d37adeebf609a766f8a&amp;uid=533793245&amp;nid=244+26&amp;usbid=16"
                              style="
                                text-decoration: none;
                                border-style: none;
                                border: 0px;
                                padding: 0px;
                                margin: 0px;
                                color: #5c5c5c;
                                text-decoration: underline;
                              "
                              target="_blank"
                              >Huỷ nhận mail</a
                            >
                            <br />
                            <a
                              href="https://twitter.com/i/u?t=1&amp;cn=YWN0aXZpdHlfZGlnZXN0X3dpdGhfaGVhZGxpbmVfY2hhbmdl&amp;sig=a429952f71ff326abd5b5ef32f619158f86911bd&amp;iid=3610b930adcf4d37adeebf609a766f8a&amp;uid=533793245&amp;nid=244+26&amp;usbid=16"
                              style="
                                text-decoration: none;
                                border-style: none;
                                border: 0px;
                                padding: 0px;
                                margin: 0px;
                                color: #5c5c5c;
                                text-decoration: underline;
                              "
                              target="_blank"
                              >Cài đặt lại</a
                            >
                          </td>
                        </tr>
                        <tr>
                          <td>
                            &nbsp;
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
                              <p
                                style="
                                  padding: 0px;
                                  font-size: 11pt;
                                  color: #111;
                                "
                              >
                                Eland chúc Hà đăng tin rao và chốt sản phẩm
                                thành công!
                              </p>
                              <p
                                style="
                                  padding: 0px;
                                  font-size: 11pt;
                                  color: #111;
                                "
                              >
                                Trân trọng!
                              </p>
                              <div
                                style="
                                  font-size: 11pt;
                                  color: #5c5c5c;
                                  font-style: italic;
                                "
                              >
                                <ul>
                                  <li>
                                    <p>
                                      Tìm kiếm nhiều sản phẩm hơn:
                                      <a
                                        style="color: red"
                                        title="Tìm kiếm"
                                        href="https://batdongsaneland.com/"
                                        target="_blank"
                                        >Tìm kiếm</a
                                      >
                                    </p>
                                  </li>
                                  <li>
                                    <p>
                                      Đăng tin rao bán sản phẩm :
                                      <a
                                        style="color: red"
                                        title="Đăng tin rao"
                                        href="https://batdongsaneland.com/dang-ky"
                                        target="_blank"
                                        >Đăng ký &amp; Đăng tin</a
                                      >
                                    </p>
                                  </li>
                                </ul>

                                <p>Mọi thắc mắc xin vui lòng liên hệ:</p>
                                <p>
                                  Email:
                                  <a
                                    style="color: red"
                                    href="mailto:batdongsaneland@gmail.com"
                                    target="_blank"
                                    >batdongsaneland@gmail.com</a
                                  >
                                </p>
                                <p>Phone: 035-9696-234</p>
                                <p>
                                  Địa chỉ: 57/34 Bờ Bao Tân Thắng, Phường Sơn
                                  Kỳ, Quận Tân Phú, thành phố Hồ Chí Minh
                                </p>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div
                              style="
                                font-size: 11pt;
                                background: radial-gradient(
                                  circle,
                                  rgba(244, 185, 71, 1) 0%,
                                  rgba(181, 113, 41, 1) 100%
                                );
                                padding: 10px;
                              "
                            >
                              Công ty: © 2020 - Bản quyền của Công Ty TNHH EAGLE
                              SKY TECHNOLOGY - Giấy chứng nhận Đăng ký Kinh
                              doanh số 0314954021
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</html>
