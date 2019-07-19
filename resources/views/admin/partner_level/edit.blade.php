<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改合伙人等级</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{$info->id }}"/>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">等级名称</label>
            <div class="col-md-7 col-sm-7">
                <select name="level" id="level" class="form-control">
                    @foreach(\App\Models\PartnerLevel::$levels as $k => $level)
                        <option value="{{ $k }}" @if($k == $info->level) selected @endif>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="sort">排序</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="sort" name="sort" placeholder="请填写排序"
                       data-parsley-required="true" data-parsley-required-message="请填写排序"
                       data-parsley-type="integer"
                       data-parsley-type-message="排序只能填写数字" value="{{ $info->sort }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">绑定商品组合</label>
            <div class="col-md-7 col-sm-7">
                <select name="sku_number[0][]" id="sku_number_1" class="form-control"
                        data-parsley-required="true" data-parsley-required-message="请选择绑定商品"
                        multiple>
                    <option value="">无绑定</option>
                    @if($partnerGoods)
                        @foreach($partnerGoods as $k => $good)
                            <option value="{{ $k }}"
                                    @if(in_array($k, $info->sku_number[0])) selected @endif>{{ $good }}</option>
                        @endforeach
                    @endif
                </select>
                <select name="sku_number[1][]" id="sku_number_2" class="form-control"
                        data-parsley-required="true" data-parsley-required-message="请选择绑定商品"
                        multiple>
                    <option value="">无绑定</option>
                    @if($partnerGoods)
                        @foreach($partnerGoods as $k => $good)
                            <option value="{{ $k }}"
                                    @if(in_array($k, $info->sku_number[1])) selected @endif>{{ $good }}</option>
                        @endforeach
                    @endif
                </select>
                <span class="help-block">每个等级可以绑定<code>2组</code>商品，用户购买合伙人商品时满足设定的任何一组条件，都将达到该等级，初始等级时，无需绑定任何商品，其它等级请绑定组合商品，按住<code>Ctrl</code>键可多选</span>
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