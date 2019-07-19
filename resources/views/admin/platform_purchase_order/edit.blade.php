<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改采购订单</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单编号</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order_number }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单金额</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order_amount }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">收货人</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->consignee }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">联系电话</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->phone }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="express_company">快递公司</label>
            <div class="col-md-7 col-sm-7">
                @if(!$info->express_company)
                    <input class="form-control" type="text" id="express_company" name="express_company"
                           placeholder="请填写快递公司"
                           data-parsley-maxlength="10"
                           data-parsley-maxlength-message="快递公司最多10个字符"/>
                @else
                    <p class="form-control-static">{{ $info->express_company }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="express_number">快递单号</label>
            <div class="col-md-7 col-sm-7">
                @if(!$info->express_number)
                    <input class="form-control" type="text" id="express_number" name="express_number"
                           placeholder="请填写快递单号"
                           data-parsley-maxlength="20"
                           data-parsley-maxlength-message="快递单号最多20个字符"/>
                @else
                    <p class="form-control-static">{{ $info->express_number }}</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">付款状态</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="pay_status"
                           value="{{ \App\Models\PlatformPurchaseOrder::PAY_STATUS_UN_PAY }}"
                           class="minimal"
                           @if(\App\Models\PlatformPurchaseOrder::PAY_STATUS_UN_PAY != $info->pay_status) disabled
                           @endif
                           @if(\App\Models\PlatformPurchaseOrder::PAY_STATUS_UN_PAY == $info->pay_status) checked @endif>&nbsp;未付款
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="pay_status"
                           value="{{ \App\Models\PlatformPurchaseOrder::PAY_STATUS_PAID }}"
                           class="minimal"
                           @if(\App\Models\PlatformPurchaseOrder::PAY_STATUS_UN_PAY != $info->pay_status) disabled
                           @endif
                           @if(\App\Models\PlatformPurchaseOrder::PAY_STATUS_PAID == $info->pay_status) checked @endif/>&nbsp;已付款
                </label>&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="is_sale">发货状态</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="shipping_status"
                           value="{{ \App\Models\PlatformPurchaseOrder::SHIPPING_STATUS_WAIT_SHIPPING }}"
                           class="minimal"
                           @if(\App\Models\PlatformPurchaseOrder::SHIPPING_STATUS_WAIT_SHIPPING != $info->shipping_status) disabled
                           @endif
                           @if(\App\Models\PlatformPurchaseOrder::SHIPPING_STATUS_WAIT_SHIPPING == $info->shipping_status) checked @endif>&nbsp;未发货
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="shipping_status"
                           value="{{ \App\Models\PlatformPurchaseOrder::SHIPPING_STATUS_SHIPPED }}"
                           class="minimal"
                           @if(\App\Models\PlatformPurchaseOrder::SHIPPING_STATUS_WAIT_SHIPPING != $info->shipping_status) disabled
                           @endif
                           @if(\App\Models\PlatformPurchaseOrder::SHIPPING_STATUS_SHIPPED == $info->shipping_status) checked @endif/>&nbsp;已发货
                </label>&nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">更新</button>
</div>

<script>
    $(function () {
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

    })
</script>