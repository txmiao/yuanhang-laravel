@extends('admin.layouts.base')
@section('title', '合伙人商品列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('partner_goods'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-type,
        #parsley-id-multiple-is_recommend,
        #parsley-id-multiple-is_hot,
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
                            <form action="{{ route('partner_goods.index') }}" class="form-inline pull-right">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if($params['_t'] == 'sku_number') 商品编号 @else 商品名称 @endif<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">商品名称</a></li>
                                            <li><a href="javascript:void(0);" data-value="sku_number">商品编号</a></li>
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
                            <th>商品名称</th>
                            <th>缩略图</th>
                            <th>商品编号</th>
                            <th>库存</th>
                            <th>在售状态</th>
                            <th>成本价</th>
                            <th>折前价</th>
                            <th>售价</th>
                            <th>是否推荐</th>
                            <th>是否热销</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img height="32"
                                             src="{{ asset('storage/'.$item->thumbnail) }}"
                                             alt="缩略图"></td>
                                    <td>{{ $item->sku_number }}</td>
                                    <td>{{ $item->inventory }}</td>
                                    <td>{!! $item::$saleStatusText[$item->is_sale] !!}</td>
                                    <td>{{ $item->cost_price }}</td>
                                    <td>{{ $item->pre_discount_price }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{!! $item::$recommendStatusText[$item->is_recommend] !!}</td>
                                    <td>{!! $item::$hotStatusText[$item->is_hot] !!}</td>
                                    <td>
                                        <a href="{{ route('partner_goods.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('partner_goods.destroy', ['id'=>$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
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
                  action="{{ route('partner_goods.update') }}" method="post" id="edit">
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