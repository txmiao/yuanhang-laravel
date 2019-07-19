@extends('admin.layouts.base')
@section('title', '商品模板库列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('template_goods'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-type,
        #parsley-id-multiple-is_sale {
            display: none;
        }

    </style>
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- begin panel -->
            <div class="panel panel-default" data-sortable-id="table-basic-2">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <button href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal"><i
                                    class="fa fa-plus"></i> 新增
                        </button>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="panel-title">
                            </h4>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <form action="{{ route('template_goods.index') }}" class="form-inline pull-right">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            商品名称 <span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">商品名称</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'name' }}"/>
                                    <input type="text" name="_kw" class="form-control pull-right"
                                           placeholder="请输入搜索内容" value="{{ $params['_kw'] ?? '' }}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>供货商名称</th>
                            <th>商品名称</th>
                            <th>商品类型</th>
                            <th>商品编号</th>
                            <th>在售状态</th>
                            <th>成本价格</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->supplier->name ?? '-' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ \App\Models\TemplateGoods::TYPE_PARTNER == $item->type ? '合伙人商品' : '其它商品' }}</td>
                                    <td>{{ $item->sku_number }}</td>
                                    <td>{!! $item::$saleStatus[$item->is_sale] !!}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <a href="{{ route('template_goods.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('template_goods.destroy', ['id'=>$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                @if(count($lists))
                    <div class="panel-footer clearfix">
                        <div class="pull-left text-muted">共 {{ $lists->total() }} 条记录</div>
                        <div class="pull-right">
                            {{ $lists->appends($params)->render() }}
                        </div>
                    </div>
                @endif
            </div>
            <!-- end panel -->
        </div>
    </div>
    <!-- end row -->

    <!-- 新增记录 -->
    <div class="modal modal-message fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('template_goods.store') }}" method="post" id="create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增模板商品</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="supplier_id">供货商</label>
                                <div class="col-md-7 col-sm-7">
                                    <select name="supplier_id" id="supplier_id" class="form-control"
                                            data-parsley-required="true" data-parsley-required-message="请选择供货商">
                                        <option value="">请选择供货商</option>
                                        @if($suppliers)
                                            @foreach($suppliers as $k => $supplier)
                                                <option value="{{ $k }}">{{ $supplier }}</option>
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
                                               class="minimal"/>&nbsp;合伙人商品
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="control-label">
                                        <input type="radio" name="type"
                                               value="{{ \App\Models\TemplateGoods::TYPE_OTHER }}"
                                               class="minimal" checked>&nbsp;其它商品
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
                                           data-parsley-maxlength-message="商品名称最多30个字符"/>
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
                                           value="{{ (new \App\Models\TemplateGoods)->sku_number_generate('P') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="subtitle">商品副标题</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="subtitle" name="subtitle"
                                           placeholder="请填写商品副标题"
                                           data-parsley-maxlength="15"
                                           data-parsley-maxlength-message="商品副标题最多15个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="price">商品价格</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="price" name="price"
                                           placeholder="请填写商品价格"
                                           data-parsley-type="number"
                                           data-parsley-type-message="商品价格只能填写数字"
                                           data-parsley-required="true" data-parsley-required-message="请填写商品价格"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"
                                       for="thumbnail_upload">商品缩略图</label>
                                <div class="col-md-7 col-sm-7">
                                    <input type="file" id="thumbnail_upload"
                                           name="thumbnail_upload"
                                           class="form-control" data-parsley-required="true"
                                           data-parsley-required-message="请上传商品缩略图"/>
                                    <span class="help-block">用于商品列表封面展示</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"
                                       for="images_upload">商品相册</label>
                                <div class="col-md-7 col-sm-7">
                                    <input type="file" id="images_upload"
                                           name="images_upload[]"
                                           class="form-control" data-parsley-required="true"
                                           data-parsley-required-message="请上传商品图片" multiple/>
                                    <span class="help-block">按住<code>Ctrl</code>键可选择多张图片上传</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">产品详情</label>
                                <div class="col-md-7 col-sm-7">
                                    <div class="row">
                                        <div class="col-md-6"><input class="form-control" type="text"
                                                                     name="detail[key][]"
                                                                     placeholder="产品编号"
                                                                     data-parsley-required="true"
                                                                     data-parsley-required-message="属性名称不能为空"
                                                                     value="产品编号"/></div>
                                        <div class="col-md-6"><input class="form-control" type="text"
                                                                     name="detail[value][]"
                                                                     placeholder="产品编号，如：13290A1015"
                                                                     data-parsley-required="true"
                                                                     data-parsley-required-message="属性值不能为空"/></div>
                                    </div>

                                </div>
                                <a class="btn btn-success btn-icon btn-circle" id="detail_collection_add"><i
                                            class="fa fa-plus"></i></a>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="is_sale">是否上架</label>
                                <div class="col-md-7 col-sm-7">
                                    <label class="control-label">
                                        <input type="radio" name="is_sale"
                                               value="{{ \App\Models\TemplateGoods::ON_SALE }}"
                                               class="minimal" checked>&nbsp;上架
                                    </label>&nbsp;&nbsp;
                                    <label class="control-label">
                                        <input type="radio" name="is_sale"
                                               value="{{ \App\Models\TemplateGoods::UN_SALE }}"
                                               class="minimal"/>&nbsp;下架
                                    </label>&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="content_area">图文详情</label>
                                <div class="col-md-7 col-sm-7">
                                    <script id="content_area" name="detail_ext" type="text/plain"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-sm btn-success">确定</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 修改记录-->
    <div class="modal modal-message fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('template_goods.update') }}" method="post" id="edit">
                {{ csrf_field() }}
                <div class="modal-content">

                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.parse.js') }}"></script>
    <script>
        $(function () {

            $('#modal-dialog').on('show.bs.modal', function () {
                var content = UE.getEditor('content_area', {
                    initialFrameHeight: 200,
                    zIndex: 9999
                });
                content.ready(function () {
                    content.setContent('', false);
                });
            });

            //解决模态框只显示一次的问题
            $("#modal-default-addCoin").on("hidden.bs.modal", function () {
                $(this).removeData("bs.modal");
            });


            //提交数据
            ajaxSubmitData('create');
            ajaxSubmitData('edit');

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            //切换搜索类型
            $('body').on('click', '.dropdown-menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });

            //添加多个产品详情
            $('body').on('click', '#detail_collection_add', function () {
                if (12 == $('input[name="detail[key][]"').length) {
                    layer.msg('产品详情最多只能填写12个');
                    return false;
                }
                var htmlStr = ' <div class="row">\n' +
                    '                                        <div class="col-md-6"><input class="form-control" type="text"\n' +
                    '                                                                     name="detail[key][]"\n' +
                    '                                                                     placeholder="产品编号"\n' +
                    '                                                                     data-parsley-required="true"\n' +
                    '                                                                     data-parsley-required-message="属性名称不能为空"/></div>\n' +
                    '                                        <div class="col-md-6"><input class="form-control" type="text"\n' +
                    '                                                                     name="detail[value][]"\n' +
                    '                                                                     placeholder="产品编号，如：13290A1015"\n' +
                    '                                                                     data-parsley-required="true"\n' +
                    '                                                                     data-parsley-required-message="属性值不能为空"/></div>\n' +
                    '                                    </div>';
                $(this).prev().append(htmlStr);
            });
        })
    </script>
@endsection
