@extends('admin.layouts.base')
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                    <h4>用户数量</h4>
                    <p>0</p>
                </div>
                <div class="stats-link">
                    <a href="#">View
                        Detail
                        <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-institution"></i></div>
                <div class="stats-info">
                    <h4>订单数量</h4>
                    <p>0</p>
                </div>
                <div class="stats-link">
                    <a href="#">View
                        Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-institution"></i></div>
                <div class="stats-info">
                    <h4>销售金额</h4>
                    <p>0</p>
                </div>
                <div class="stats-link">
                    <a href="#">View
                        Detail <i
                                class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-bolt"></i></div>
                <div class="stats-info">
                    <h4>店铺数量</h4>
                    <p>0</p>
                </div>
                <div class="stats-link">
                    <a href="#">View
                        Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <!-- end row -->


@endsection
@section('script')
    <script src="{{ asset('admin/assets/js/echarts/echarts.min.js') }}"></script>
    <script>
        $(function () {
        })
    </script>
@endsection