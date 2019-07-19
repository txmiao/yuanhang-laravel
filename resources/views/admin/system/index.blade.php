@extends('admin.layouts.base')
@section('title', '系统设置')
@section('breadcrumb')
    {!! Breadcrumbs::render('system'); !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/iCheck/all.css') }}">
    <style>
        #parsley-id-multiple-android_update_force,
        #parsley-id-multiple-ios_update_force {
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#default-tab-1" data-toggle="tab">系统资源使用费设置</a></li>
                <li class=""><a href="#default-tab-2" data-toggle="tab">签到设置</a></li>
                <li class=""><a href="#default-tab-3" data-toggle="tab">会员注册规则及权益设置</a></li>
                <li class=""><a href="#default-tab-4" data-toggle="tab">合伙人权益设置</a></li>
                <li class=""><a href="#default-tab-5" data-toggle="tab">合伙人商城推广奖励政策设置</a></li>
                <li class=""><a href="#default-tab-6" data-toggle="tab">结算设置</a></li>
                <li class=""><a href="#default-tab-7" data-toggle="tab">关于平台设置</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="default-tab-1">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-1"
                          data-parsley-validate="true">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <div class="note note-warning">
                                    <h4>注意事项</h4>
                                    <ul>
                                        <li>注册会员数：<code>单位：万人</code>，系统资源使用费：<code>单位：万元</code>，信用积分：<code>单位：个</code>
                                        </li>
                                        <li>注册会员数范围区间，必须以英文逗号分隔，如：30 万以内，<code>0,30</code></li>
                                        <li>注册会员数范围区间，最后一组必须以英文逗号结束，如：300 万以上，<code>300,</code></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="click_number">省级</label>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[province][range][]"
                                                                 placeholder="注册会员数"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['participation_fee']['province'][0])) value="{{ $config['participation_fee']['province'][0]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[province][fee][]"
                                                                 placeholder="资源使用费"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写资源使用费"
                                                                 @if(isset($config['participation_fee']['province'][0])) value="{{ $config['participation_fee']['province'][0]['fee'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[province][credit_score][]"
                                                                 placeholder="赠送信用积分"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写赠送信用积分"
                                                                 @if(isset($config['participation_fee']['province'][0])) value="{{ $config['participation_fee']['province'][0]['credit_score'] }}" @endif/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[province][range][]"
                                                                 placeholder="0,300000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['participation_fee']['province'][1])) value="{{ $config['participation_fee']['province'][1]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[province][fee][]"
                                                                 placeholder="20000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写资源使用费"
                                                                 @if(isset($config['participation_fee']['province'][1])) value="{{ $config['participation_fee']['province'][1]['fee'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[province][credit_score][]"
                                                                 placeholder="4000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写赠送信用积分"
                                                                 @if(isset($config['participation_fee']['province'][1])) value="{{ $config['participation_fee']['province'][1]['credit_score'] }}" @endif/>
                                    </div>
                                </div>
                                @if(isset($config['participation_fee']['province']) && 2 < count($config['participation_fee']['province']))
                                    @for($i=2; $i<count($config['participation_fee']['province']); $i++)
                                        <div class="row">
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[province][range][]"
                                                                         placeholder="0,300000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写注册会员数范围"
                                                                         @if(isset($config['participation_fee']['province'][$i])) value="{{ $config['participation_fee']['province'][$i]['range'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[province][fee][]"
                                                                         placeholder="20000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写资源使用费"
                                                                         @if(isset($config['participation_fee']['province'][$i])) value="{{ $config['participation_fee']['province'][$i]['fee'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[province][credit_score][]"
                                                                         placeholder="4000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写赠送信用积分"
                                                                         @if(isset($config['participation_fee']['province'][$i])) value="{{ $config['participation_fee']['province'][$i]['credit_score'] }}" @endif/>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <a class="btn btn-success btn-icon btn-circle" id="participation_fee_collection_add"><i
                                        class="fa fa-plus"></i></a>
                            <a class="btn btn-danger btn-icon btn-circle" id="participation_fee_collection_dec"><i
                                        class="fa fa-minus"></i></a>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">市级</label>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[city][range][]"
                                                                 placeholder="注册会员数"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['participation_fee']['city'][0])) value="{{ $config['participation_fee']['city'][0]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[city][fee][]"
                                                                 placeholder="资源使用费"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写资源使用费"
                                                                 @if(isset($config['participation_fee']['city'][0])) value="{{ $config['participation_fee']['city'][0]['fee'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[city][credit_score][]"
                                                                 placeholder="赠送信用积分"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写赠送信用积分"
                                                                 @if(isset($config['participation_fee']['city'][0])) value="{{ $config['participation_fee']['city'][0]['credit_score'] }}" @endif/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[city][range][]"
                                                                 placeholder="0,300000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['participation_fee']['city'][1])) value="{{ $config['participation_fee']['city'][1]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[city][fee][]"
                                                                 placeholder="20000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写资源使用费"
                                                                 @if(isset($config['participation_fee']['city'][1])) value="{{ $config['participation_fee']['city'][1]['fee'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[city][credit_score][]"
                                                                 placeholder="4000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写赠送信用积分"
                                                                 @if(isset($config['participation_fee']['city'][1])) value="{{ $config['participation_fee']['city'][1]['credit_score'] }}" @endif/>
                                    </div>
                                </div>
                                @if(isset($config['participation_fee']['city']) && 2 < count($config['participation_fee']['city']))
                                    @for($i=2; $i<count($config['participation_fee']['city']); $i++)
                                        <div class="row">
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[city][range][]"
                                                                         placeholder="0,300000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写注册会员数范围"
                                                                         @if(isset($config['participation_fee']['city'][$i])) value="{{ $config['participation_fee']['city'][$i]['range'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[city][fee][]"
                                                                         placeholder="20000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写资源使用费"
                                                                         @if(isset($config['participation_fee']['city'][$i])) value="{{ $config['participation_fee']['city'][$i]['fee'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[city][credit_score][]"
                                                                         placeholder="4000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写赠送信用积分"
                                                                         @if(isset($config['participation_fee']['city'][$i])) value="{{ $config['participation_fee']['city'][$i]['credit_score'] }}" @endif/>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <a class="btn btn-success btn-icon btn-circle" id="participation_fee_city_collection_add"><i
                                        class="fa fa-plus"></i></a>
                            <a class="btn btn-danger btn-icon btn-circle" id="participation_fee_city_collection_dec"><i
                                        class="fa fa-minus"></i></a>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">区/县级</label>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[district][range][]"
                                                                 placeholder="注册会员数"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['participation_fee']['district'][0])) value="{{ $config['participation_fee']['district'][0]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[district][fee][]"
                                                                 placeholder="资源使用费"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写资源使用费"
                                                                 @if(isset($config['participation_fee']['district'][0])) value="{{ $config['participation_fee']['district'][0]['fee'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[district][credit_score][]"
                                                                 placeholder="赠送信用积分"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写赠送信用积分"
                                                                 @if(isset($config['participation_fee']['district'][0])) value="{{ $config['participation_fee']['district'][0]['credit_score'] }}" @endif/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[district][range][]"
                                                                 placeholder="0,300000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['participation_fee']['district'][1])) value="{{ $config['participation_fee']['district'][1]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[district][fee][]"
                                                                 placeholder="20000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写资源使用费"
                                                                 @if(isset($config['participation_fee']['district'][1])) value="{{ $config['participation_fee']['district'][1]['fee'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="participation_fee[district][credit_score][]"
                                                                 placeholder="4000"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写赠送信用积分"
                                                                 @if(isset($config['participation_fee']['district'][1])) value="{{ $config['participation_fee']['district'][1]['credit_score'] }}" @endif/>
                                    </div>
                                </div>
                                @if(isset($config['participation_fee']['district']) && 2 < count($config['participation_fee']['district']))
                                    @for($i=2; $i<count($config['participation_fee']['district']); $i++)
                                        <div class="row">
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[district][range][]"
                                                                         placeholder="0,300000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写注册会员数范围"
                                                                         @if(isset($config['participation_fee']['district'][$i])) value="{{ $config['participation_fee']['district'][$i]['range'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[district][fee][]"
                                                                         placeholder="20000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写资源使用费"
                                                                         @if(isset($config['participation_fee']['district'][$i])) value="{{ $config['participation_fee']['district'][$i]['fee'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="participation_fee[district][credit_score][]"
                                                                         placeholder="4000"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写赠送信用积分"
                                                                         @if(isset($config['participation_fee']['district'][$i])) value="{{ $config['participation_fee']['district'][$i]['credit_score'] }}" @endif/>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <a class="btn btn-success btn-icon btn-circle"
                               id="participation_fee_district_collection_add"><i
                                        class="fa fa-plus"></i></a>
                            <a class="btn btn-danger btn-icon btn-circle"
                               id="participation_fee_district_collection_dec"><i
                                        class="fa fa-minus"></i></a>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-2">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-2"
                          data-parsley-validate="true">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-3">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-3"
                          data-parsley-validate="true">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <div class="note note-warning">
                                    <h4>注意事项</h4>
                                    <ul>
                                        <li>注册会员数：<code>单位：万人</code>，信用积分：<code>单位：个</code>
                                        </li>
                                        <li>注册会员数范围区间，必须以英文逗号分隔，如：30 万以内，<code>0,30</code></li>
                                        <li>注册会员数范围区间，最后一组必须以英文逗号结束，如：300 万以上，<code>300,</code></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="click_number">会员注册规则及权益</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="register_present_credit_score[range][]"
                                                                 placeholder="注册会员数"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写注册会员数范围"
                                                                 @if(isset($config['register_present_credit_score'][0]['range'])) value="{{ $config['register_present_credit_score'][0]['range'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="register_present_credit_score[new_user][]"
                                                                 placeholder="新会员注册获赠信用积分"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写新会员注册获赠信用积分"
                                                                 @if(isset($config['register_present_credit_score'][0]['new_user'])) value="{{ $config['register_present_credit_score'][0]['new_user'] }}" @endif/>
                                    </div>
                                    <div class="col-md-4"><input class="form-control" type="text"
                                                                 name="register_present_credit_score[inviter][]"
                                                                 placeholder="推荐人获赠信用积分"
                                                                 data-parsley-required="true"
                                                                 data-parsley-required-message="请填写推荐人获赠信用积分"
                                                                 @if(isset($config['register_present_credit_score'][0]['inviter'])) value="{{ $config['register_present_credit_score'][0]['inviter'] }}" @endif/>
                                    </div>
                                </div>
                                @if(isset($config['register_present_credit_score']) && 1 < count($config['register_present_credit_score']))
                                    @for($i=1; $i<count($config['register_present_credit_score']); $i++)
                                        <div class="row">
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="register_present_credit_score[range][]"
                                                                         placeholder="注册会员数"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写注册会员数范围"
                                                                         @if(isset($config['register_present_credit_score'][$i]['range'])) value="{{ $config['register_present_credit_score'][$i]['range'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="register_present_credit_score[new_user][]"
                                                                         placeholder="新会员注册获赠信用积分"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写新会员注册获赠信用积分"
                                                                         @if(isset($config['register_present_credit_score'][$i]['new_user'])) value="{{ $config['register_present_credit_score'][$i]['new_user'] }}" @endif/>
                                            </div>
                                            <div class="col-md-4"><input class="form-control" type="text"
                                                                         name="register_present_credit_score[inviter][]"
                                                                         placeholder="推荐人获赠信用积分"
                                                                         data-parsley-required="true"
                                                                         data-parsley-required-message="请填写推荐人获赠信用积分"
                                                                         @if(isset($config['register_present_credit_score'][$i]['inviter'])) value="{{ $config['register_present_credit_score'][$i]['inviter'] }}" @endif/>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <a class="btn btn-success btn-icon btn-circle"
                               id="register_present_credit_score_collection_add"><i
                                        class="fa fa-plus"></i></a>
                            <a class="btn btn-danger btn-icon btn-circle"
                               id="register_present_credit_score_collection_dec"><i
                                        class="fa fa-minus"></i></a>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-4">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-4"
                          data-parsley-validate="true">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-5">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-5"
                          data-parsley-validate="true">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-md-offset-2">
                                <blockquote>
                                    <p>合伙人</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[default][direct_recommend]">直推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[default][direct_recommend]"
                                           name="partner_level_rights[default][direct_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写直推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['default']['direct_recommend']))
                                           value="{{ $config['partner_level_rights']['default']['direct_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[default][indirect_recommend]">间推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[default][indirect_recommend]"
                                           name="partner_level_rights[default][indirect_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['default']['indirect_recommend']))
                                           value="{{ $config['partner_level_rights']['default']['indirect_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[default][differential]">级差奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[default][differential]"
                                           name="partner_level_rights[default][differential]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['default']['differential']))
                                           value="{{ $config['partner_level_rights']['default']['differential'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[default][same_level]">平级奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[default][same_level]"
                                           name="partner_level_rights[default][same_level]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['default']['same_level']))
                                           value="{{ $config['partner_level_rights']['default']['same_level'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-2">
                                <blockquote>
                                    <p>银牌合伙人</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[silver][direct_recommend]">直推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[silver][direct_recommend]"
                                           name="partner_level_rights[silver][direct_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写直推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['silver']['direct_recommend']))
                                           value="{{ $config['partner_level_rights']['silver']['direct_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[silver][indirect_recommend]">间推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[silver][indirect_recommend]"
                                           name="partner_level_rights[silver][indirect_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['silver']['indirect_recommend']))
                                           value="{{ $config['partner_level_rights']['silver']['indirect_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[silver][differential]">级差奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[silver][differential]"
                                           name="partner_level_rights[silver][differential]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['silver']['differential']))
                                           value="{{ $config['partner_level_rights']['silver']['differential'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[silver][same_level]">平级奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[silver][same_level]"
                                           name="partner_level_rights[silver][same_level]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['silver']['same_level']))
                                           value="{{ $config['partner_level_rights']['silver']['same_level'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-2">
                                <blockquote>
                                    <p>金牌合伙人</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[gold][direct_recommend]">直推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[gold][direct_recommend]"
                                           name="partner_level_rights[gold][direct_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写直推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['gold']['direct_recommend']))
                                           value="{{ $config['partner_level_rights']['gold']['direct_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[gold][indirect_recommend]">间推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[gold][indirect_recommend]"
                                           name="partner_level_rights[gold][indirect_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['gold']['indirect_recommend']))
                                           value="{{ $config['partner_level_rights']['gold']['indirect_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[gold][differential]">级差奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[gold][differential]"
                                           name="partner_level_rights[gold][differential]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['gold']['differential']))
                                           value="{{ $config['partner_level_rights']['gold']['differential'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[gold][same_level]">平级奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[gold][same_level]"
                                           name="partner_level_rights[gold][same_level]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['gold']['same_level']))
                                           value="{{ $config['partner_level_rights']['gold']['same_level'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-2">
                                <blockquote>
                                    <p>钻石合伙人</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[diamond][direct_recommend]">直推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[diamond][direct_recommend]"
                                           name="partner_level_rights[diamond][direct_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写直推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['diamond']['direct_recommend']))
                                           value="{{ $config['partner_level_rights']['diamond']['direct_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[diamond][indirect_recommend]">间推奖</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[diamond][indirect_recommend]"
                                           name="partner_level_rights[diamond][indirect_recommend]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间推奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['diamond']['indirect_recommend']))
                                           value="{{ $config['partner_level_rights']['diamond']['indirect_recommend'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[diamond][differential]">级差奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[diamond][differential]"
                                           name="partner_level_rights[diamond][differential]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['diamond']['differential']))
                                           value="{{ $config['partner_level_rights']['diamond']['differential'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_level_rights[diamond][same_level]">平级奖（二层内）</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_level_rights[diamond][same_level]"
                                           name="partner_level_rights[diamond][same_level]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写间级差奖比例"
                                           data-parsley-type="number"
                                           data-parsley-type-message="奖项比例只能填写数字"
                                           @if(isset($config['partner_level_rights']['diamond']['same_level']))
                                           value="{{ $config['partner_level_rights']['diamond']['same_level'] }}" @endif/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-6">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-6"
                          data-parsley-validate="true">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="partner_settle_accounts_period">合伙人商城结算周期</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="partner_settle_accounts_period"
                                           name="partner_settle_accounts_period" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写系统结算周期"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="系统结算周期只能填写整数"
                                           @if(isset($config['partner_settle_accounts_period']))
                                           value="{{ $config['partner_settle_accounts_period'] }}" @endif/>
                                    <span class="input-group-addon">天</span>
                                </div>
                                <span class="help-block">系统将按如上设置的结算周期对合伙人进行自动结算</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="factory_settle_accounts_period">厂家店结算周期</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="factory_settle_accounts_period"
                                           name="factory_settle_accounts_period" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写厂家店结算周期"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="厂家店结算周期只能填写整数"
                                           @if(isset($config['factory_settle_accounts_period']))
                                           value="{{ $config['factory_settle_accounts_period'] }}" @endif/>
                                    <span class="input-group-addon">天</span>
                                </div>
                                <span class="help-block">系统将按如上设置的结算周期对厂家店进行自动结算</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="community_settle_accounts_period">社区店结算周期</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="community_settle_accounts_period"
                                           name="community_settle_accounts_period" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写社区店结算周期"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="社区店结算周期只能填写整数"
                                           @if(isset($config['community_settle_accounts_period']))
                                           value="{{ $config['community_settle_accounts_period'] }}" @endif/>
                                    <span class="input-group-addon">天</span>
                                </div>
                                <span class="help-block">系统将按如上设置的结算周期对社区店进行自动结算</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="special_store_settle_accounts_period[province]">省级代理商（专卖店）结算周期</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="special_store_settle_accounts_period[province]"
                                           name="special_store_settle_accounts_period[province]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写专卖店结算周期"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="专卖店结算周期只能填写整数"
                                           @if(isset($config['special_store_settle_accounts_period']['province']))
                                           value="{{ $config['special_store_settle_accounts_period']['province'] }}" @endif/>
                                    <span class="input-group-addon">天</span>
                                </div>
                                <span class="help-block">系统将按如上设置的结算周期对专卖店进行自动结算</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="special_store_settle_accounts_period[city]">市级代理商（专卖店）结算周期</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="special_store_settle_accounts_period[city]"
                                           name="special_store_settle_accounts_period[city]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写专卖店结算周期"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="专卖店结算周期只能填写整数"
                                           @if(isset($config['special_store_settle_accounts_period']['city']))
                                           value="{{ $config['special_store_settle_accounts_period']['city'] }}" @endif/>
                                    <span class="input-group-addon">天</span>
                                </div>
                                <span class="help-block">系统将按如上设置的结算周期对专卖店进行自动结算</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"
                                   for="special_store_settle_accounts_period[district]">区级代理商（专卖店）结算周期</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" id="special_store_settle_accounts_period[district]"
                                           name="special_store_settle_accounts_period[district]" class="form-control"
                                           data-parsley-required="true"
                                           data-parsley-required-message="请填写专卖店结算周期"
                                           data-parsley-type="integer"
                                           data-parsley-type-message="专卖店结算周期只能填写整数"
                                           @if(isset($config['special_store_settle_accounts_period']['district']))
                                           value="{{ $config['special_store_settle_accounts_period']['district'] }}" @endif/>
                                    <span class="input-group-addon">天</span>
                                </div>
                                <span class="help-block">系统将按如上设置的结算周期对专卖店进行自动结算</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-7">
                    <form class="form-horizontal" action="{{ route('system.update') }}" method="post" id="form-7"
                          data-parsley-validate="true">
                        {{ csrf_field() }}
                        <input type="hidden" name="platform_logo"/>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="app_name">应用名称</label>
                            <div class="col-md-3">
                                <input type="text" id="app_name" name="app_name" class="form-control"
                                       data-parsley-required="true"
                                       data-parsley-required-message="请填写应用名称"
                                       @if(isset($config['app_name'])) value="{{ $config['app_name'] }}" @endif/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="belong_to_company">所属公司</label>
                            <div class="col-md-3">
                                <input type="text" id="belong_to_company" name="belong_to_company" class="form-control"
                                       data-parsley-required="true"
                                       data-parsley-required-message="请填写所属公司"
                                       @if(isset($config['belong_to_company'])) value="{{ $config['belong_to_company'] }}" @endif/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="app_version">版本号</label>
                            <div class="col-md-3">
                                <input type="text" id="app_version" name="app_version" class="form-control"
                                       data-parsley-required="true"
                                       data-parsley-required-message="请填写版本号"
                                       @if(isset($config['app_version'])) value="{{ $config['app_version'] }}" @endif/>
                                <span class="help-block">填写的版本号请与APP端开发者版本号保持一致</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="service_tel">客服电话</label>
                            <div class="col-md-3">
                                <input type="text" id="service_tel" name="service_tel" class="form-control"
                                       data-parsley-required="true"
                                       data-parsley-required-message="请填写客服电话"
                                       @if(isset($config['service_tel'])) value="{{ $config['service_tel'] }}" @endif/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success">保存设置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('script')
    <script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            //提交数据
            ajaxSubmitData('form-1');
            ajaxSubmitData('form-2');
            ajaxSubmitData('form-3');
            ajaxSubmitData('form-4');
            ajaxSubmitData('form-5');
            ajaxSubmitData('form-6');
            ajaxSubmitData('form-7');

            //上传APP背景图片
            var url = "{{ route('system.upload') }}?type=background_image";
            $('body').on('click', '#background_image_upload', function () {
                var formdata = new FormData();
                formdata.append('uploadImage', $('#background_image_handler').get(0).files[0]);
                $.ajax({
                    url: url,
                    type: 'post',
                    contentType: false,
                    data: formdata,
                    processData: false,
                    success: function (res) {
                        console.log(res);
                        layer.msg(res.msg);
                        if (res.status) {
                            $('#show_bg').attr('src', '/storage/' + res.data.path);
                            $('input[name="background_image"]').val(res.data.path);
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });

            //上传平台LOGO
            var url = "{{ route('system.upload') }}?type=platform_logo";
            $('body').on('click', '#platform_logo_upload', function () {
                var formdata = new FormData();
                formdata.append('uploadImage', $('#platform_logo_handler').get(0).files[0]);
                $.ajax({
                    url: url,
                    type: 'post',
                    contentType: false,
                    data: formdata,
                    processData: false,
                    success: function (res) {
                        console.log(res);
                        layer.msg(res.msg);
                        if (res.status) {
                            $('#show_platform_logo').attr('src', '/storage/' + res.data.path);
                            $('input[name="platform_logo"]').val(res.data.path);
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });

            //增加系统资源使用费用方案
            $('body').on('click', '#participation_fee_collection_add', function () {
                if (10 == $('input[name="participation_fee[province][range][]"').length) {
                    layer.msg('费用方案最多只能填写10组');
                    return false;
                }
                var htmlStr = '<div class="row">\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[province][range][]"\n' +
                    '                                                                 placeholder="注册会员数"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写注册会员数范围"/></div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[province][fee][]"\n' +
                    '                                                                 placeholder="资源使用费"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写资源使用费"/></div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[province][credit_score][]"\n' +
                    '                                                                 placeholder="赠送信用积分"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写赠送信用积分"/></div>\n' +
                    '                                </div>';
                $(this).prev().append(htmlStr);
            });
            $('body').on('click', '#participation_fee_city_collection_add', function () {
                if (10 == $('input[name="participation_fee[city][range][]"').length) {
                    layer.msg('费用方案最多只能填写10组');
                    return false;
                }
                var htmlStr = '<div class="row">\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[city][range][]"\n' +
                    '                                                                 placeholder="注册会员数"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写注册会员数范围"/></div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[city][fee][]"\n' +
                    '                                                                 placeholder="资源使用费"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写资源使用费"/></div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[city][credit_score][]"\n' +
                    '                                                                 placeholder="赠送信用积分"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写赠送信用积分"/></div>\n' +
                    '                                </div>';
                $(this).prev().append(htmlStr);
            });
            $('body').on('click', '#participation_fee_district_collection_add', function () {
                if (10 == $('input[name="participation_fee[district][range][]"').length) {
                    layer.msg('费用方案最多只能填写10组');
                    return false;
                }
                var htmlStr = '<div class="row">\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[district][range][]"\n' +
                    '                                                                 placeholder="注册会员数"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写注册会员数范围"/></div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[district][fee][]"\n' +
                    '                                                                 placeholder="资源使用费"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写资源使用费"/></div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="participation_fee[district][credit_score][]"\n' +
                    '                                                                 placeholder="赠送信用积分"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写赠送信用积分"/></div>\n' +
                    '                                </div>';
                $(this).prev().append(htmlStr);
            });

            //减少系统资源使用费用方案
            $('body').on('click', '#participation_fee_collection_dec', function () {
                if (3 > $('input[name="participation_fee[province][range][]"').length) {
                    layer.msg('费用方案至少填写2组');
                    return false;
                }
                $(this).parent().children(':eq(1)').children(':last').remove();
            });
            $('body').on('click', '#participation_fee_city_collection_dec', function () {
                if (3 > $('input[name="participation_fee[city][range][]"').length) {
                    layer.msg('费用方案至少填写2组');
                    return false;
                }
                $(this).parent().children(':eq(1)').children(':last').remove();
            });
            $('body').on('click', '#participation_fee_district_collection_dec', function () {
                if (3 > $('input[name="participation_fee[district][range][]"').length) {
                    layer.msg('费用方案至少填写2组');
                    return false;
                }
                $(this).parent().children(':eq(1)').children(':last').remove();
            });

            //增加会员注册规则及权益
            $('body').on('click', '#register_present_credit_score_collection_add', function () {
                if (10 == $('input[name="register_present_credit_score[range][]"').length) {
                    layer.msg('会员注册权益方案最多只能填写10组');
                    return false;
                }
                var htmlStr = '<div class="row">\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="register_present_credit_score[range][]"\n' +
                    '                                                                 placeholder="注册会员数"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写注册会员数范围"\n' +
                    '                                                                />\n' +
                    '                                    </div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="register_present_credit_score[new_user][]"\n' +
                    '                                                                 placeholder="新会员注册获赠信用积分"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写新会员注册获赠信用积分"\n' +
                    '                                                                 />\n' +
                    '                                    </div>\n' +
                    '                                    <div class="col-md-4"><input class="form-control" type="text"\n' +
                    '                                                                 name="register_present_credit_score[inviter][]"\n' +
                    '                                                                 placeholder="推荐人获赠信用积分"\n' +
                    '                                                                 data-parsley-required="true"\n' +
                    '                                                                 data-parsley-required-message="请填写推荐人获赠信用积分"\n' +
                    '                                                                 />\n' +
                    '                                    </div>\n' +
                    '                                </div>';
                $(this).prev().append(htmlStr);
            });

            //减少会员注册规则及权益
            $('body').on('click', '#register_present_credit_score_collection_dec', function () {
                if (3 > $('input[name="register_present_credit_score[range][]"').length) {
                    layer.msg('会员注册权益方案至少填写2组');
                    return false;
                }
                $(this).parent().children(':eq(1)').children(':last').remove();
            });

        })


    </script>
@endsection
