<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改合伙人商品</h4>
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
            <label class="control-label col-md-3 col-sm-3" for="price">折前价</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="price" name="price"
                       placeholder="请填写商品价格"
                       data-parsley-type="number"
                       data-parsley-type-message="商品价格只能填写数字"
                       data-parsley-required="true" data-parsley-required-message="请填写商品价格" value="{{ $info->price }}"/>
                <span class="help-block"><code>此价格用于店铺原价（折前价）展示，请务必高于您的当前售价</code></span>
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
                <span class="help-block"><code>此价格用于店铺售价，请务必高于您的成本价（进货价）</code></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="service_tips_ids">服务保障</label>
            <div class="col-md-7 col-sm-7">
                <select name="service_tips_ids[]" id="service_tips_ids" class="form-control" multiple>
                    @if($serviceTips)
                        @foreach($serviceTips as $k => $tip)
                            <option value="{{ $k }}"
                                    @if($info->service_tips_ids && in_array($k, $info->service_tips_ids)) selected @endif>{{ $tip }}</option>
                        @endforeach
                    @endif
                </select>
                <span class="help-block">按住<code>Ctrl</code>键可以多选</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3"></label>
            <div class="col-md-7 col-sm-7">
                <div class="note note-warning">
                    <h4>注意事项</h4>
                    <ul>
                        <li><code>请根据商品售价填写对应的组合支付方式</code></li>
                        <li><code>完成支付时将扣除对应的现金、信用积分及优惠券额度</code></li>
                        <li><code>如果支付方式组合中不包括该类型（如：优惠券），则该类型默认值填写 0</code></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="price">组合支付方式</label>
            <div class="col-md-7 col-sm-7">
                <div class="row">
                    <div class="col-md-12">
                        <p class="form-control-static">方案一：现金</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><input class="form-control" type="text"
                                                 name="pricing_schemes[desc][]"
                                                 placeholder="现金2000"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写方案名称及描述"
                                                 value="{{ $info->pricing_schemes[1]['desc'] ?? '现金'.$info->price }}"/>
                    </div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[cash][]"
                                                 placeholder="现金额度"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写现金额度"
                                                 value="{{ $info->pricing_schemes[1]['cash'] ?? $info->price }}"/>
                    </div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[credit_score][]"
                                                 placeholder="信用积分"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写信用积分"/></div>
                    <div class="col-md-2"><input class="form-control" type="text"
                                                 name="pricing_schemes[coupons][]"
                                                 placeholder="优惠券"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写优惠券额度"/></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="form-control-static">方案二：现金+优惠券</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><input class="form-control" type="text"
                                                 name="pricing_schemes[desc][]"
                                                 placeholder="现金2000+优惠券200"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写方案名称及描述"
                                                 value="{{ $info->pricing_schemes[1]['desc'] ?? '' }}"/></div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[cash][]"
                                                 placeholder="现金额度"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写现金额度"
                                                 value="{{ $info->pricing_schemes[1]['cash'] ?? '' }}"/></div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[credit_score][]"
                                                 placeholder="信用积分"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写信用积分"
                                                 value="{{ $info->pricing_schemes[1]['credit_score'] ?? '' }}"/></div>
                    <div class="col-md-2"><input class="form-control" type="text"
                                                 name="pricing_schemes[coupons][]"
                                                 placeholder="优惠券"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写优惠券额度"
                                                 value="{{ $info->pricing_schemes[1]['coupons'] ?? '' }}"/></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="form-control-static">方案三：现金+信用积分</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><input class="form-control" type="text"
                                                 name="pricing_schemes[desc][]"
                                                 placeholder="现金2000+积分200"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写方案名称及描述"
                                                 value="{{ $info->pricing_schemes[2]['desc'] ?? '' }}"/></div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[cash][]"
                                                 placeholder="现金额度"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写现金额度"
                                                 value="{{ $info->pricing_schemes[2]['cash'] ?? '' }}"/></div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[credit_score][]"
                                                 placeholder="信用积分"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写信用积分"
                                                 value="{{ $info->pricing_schemes[2]['credit_score'] ?? '' }}"/></div>
                    <div class="col-md-2"><input class="form-control" type="text"
                                                 name="pricing_schemes[coupons][]"
                                                 placeholder="优惠券"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写优惠券额度"
                                                 value="{{ $info->pricing_schemes[2]['coupons'] ?? ''}}"/></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="form-control-static">方案四：现金+优惠券+信用积分</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><input class="form-control" type="text"
                                                 name="pricing_schemes[desc][]"
                                                 placeholder="现金2000+优惠券200+积分200"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写方案名称及描述"
                                                 value="{{ $info->pricing_schemes[3]['desc'] ?? '' }}"/></div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[cash][]"
                                                 placeholder="现金额度"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写现金额度"
                                                 value="{{ $info->pricing_schemes[3]['cash'] ?? '' }}"/></div>
                    <div class="col-md-3"><input class="form-control" type="text"
                                                 name="pricing_schemes[credit_score][]"
                                                 placeholder="信用积分"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写信用积分"
                                                 value="{{ $info->pricing_schemes[3]['credit_score'] ?? '' }}"/></div>
                    <div class="col-md-2"><input class="form-control" type="text"
                                                 name="pricing_schemes[coupons][]"
                                                 placeholder="优惠券"
                                                 data-parsley-required="true"
                                                 data-parsley-required-message="请填写优惠券额度"
                                                 value="{{ $info->pricing_schemes[3]['coupons'] ?? ''}}"/></div>
                </div>
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
            <label class="control-label col-md-3 col-sm-3">是否上架</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="is_sale"
                           value="{{ \App\Models\PartnerGoods::IS_SALE }}"
                           class="minimal"
                           @if(\App\Models\PartnerGoods::IS_SALE == $info->is_sale) checked @endif>&nbsp;上架
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_sale"
                           value="{{ \App\Models\PartnerGoods::UN_SALE }}"
                           class="minimal"
                           @if(\App\Models\PartnerGoods::UN_SALE == $info->is_sale) checked @endif/>&nbsp;下架
                </label>&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">是否推荐</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="is_recommend"
                           value="{{ \App\Models\PartnerGoods::IS_RECOMMEND }}"
                           class="minimal"
                           @if(\App\Models\PartnerGoods::IS_RECOMMEND == $info->is_recommend) checked @endif>&nbsp;推荐
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_recommend"
                           value="{{ \App\Models\PartnerGoods::NOT_RECOMMEND }}"
                           class="minimal"
                           @if(\App\Models\PartnerGoods::NOT_RECOMMEND == $info->is_recommend) checked @endif/>&nbsp;不推荐
                </label>&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">是否热销</label>
            <div class="col-md-7 col-sm-7">
                <label class="control-label">
                    <input type="radio" name="is_hot"
                           value="{{ \App\Models\PartnerGoods::IS_HOT }}"
                           class="minimal"
                           @if(\App\Models\PartnerGoods::IS_HOT == $info->is_hot) checked @endif>&nbsp;热销
                </label>&nbsp;&nbsp;
                <label class="control-label">
                    <input type="radio" name="is_hot"
                           value="{{ \App\Models\PartnerGoods::NOT_HOT }}"
                           class="minimal"
                           @if(\App\Models\PartnerGoods::NOT_HOT == $info->is_hot) checked @endif/>&nbsp;不热销
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