<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改资源</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $menu->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="pid">父级资源</label>
            <div class="col-md-7 col-sm-7">
                <select name="pid" class="form-control">
                    <option value="0" @if (0 == $menu->pid) selected @endif>顶级资源</option>
                    @if (count($pid))
                        @foreach($pid as $item)
                            <option value="{{ $item->id }}" @if($menu->pid == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">资源名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写资源名称"
                       data-parsley-required="true" data-parsley-required-message="请填写资源名称" data-parsley-maxlength="10"
                       data-parsley-maxlength-message="资源名称最多10个字符" value="{{ $menu->name }}"/>
            </div>
        </div>
        <div class="form-group hide_for_top_menu" @if(0 == $menu->pid) style="display: none;" @endif>
            <label class="control-label col-md-3 col-sm-3" for="link">资源链接</label>
            <div class="col-md-7 col-sm-7">
                <input @if(0 == $menu->pid) disabled @endif class="form-control" type="text" id="link" name="link"
                       placeholder="请填写资源链接" value="{{ $menu->link }}"/>
            </div>
        </div>
        <div class="form-group hide_for_top_menu" @if(0 == $menu->pid) style="display: none;" @endif>
            <label class="control-label col-md-3 col-sm-3" for="permission">资源权限</label>
            <div class="col-md-7 col-sm-7">
                <input  @if(0 == $menu->pid) disabled @endif class="form-control" type="text" id="permission" name="permission" placeholder="请填写资源权限"
                       value="{{ $menu->permission }}"/>
            </div>
        </div>
        <div class="form-group hide_for_sub_menu" @if(0 != $menu->pid) style="display: none;" @endif>
            <label class="control-label col-md-3 col-sm-3" for="icon">资源图标</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="icon" name="icon" placeholder="请填写资源图标"
                       value="{{ $menu->icon }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="sort">资源排序</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="sort" name="sort" placeholder="请填写资源排序" value="{{ $menu->sort }}"/>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">更新</button>
</div>