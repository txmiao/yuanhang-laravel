<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'cors']
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires')
    ], function ($api) {
//        $origin = $request->header('ORIGIN', '*');
        /*
        |--------------------------------------------------------------
        | 用户登录/注册
        |--------------------------------------------------------------
        */
        $api->post('/verificationCodes', 'VerificationCodesController@store'); //发送短信验证码
        $api->post('/users', 'UserController@store');  //用户注册
        $api->patch('/forgetPassword', 'UserController@forgetPassword'); //忘记密码
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore'); //第三方登录
        $api->post('authorizations', 'AuthorizationsController@store'); //登录
        $api->delete('logoff', 'AuthorizationsController@logoff'); //注销
        $api->put('authorizations/current', 'AuthorizationsController@update'); //刷新token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy'); //删除token
        $api->post('/captchas', 'CaptchasController@store');  //创建图片验证码
    });
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires')
    ], function ($api) {
        //游客可以访问的接口
        $api->get('ads', 'AdController@index'); //广告列表
        $api->any('notify/wechat', 'ChargeRecordController@wechatNotify'); //微信支付异步回调
        $api->any('notify/alipay', 'ChargeRecordController@alipayNotify'); //支付宝支付异步回调
        $api->get('regions', 'RegionController@index'); //地区三级联动列表
        $api->get('region_lists', 'RegionController@region_lists'); //地区地区列表
        $api->get('platform', 'SystemController@index'); //关于平台
        $api->get('helps', 'ArticleController@index'); //帮助中心
        $api->get('system_config', 'SystemController@config'); //配置信息
        $api->get('merchants_join_helps', 'MerchantsJoinApplyRecordController@index'); //招商加盟政策
        $api->get('mercantile_agent', 'MerchantsJoinApplyRecordController@mercantile_agent'); //获取地区招商代理列表
        $api->get('platform_slogan', 'PlatformSloganController@index'); //平台标语列表


        //需要 token 验证的接口
        $api->group(['middleware' => ['api.auth']], function ($api) {
            /*
            |--------------------------------------------------------------
            | 用户管理
            |--------------------------------------------------------------
            */
            $api->get('user', 'UserController@me'); //当前登录用户信息
            $api->patch('user', 'UserController@update'); //编辑登录用户信息
            $api->patch('/modifyPassword', 'UserController@modifyPassword'); //修改密码
            /*
            |--------------------------------------------------------------
            | 图片资源管理
            |--------------------------------------------------------------
            */
            $api->post('images', 'ImagesController@store'); //图片资源
            /*
            |--------------------------------------------------------------
            | 消息管理
            |--------------------------------------------------------------
            */
            $api->get('messages', 'MessageController@index'); //消息列表;
            $api->patch('messages/{id}/is_read', 'MessageController@update'); //标记消息为已读
            $api->put('messages', 'MessageController@markAllIsRead'); //标记当前用户所有消息为已读状态
            $api->delete('messages/{id}', 'MessageController@destroy'); //删除消息
            /*
            |--------------------------------------------------------------
            | 收藏管理
            |--------------------------------------------------------------
            */
            $api->get('collections', 'CollectionController@index'); //收藏列表;
            $api->get('beCollections', 'CollectionController@beCollections'); //被收藏列表;
            $api->post('collections', 'CollectionController@store'); //添加收藏;
            $api->delete('collections/{id}', 'CollectionController@destroy'); //取消收藏;

            /*
            |--------------------------------------------------------------
            | 地址管理
            |--------------------------------------------------------------
            */
            $api->get('addresses', 'AddressesController@index')->name('addresses.index');//用户地址列表
            $api->post('addresses/store', 'AddressesController@store')->name('addresses.store');//用户地址增加
            $api->get('addresses/edit/{id}', 'AddressesController@edit')->name('addresses.edit');//用户编辑地址
            $api->post('addresses/update', 'AddressesController@update')->name('addresses.update');//用户更新地址
            $api->get('addresses/destroy/{id}', 'AddressesController@destroy')->name('addresses.destroy');//用户删除地址
            /*
             |--------------------------------------------------------------
             | 认证管理
             |--------------------------------------------------------------
            */

            $api->post('authentication/store', 'AuthenticationController@store')->name('authentication.store');//用户提交认证
            $api->post('authentication/show', 'AuthenticationController@show')->name('authentication.show');//用户认证详情
            /*
             |--------------------------------------------------------------
             | 资产历史
             |--------------------------------------------------------------
            */

            $api->post('AssetHistory/show', 'AssetHistoryController@show')->name('AssetHistory.show');//用户提交认证
            /*
            |--------------------------------------------------------------
            | 购物车
            |--------------------------------------------------------------
            */
            $api->group(['prefix' => 'cart'], function ($api) {
                $api->post('/', 'CartController@index')->name('cart.index');      //购物车列表
                $api->post('add', 'CartController@addToCart')->name('cart.addToCart');      //加入购物车
                $api->patch('update', 'CartController@update')->name('cart.update');      //更新购物车
                $api->delete('delete/{id}', 'CartController@delete')->name('cart.delete');      //删除购物车
                $api->post('clear', 'CartController@clear')->name('cart.clear');      //清空购物车
                $api->get('summary', 'CartController@summary')->name('cart.summary');        //获取购物车小计
                $api->post('checkout','CartController@checkout')->name('cart.checkout');     //购物车结算
            });

            /*
            |--------------------------------------------------------------
            | 配送方式
            |--------------------------------------------------------------
            */
            $api->group(['prefix'=>'shipping'],function($api){
                $api->get('/','ShippingController@index')->name('shipping.index');      //配送方式列表
            });

            /*
            |--------------------------------------------------------------
            | 订单
            |--------------------------------------------------------------
            */
            $api->group(['prefix'=>'order'],function($api){
                $api->get('/','OrderController@index')->name('order.index');            //订单列表
                $api->post('show','OrderController@show')->name('order.show');            //订单列表
                $api->post('receive','OrderController@receive')->name('order.receive');            //订单收货
                $api->post('store','OrderController@store')->name('order.store');       //生成订单
            });



            /*
            |--------------------------------------------------------------
            | 招商加盟
            |--------------------------------------------------------------
            */
            $api->post('merchants_join_record', 'MerchantsJoinApplyRecordController@store'); //添加招商加盟申请

        });

        $api->group(['prefix' => 'goods'], function ($api) {
            $api->get('/', 'GoodsController@index')->name('goods.index');    //商品首页
            $api->get('/show', 'GoodsController@show')->name('goods.show');    //商品详情
        });

        $api->get('/', 'IndexController@index')->name('index'); //首页
    });

});
