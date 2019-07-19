<link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">编辑角色</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $role->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3" for="name">角色</label>
            <div class="col-md-8 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写角色"
                       data-parsley-required="true" data-parsley-required-message="请填写角色" value="{{ $role->name }}" @if($role->name) readonly @endif/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3" for="display_name">名称</label>
            <div class="col-md-8 col-sm-7">
                <input class="form-control" type="text" id="display_name" name="display_name"
                       placeholder="请填写名称" data-parsley-required="true" data-parsley-required-message="请填写名称"
                       data-parsley-maxlength="20"
                       data-parsley-maxlength-message="名称最多20个字符" value="{{ $role->display_name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-3" for="description">描述</label>
            <div class="col-md-8 col-sm-7">
                <input class="form-control" type="text" id="description" name="description"
                       placeholder="请填写角色描述" data-parsley-required="true" data-parsley-required-message="请填写角色描述"
                       data-parsley-maxlength="20"
                       data-parsley-maxlength-message="角色描述最多20个字符" value="{{ $role->description }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">权限</label>
            <div class="col-md-10">
                <table class="table no-border table-responsive">
                    @if(count($permission))
                        <tr>
                            <td colspan="5">
                                <a class="btn btn-success btn-xs select_all">全选</a>
                                <a class="btn btn-success btn-xs select_reverse">反选</a>
                                <a class="btn btn-success btn-xs select_empty">清空</a>
                            </td>
                        </tr>
                        @foreach($permission as $perm)
                            <tr>
                                @for($i=0; $i<count($perm); $i++)
                                    <td align="left"><label class="checkbox-inline">
                                            <input type="checkbox" name="perm_id[]" class="minimal"
                                                   value="{{ $perm[$i]['id'] }}"
                                                   @foreach($role->permissions as $permItem)
                                                   @if($perm[$i]['name'] == $permItem->name) checked @endif
                                                    @endforeach />
                                            {{ $perm[$i]['display_name'] }}
                                        </label></td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                </table>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
    <button type="submit" class="btn btn-sm btn-success">确定</button>
</div>

<script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //全选
        $('.select_all').click(function () {
            $('label.checkbox-inline>div').attr('aria-checked', true).addClass('checked');
            $('label.checkbox-inline>div>input[type="checkbox"]').prop('checked', true);
        });

        //反选
        $('.select_reverse').click(function () {
            $('label.checkbox-inline>div').each(function (i, e) {
                if ($(e).hasClass('checked')) {
                    $(e).attr('aria-checked', false).removeClass('checked');
                    $(e).children('input[type="checkbox"]').prop('checked', false);
                } else {
                    $(e).attr('aria-checked', true).addClass('checked');
                    $(e).children('input[type="checkbox"]').prop('checked', true);
                }
            });
        });

        //清空
        $('.select_empty').click(function () {
            $('label.checkbox-inline>div').attr('aria-checked', false).removeClass('checked');
            $('label.checkbox-inline>div>input[type="checkbox"]').prop('checked', false);
        });
    })
</script>
