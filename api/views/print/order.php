<div id="container-view-print">
    <div class="text-left">
        <div class="title-shop-print">%company_name%</div>
        <div>
            Địa chỉ : %company_address%
        </div>
        <div>
            số điện thoại : %company_phone%
        </div>
    </div>
    <div class="text-center">
        <h4 class="title-type-print">Hóa đơn bán hàng</h4>
        <div>
            <div>Mã HD : {{printObject.object.code}}</div>
            <div>{{printObject.object.created}}</div> 
        </div>
    </div>
    <br/>
    <div>
        <strong>Khách hàng</strong> : {{printObject.object.customer_name}}<br/>
        <strong>Số điện thoại</strong> : {{printObject.object.customer_phone}}<br/>
        <strong>Địa chỉ</strong> : {{printObject.object.customer_address}}
    </div>
    <!--Người tạo : {{printObject.object.user}}<br/><br/>--><br/>
    <table class="table table-striped" style="margin: 0px 0px 5px 0px">
        <tr class="header-table active-header-child">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th class="text-right">Thành tiền</th>
        </tr>
        <tr ng-repeat="row in printObject.child">
            <td class="vertical-align-middle">
                {{row.name}} ({{row.code}})<br/>
                {{row.text_attribute}}

            </td>
            <td class="vertical-align-middle">{{row.quantity}} x {{row.price| number:0 }}</td>
            <td class="vertical-align-middle text-right">{{row.price * row.quantity| number:0 }}</td>

        </tr>
        <tr>
            <td colspan="5" ></td>
        </tr>
        
        
    </table>
    <table width="100%">
        <tr>
            <td class="text-right">Tiền hàng</td>
            <td class="text-right">{{printObject.object.total_cart| number:0}} VND</td>
        </tr>
        <tr>
            <td class="text-right">Giảm giá</td>
            <td class="text-right">{{printObject.object.discount| number:0}} VND</td>
        </tr>
        <tr>
            <td class="text-right">Phí giao hàng</td>
            <td class="text-right">{{printObject.object.shipping_cost| number:0}} VND</td>
        </tr>
        <tr>
            <td class="text-right">Tổng cộng</td>
            <td class="text-right">{{printObject.object.total| number:0}} VND</td>
        </tr>
    </table>
    
    
    <i>Ghi chú</i>: <br/>{{object.comment}}
    <br/><br/>
</div>
