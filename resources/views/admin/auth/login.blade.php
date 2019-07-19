<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>管理后台 | 登录</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    {{--<link href="http://fonts.useso.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">--}}
    <link href="{{ asset('admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/style.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/style-responsive.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/theme/default.css') }}" rel="stylesheet" id="theme"/>
    <!-- ================== END BASE CSS STYLE ================== -->

</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<div class="login-cover">
    <div class="login-cover-image"><img src="{{ asset('admin/assets/img/login-bg/bg-5.jpg') }}"
                                        data-id="login-cover-image" alt=""/></div>
    <div class="login-cover-bg"></div>
</div>
<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated flipInX">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> 秒老鼠酒仓库系统
                <small>后台管理系统</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end brand -->
        <div class="login-content">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.login') }}" method="POST" class="margin-bottom-0">
                {{ csrf_field() }}
                <div class="form-group m-b-20">
                    <input type="text" class="form-control input-lg" name="name" placeholder="用户"
                           value="{{ old('name') }}"/>
                </div>
                <div class="form-group m-b-20">
                    <input type="password" class="form-control input-lg" name="password" placeholder="密码"/>
                </div>
                <div class="form-group m-b-20" style="width: 50%;float: left">
                    <input type="text" class="form-control input-lg" name="verification_code" placeholder="验证码"/>
                </div>
                <div class="form-group m-b-20" style="width: 45%;float: right;">
                    <img src="{{ $captchaData['captcha'] }}" alt="验证码，点击更换" title="点击更换" id="refresh_captcha">
                    <input type="hidden" name="captcha_key" value="{{ $captchaData['captcha_key'] }}" id="captcha_key">
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">登&nbsp;&nbsp;录</button>
                </div>
                {{-- <div class="m-t-20">
                     <a href="#">忘记密码&nbsp;?</a>
                 </div>--}}
            </form>
        </div>
    </div>
    <!-- end login -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('admin/assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/layer/layer.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('admin/assets/crossbrowserjs/html5shiv.js') }}"></script>
<script src="{{ asset('admin/assets/crossbrowserjs/respond.min.js') }}"></script>
<script src="{{ asset('admin/assets/crossbrowserjs/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('admin/assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('admin/assets/js/login-v2.demo.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/apps.min.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>

<script>
    $(document).ready(function () {
        App.init();
        LoginV2.init();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //随机激活一个登录背景
        /*$('ul.login-bg-list > li:eq(' + Math.floor(Math.random() * 6) + ')')
            .find('a[data-click="change-bg"]').click()
            .addClass('active')
            .siblings().removeClass('active');*/

        //刷新验证码
        $('body').on('click', '#refresh_captcha', function () {
            var captcha_key = $('#captcha_key').val();
            $.get("{{ route('auth.refresh_captcha') }}", {captcha_key: captcha_key}, function (res) {
                if (res.captcha && res.captcha_key) {
                    $('#refresh_captcha').attr('src', res.captcha);
                    $('#captcha_key').val(res.captcha_key);
                } else {
                    layer.msg('操作失败，请稍后重试');
                }
            })
        });
    });
</script>

</body>
</html>
