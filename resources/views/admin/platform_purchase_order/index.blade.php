@extends('admin.layouts.base')
@section('title', '平台采购订单列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('platform_purchase_order'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-type,
        #parsley-id-multiple-shipping_status,
        #parsley-id-multiple-pay_status,
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
                            <form action="{{ route('platform_purchase_order.index') }}"
                                  class="form-inline pull-right">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            订单编号 <span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="order_number">订单编号</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'order_number' }}"/>
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
                            <th>订单编号</th>
                            <th>订单金额</th>
                            <th>收货人</th>
                            <th>联系电话</th>
                            <th>快递公司</th>
                            <th>快递单号</th>
                            <th>支付状态</th>
                            <th>下单时间</th>
                            <th>发货状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->order_number }}</td>
                                    <td>{{ $item->order_amount }}</td>
                                    <td>{{ $item->consignee }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->express_company ?? '-' }}</td>
                                    <td>{{ $item->express_number ?? '-' }}</td>
                                    <td>{!! $item::$payStatusText[$item->pay_status] !!}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{!! $item::$shippingStatusText[$item->shipping_status] !!}</td>
                                    <td>
                                        <a href="{{ route('platform_purchase_order.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-shield"></i> 审核</a>

                                        <a href="{{ route('platform_purchase_records.index', ['_t'=>'order_number', '_kw'=>$item->order_number]) }}"
                                           class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看商品</a>

                                        <a href="javascript:void(0);"
                                           data-href="{{ route('platform_purchase_order.destroy', ['id'=>$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
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
                  action="{{ route('platform_purchase_order.store') }}" method="post" id="create"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增采购订单</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="consignee">收货人</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="consignee" name="consignee"
                                           placeholder="请填写收货人"
                                           data-parsley-required="true" data-parsley-required-message="请填写收货人"
                                           data-parsley-maxlength="10"
                                           data-parsley-maxlength-message="收货人最多10个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="phone">联系电话</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="phone" name="phone"
                                           placeholder="请填写联系电话"
                                           data-parsley-required="true" data-parsley-required-message="请填写联系电话"
                                           data-parsley-maxlength="12"
                                           data-parsley-maxlength-message="联系电话最多12个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">选择商品</label>
                                <div class="col-md-7 col-sm-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($goodsList)
                                                <select name="goods_id[]" class="form-control"
                                                        data-parsley-required="true"
                                                        data-parsley-required-message="请选择商品">
                                                    <option value="">选择商品</option>
                                                    @foreach($goodsList as $k => $goods)
                                                        <optgroup label="{{ "partner_goods" == $k ? "合伙人商品" : "其它商品"}}">
                                                            @if($goods)
                                                                @foreach($goods as $good)
                                                                    <option value="{{ $good->id }}">
                                                                        [&nbsp;￥{{ $good->price }}
                                                                        &nbsp;]&nbsp;{{ $good->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        <div class="col-md-6"><input class="form-control" type="text"
                                                                     name="number[]"
                                                                     placeholder="请填写采购数量"
                                                                     data-parsley-required="true"
                                                                     data-parsley-type="integer"
                                                                     data-parsley-type-message="采购数量只能填写整数"
                                                                     data-parsley-required-message="采购数量不能为空"/></div>
                                    </div>
                                </div>
                                <a class="btn btn-success btn-icon btn-circle" id="detail_collection_add"><i
                                            class="fa fa-plus"></i></a>
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
                  action="{{ route('platform_purchase_order.update') }}" method="post" id="edit">
                {{ csrf_field() }}
                <div class="modal-content">

                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {

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
                if (12 == $('input[name="number[]"').length) {
                    layer.msg('采购商品最多只能填写12个');
                    return false;
                }
                var htmlStr = ' <div class="row">\n' +
                    '                                        <div class="col-md-6">\n' +
                    '                                            @if($goodsList)\n' +
                    '                                                <select name="goods_id[]" class="form-control"\n' +
                    '                                                        data-parsley-required="true"\n' +
                    '                                                        data-parsley-required-message="请选择商品">\n' +
                    '                                                    <option value="">选择商品</option>\n' +
                    '                                                    @foreach($goodsList as $k => $goods)\n' +
                    '                                                        <optgroup label="{{ "partner_goods" == $k ? "合伙人商品" : "其它商品"}}">\n' +
                    '                                                            @if($goods)\n' +
                    '                                                                @foreach($goods as $good)\n' +
                    '                                                                    <option value="{{ $good->id }}">\n' +
                    '                                                                        [&nbsp;￥{{ $good->price }}\n' +
                    '                                                                        &nbsp;]&nbsp;{{ $good->name }}</option>\n' +
                    '                                                                @endforeach\n' +
                    '                                                            @endif\n' +
                    '                                                        </optgroup>\n' +
                    '                                                    @endforeach\n' +
                    '                                                </select>\n' +
                    '                                            @endif\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-6"><input class="form-control" type="text"\n' +
                    '                                                                     name="number[]"\n' +
                    '                                                                     placeholder="请填写采购数量"\n' +
                    '                                                                     data-parsley-required="true"\n' +
                    '                                                                     data-parsley-type="integer"\n' +
                    '                                                                     data-parsley-type-message="采购数量只能填写整数"\n' +
                    '                                                                     data-parsley-required-message="采购数量不能为空"/></div>\n' +
                    '                                    </div>';
                $(this).prev().append(htmlStr);
            });
        })
    </script>
@endsection