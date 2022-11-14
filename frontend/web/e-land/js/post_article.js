
	// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'
  
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('#post-article-form')
    
      
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              event.preventDefault()
              event.stopPropagation()
              if (!form.checkValidity()) {
            //    console.log(form.classList);
                form.classList.add('was-validated');
                 modalRegisterError.show();
                 $('#modalRegisterError').find('.modal-body').html('Lưu ý*: Vui lòng nhập đầy đủ thông tin theo yêu cầu để hoàn tất đăng tin sản phẩm.');
              }else{
                              var data = $(this).serialize();
                              var url = $(this).attr('action');
                             $.ajax({
                                  url: url,
                                  type: 'POST',
                                  data: data,
                                  beforeSend: function(xhr) {
                                    xhr.setRequestHeader('Csrf-Token', $('meta[name="csrf-token"]').attr('content'));
                                },
                                  success: function (data) {
                                  //  console.log(data);
                                 //   data = JSON.parse(data);
                                   if(data && data.errors.length > 0){
                                           data.errors.forEach(function(value,key){
                                           document.getElementById("article-" + value.field).classList.add("is-invalid");
                                              document.getElementById("article-" + value.field).setAttribute("required", '');
                                              document.getElementById("validationServer-" + value.field).innerHTML=value.message;
                                          
                                          });
                                     //   modalRegisterError.show();
                                  //   modalRegisterError.show();
                               //      $('#modalRegisterError').find('.modal-body').html(data.errors);
                                 
                                   
                                   //    $("#modalRegisterError").modal('show').find('.modal-content p').html(data.errors);
                                      }else{
                                        //    $('#active-form')[0].reset();
                                      modalRegisterSuccess.show();
                                      $('#modalRegisterSuccess').find('.modal-body').html('Đăng tin rao bán Bđs thành công!');
                                        document.getElementById("post-article-form").reset();
                                        location.reload();
                                    }
                                  },
                               /*   error: function(jqXHR, errMsg) {
                                      alert(jqXHR);
                                      alert(errMsg);
                                  }
                                  */
                              });
              }
      
          
            }, false)
          })
      })()

      
  
    $(document).ready(function(){
        $('input[name="Article[category_id]"]').click(function(){
            var inputValue = $(this).attr("id");
            var targetBox = $(".category-" + inputValue);
            $(".box-category").not(targetBox).hide();
            $(targetBox).show();
            //$(".box-category").not(targetBox +  " input").attr("required", false);
         //   $(targetBox + " input").attr("required", true);
           
        });
  

        $('input[name="Article[is_owner]"]').click(function(){
            var inputValue = $(this).attr("value");
         
            if(inputValue==1){
                var  targetBox=  $(".owner-1");
                $(targetBox).show();
                $(".owner").not(targetBox).hide();
               
            }else if(inputValue==2){
                var  targetBox=  $(".owner-1, .owner-2");
                $(targetBox).show();
                $(".owner").not(targetBox).hide();
            }else{
                var  targetBox=  $(".owner-1, .owner-3");
                $(targetBox).show();
                $(".owner").not(targetBox).hide();
            }
           
        });
  
      $("#article-price").keyup(function() {
      var val = $(this).val();
      if (val == "") val = 0;
      else val = val.replace(/,/gi, "");
          $(this).val(currencyFormat(val, false));
          var priceText =DocTienBangChu(val);
         $('.form-text-price').text(priceText);
         $('#article-price_text').val(priceText);

      });  
      $("#article-area").keyup(function() {
      var val = $(this).val();
      if (val == "") val = 0;
      else val = val.replace(/,/gi, "");
          $(this).val(currencyFormat(val, false));
     
    });  
      $("#article-price_rent").keyup(function() {
      var val = $(this).val();
      if (val == "") val = 0;
      else val = val.replace(/,/gi, "");
          $(this).val(currencyFormat(val, false));
          var priceText =DocTienBangChu(val);
         $('.form-text-price-rent').text(priceText);
         $('#article-price_rent_text').val(priceText);

    });  
   
  });
    
	function currencyFormat(number, moneyCode) {
				var decimalplaces = 0; //2
				var decimalcharacter = ""; //"."
				var thousandseparater = ",";
	
				number = parseFloat(number);
	
				var sign = number < 0 ? "-" : "";
				var formatted = new String(number.toFixed(decimalplaces));
				if (decimalcharacter.length && decimalcharacter != ".") {
					formatted = formatted.replace(/\./, decimalcharacter);
				}
				var integer = "";
				var fraction = "";
				var strnumber = new String(formatted);
				var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
				if (dotpos > -1) {
					if (dotpos) {
						integer = strnumber.substr(0, dotpos);
					}
					fraction = strnumber.substr(dotpos + 1);
				} else {
					integer = strnumber;
				}
				if (integer) {
					integer = String(Math.abs(integer));
				}
				while (fraction.length < decimalplaces) {
					fraction += "0";
				}
				temparray = new Array();
				while (integer.length > 3) {
					temparray.unshift(integer.substr(-3));
					integer = integer.substr(0, integer.length - 3);
				}
				temparray.unshift(integer);
				integer = temparray.join(thousandseparater);
	
				var code = 'VNĐ';
				if (moneyCode == false) code = "";
				
				return sign + integer + decimalcharacter + fraction + code;
            }


      
     
var ChuSo=new Array(" không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín ");
var Tien=new Array( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");

//1. Hàm đọc số có ba chữ số;
function DocSo3ChuSo(baso)
{
    var tram;
    var chuc;
    var donvi;
    var KetQua="";
    tram=parseInt(baso/100);
    chuc=parseInt((baso%100)/10);
    donvi=baso%10;
    if(tram==0 && chuc==0 && donvi==0) return "";
    if(tram!=0)
    {
        KetQua += ChuSo[tram] + " trăm ";
        if ((chuc == 0) && (donvi != 0)) KetQua += " linh ";
    }
    if ((chuc != 0) && (chuc != 1))
    {
            KetQua += ChuSo[chuc] + " mươi";
            if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh ";
    }
    if (chuc == 1) KetQua += " mười ";
    switch (donvi)
    {
        case 1:
            if ((chuc != 0) && (chuc != 1))
            {
                KetQua += " mốt ";
            }
            else
            {
                KetQua += ChuSo[donvi];
            }
            break;
        case 5:
            if (chuc == 0)
            {
                KetQua += ChuSo[donvi];
            }
            else
            {
                KetQua += " lăm ";
            }
            break;
        default:
            if (donvi != 0)
            {
                KetQua += ChuSo[donvi];
            }
            break;
        }
    return KetQua;
}

//2. Hàm đọc số thành chữ (Sử dụng hàm đọc số có ba chữ số)

function DocTienBangChu(SoTien)
{
    var lan=0;
    var i=0;
    var so=0;
    var KetQua="";
    var tmp="";
    var ViTri = new Array();
    if(SoTien<0) return "Số tiền âm !";
    if(SoTien==0) return "Không đồng !";
    if(SoTien>0)
    {
        so=SoTien;
    }
    else
    {
        so = -SoTien;
    }
    if (SoTien > 8999999999999999)
    {
        //SoTien = 0;
        return "Số quá lớn!";
    }
    ViTri[5] = Math.floor(so / 1000000000000000);
    if(isNaN(ViTri[5]))
        ViTri[5] = "0";
    so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
    ViTri[4] = Math.floor(so / 1000000000000);
     if(isNaN(ViTri[4]))
        ViTri[4] = "0";
    so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
    ViTri[3] = Math.floor(so / 1000000000);
     if(isNaN(ViTri[3]))
        ViTri[3] = "0";
    so = so - parseFloat(ViTri[3].toString()) * 1000000000;
    ViTri[2] = parseInt(so / 1000000);
     if(isNaN(ViTri[2]))
        ViTri[2] = "0";
    ViTri[1] = parseInt((so % 1000000) / 1000);
     if(isNaN(ViTri[1]))
        ViTri[1] = "0";
    ViTri[0] = parseInt(so % 1000);
  if(isNaN(ViTri[0]))
        ViTri[0] = "0";
    if (ViTri[5] > 0)
    {
        lan = 5;
    }
    else if (ViTri[4] > 0)
    {
        lan = 4;
    }
    else if (ViTri[3] > 0)
    {
        lan = 3;
    }
    else if (ViTri[2] > 0)
    {
        lan = 2;
    }
    else if (ViTri[1] > 0)
    {
        lan = 1;
    }
    else
    {
        lan = 0;
    }
    for (i = lan; i >= 0; i--)
    {
       tmp = DocSo3ChuSo(ViTri[i]);
       KetQua += tmp;
       if (ViTri[i] > 0) KetQua += Tien[i];
       if ((i > 0) && (tmp.length > 0)) KetQua += ',';//&& (!string.IsNullOrEmpty(tmp))
    }
   if (KetQua.substring(KetQua.length - 1) == ',')
   {
        KetQua = KetQua.substring(0, KetQua.length - 1);
   }
   KetQua = KetQua.substring(1,2).toUpperCase()+ KetQua.substring(2);
   return KetQua;//.substring(0, 1);//.toUpperCase();// + KetQua.substring(1);
}
     
  