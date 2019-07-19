<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改文章</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $article->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="title">标题</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="title" name="title"
                       placeholder="请填写文章标题"
                       data-parsley-required="true" data-parsley-required-message="请填写文章标题"
                       data-parsley-maxlength="30"
                       data-parsley-maxlength-message="文章标题最多30个字符" value="{{ $article->title }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="category_id">分类</label>
            <div class="col-md-7 col-sm-7">
                <select class="form-control" name="category_id" id="category_id"
                        data-parsley-required="true"
                        data-parsley-required-message="请选择文章分类">
                    <option value="">请选择文章分类</option>
                    @if(count($categories))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($article->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="is_show">是否展示</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="is_show" value="100"
                           class="minimal" @if(100 == $article->is_show) checked @endif/>&nbsp;不展示
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_show" value="101"
                           class="minimal" @if(101 == $article->is_show) checked @endif>&nbsp;展示
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="is_top">是否置顶</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="is_top" value="100"
                           class="minimal" @if(100 == $article->is_top) checked @endif/>&nbsp;不置顶
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_top" value="101"
                           class="minimal" @if(101 == $article->is_top) checked @endif>&nbsp;置顶
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="background_image_handler">缩略图</label>
            <div class="col-md-7 col-sm-7">
                <input type="file" id="thumbnail_upload"
                       name="thumbnail_upload[]"
                       class="form-control" multiple/>
                <span class="help-block">按住<code>Ctrl</code>键可选择多张图片上传</span>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($article->thumbnail)
                            @foreach($article->thumbnail as $img)
                                <img height="48" src="{{ asset('storage/' . $img) }}" alt="">&nbsp;
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="content_area_edit">内容</label>
            <div class="col-md-7 col-sm-7">
                <script id="content_area_edit" name="content" type="text/plain"></script>
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
        var content_area_edit = UE.getEditor('content_area_edit', {
            initialFrameHeight: 200,
            zIndex: 99999
        });
        content_area_edit.ready(function () {
            content_area_edit.setContent('{!! $article->content ?? "" !!}', false);
        });
        $('#modal-default-edit').on('hidden.bs.modal', function () {
            UE.delEditor('content_area_edit');
        });

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    })
</script>
