<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改服务保障名称</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{$info->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">服务名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写服务名称"
                       data-parsley-required="true" data-parsley-required-message="请填写服务名称"
                       data-parsley-maxlength="6"
                       data-parsley-maxlength-message="服务名称最多6个字符" value="{{ $info->name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="icon_upload">图标</label>
            <div class="col-md-7 col-sm-7">
                <input type="file" id="icon_upload"
                       name="icon_upload"
                       class="form-control"/>
                <span class="help-block"></span>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($info->icon)
                            <img height="48" src="{{ asset('storage/' . $info->icon) }}" alt="">&nbsp;
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="sort">绑定类型</label>
            <div class="col-md-7 col-sm-7">
                <select name="bind_type" id="bind_type" class="form-control">
                    @foreach(\App\Models\ServiceTip::$bindTypeText as $k => $v)
                        <option value="{{ $k }}"
                                @if($info->bind_type == $k) selected @endif>{{ strip_tags($v) }}</option>
                    @endforeach
                </select>
                <span class="help-block">该服务保障服务名称只有被绑定类型才能使用</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="content">内容</label>
            <div class="col-md-7 col-sm-7">
                <textarea class="form-control" name="content" id="content" rows="8"
                          style="resize: none">{{ $info->content }}</textarea>
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

    })
</script>