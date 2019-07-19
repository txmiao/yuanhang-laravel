<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改发货单</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单编号</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order->order_number }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单金额</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order->order_money }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">支付金额</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order->pay_money }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单状态</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{!! \App\Models\Order::$statusText[$info->order->status] !!}</p>
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">收货人</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order->address->consignee ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">联系电话</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order->address->phone ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">收货地址</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order->address->full_address ?? '-' }}</p>
            </div>
        </div>
        @if($info->order->order_goods)
            <hr/>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">订单商品</label>
                <div class="col-md-7 col-sm-7">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <td>商品名称</td>
                            <td>数量</td>
                            <td>金额</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($info->order->order_goods as $orderGoods)
                            <tr>
                                <td>{{ $orderGoods->goods->name ?? '-' }}</td>
                                <td><code>x{{ $orderGoods->number }}</code></td>
                                <td>{{ $orderGoods->subtotal }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <hr/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="express_company">快递公司</label>
            <div class="col-md-7 col-sm-7">
                @if(!$info->express_company)
                    <select name="express_company_select" id="express_company_select" class="form-control">
                        <option value="">请选择快递公司</option>
                        @if(App\Models\Shipment::$express)
                            @foreach(App\Models\Shipment::$express as $k => $v)
                                <option value="{{ $k }}">{{ $v['express_company'] }}</option>
                            @endforeach
                        @endif
                    </select>
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
            <label class="control-label col-md-3 col-sm-3" for="is_sale">发货状态</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="status"
                           value="{{ \App\Models\Shipment::STATUS_UN_SHIPMENT }}"
                           class="minimal"
                           @if(\App\Models\Shipment::STATUS_UN_SHIPMENT != $info->status) disabled
                           @endif
                           @if(\App\Models\Shipment::STATUS_UN_SHIPMENT == $info->status) checked @endif>&nbsp;未发货
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="status"
                           value="{{ \App\Models\Shipment::STATUS_SHIPPED }}"
                           class="minimal"
                           @if(\App\Models\Shipment::STATUS_UN_SHIPMENT != $info->status) disabled
                           @endif
                           @if(\App\Models\Shipment::STATUS_SHIPPED == $info->status) checked @endif/>&nbsp;已发货
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