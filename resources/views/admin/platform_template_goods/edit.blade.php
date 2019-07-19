<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改平台模板商品</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}">
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
            <label class="control-label col-md-3 col-sm-3" for="subtitle">商品副标题</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="subtitle" name="subtitle"
                       placeholder="请填写商品副标题"
                       data-parsley-maxlength="10"
                       data-parsley-maxlength-message="商品副标题最多10个字符" value="{{ $info->subtitle }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">商品编号</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->sku_number }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">库存</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->inventory }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">成本价格（进货价）</label>
            <div class="col-md-7 col-sm-7">
                <p class="form-control-static">{{ $info->cost_price }}</p>
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
                <span class="help-block"><code>此价格用于店铺采购进货价，请务必高于您的成本价（进货价）</code></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="thumbnail_upload">商品缩略图</label>
            <div class="col-md-7 col-sm-7">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($info->thumbnail)
                            <img height="128" src="{{ asset('storage/' . $info->thumbnail) }}" alt="">&nbsp;
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"
                   for="images_upload">商品相册</label>
            <div class="col-md-7 col-sm-7">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if($info->images)
                            @foreach($info->images as $img)
                                <img height="128" src="{{ asset('storage/' . $img) }}" alt="">&nbsp;
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
                            <div class="row">
                                <div class="col-md-3 col-sm-3"><p class="form-control-static">{{ $detailItem['key'] }}
                                        :</p>
                                </div>
                                <div class="col-md-6 col-sm-6"><p
                                            class="form-control-static">{{ $detailItem['value'] }}</p>
                                </div>
                            </div>
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
                           value="{{ \App\Models\PlatformTemplateGoods::ON_SALE }}"
                           class="minimal"
                           @if(\App\Models\PlatformTemplateGoods::ON_SALE == $info->is_sale) checked @endif>&nbsp;上架
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_sale"
                           value="{{ \App\Models\PlatformTemplateGoods::UN_SALE }}"
                           class="minimal"
                           @if(\App\Models\PlatformTemplateGoods::UN_SALE == $info->is_sale) checked @endif/>&nbsp;下架
                </label>&nbsp;&nbsp;
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