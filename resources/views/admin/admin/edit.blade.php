<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改管理员</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $admin->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">用户名</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" value="{{ $admin->name }}" readonly
                       data-parsley-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="password">密码</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="password" id="password" name="password" placeholder="如果不修改密码请留空"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="email">邮箱</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="email" name="email" value="{{ $admin->email }}"
                       data-parsley-type="email" data-parsley-type-message="邮箱格式不正确" placeholder="请填写邮箱" data-parsley-required="true" data-parsley-required-message="请填写邮箱"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="message">角色</label>
            <div class="col-md-7 col-sm-7">
                <select multiple name="role_id[]" id="role" class="form-control">
                    @if (count($roles))
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                    @if(in_array($role->id, array_column($admin->roles->toArray(), 'id'))) selected @endif>{{ $role->display_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">更新</button>
</div>