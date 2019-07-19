@extends('admin.layouts.base')
@section('title', '权限列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('permission'); !!}
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- begin panel -->
            <div class="panel panel-default" data-sortable-id="table-basic-2">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
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
                            <form action="{{ route('permission.index') }}" class="pull-right">
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if('display_name' == $params['_t']) 名称 @else 权限 @endif<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">权限</a></li>
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
                            <th>权限</th>
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
                                        <a href="{{ route('permission.edit', [$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('permission.destroy', [$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
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

    <!-- 新增权限表单 -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true"
                  action="{{ route('permission.store') }}" method="post" id="create">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增权限</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="name">权限</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="请填写权限"
                                           data-parsley-required="true" data-parsley-required-message="请填写权限"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="display_name">名称</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="display_name" name="display_name"
                                           placeholder="请填写权限名称" data-parsley-required="true"
                                           data-parsley-required-message="请填写权限名称" data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="权限名称最多20个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="description">描述</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="description" name="description"
                                           placeholder="请填写权限描述" data-parsley-required="true"
                                           data-parsley-required-message="请填写权限描述" data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="权限描述最多20个字符"/>
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

    <!-- 修改权限表单 -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('permission.update') }}" id="edit" method="post"
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
    <script>
        $(function () {
            //提交数据
            ajaxSubmitData('create');
            ajaxSubmitData('edit');

            //切换搜索类型
            $('body').on('click', '.dropdown-menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });
        })
    </script>
@endsection