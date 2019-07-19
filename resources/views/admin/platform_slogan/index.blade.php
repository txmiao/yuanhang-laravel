@extends('admin.layouts.base')
@section('title', '平台标语列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('platform_slogan'); !!}
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
                            <a href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal"><i
                                        class="fa fa-plus"></i> 新增
                            </a>
                            {{--<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-share"></i> 导出</a>--}}
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
                            <form action="{{ route('platform_slogan.index') }}" class="form-inline pull-right">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            标语名称 <span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">标语名称</a></li>
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
                            <th>名称</th>
                            <th>图标</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img height="28" src="{{ asset('storage/' . $item->icon) }}" alt="">&nbsp;</td>
                                    <td>
                                        <a href="{{ route('platform_slogan.edit', ['id'=>$item->id]) }}"
                                           data-toggle="modal"
                                           data-target="#modal-default-edit"
                                           class="btn btn-success btn-xs"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('platform_slogan.destroy', ['id'=>$item->id]) }}"
                                           class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center"><i class="fa fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
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
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('platform_slogan.store') }}" method="post" id="create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增标语</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="name">标语名称</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="请填写标语名称"
                                           data-parsley-required="true" data-parsley-required-message="请填写标语名称"
                                           data-parsley-maxlength="6"
                                           data-parsley-maxlength-message="标语名称最多6个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"
                                       for="icon_upload">图标</label>
                                <div class="col-md-7 col-sm-7">
                                    <input type="file" id="icon_upload"
                                           name="icon_upload"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"
                                       for="sort">排序</label>
                                <div class="col-md-7 col-sm-7">
                                    <input type="text" id="sort" name="sort" class="form-control" value="0"/>
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

    <!-- 修改记录 -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('platform_slogan.update') }}" id="edit" method="post"
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
    <script src="{{ asset('admin/assets/plugins/distpicker/distpicker.data.min.js') }}"></script>
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