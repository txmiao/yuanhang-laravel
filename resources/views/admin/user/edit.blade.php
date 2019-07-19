<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改会员</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $user->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">用户名</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写用户名"
                       data-parsley-required="true" data-parsley-required-message="请填写用户名"
                       data-parsley-maxlength="20"
                       data-parsley-maxlength-message="用户名最多20个字符" value="{{ $user->name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="password">密码</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="password" id="password" name="password"
                       placeholder="如不修改，请勿填写" data-parsley-lenlength="6"
                       data-parsley-lenlength-message="密码至少6个字符"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="phone">手机号</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="phone" name="phone"
                       placeholder="请填写手机号"
                       data-parsley-required="true" data-parsley-required-message="请填写手机号"
                       data-parsley-pattern="/^1[3456789]\d{9}$/"
                       data-parsley-pattern-message="手机号格式有误" value="{{ $user->phone }}"/>
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