@extends('admin.layouts.base')
@section('title', '登录日志')
@section('breadcrumb')
    {!! Breadcrumbs::render('log'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
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
                    <h4 class="panel-title">&nbsp;
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <form action="" class="pull-left" id="batch" method="post">
                                <div class="input-group input-group-sm col-md-2 col-sm-6">
                                    <input type="hidden" name="id"/>
                                    {{ csrf_field() }}
                                    <select class="form-control" id="batch_type">
                                        <option value="{{ route('log.destroy') }}">删除</option>
                                    </select>
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default batch"><i class="fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <form action="{{ route('log.index') }}" class="pull-right">
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if('ip' == $params['_t']) IP @else 地区 @endif<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="location">地区</a></li>
                                            <li><a href="javascript:void(0);" data-value="ip">IP</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'location' }}"/>
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
                            <th><input type="checkbox" class="minimal batch_all"></th>
                            <th>ID</th>
                            <th>管理员</th>
                            <th>登录IP</th>
                            <th>登录地区</th>
                            <th>登录时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <th><input type="checkbox" value="{{ $item->id }}" class="minimal batch"></th>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->admin->nickname ?? $item->admin->name }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('log.destroy', ['id'=>$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                @if(count($lists))
                    <div class="panel-footer clearfix">
                        <div class="pull-left text-muted">共 {{ $lists->total() }} 条记录</div>
                        <div class="pull-right">
                            {{ $lists->render() }}
                        </div>
                    </div>
                @endif
            </div>
            <!-- end panel -->
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-grey',
                radioClass: 'iradio_minimal-grey'
            });

            //切换搜索类型
            $('body').on('click', '.dropdown-menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });

            //批量处理
            var _checked = [];
            $('body').on('ifChecked', 'input.batch_all', function () {
                $('input.batch').iCheck('check');
            }).on('ifUnchecked', function () {
                $('input.batch').iCheck('uncheck');
            });

            $('body').on('click', 'button[type="submit"].batch', function () {
                _checked.length = 0;
                $('input.batch:checked').each(function (i, e) {
                    _checked.push($(e).val());
                });
                if (0 == _checked.length) {
                    layer.msg('请至少选择一条记录');
                    return false;
                }
                $('input[name="id"]').val(_checked.join(','));
                $('#batch').attr('action', $('#batch_type').val());
            });

            ajaxSubmitData('batch');

        })
    </script>
@endsection