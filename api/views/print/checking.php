<div class="text-center">
    <h2>Phiếu kiểm hàng</h2>
    <div>Mã phiếu : {{object.code}}</div>
    <div>{{object.created}}</div> 
</div>
<br/><br/>

Người tạo : {{object.user}}<br/><br/>
<table class="table table-striped">
    <tr class="header-table active-header-child">
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th class="text-center">Tồn kho</th>
        <th class="text-center">Kiểm thực tế</th>
    </tr>
    <tr ng-repeat="row in child">
        <td class="vertical-align-middle">{{row.code}}</td>
        <td class="vertical-align-middle">
            {{row.name}}<br/>
            {{row.text_attribute}}
        </td>
        <td class="vertical-align-middle text-center">{{row.virtual_quantity}}</td>
        <td class="vertical-align-middle text-center">{{row.quantity}}</td>

    </tr>

</table>
<i>Ghi chú</i> : <br/>{{object.comment}}
<br/><br/>
