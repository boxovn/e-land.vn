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
        <h4 class="title-type-print">Phiếu trả hàng nhập</h4>
        <div>
            <div>Mã phiếu : {{object.code}}</div>
            <div>{{object.created}}</div> 
        </div>
    </div>
    <br/>
    <div>
        <strong>Nhà cung cấp</strong> : {{object.manufacture_name}}<br/>
        <strong>Số điện thoại</strong> : {{object.manufacture_phone}}<br/>
        <!--<strong>Địa chỉ</strong> : {{object.manufacture_name}}-->
    </div>

    Người tạo : {{object.user}}<br/><br/>
    <table class="table table-striped">
        <tr class="header-table active-header-child">
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th class="text-right">Thành tiền</th>
        </tr>
        <tr ng-repeat="row in child">
            <td class="vertical-align-middle">{{row.code}}</td>
            <td class="vertical-align-middle">
                {{row.name}}<br/>
                {{row.text_attribute}}

            </td>
            <td class="vertical-align-middle ">{{row.quantity}} x {{row.price| number:0 }}</td>
            <td class="vertical-align-middle text-right">{{row.price * row.quantity| number:0 }}</td>

        </tr>
        <tr>
            <td colspan="2"></td>
            <td><strong>Tổng cộng</strong></td>
            <td class="text-right">{{object.total| number:0}} VND</td>
        </tr>
    </table>
    <i>Ghi chú</i>: <br/>{{object.comment}}
    <br/><br/>
    <div class="row">
        <div class="col-xs-6 text-center">
            <h4>Nhà cung cấp</h4>
            <br/></br/>
            {{object.manufacture_name}}
        </div>
        <div class="col-xs-6 text-center">
            <h4>Người lập</h4>
        </div>
    </div>
</div>