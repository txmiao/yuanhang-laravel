<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">审核加盟申请记录</h4>
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
                <label class="control-label col-md-3 col-sm-3">加盟类型</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{!! $info::$typeStoreText[$info->type] !!}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">级别</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{!! $info::$levelText[$info->level] !!}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">加盟地址</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->full_address ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">推荐人</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->recommend_user->name ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">联系人</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->contact ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">电话</label>
                <div class="col-md-7 col-sm-7">
                    <p class="form-control-static">{{ $info->phone ?? '-' }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3"
                       for="images_upload">必备资质</label>
                <div class="col-md-7 col-sm-7">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            @if($info->essential_material)
                                @foreach($info->essential_material as $img)
                                    <img height="128" src="{{ asset('storage/' . $img) }}" alt="">&nbsp;
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3"
                       for="images_upload">其它材料</label>
                <div class="col-md-7 col-sm-7">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            @if($info->other_material)
                                @foreach($info->other_material as $img)
                                    <img height="128" src="{{ asset('storage/' . $img) }}" alt="">&nbsp;
                                @endforeach
                            @else
                                <p class="form-control-static">暂无</p>
                            @endif
                        </div>
                    </div>
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
            <hr/>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3">审核状态</label>
                <div class="col-md-7 col-sm-7">
                    <label class="control-label">
                        <input type="radio" name="status"
                               value="{{ \App\Models\MerchantsJoinApplyRecord::STATUS_PASS }}"
                               class="minimal"
                               @if(\App\Models\MerchantsJoinApplyRecord::STATUS_WAIT_AUDIT != $info->status) disabled
                               @endif
                               @if(in_array($info->status, [\App\Models\MerchantsJoinApplyRecord::STATUS_PASS, \App\Models\MerchantsJoinApplyRecord::STATUS_WAIT_AUDIT])) checked @endif>
                        通过
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="control-label">
                        <input type="radio" name="status"
                               value="{{ \App\Models\MerchantsJoinApplyRecord::STATUS_FAIL }}"
                               class="minimal"
                               @if(\App\Models\MerchantsJoinApplyRecord::STATUS_WAIT_AUDIT != $info->status) disabled
                               @endif
                               @if($info->status == \App\Models\MerchantsJoinApplyRecord::STATUS_FAIL) checked @endif>
                        拒绝
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3" for="refuse_reason">审核拒绝理由</label>
                <div class="col-md-7 col-sm-7">
                    <textarea class="form-control" name="refuse_reason" id="refuse_reason" rows="5"
                              style="resize: none"
                              @if(\App\Models\MerchantsJoinApplyRecord::STATUS_WAIT_AUDIT != $info->status) disabled @endif>{{ $info->refuse_reason }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success"
            @if(\App\Models\MerchantsJoinApplyRecord::STATUS_WAIT_AUDIT != $info->status) disabled @endif>更新
    </button>
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