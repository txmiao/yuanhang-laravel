<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改个人设置</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $profile->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">用户</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $profile->name }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="nickname">昵称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="nickname" name="nickname"
                       placeholder="请填写昵称" value="{{ $profile->nickname }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="password">密码</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="password" id="password" name="password"
                       placeholder="如不修改请留空" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="email">邮箱</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="email" id="email" name="email"
                       placeholder="请填写邮箱" data-parsley-required="true"
                       data-parsley-required-message="请填写邮箱" data-parsley-type="email"
                       data-parsley-type-message="邮箱格式不正确"
                       value="{{ $profile->email }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="headimgurl">头像</label>
            <div class="col-md-7 col-sm-7">
                <input type="file" class="form-control" name="headimgurl" id="headimgurl"/>
                <span class="help-block text-muted">请上传200x200且不大于1M的图片</span>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">更新</button>
</div>

<script src="{{ asset('admin/assets/plugins/prettyfile/bootstrap-prettyfile.js') }}"></script>
<script>
    $(function () {
        //文件上传
        $('input[type="file"]').prettyFile();
    })
</script>