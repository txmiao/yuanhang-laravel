<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改分类名称</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{$category->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">分类名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name" placeholder="请填写分类名称"
                       data-parsley-required="true" data-parsley-required-message="请填写分类名称"
                       data-parsley-maxlength="6"
                       data-parsley-maxlength-message="分类名称最多6个字符" value="{{ $category->name }}"/>
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