@extends('admin.layouts.base')
@section('title', '资源列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('menu'); !!}
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
                            <form action="{{ route('menu.index') }}" class="pull-right">
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            @if('name' == $params['_t']) 资源名称 @else 资源链接 @endif<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">资源名称</a></li>
                                            <li><a href="javascript:void(0);" data-value="link">资源链接</a></li>
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
                            <th>资源名称</th>
                            <th>资源图标</th>
                            <th>资源链接</th>
                            <th>资源权限</th>
                            <th>上级资源</th>
                            <th>排序</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>@if(0 == $item->pid) <i class="fa {{ $item->icon }}"></i> @else - @endif</td>
                                    <td>{{ $item->link }}</td>
                                    <td>{{ $item->permission }}</td>
                                    <td>{{ $item->getParentMenu($item->pid) }}</td>
                                    <td>{{ $item->sort }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('menu.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('menu.destroy', ['id'=>$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
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

    <!-- 新增资源 -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('menu.store') }}" method="post" id="create">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增资源</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="pid">父级资源</label>
                                <div class="col-md-7 col-sm-7">
                                    <select name="pid" class="form-control">
                                        <option value="0">顶级资源</option>
                                        @if (count($pid))
                                            @foreach($pid as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="name">资源名称</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="请填写资源名称"
                                           data-parsley-required="true" data-parsley-required-message="请填写资源名称"
                                           data-parsley-maxlength="10"
                                           data-parsley-maxlength-message="资源名称最多10个字符"/>
                                </div>
                            </div>
                            <div class="form-group hide_for_top_menu" style="display: none;">
                                <label class="control-label col-md-3 col-sm-3" for="link">资源链接</label>
                                <div class="col-md-7 col-sm-7">
                                    <input disabled class="form-control" type="text" id="link" name="link"
                                           placeholder="请填写资源链接"/>
                                </div>
                            </div>
                            <div class="form-group hide_for_top_menu" style="display: none;">
                                <label class="control-label col-md-3 col-sm-3" for="permission">资源权限</label>
                                <div class="col-md-7 col-sm-7">
                                    <input disabled class="form-control" type="text" id="permission" name="permission"
                                           placeholder="请填写资源权限"/>
                                </div>
                            </div>
                            <div class="form-group hide_for_sub_menu">
                                <label class="control-label col-md-3 col-sm-3" for="icon">资源图标</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="icon" name="icon"
                                           placeholder="请填写资源图标"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="sort">资源排序</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="sort" name="sort" placeholder="请填写资源排序"
                                           value="0"/>
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

    <!-- 修改资源 -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('menu.update') }}" method="post" id="edit">
                {{ csrf_field() }}
                <div class="modal-content">

                </div>
            </form>
        </div>
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

            //控制顶级资源和子资源填写项
            $('body').on('change', '[name="pid"]', function () {
                if (0 == $(this).val()) {
                    $('.hide_for_top_menu').hide().find('input').prop('disabled', true);
                    $('.hide_for_sub_menu').show().find('input').prop('disabled', false);
                } else {
                    $('.hide_for_top_menu').show().find('input').prop('disabled', false);
                    $('.hide_for_sub_menu').hide().find('input').prop('disabled', true);
                }
            });
        })
    </script>
@endsection