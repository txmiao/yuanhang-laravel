<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>管理后台 | @yield('title', '首页')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    {{--<link href="http://fonts.useso.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />--}}
    <link href="{{ asset('admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/style.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/style-responsive.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/theme/default.css') }}" rel="stylesheet" id="theme"/>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- BEGIN 自定义layer skin -->
    <style type="text/css">
        body .my-layer-skin-class .layui-layer-title {
            background: #00acac;
            color: #fff;
            border: none;
        }

        body .my-layer-skin-class .layui-layer-btn a {
            border: none;
        }

        body .my-layer-skin-class .layui-layer-btn .layui-layer-btn0 {
            background: #00acac;
        }

        input, select {
            -webkit-appearance: none;
        }

        /* 重置页码样式 */
        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover {
            background: #008a8a !important;
            border-color: #008a8a !important;
        }

        /* 重置datetimepicker选中样式 */
        .datetimepicker table tr td.active:active,
        .datetimepicker table tr td.active:hover:active,
        .datetimepicker table tr td.active.disabled:active,
        .datetimepicker table tr td.active.disabled:hover:active,
        .datetimepicker table tr td.active.active,
        .datetimepicker table tr td.active:hover.active,
        .datetimepicker table tr td.active.disabled.active,
        .datetimepicker table tr td.active.disabled:hover.active,
        .datetimepicker table tr td span.active:active,
        .datetimepicker table tr td span.active:hover:active,
        .datetimepicker table tr td span.active.disabled:active,
        .datetimepicker table tr td span.active.disabled:hover:active,
        .datetimepicker table tr td span.active.active,
        .datetimepicker table tr td span.active:hover.active,
        .datetimepicker table tr td span.active.disabled.active,
        .datetimepicker table tr td span.active.disabled:hover.active {
            background-color: #008a8a !important;
        }

        .datepicker table tr td.active:active,
        .datepicker table tr td.active:hover:active,
        .datepicker table tr td.active.disabled:active,
        .datepicker table tr td.active.disabled:hover:active,
        .datepicker table tr td.active.active,
        .datepicker table tr td.active:hover.active,
        .datepicker table tr td.active.disabled.active,
        .datepicker table tr td.active.disabled:hover.active,
        .open .dropdown-toggle.datepicker table tr td.active,
        .open .dropdown-toggle.datepicker table tr td.active:hover,
        .open .dropdown-toggle.datepicker table tr td.active.disabled,
        .open .dropdown-toggle.datepicker table tr td.active.disabled:hover {
            background-color: #008a8a !important;
        }
    </style>
    <!-- END 自定义layer skin -->

    <!-- BEGIN 自定义CSS -->
@yield('style')
<!-- END 自定义CSS -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('admin/assets/plugins/pace/pace.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="{{ route('index.index') }}" class="navbar-brand"><span class="navbar-logo"></span> 秒老鼠管理后台</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('storage/'.auth()->guard('admin')->user()->headimgurl) }}" alt="头像"/>
                        <span class="hidden-xs">{{ auth()->guard('admin')->user()->nickname ?? auth()->guard('admin')->user()->name }}</span> <b
                                class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li><a href="{{ route('index.profile') }}" data-toggle="modal"
                               data-target="#modal-default-edit-profile">个人设置</a></li>
                        <li class="divider"></li>
                        {{--<li><a href="javascript:void(0);" class="flush_cache">清除缓存</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        <li><a href="{{ route('login.logout') }}">退出</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="image">
                        <a href="javascript:;"><img
                                    src="{{ asset('storage/'.auth()->guard('admin')->user()->headimgurl) }}"
                                    alt="头像"/></a>
                    </div>
                    <div class="info">
                        {{ auth()->guard('admin')->user()->nickname ?? auth()->guard('admin')->user()->name }}
                        <small>{{ (new \App\Models\Admin)->getAllRoles(auth()->guard('admin')->user()) }}</small>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">导航</li>
                @if(count($menu))
                    @foreach($menu as $menuItem)
                        <li class="has-sub">
                            <a href="javascript:;">
                                <b class="caret pull-right"></b>
                                <i class="fa {{ $menuItem['icon'] }}"></i>
                                <span>{{ $menuItem['name'] }}</span>
                            </a>
                            @if(count($menuItem['child']))
                                <ul class="sub-menu">
                                    @foreach($menuItem['child'] as $childMenuItem)
                                        <li @if($childMenuItem['permission'] == $currMenu) class="active" @endif><a
                                                    href="{{ route($childMenuItem['permission']) }}">{{ $childMenuItem['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
                <li class="nav-profile text-left">最近登录<br/>{{ auth()->guard('admin')->user()->updated_at }}
                    <br/>{{ auth()->guard('admin')->user()->ip }}
                    <br/>{{ auth()->guard('admin')->user()->location }}</li>
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                                class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            @yield('breadcrumb')
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">@yield('title')
            {{--        <small>@yield('description', '')</small>--}}
        </h1>
        <!-- end page-header -->

        @yield('content')
    </div>
    <!-- end #content -->

    <!-- begin #footer -->
    <div id="footer" class="footer">
        &copy; {{ \Carbon\Carbon::now()->year }} 秒老鼠科技重庆股份有限公司 - All Rights Reserved
    </div>
    <!-- end #footer -->

    <!-- begin theme-panel -->
{{--@include('admin.layouts.theme-panel')--}}
<!-- end theme-panel -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i
                class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->


<!-- 修改个人设置 -->
<div class="modal fade" id="modal-default-edit-profile">
    <div class="modal-dialog">
        <form class="form-horizontal" data-parsley-validate="true" name="demo-form"
              action="{{ route('index.update_profile') }}" method="post" id="edit_profile">
            {{ csrf_field() }}
            <div class="modal-content">

            </div>
        </form>
    </div>
</div>


<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('admin/assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('admin/assets/crossbrowserjs/html5shiv.js') }}"></script>
<script src="{{ asset('admin/assets/crossbrowserjs/respond.min.js') }}"></script>
<script src="{{ asset('admin/assets/crossbrowserjs/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
{{--<script src="{{ asset('admin/assets/plugins/flot/jquery.flot.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/flot/jquery.flot.time.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/flot/jquery.flot.pie.min.js') }}"></script>--}}
<script src="{{ asset('admin/assets/plugins/sparkline/jquery.sparkline.js') }}"></script>
{{--<script src="{{ asset('admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
<script src="{{ asset('admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/layer/layer.js') }}"></script>
<script src="{{ asset('admin/assets/js/dashboard.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/apps.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
{{--	<script src="{{ asset('admin/jquery.validate.min.js') }}"></script>--}}
<script src="{{ asset('admin/jquery.form.js') }}"></script>
<script src="{{ asset('admin/custom.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<!-- BEGIN 自定义javascript -->
@yield('script')
<!-- END 自定义javascript -->

<script>
    $(document).ready(function () {
        App.init();
        Dashboard.init();
        $("#content").slimScroll({
            allowPageScroll: true, //是否 使用滚轮到达顶端/底端时，滚动窗口
            height: '850px'
        });
    });

    //提交数据
    ajaxSubmitData('edit_profile');

    //解决modal只请求一次remote的问题
    $("#modal-default-edit").on("hidden.bs.modal", function () {
        $(this).removeData("bs.modal");
    });

    //父级菜单高亮显示
    $('ul.sub-menu>li.active').parents('li.has-sub').addClass('active');

    //清除所有缓存
    $('.flush_cache').click(function () {
        var index = layer.load(2, {shade: [0.5, '#5c5c5c'], time: 2000});
        var url = "{{ route('index.flush') }}";
        $.get(url, {}, function (res) {
            layer.close(index);
            layer.msg(res.msg);
        });
    });

    //更改页码样式
    $('ul.pagination').addClass('pagination-sm m-t-0 m-b-10');
</script>
</body>
</html>
