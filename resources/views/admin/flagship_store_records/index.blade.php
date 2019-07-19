@extends('admin.layouts.base')
@section('title', '区域招商记录列表')
@section('breadcrumb')
    {!! Breadcrumbs::render('flagship_store_records'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-status {
            display: none;
        }

        .category_link {
            color: #707478;
            border-bottom: 1px solid #707478;
        }

        a.category_link:link, a.category_link:visited, a.category_link:hover, a.category_link:active {
            text-decoration: none;
        }

        a.category_link:active, a.category_link:hover {
            color: #ff5b57;
            border-bottom: 1px solid #ff5b57;
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
                            <form action="{{ route('flagship_store_records.index') }}" class="form-inline pull-right">
                                <!-- 状态 -->
                                <div class="form-group form-group-sm">
                                    <select name="status" class="form-control">
                                        <option value="">请选择状态</option>
                                        @foreach(\App\Models\FlagshipStoreRecord::$statusText as $k => $item)
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
                                                data-toggle="dropdown">地区名称&nbsp;<span
                                                    class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" data-value="location_name">地区名称</a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="_t"
                                           value="{{ $params['_t'] ?? 'location_name' }}"/>
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
                            <th>地区名称</th>
                            <th>级别</th>
                            <th>绑定店铺</th>
                            <th>状态</th>
                            {{--<th>操作</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lists))
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>@if(\App\Models\FlagshipStoreRecord::LEVEL_DISTRICT == $item->level) {{ $item->location_name }}
                                        @else
                                            <a class="category_link"
                                               href="{{ route('flagship_store_records.index')  }}?parent_code={{$item->location_code}}"
                                               title="点击进入下一级">{{ $item->location_name }}</a> @endif
                                    </td>
                                    <td>{!! $item::$levelText[$item->level] !!}</td>
                                    <td>{{ $item->store->name ?? '-' }}</td>
                                    <td>{!! $item::$statusText[$item->status] !!}</td>
                                    {{--<td>
                                        <a href="{{ route('flagship_store_records.edit', ['id'=>$item->id]) }}"
                                           data-toggle="modal"
                                           data-target="#modal-default-edit"
                                           class="btn btn-success btn-xs"><i class="fa fa-eye"></i> 查看</a>
                                    </td>--}}
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


    <!-- 修改记录 -->
    {{--<div class="modal modal-message fade" id="modal-default-edit">
        <div class="modal-dialog">
            <form class="form-horizontal" action="{{ route('flagship_store_records.update') }}" id="edit" method="post"
                  data-parsley-validate="true">
                {{ csrf_field() }}
                <div class="modal-content">

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>--}}

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