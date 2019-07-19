@extends('admin.layouts.base')
@section('title', '广告列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('ad'); !!}
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
                            <form action="{{ route('ad.index') }}" class="form-inline pull-right">
                                <!-- 状态 -->
                                <div class="form-group form-group-sm">
                                    <select name="status" class="form-control">
                                        <option value="">请选择状态</option>
                                        <option value="{{ \App\Models\Ad::STATUS_OPEN }}"
                                                @if ($params['status'] == \App\Models\Ad::STATUS_OPEN) selected @endif>
                                            已开启
                                        </option>
                                        <option value="{{ \App\Models\Ad::STATUS_CLOSE }}"
                                                @if ($params['status'] == \App\Models\Ad::STATUS_CLOSE) selected @endif>
                                            已关闭
                                        </option>
                                    </select>
                                </div>

                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            广告名称 <span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="name">广告名称</a></li>
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
                            <th>广告名称</th>
                            <th>缩略图</th>
                            <th>状态</th>
                            <th>排序</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><i class="fa fa-image fa-2x ajax-img"
                                           data-src="{{ asset('storage/'.$item->image) }}"
                                           style="cursor:pointer"></i>
                                    </td>
                                    <td>{!! $item::$statusText[$item->status] !!}</td>
                                    <td>{{ $item->sort }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('ad.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-success btn-xs edit" data-toggle="modal"
                                           data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('ad.destroy', ['id'=>$item->id]) }}"
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
                            {{ $lists->appends($params)->render() }}
                        </div>
                    </div>
                @endif
            </div>
            <!-- end panel -->
        </div>
    </div>
    <!-- end row -->

    <!-- 新增广告 -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('ad.store') }}" method="post" id="create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增广告</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="name">广告名称</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="name" name="name"
                                           placeholder="请填写广告名称"
                                           data-parsley-required="true" data-parsley-required-message="请填写广告名称"
                                           data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="广告名称最多20个字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"
                                       for="change_coin_number">排序</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="sort"
                                           name="sort"
                                           placeholder="请填写排序"
                                           data-parsley-required="true" data-parsley-required-message="请填写请填写排序"
                                           data-parsley-type="number"
                                           data-parsley-type-message="排序只能填写数字" value="0"/>
                                    <span class="help-block">排序越大越靠前，影响展示顺序</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="status">状态</label>
                                <div class="col-md-7 col-sm-7">
                                    <select name="status" id="status" class="form-control">
                                        <option value="{{ App\Models\Ad::STATUS_OPEN }}">开启</option>
                                        <option value="{{ App\Models\Ad::STATUS_CLOSE }}">锁定</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="image_upload">广告展示图</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="file" id="image_upload" name="image_upload"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请上传广告展示图"/>
                                    <span class="help-block">广告展示图大小为320x200px，或是按相应比例放大的图片，大小不超过200KB</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="url">广告链接</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="url" name="url"
                                           placeholder="请填写跳转链接"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写跳转链接"/>
                                    <span class="help-block">如果是外链，请填写完整的url信息，带<code>https://</code>或<code>http://</code>，
                                        如果是内部链接，请以<code>/</code>开头，并访问路径的正确性</span>
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

    <!-- 修改广告-->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('ad.update') }}" method="post" id="edit">
                {{ csrf_field() }}
                <div class="modal-content">

                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.parse.js') }}"></script>
    <script>
        $(function () {

            // $('#modal-dialog').on('show.bs.modal', function () {
            //     var introduce = UE.getEditor('introduce', {
            //         initialFrameHeight: 300,
            //         zIndex: 9999
            //     });
            //     introduce.ready(function () {
            //         introduce.setContent('', false);
            //     });
            // });

            //提交数据
            ajaxSubmitData('create');
            ajaxSubmitData('edit');

            //筛选日期
            $(".time-selecter").datetimepicker({
                autoclose: true, format: 'yyyy-mm-dd hh:ii:ss', todayHighlight: true, clearBtn: true
            });

            //切换搜索类型
            $('body').on('click', '.dropdown-menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });

            //显示二维码
            $('[data-src].ajax-img').click(function () {
                var _this = $(this);
                layer.open({
                    type: 1,
                    title: false,
                    content: '<img src="' + _this.attr('data-src') + '" width="300" alt="广告缩略图">'
                });
            });

        })
    </script>
@endsection