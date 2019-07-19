<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改模板商品</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="supplier_id">供货商</label>
            <div class="col-md-7 col-sm-7">
                <select name="supplier_id" id="supplier_id" class="form-control"
                        data-parsley-required="true" data-parsley-required-message="请选择供货商">
                    <option value="">请选择供货商</option>
                    @if($suppliers)
                        @foreach($suppliers as $k => $supplier)
                            <option value="{{ $k }}"
                                    @if($info->supplier_id == $k) selected @endif>{{ $supplier }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">商品类型</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="type"
                           value="{{ \App\Models\TemplateGoods::TYPE_PARTNER }}"
                           class="minimal" @if(\App\Models\TemplateGoods::TYPE_PARTNER == $info->type) checked @endif/>&nbsp;合伙人商品
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="type"
                           value="{{ \App\Models\TemplateGoods::TYPE_OTHER }}"
                           class="minimal" @if(\App\Models\TemplateGoods::TYPE_OTHER == $info->type) checked @endif>&nbsp;其它商品
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">商品名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name"
                       placeholder="请填写商品名称"
                       data-parsley-required="true" data-parsley-required-message="请填写商品名称"
                       data-parsley-maxlength="30"
                       data-parsley-maxlength-message="商品名称最多30个字符" value="{{ $info->name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="sku_number">商品编号(SKU)</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="sku_number" name="sku_number"
                       placeholder="请填写商品编号"
                       data-parsley-required="true" data-parsley-required-message="请填写商品编号"
                       data-parsley-maxlength="30"
                       data-parsley-maxlength-message="商品编号最多30个字符"
                       value="{{ $info->sku_number }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="subtitle">商品副标题</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="subtitle" name="subtitle"
                       placeholder="请填写商品副标题"
                       data-parsley-maxlength="10"
                       data-parsley-maxlength-message="商品副标题最多10个字符" value="{{ $info->subtitle }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="price">商品价格</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="price" name="price"
                       placeholder="请填写商品价格"
                       data-parsley-type="number"
                       data-parsley-type-message="商品价格只能填写数字"
                       data-parsley-required="true" data-parsley-required-message="请填写商品价格" value="{{ $info->price }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="thumbnail_upload">商品缩略图</label>
            <div class="col-md-7 col-sm-7">
                <input type="file" id="thumbnail_upload"
                       name="thumbnail_upload"
                       class="form-control"/>
                <span class="help-block">用于商品列表封面展示</span>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($info->thumbnail)
                            <img height="48" src="{{ asset('storage/' . $info->thumbnail) }}" alt="">&nbsp;
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="images_upload">商品相册</label>
            <div class="col-md-7 col-sm-7">
                <input type="file" id="images_upload"
                       name="images_upload[]"
                       class="form-control" multiple/>
                <span class="help-block">按住<code>Ctrl</code>键可选择多张图片上传</span>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($info->images)
                            @foreach($info->images as $img)
                                <img height="48" src="{{ asset('storage/' . $img) }}" alt="">&nbsp;
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">产品详情</label>
            <div class="col-md-7 col-sm-7">
                @if(count($info->detail))
                    @foreach($info->detail as $detailItem)
                        <div class="row">
                            <div class="col-md-6"><input class="form-control" type="text"
                                                         name="detail[key][]"
                                                         placeholder="产品编号"
                                                         data-parsley-required="true"
                                                         data-parsley-required-message="属性名称不能为空"
                                                         value="{{ $detailItem['key'] }}"/></div>
                            <div class="col-md-6"><input class="form-control" type="text"
                                                         name="detail[value][]"
                                                         placeholder="产品编号，如：13290A1015"
                                                         data-parsley-required="true"
                                                         data-parsley-required-message="属性值不能为空"
                                                         value="{{ $detailItem['value'] }}"/></div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="is_sale">是否上架</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="is_sale"
                           value="{{ \App\Models\TemplateGoods::ON_SALE }}"
                           class="minimal" @if(\App\Models\TemplateGoods::ON_SALE == $info->is_sale) checked @endif>&nbsp;上架
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_sale"
                           value="{{ \App\Models\TemplateGoods::UN_SALE }}"
                           class="minimal" @if(\App\Models\TemplateGoods::UN_SALE == $info->is_sale) checked @endif/>&nbsp;下架
                </label>&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="content_area_edit">图文详情</label>
            <div class="col-md-7 col-sm-7">
                <script id="content_area_edit" name="detail_ext" type="text/plain"></script>
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

        var content_area_edit = UE.getEditor('content_area_edit', {
            initialFrameHeight: 200,
            zIndex: 99999
        });
        content_area_edit.ready(function () {
            content_area_edit.setContent('{!! $info->detail_ext ?? "" !!}', false);
        });
        $('#modal-default-edit').on('hidden.bs.modal', function () {
            UE.delEditor('content_area_edit');
        });

    })
</script>