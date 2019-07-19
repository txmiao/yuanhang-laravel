@extends('admin.layouts.base')
@section('title', '消息列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('message'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
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
                            <form action="{{ route('message.index') }}" class="form-inline pull-right">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                            消息标题 <span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu search_dropdown_menu">
                                            <li><a href="javascript:void(0);" data-value="title">消息标题</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'title' }}"/>
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
                            <th>用户名</th>
                            <th>类型</th>
                            <th>标题</th>
                            <th>是否已读</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ isset($item->user->name) ? $item->user->name : '-' }}</td>
                                    <td>{!! $item->getType($item->type) !!}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>@if(\App\Models\Message::READ == $item->is_read) 是 @else 否 @endif</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        {{-- <a href="{{ route('message.edit', ['id'=>$item->id]) }}"
                                            class="btn btn-success btn-xs edit" data-toggle="modal"
                                            data-target="#modal-default-edit"><i class="fa fa-edit"></i> 编辑</a>--}}
                                        <a href="javascript:void(0);"
                                           data-content="{{ $item->content }}" data-title="{{ $item->title }}"
                                           class="btn btn-success btn-xs ajax-view"><i class="fa fa-eye"></i> 查看</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('message.destroy', ['id'=>$item->id]) }}"
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

    <!-- 新增消息 -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
                  action="{{ route('message.store') }}" method="post" id="create">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">新增消息</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body panel-form">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="send_type">发送给</label>
                                <div class="col-md-7 col-sm-7">
                                    <select class="form-control" name="send_type" id="send_type">
                                        <option value="all">全部用户</option>
                                        <option value="single">单一用户</option>
                                        <option value="exclusive">专线用户</option>
                                        <option value="common">普通用户</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="display: none" id="user_id_input">
                                <label class="control-label col-md-3 col-sm-3" for="user_id">用户</label>
                                <div class="col-md-7 col-sm-7">
                                    <select name="user_id" id="user_id" class="form-control selectpicker">
                                        @if($users)
                                            @foreach($users as $k => $user)
                                                <option value="{{$k}}">[&nbsp;{{$k}}&nbsp;]&nbsp;{{$user}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="type">消息类型</label>
                                <div class="col-md-7 col-sm-7">
                                    <select class="form-control" name="type" id="type">
                                        <option value="{{ \App\Models\Message::TYPE_SYSTEM  }}">系统消息</option>
                                        <option value="{{ \App\Models\Message::TYPE_USER  }}">业务消息</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="title">消息标题</label>
                                <div class="col-md-7 col-sm-7">
                                    <input class="form-control" type="text" id="title" name="title"
                                           data-parsley-required="true" data-parsley-required-message="请填写消息标题"
                                           placeholder="请填写消息标题"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3" for="content">消息内容</label>
                                <div class="col-md-7 col-sm-7">
                                    <textarea style="resize: none" class="form-control" name="content" id="content"
                                              rows="10"
                                              placeholder="请填写消息内容"
                                              data-parsley-required="true" data-parsley-required-message="请填写消息内容"
                                              data-parsley-maxlength="255"
                                              data-parsley-maxlength-message="消息内容最多255个字符"></textarea>
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


@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/ueditor/ueditor.parse.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $(function () {

            //提交数据
            ajaxSubmitData('create');
            ajaxSubmitData('edit');

            //切换发送类型时选择是否填写用户ID
            $('body').on('change', '#send_type', function () {
                if ('single' == $(this).val()) {
                    $('#user_id_input').show();
                } else {
                    $('#user_id_input').hide();
                }
            });

            //切换搜索类型
            $('body').on('click', '.search_dropdown_menu li>a', function () {
                $('input[name="_t"]').val($(this).attr('data-value'));
                $('button.dropdown-toggle').html($(this).html() + '&nbsp;<span class="caret"></span>')
            });

            //显示消息内容
            $('body').on('click', '[data-content].ajax-view', function () {
                var _this = $(this);
                layer.open({
                    type: 1,
                    area: '30%',
                    title: _this.attr('data-title'),
                    content: "<p style=\"padding: 10px;\">" + _this.attr('data-content') + "<p/>"
                });
            });

            $('.selectpicker').selectpicker({
                liveSearch: true,
                showTick: true,
                showIcon: false
            });

        })
    </script>
@endsection