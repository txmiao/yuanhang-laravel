<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改平台标语</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{$info->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">标语名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写标语名称"
                       data-parsley-required="true" data-parsley-required-message="请填写标语名称"
                       data-parsley-maxlength="6"
                       data-parsley-maxlength-message="标语名称最多6个字符" value="{{ $info->name }}"/>
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
                   for="sort">排序</label>
            <div class="col-md-7 col-sm-7">
                <input type="text" id="sort" name="sort" class="form-control" value="{{ $info->sort }}"/>
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