<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改广告</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $ad->id }}">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">广告名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name"
                       placeholder="请填写广告名称"
                       data-parsley-required="true" data-parsley-required-message="请填写广告名称"
                       data-parsley-maxlength="20"
                       data-parsley-maxlength-message="广告名称最多20个字符" value="{{ $ad->name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="change_coin_number">排序</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="sort"
                       name="sort"
                       placeholder="请填写排序"
                       data-parsley-required="true" data-parsley-required-message="请填写请填写排序"
                       data-parsley-type="number"
                       data-parsley-type-message="排序只能填写数字" value="{{ $ad->sort }}"/>
                <span class="help-block">排序越大越靠前，影响展示顺序</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="status">状态</label>
            <div class="col-md-7 col-sm-7">
                <select name="status" id="status" class="form-control">
                    <option value="{{ App\Models\Ad::STATUS_OPEN }}"
                            @if(App\Models\Ad::STATUS_OPEN == $ad->status) selected @endif>开启
                    </option>
                    <option value="{{ App\Models\Ad::STATUS_CLOSE }}"
                            @if(App\Models\Ad::STATUS_CLOSE == $ad->status) selected @endif>关闭
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="image_upload">广告展示图</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="file" id="image_upload" name="image_upload"/>
                <span class="help-block">广告展示图大小为320x200px，或是按相应比例放大的图片，大小不超过200KB</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="url">广告链接</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="url" name="url"
                       placeholder="请填写跳转链接"
                       data-parsley-required="true"
                       data-parsley-required-message="请填写跳转链接" value="{{ $ad->url }}"/>
                <span class="help-block">如果是外链，请填写完整的url信息，带<code>https://</code>或<code>http://</code>，
                                        如果是内部链接，请以<code>/</code>开头，并访问路径的正确性</span>
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