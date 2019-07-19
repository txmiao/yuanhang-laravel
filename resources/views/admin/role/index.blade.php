@extends('admin.layouts.base')
@section('title', '角色列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('role'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-perm_id {
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
                            <form action="{{ route('role.index') }}" class="pull-right">
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if('display_name' == $params['_t']) 名称 @else 角色 @endif<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">角色</a></li>
                                            <li><a href="javascript:void(0);" data-value="display_name">名称</a></li>
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
                            <th>角色</th>
                            <th>名称</th>
                            <th>描述</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->display_name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('role.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        @if($item->name != 'SuperAdmin')
                                            <a href="javascript:void(0);"
                                               data-href="{{ route('role.destroy', ['id'=>$item->id]) }}"
                                               class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
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

    <!-- 新增角色表单 -->
    <div class="modal modal-message fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('role.store') }}" method="post" id="create">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增角色</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3" for="name">角色</label>
                                <div class="col-md-8 col-sm-7">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="请填写角色"
                                           data-parsley-required="true" data-parsley-required-message="请填写角色"
                                           data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="角色最多20个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3" for="display_name">名称</label>
                                <div class="col-md-8 col-sm-7">
                                    <input class="form-control" type="text" id="display_name" name="display_name"
                                           placeholder="请填写名称" data-parsley-required="true"
                                           data-parsley-required-message="请填写名称"
                                           data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="名称最多20个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3" for="description">描述</label>
                                <div class="col-md-8 col-sm-7">
                                    <input class="form-control" type="text" id="description" name="description"
                                           placeholder="请填写角色描述" data-parsley-required="true"
                                           data-parsley-required-message="请填写角色描述" data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="角色描述最多20个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">权限</label>
                                <div class="col-md-10">
                                    <table class="table no-border table-responsive">
                                        @if(count($permission))
                                            <tr>
                                                <td colspan="5">
                                                    <a class="btn btn-success btn-xs select_all">全选</a>
                                                    <a class="btn btn-success btn-xs select_reverse">反选</a>
                                                    <a class="btn btn-success btn-xs select_empty">清空</a>
                                                </td>

                                            </tr>
                                            @foreach($permission as $perm)
                                                <tr>
                                                    @for($i=0; $i<count($perm); $i++)
                                                        <td align="left"><label class="checkbox-inline">
                                                                <input type="checkbox" name="perm_id[]" class="minimal"
                                                                       value="{{ $perm[$i]['id'] }}"
                                                                       @if($perm[$i]['name'] == 'index.index') checked @endif />
                                                                {{ $perm[$i]['display_name'] }}
                                                            </label></td>
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>

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

    <!-- 修改角色表单 -->
    <div class="modal modal-message fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('role.update') }}" id="edit" method="post"
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
    <script>
        $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            //提交数据
            ajaxSubmitData('create');
            ajaxSubmitData('edit');

            //切换搜索类型
            $('body').on('click', '.dropdown-menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });

            //全选
            $('.select_all').click(function () {
                $('label.checkbox-inline>div').attr('aria-checked', true).addClass('checked');
                $('label.checkbox-inline>div>input[type="checkbox"]').prop('checked', true);
            });

            //反选
            $('.select_reverse').click(function () {
                $('label.checkbox-inline>div').each(function (i, e) {
                    if ($(e).hasClass('checked')) {
                        $(e).attr('aria-checked', false).removeClass('checked');
                        $(e).children('input[type="checkbox"]').prop('checked', false);
                    } else {
                        $(e).attr('aria-checked', true).addClass('checked');
                        $(e).children('input[type="checkbox"]').prop('checked', true);
                    }
                });
            });

            //清空
            $('.select_empty').click(function () {
                $('label.checkbox-inline>div').attr('aria-checked', false).removeClass('checked');
                $('label.checkbox-inline>div>input[type="checkbox"]').prop('checked', false);
            });

        })
    </script>
@endsection