<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">修改供货商</h4>
</div>
<div class="modal-body">
    <div class="panel-body panel-form">
        <input type="hidden" name="id" value="{{ $info->id }}">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="name">供货商名称</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="name" name="name"
                       placeholder="请填写供货商名称"
                       data-parsley-required="true" data-parsley-required-message="请填写供货商名称"
                       data-parsley-maxlength="20"
                       data-parsley-maxlength-message="供货商名称最多20个字符" value="{{ $info->name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="contact">联系人</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="contact" name="contact"
                       placeholder="请填写联系人"
                       data-parsley-required="true" data-parsley-required-message="请填写联系人"
                       data-parsley-maxlength="10"
                       data-parsley-maxlength-message="联系人最多10个字符" value="{{ $info->contact }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="phone">联系方式</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="phone" name="phone"
                       placeholder="请填写联系方式"
                       data-parsley-required="true" data-parsley-required-message="请填写联系方式"
                       data-parsley-maxlength="12"
                       data-parsley-maxlength-message="联系方式最多12个字符" value="{{ $info->phone }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="address">地址</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="address" name="address"
                       placeholder="请填写联系地址"
                       data-parsley-required="true" data-parsley-required-message="请填写联系地址"
                       value="{{ $info->address }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3" for="main_business">主营业务范围</label>
            <div class="col-md-7 col-sm-7">
                <input class="form-control" type="text" id="main_business" name="main_business"
                       placeholder="请填写主营业务范围"
                       data-parsley-required="true" data-parsley-required-message="请填写主营业务范围"
                       value="{{ $info->main_business }}"/>
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