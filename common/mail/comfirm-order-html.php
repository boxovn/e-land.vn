<?php

use yii\helpers\Html;
use  yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

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
                src="https://e-land.vn/images/icon_facebook.png"
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
                src="https://e-land.vn/images/icon_zalo.png"
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
                                  <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách <?php echo $order->user_name;?> đã đặt hàng tại E-Books,</h1>
                                  <p style="margin:7px 0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal">E-Books rất vui thông báo đơn hàng #<?php echo $order->id;?> của quý khách đã được tiếp nhận và đang trong quá trình xử lý. E-Books sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
                                  <h3 style="font-size:13px;font-weight:bold; padding: 15px 0px; color:#c00;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin đơn hàng #<?php echo $order->id;?> <span style="font-size:13px;color:#777;text-transform:none;font-weight:normal">(Ngày <?php echo date('d');?> Tháng <?php echo date('m');?> Năm <?php echo date('Y');?> <?php echo date('H:i');?>)</span></h3>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px">
                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                              <th align="left" style="padding:10px 0px;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
                                              <th align="left" style="padding:10px 0px;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;font-weight:bold" width="50%"> Địa chỉ giao hàng </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td style="padding:10px 0px 10px 10px;border-top:0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal" valign="top"><span style="text-transform:capitalize"><?php echo $order->user_name;?></span><br>
                                              <a href="mailto:duongtranha.vnit@gmail.com" target="_blank"><?php echo $order->user_email;?></a><br>
                                              <?php echo $order->user_phone;?></td>
                                              <td style="padding:10px 0px 10px 10px;border-top:0;border-left:0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal" valign="top"><span style="text-transform:capitalize"><?php echo $order->ship_name;?></span><br>
                                               <a href="mailto:duongtranha.vnit@gmail.com" target="_blank"><?php echo $order->ship_email;?></a><br>
                                               <?php echo $order->ship_address;?><br>
                                               <?php echo $order->ship_phone;?></td>
                                          </tr>
                                                                                      <tr>
                                              <td colspan="2" style="padding:10px 0px;border-top:0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444" valign="top">
                                              <p style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif; font-size:13px; color:#444; line-height:23px; font-weight:normal">
											
                                                <strong>Thời gian giao hàng dự kiến:</strong> Dự kiến giao hàng mất 2 ngày, tính tư ngày đặt hàng <?php echo date('d/m');?> - không giao ngày Thứ Bảy &amp; Chủ Nhật  <br>
												<strong>Phương thức vân chuyển: </strong><?php echo $order->delivery->name;?><?php echo number_format($order->payment_price, 0, '', ',');?> đ<br>
												<strong>Phương thức thanh toán: </strong> <?php echo $order->payment->name;?><?php echo number_format($order->payment_price, 0, '', ',');?> đ<br>
												<strong>Sử dụng gói quà: </strong>  Không <br>
                                               </p>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                  <p style="margin:4px 0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal"><i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể yêu cầu người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc ghi lại thông tin.</i></p>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                  <h2 style="text-align:left;margin:10px 0; padding: 15px; padding-bottom:5px;font-size:13px;color:#c00">CHI TIẾT ĐƠN HÀNG</h2>

                                  <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                                      <thead>
                                          <tr>
                                              <th align="left" bgcolor="#c00" style="padding:6px 9px;color:#fff;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;line-height:14px">Sản phẩm</th>
                                              <th align="left" bgcolor="#c00" style="padding:6px 9px;color:#fff;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;line-height:14px">Đơn giá</th>
                                              <th align="left" bgcolor="#c00" style="padding:6px 9px;color:#fff;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;line-height:14px">Số lượng</th>
                                              <th align="left" bgcolor="#c00" style="padding:6px 9px;color:#fff;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;line-height:14px">Giảm giá</th>
                                              <th align="right" bgcolor="#c00" style="padding:6px 9px;color:#fff;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;line-height:14px; width:15%;">Tổng tạm</th>
                                          </tr>
                                      </thead>
                                      <tbody bgcolor="#eee" style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px">											
									  <tr>
                                            <?php
												 $total_price =0;
											foreach($orderDetail as $key => $value){
														$total_price +=  $value->product_amount*($value->product_price + $value->product_price*($value->product_discount/100));
														?>
                                                <tr>
                                                    <td align="left" style="padding:3px 9px" valign="top">
														<span>
															<a class="product-name" style="text-decoration: none; " href="<?php echo Url::to(['business-book/detail','slug' => $value->product->slug, 'product_id' => $value->product->id],true);?>">
																<?php echo  $value->product->name;?>
															</a>
                                                        </span><br>
                                                    </td>
                                                    <td align="left" style="padding:3px 9px" valign="top"><span><?php echo  $value->product_price;?></span></td>
                                                    <td align="left" style="padding:3px 9px" valign="top"><?php echo  $value->product_amount;?></td>
                                                    <td align="left" style="padding:3px 9px" valign="top"><span><?php echo  $value->product_discount;?> %</span></td>
                                                    <td align="right" style="padding:3px 9px; width:15%;" valign="top"><span> <?php echo number_format($value->product_price + ($value->product_price*($value->product_discount/100)), 0, '', ',');?> đ</span></td>
                                                </tr>
                                              <?php   }  ?>
                                    </tbody>
                                                                                  
                                      <tfoot style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px">									
                                      		<tr>
                                              <td align="right" colspan="4" style="padding:5px 9px">Phí tạm tính</td>
                                              <td align="right" style="padding:5px 9px"><span><?php echo number_format($total_price, 0, '', ',');?> đ</span></td>
                                          </tr>
                                             <tr>
                                              <td align="right" colspan="4" style="padding:5px 9px">Phí vận chuyển</td>
                                              <td align="right" style="padding:5px 9px"><span><?php echo number_format( $order->delivery_price, 0, '', ',');?> đ</span></td>
                                          </tr>
                                          
                                          <tr>
                                              <td align="right" colspan="4" style="padding:5px 9px">Phí thanh toán</td>
                                              <td align="right" style="padding:5px 9px"><span><?php echo number_format($order->payment_price, 0, '', ',');?> đ</span></td>
                                          </tr>
                                          <tr bgcolor="#eee">
                                              <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
                                              <td align="right" style="padding:7px 9px"><strong><big><span> <?php echo    number_format($total_price + $order->delivery_price + $order->payment_price, 0, '', ',');?> đ</span> </big> </strong></td>
                                          </tr>
                                      </tfoot>
                                  </table>

                                  <div style="margin:auto">
									<a href="<?php echo Url::to(['shopping-cart/order'],true);?>" style="display:inline-block;text-decoration:none;background-color:#c00!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:13px;font-weight:bold;margin-left:35%;margin-top:5px" target="_blank">
								  Chi tiết đơn hàng tại E-books</a>
								  </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>&nbsp;
                                  <p style="margin:0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal">Trường hợp quý khách có những băn khoăn về đơn hàng, có thể xem thêm mục 
								  <a href="#" title="Các câu hỏi thường gặp" target="_blank" data-saferedirecturl="#"> <strong>các câu hỏi thường gặp</strong>.</a></p>
                                  <p style="margin:10px 0 0 0;font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal">Bạn cần được hỗ trợ ngay? Chỉ cần email <a href="mailto:hotro@e-land.vn" style="color:#099202;text-decoration:none" target="_blank"> <strong>hotro@e-books.com</strong> </a>, hoặc gọi số điện thoại <strong style="color:#099202">035-9696-234</strong> (8-21h cả T7,CN). Đội ngũ E-books Care luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
                                  </td>
                              </tr>
                              <tr>
                                  <td>&nbsp;
                                  <p style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;margin:0;padding:0;line-height:23px;color:#444;font-weight:bold">Một lần nữa E-books cảm ơn quý khách.</p>

                                  <p style="font-family:'Helvetica Neue', Helvetica,Arial, sans-serif;font-size:13px;color:#444;line-height:23px;font-weight:normal;text-align:right"><strong><a href="" style="color:#00a3dd;text-decoration:none;font-size:14px" target="_blank" >E-Boooks</a> </strong></p>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                         </td>
                        <td
                          class="m_-7374574323749046660width_24"
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
    </tbody>
  </table>
</div>
</html>

