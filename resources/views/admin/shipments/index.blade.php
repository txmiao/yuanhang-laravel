@extends('admin.layouts.base')
@section('title', '发货单列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('shipments'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-status {
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
                        {{--<button href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal"><i
                                    class="fa fa-plus"></i> 新增
                        </button>--}}
                        &nbsp;
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="panel-title">
                            </h4>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <form action="{{ route('shipments.index') }}"
                                  class="form-inline pull-right">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            订单ID <span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="order_id">订单ID</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'order_id' }}"/>
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
                            <th>订单状态</th>
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
                                    <td>{{ $item->order->order_number }}</td>
                                    <td>{{ $item->order->order_money }}</td>
                                    <td>{{ $item->order->address->consignee ?? '-' }}</td>
                                    <td>{{ $item->order->address->phone ?? '-' }}</td>
                                    <td>{{ $item->express_company ?? '-' }}</td>
                                    <td>{{ $item->express_number ?? '-' }}</td>
                                    <td>{!! \App\Models\Order::$statusText[$item->order->status] !!}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{!! $item::$shippingStatusText[$item->status] !!}</td>
                                    <td>
                                        {{--<a href="{{ route('order_goods.index', ['_t'=>'order_number', '_kw'=>$item->order_number]) }}"
                                           class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看商品</a>--}}
                                        <a href="{{ route('shipments.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('shipments.destroy', ['id'=>$item->id]) }}"
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

    <!-- 修改记录-->
    <div class="modal modal-message fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('shipments.update') }}" method="post" id="edit">
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

        })
    </script>
@endsection