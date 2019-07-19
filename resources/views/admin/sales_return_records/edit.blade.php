<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">审核退货/退款记录</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}"/>
        <div class="panel-body panel-form">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">用户名</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->user->name ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">订单号</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->order->order_number ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">订单来源</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->store->name ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">状态</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{!! $info::$statusText[$info->status] !!}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">申请时间</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->created_at }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">退货申请理由</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->remark ?? '-' }}</p>
                </div>
            </div>
            <hr/>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">审核状态</label>
                <div class="col-md-7 col-sm-7">
                    <label class="control-label">
                        <input type="radio" name="status"
                               value="{{ \App\Models\SalesReturnRecord::STATUS_PASS }}"
                               class="minimal"
                               @if(\App\Models\SalesReturnRecord::STATUS_UN_AUDIT != $info->status) disabled
                               @endif
                               @if(in_array($info->status, [\App\Models\SalesReturnRecord::STATUS_PASS, \App\Models\SalesReturnRecord::STATUS_UN_AUDIT])) checked @endif>
                        通过
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="control-label">
                        <input type="radio" name="status"
                               value="{{ \App\Models\SalesReturnRecord::STATUS_FAIL }}"
                               class="minimal"
                               @if(\App\Models\SalesReturnRecord::STATUS_UN_AUDIT != $info->status) disabled
                               @endif
                               @if($info->status == \App\Models\SalesReturnRecord::STATUS_FAIL) checked @endif>
                        拒绝
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3" for="refuse_reason">审核拒绝理由</label>
                <div class="col-md-7 col-sm-7">
                    <textarea class="form-control" name="refuse_reason" id="refuse_reason" rows="5"
                              style="resize: none"></textarea>
                </div>
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