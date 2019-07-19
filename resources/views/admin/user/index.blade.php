@extends('admin.layouts.base')
@section('title', '用户列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('user'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <link href="{{ asset('admin/assets/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet"/>
    <style>
        #parsley-id-multiple-type {
            display: none;
        }

        .area_select {
            display: inline-block !important;
            width: auto;
            float: left;
            margin-right: 5px;
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
                        <div class="btn-group">
                            <a href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> 新增</a>
                        </div>
                        &nbsp;&nbsp;
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="panel-title">
                            </h4>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <form action="{{ route('user.index') }}" class="form-inline pull-right">
                                <!-- 筛选类型 -->
                                <div class="form-group form-group-sm">
                                    <select name="type" class="form-control">
                                        <option value="">全部</option>
                                        <option value="{{ \App\Models\User::TYPE_COMMON }}"
                                                @if(\App\Models\User::TYPE_COMMON == $params['type']) selected @endif>
                                            普通用户
                                        </option>
                                        <option value="{{ \App\Models\User::TYPE_PARTNER }}"
                                                @if(\App\Models\User::TYPE_PARTNER == $params['type']) selected @endif>
                                            合伙人用户
                                        </option>
                                    </select>
                                </div>

                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if('id' == $params['_t']) 用户ID @elseif('phone' == $params['_t'])
                                                手机号 @else 用户名 @endif<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">用户名</a></li>
                                            <li><a href="javascript:void(0);" data-value="id">用户ID</a></li>
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
                            <th>UID</th>
                            <th>用户名</th>
                            <th>类型</th>
                            <th>手机</th>
                            <th>真实姓名</th>
                            <th>信用积分</th>
                            <th>金积分</th>
                            <th>银积分</th>
                            <th>代金券</th>
                            <th>注册时间</th>
                            <th>最后登录时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><img height="20" class="img-circle"
                                             src="{{ strpos($item->avatar, 'https://') === false ? ($item->avatar ? asset('storage/'.$item->avatar) : '/admin/images/user_default.jpeg') : $item->avatar }}"
                                             alt="用户头像">&nbsp;&nbsp;{{ $item->name }}</td>
                                    <td>{!! $item::$typeText[$item->type] !!}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->real_name ?? '-' }}</td>
                                    s
                                    <td>{{ $item->credit_score }}</td>
                                    <td>{{ $item->gold_score }}</td>
                                    <td>{{ $item->silver_score }}</td>
                                    <td>{{ $item->coupons_total }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->last_actived_at ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', ['id'=>$item->id]) }}" data-toggle="modal"
                                           data-target="#modal-default-edit"
                                           class="btn btn-success btn-xs"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('user.destroy', ['id'=>$item->id]) }}"
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

    <!-- 新增会员 -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('user.store') }}" method="post" id="create">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增用户</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="name">用户名</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="请填写用户名"
                                           data-parsley-required="true" data-parsley-required-message="请填写用户名"
                                           data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="用户名最多20个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="password">密码</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="password" id="password" name="password"
                                           data-parsley-required="true" data-parsley-required-message="请填写密码"
                                           placeholder="请填写密码" data-parsley-lenlength="6"
                                           data-parsley-lenlength-message="密码至少6个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="phone">手机号</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="phone" name="phone"
                                           placeholder="请填写手机号"
                                           data-parsley-required="true" data-parsley-required-message="请填写手机号"
                                           data-parsley-pattern="/^1[3456789]\d{9}$/"
                                           data-parsley-pattern-message="手机号格式有误"/>
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

    <!-- 修改会员 -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('user.update') }}" id="edit" method="post"
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
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/distpicker/distpicker.min.js') }}"></script>
    <script>
        $(function () {
            // console.log(JSON.stringify(ChineseDistricts));

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $('#distpicker').distpicker({valueType: 'code'});

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
