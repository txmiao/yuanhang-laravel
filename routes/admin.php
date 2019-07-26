<?php
/**
 * Created by PhpStorm.
 * User: pijh
 * Date: 2017/9/16
 * Time: 22:49
 */
Route::get('getcs', 'CsController@getcs')->name('login.getcs');
Route::post('postcs', 'CsController@postcs')->name('login.postcs');


Route::group(['namespace' => 'Auth', 'middleware' => ['cors']], function () {
    //登录、找回密码
    Route::get('login', 'LoginController@index')->name('login.index');
    Route::post('login', 'LoginController@login')->name('login.login');
    Route::get('logout', 'LoginController@logout')->name('login.logout');
    Route::get('auth/geetest', 'LoginController@getGeetest'); //生成极验验证码
    Route::get('auth/refresh_captcha', 'LoginController@refreshCaptcha')->name('auth.refresh_captcha'); //刷新验证码

    Route::get('/tree/', 'LoginController@tree')->name('login.tree');
});


Route::group(['namespace' => 'Admin', 'middleware' => ['cors']], function () {
    Route::any('/wechat', 'WeChatController@serve'); //微信对接
    Route::post('system/upload', 'SystemController@upload')->name('system.upload');
    Route::get('company/{id}/share/', 'CompanyController@share')->name('company.share');
});

//Route::group(['namespace' => 'Admin', 'middleware' => ['check.login', 'check.permission', 'generate.menu']], function () {
Route::group(['namespace' => 'Admin', 'middleware' => ['cors']], function () {
    /*
    |--------------------------------------------------------------------------
    | 仪表盘
    |--------------------------------------------------------------------------
    */

    //系统首页
    Route::get('/', 'IndexController@index')->name('index.index');

    //个人设置
    Route::get('/profile', 'IndexController@profile')->name('index.profile');
    Route::post('/profile', 'IndexController@updateProfile')->name('index.update_profile');


    //系统设置
    Route::group(['prefix' => 'system'], function () {
        Route::get('/', 'SystemController@index')->name('system.index');
        Route::get('/introduce', 'SystemController@introduce')->name('system.introduce');
        Route::get('/vote', 'SystemController@vote')->name('system.vote');
        Route::get('/modify_period', 'SystemController@modifyPeriod')->name('system.modify_period');
        Route::post('/update', 'SystemController@update')->name('system.update');
    });


    /*
    |--------------------------------------------------------------------------
    | 权限管理
    |--------------------------------------------------------------------------
    */
    //管理员
    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::post('/', 'AdminController@store')->name('admin.store');
        Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
        Route::get('/createCode/{id}', 'AdminController@createCode')->name('admin.createCode');
        Route::post('/update', 'AdminController@update')->name('admin.update');
        Route::get('/destroy/{id}', 'AdminController@destroy')->name('admin.destroy');
        Route::get('/role', 'AdminController@role')->name('admin.role');
    });

    //权限
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', 'PermissionController@index')->name('permission.index');
        Route::post('/', 'PermissionController@store')->name('permission.store');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('permission.edit');
        Route::post('/update', 'PermissionController@update')->name('permission.update');
        Route::get('/destroy/{id}', 'PermissionController@destroy')->name('permission.destroy');
    });

    //角色
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('role.index');
        Route::post('/', 'RoleController@store')->name('role.store');
        Route::get('/permission', 'RoleController@permission')->name('role.permission');
        Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::post('/update', 'RoleController@update')->name('role.update');
        Route::get('/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
    });

    //资源
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', 'MenuController@index')->name('menu.index');
        Route::post('/', 'MenuController@store')->name('menu.store');
        Route::get('/edit/{id}', 'MenuController@edit')->name('menu.edit');
        Route::post('/update', 'MenuController@update')->name('menu.update');
        Route::get('/destroy/{id}', 'MenuController@destroy')->name('menu.destroy');
        Route::get('/topmenu', 'MenuController@topmenu')->name('menu.topmenu');

    });


    /*
    |--------------------------------------------------------------------------
    | 日志管理
    |--------------------------------------------------------------------------
    */
    //登录日志
    Route::group(['prefix' => 'log'], function () {
        Route::get('/', 'LogController@index')->name('log.index');
        Route::match(['get', 'post'], '/destroy/{id?}', 'LogController@destroy')->name('log.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 用户管理
    |--------------------------------------------------------------------------
    */
    //用户管理

    Route::group(['prefix' => 'user', 'middleware' => ['cors']], function () {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::post('/', 'UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/update', 'UserController@update')->name('user.update');
        Route::get('/destroy/{id}', 'UserController@destroy')->name('user.destroy');
    });

    Route::group(['prefix' => 'user_info', 'middleware' => ['cors']], function () {
        Route::get('/', 'UserInfoController@index')->name('user_info.index');

        Route::post('/', 'UserInfoController@store')->name('user_info.store');
        Route::get('/edit/{id}', 'UserInfoController@edit')->name('user_info.edit');
        Route::post('/update', 'UserInfoController@update')->name('user_info.update');
        Route::get('/destroy/{id}', 'UserInfoController@destroy')->name('user_info.destroy');
    });

    //合伙人等级管理
    Route::group(['prefix' => 'partner_level'], function () {
        Route::get('/', 'PartnerLevelController@index')->name('partner_level.index');
        Route::post('/', 'PartnerLevelController@store')->name('partner_level.store');
        Route::get('/edit/{id}', 'PartnerLevelController@edit')->name('partner_level.edit');
        Route::post('/update', 'PartnerLevelController@update')->name('partner_level.update');
        Route::get('/destroy/{id}', 'PartnerLevelController@destroy')->name('partner_level.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 广告管理
    |--------------------------------------------------------------------------
    */
    //广告服务管理
    Route::group(['prefix' => 'ad'], function () {
        Route::get('/', 'AdController@index')->name('ad.index');
        Route::post('/', 'AdController@store')->name('ad.store');
        Route::get('/edit/{id}', 'AdController@edit')->name('ad.edit');
        Route::post('/update', 'AdController@update')->name('ad.update');
        Route::get('/destroy/{id}', 'AdController@destroy')->name('ad.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 文章管理
    |--------------------------------------------------------------------------
    */
    //分类管理
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/', 'CategoryController@store')->name('category.store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
    });

    //文章管理
    Route::group(['prefix' => 'article'], function () {
        Route::get('/', 'ArticleController@index')->name('article.index');
        Route::post('/', 'ArticleController@store')->name('article.store');
        Route::get('/edit/{id}', 'ArticleController@edit')->name('article.edit');
        Route::post('/update', 'ArticleController@update')->name('article.update');
        Route::get('/destroy/{id}', 'ArticleController@destroy')->name('article.destroy');

        Route::get('/category', 'ArticleController@categoryList')->name('article.category');
        Route::post('/store_image', 'ArticleController@store_image')->name('article.store_image');

    });

    /*
    |--------------------------------------------------------------------------
    | 消息管理
    |--------------------------------------------------------------------------
    */
    //消息管理
    Route::group(['prefix' => 'message'], function () {
        Route::get('/', 'MessageController@index')->name('message.index');
        Route::post('/', 'MessageController@store')->name('message.store');
        Route::get('/destroy/{id}', 'MessageController@destroy')->name('message.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 采购管理
    |--------------------------------------------------------------------------
    */
    //供应商管理
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', 'SupplierController@index')->name('supplier.index');
        Route::post('/', 'SupplierController@store')->name('supplier.store');
        Route::get('/edit/{id}', 'SupplierController@edit')->name('supplier.edit');
        Route::post('/update', 'SupplierController@update')->name('supplier.update');
        Route::get('/destroy/{id}', 'SupplierController@destroy')->name('supplier.destroy');
    });

    //商品模板库管理
    Route::group(['prefix' => 'template_goods'], function () {
        Route::get('/', 'TemplateGoodsController@index')->name('template_goods.index');
        Route::post('/', 'TemplateGoodsController@store')->name('template_goods.store');
        Route::get('/edit/{id}', 'TemplateGoodsController@edit')->name('template_goods.edit');
        Route::post('/update', 'TemplateGoodsController@update')->name('template_goods.update');
        Route::get('/destroy/{id}', 'TemplateGoodsController@destroy')->name('template_goods.destroy');
    });

    //平台采购/进货订单管理
    Route::group(['prefix' => 'platform_purchase_order'], function () {
        Route::get('/', 'PlatformPurchaseOrderController@index')->name('platform_purchase_order.index');
        Route::post('/', 'PlatformPurchaseOrderController@store')->name('platform_purchase_order.store');
        Route::get('/edit/{id}', 'PlatformPurchaseOrderController@edit')->name('platform_purchase_order.edit');
        Route::post('/update', 'PlatformPurchaseOrderController@update')->name('platform_purchase_order.update');
        Route::get('/destroy/{id}', 'PlatformPurchaseOrderController@destroy')->name('platform_purchase_order.destroy');
    });

    //平台采购/进货商品记录管理
    Route::group(['prefix' => 'platform_purchase_records'], function () {
        Route::get('/', 'PlatformPurchaseRecordController@index')->name('platform_purchase_records.index');
        Route::get('/edit/{id}', 'PlatformPurchaseRecordController@edit')->name('platform_purchase_records.edit');
        Route::post('/update', 'PlatformPurchaseRecordController@update')->name('platform_purchase_records.update');
    });

    //平台商品模板库管理
    Route::group(['prefix' => 'platform_template_goods'], function () {
        Route::get('/', 'PlatformTemplateGoodsController@index')->name('platform_template_goods.index');
        Route::get('/edit/{id}', 'PlatformTemplateGoodsController@edit')->name('platform_template_goods.edit');
        Route::post('/update', 'PlatformTemplateGoodsController@update')->name('platform_template_goods.update');
        Route::get('/destroy/{id}', 'PlatformTemplateGoodsController@destroy')->name('platform_template_goods.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | 商品管理
    |--------------------------------------------------------------------------
    */
    //合伙人商品管理
    Route::group(['prefix' => 'partner_goods'], function () {
        Route::get('/', 'PartnerGoodsController@index')->name('partner_goods.index');
        Route::get('/edit/{id}', 'PartnerGoodsController@edit')->name('partner_goods.edit');
        Route::post('/update', 'PartnerGoodsController@update')->name('partner_goods.update');
        Route::get('/destroy/{id}', 'PartnerGoodsController@destroy')->name('partner_goods.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 订单管理
    |--------------------------------------------------------------------------
    */
    //订单管理
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index')->name('order.index');
        Route::post('/', 'OrderController@store')->name('order.store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::post('/update', 'OrderController@update')->name('order.update');
        Route::get('/destroy/{id}', 'OrderController@destroy')->name('order.destroy');
    });

    //退货管理
    Route::group(['prefix' => 'sales_return_records'], function () {
        Route::get('/', 'SalesReturnRecordController@index')->name('sales_return_records.index');
        Route::get('/edit/{id}', 'SalesReturnRecordController@edit')->name('sales_return_records.edit');
        Route::post('/update', 'SalesReturnRecordController@update')->name('sales_return_records.update');
    });

    /*
    |--------------------------------------------------------------------------
    | 发货管理
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'shipments'], function () {
        Route::get('/', 'ShipmentController@index')->name('shipments.index');
        Route::get('/edit/{id}', 'ShipmentController@edit')->name('shipments.edit');
        Route::post('/update', 'ShipmentController@update')->name('shipments.update');
        Route::get('/destroy/{id}', 'ShipmentController@destroy')->name('shipments.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 实名认证管理
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'authentication'], function () {
        Route::get('/', 'AuthenticationController@index')->name('authentication.index');
        Route::get('/edit/{id}', 'AuthenticationController@edit')->name('authentication.edit');
        Route::post('/update', 'AuthenticationController@update')->name('authentication.update');
        Route::get('/destroy/{id}', 'AuthenticationController@destroy')->name('authentication.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 商务管理
    |--------------------------------------------------------------------------
    */
    //加盟申请管理
    Route::group(['prefix' => 'join_apply_records'], function () {
        Route::get('/', 'MerchantsJoinApplyRecordController@index')->name('join_apply_records.index');
        Route::get('/edit/{id}', 'MerchantsJoinApplyRecordController@edit')->name('join_apply_records.edit');
        Route::post('/update', 'MerchantsJoinApplyRecordController@update')->name('join_apply_records.update');
        Route::get('/destroy/{id}', 'MerchantsJoinApplyRecordController@destroy')->name('join_apply_records.destroy');
    });

    //区域招商记录管理
    Route::group(['prefix' => 'flagship_store_records'], function () {
        Route::get('/', 'FlagshipStoreRecordController@index')->name('flagship_store_records.index');
    });


    /*
    |--------------------------------------------------------------------------
    | 平台标语及标签管理管理
    |--------------------------------------------------------------------------
    */
    //标签管理
    Route::group(['prefix' => 'label'], function () {
        Route::get('/', 'LabelController@index')->name('label.index');
        Route::post('/', 'LabelController@store')->name('label.store');
        Route::get('/edit/{id}', 'LabelController@edit')->name('label.edit');
        Route::post('/update', 'LabelController@update')->name('label.update');
        Route::get('/destroy/{id}', 'LabelController@destroy')->name('label.destroy');
    });

    //平台标语管理
    Route::group(['prefix' => 'platform_slogan'], function () {
        Route::get('/', 'PlatformSloganController@index')->name('platform_slogan.index');
        Route::post('/', 'PlatformSloganController@store')->name('platform_slogan.store');
        Route::get('/edit/{id}', 'PlatformSloganController@edit')->name('platform_slogan.edit');
        Route::post('/update', 'PlatformSloganController@update')->name('platform_slogan.update');
        Route::get('/destroy/{id}', 'PlatformSloganController@destroy')->name('platform_slogan.destroy');
    });

    //服务保障说明管理
    Route::group(['prefix' => 'service_tips'], function () {
        Route::get('/', 'ServiceTipController@index')->name('service_tips.index');
        Route::post('/', 'ServiceTipController@store')->name('service_tips.store');
        Route::get('/edit/{id}', 'ServiceTipController@edit')->name('service_tips.edit');
        Route::post('/update', 'ServiceTipController@update')->name('service_tips.update');
        Route::get('/destroy/{id}', 'ServiceTipController@destroy')->name('service_tips.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 其它
    |--------------------------------------------------------------------------
    */
    Route::get('/flush', 'IndexController@flush')->name('index.flush'); //清除所有缓存

});
