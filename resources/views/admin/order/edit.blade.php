<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改订单</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单来源</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->store->name ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单编号</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order_number }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单金额</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->order_money }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">支付类型</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{!! $info::$payTypeText[$info->pay_type] !!}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">支付金额</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->pay_money }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">支付信用积分</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->pay_credit_score }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">支付代金券</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->pay_coupons_number }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单备注</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->remark ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">订单状态</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{!! $info::$statusText[$info->status] !!}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">下单时间</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->created_at ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">支付时间</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->paid_at ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">发货时间</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->shipping_at ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">交易完成时间</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->deal_done_at ?? '-' }}</p>
            </div>
        </div>
        @if($info->order_goods)
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
                        @foreach($info->order_goods as $orderGoods)
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
            <label class="control-label col-md-3 col-sm-3">用户名</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->user->name ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">收件人</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->address->consignee ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">联系电话</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->address->phone ?? '-' }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">收货地址</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->address->full_address ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">生成发货单</button>
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