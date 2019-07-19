<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>管理后台 | 403 没有权限访问</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.useso.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin error -->
        <div class="error">
            <div class="error-code m-b-10">403 <i class="fa fa-warning"></i></div>
            <div class="error-content">
                <div class="error-message">访问被拒绝</div>
                <div class="error-desc m-b-20">
                    您没有操作此资源的权限 <br />
                    请联系管理员
                </div>
                <div>
                    <a href="{{ route('index.index') }}" class="btn btn-success">返回首页</a>
                </div>
            </div>
        </div>
        <!-- end error -->
        
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

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
    <script src="{{ asset('admin/assets/js/apps.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	 
</body>
</html>
