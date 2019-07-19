<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">编辑权限</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $permission->id }}" />
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">权限</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写权限" value="{{ $permission->name }}"
                       data-parsley-required="true" data-parsley-required-message="请填写权限"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="display_name">名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="display_name" name="display_name" value="{{ $permission->display_name }}"
                       placeholder="请填写权限名称" data-parsley-required="true" data-parsley-required-message="请填写权限名称" data-parsley-maxlength="20" data-parsley-maxlength-message="权限名称最多20个字符"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="description">描述</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="description" name="description" value="{{ $permission->description }}"
                       placeholder="请填写权限描述" data-parsley-required="true" data-parsley-required-message="请填写权限描述" data-parsley-maxlength="20" data-parsley-maxlength-message="权限描述最多20个字符"/>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">更新</button>
</div>