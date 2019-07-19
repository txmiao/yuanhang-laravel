@extends('admin.layouts.base')
@section('title', '实名认证申请列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('authentication'); !!}
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
                        &nbsp;
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="panel-title">
                            </h4>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <form action="{{ route('authentication.index') }}" class="form-inline pull-right">
                                <!-- 状态 -->
                                <div class="form-group form-group-sm">
                                    <select name="status" class="form-control">
                                        <option value="">请选择状态</option>
                                        @foreach(\App\Models\Authentication::$statusText as $k => $item)
                                            <option value="{{ $k }}"
                                                    @if ($params['status'] == $k) selected @endif>
                                                {{ strip_tags($item) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group input-group-sm">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if($params['_t'] == 'phone') 手机号 @else 用户名 @endif&nbsp;<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">用户名</a></li>
                                            <li><a href="javascript:void(0);" data-value="phone">手机号</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'name' }}"/>
                                    <input type="text" name="_kw" class="form-control pull-right"
                                           placeholder="请填写搜索内容" value="{{ $params['_kw'] ?? '' }}">
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
                            <th>用户名</th>
                            <th>真实姓名</th>
                            <th>身份证号</th>
                            <th>银行卡号</th>
                            <th>开户行</th>
                            <th>状态</th>
                            <th>申请时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ $item->real_name ?? '-' }}</td>
                                    <td>{{ $item->id_card_number ?? '-' }}</td>
                                    <td>{{ $item->account_number ?? '-' }}</td>
                                    <td>{{ $item->open_bank ?? '-' }}</td>
                                    <td>{!! $item::$statusText[$item->status] !!}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('authentication.edit', ['id'=>$item->id]) }}"
                                           data-toggle="modal"
                                           data-target="#modal-default-edit"
                                           class="btn btn-success btn-xs"><i class="fa fa-edit"></i> 审核</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
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


    <!-- 修改记录 -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('authentication.update') }}" id="edit" method="post"
                  data-parsley-validate="true">
                {{ csrf_field() }}
                <div class="modal-content">

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script src="{{ asset('admin/assets/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {

            //提交数据
            ajaxSubmitData('create');
            ajaxSubmitData('edit');

            //解决模态框只显示一次的问题
            $("#modal-default-addCoin").on("hidden.bs.modal", function () {
                $(this).removeData("bs.modal");
            });

            //切换搜索类型
            $('body').on('click', '.dropdown-menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });
        })
    </script>
@endsection