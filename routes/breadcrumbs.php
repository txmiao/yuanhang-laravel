<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/30
 * Time: 16:04
 */

//Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('首页', route('index.index'));
});

//Home > 系统首页
Breadcrumbs::register('index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('系统首页', route('index.index'));
});

//Home > 系统设置
Breadcrumbs::register('system', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('系统设置', route('system.index'));
});

//Home > 管理员列表
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('管理员列表', route('admin.index'));
});

//Home > 角色列表
Breadcrumbs::register('role', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('角色列表', route('role.index'));
});

//Home > 权限管理 > 权限列表
Breadcrumbs::register('permission', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('权限列表', route('permission.index'));
});


//Home > 资源列表
Breadcrumbs::register('menu', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('资源列表', route('menu.index'));
});

//Home > 登录日志
Breadcrumbs::register('log', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('登录日志', route('log.index'));
});

//Home > 用户列表
Breadcrumbs::register('user', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('用户列表', route('user.index'));
});


//Home > 广告列表
Breadcrumbs::register('ad', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('广告列表', route('ad.index'));
});

//Home > 文章列表
Breadcrumbs::register('article', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('文章列表', route('article.index'));
});

//Home > 文章管理 > 分类列表
Breadcrumbs::register('category', function ($breadcrumbs) {
    $breadcrumbs->parent('article');
    $breadcrumbs->push('分类列表', route('category.index'));
});

//Home > 消息列表
Breadcrumbs::register('message', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('消息列表', route('message.index'));
});

//Home > 供货商列表
Breadcrumbs::register('supplier', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('供货商列表', route('supplier.index'));
});

//Home > 商品模板库列表
Breadcrumbs::register('template_goods', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('商品模板库列表', route('template_goods.index'));
});

//Home > 平台采购商品列表
Breadcrumbs::register('platform_purchase_records', function ($breadcrumbs) {
    $breadcrumbs->parent('platform_purchase_order');
    $breadcrumbs->push('平台采购商品列表', route('platform_purchase_records.index'));
});

//Home > 平台采购订单列表
Breadcrumbs::register('platform_purchase_order', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('平台采购记录列表', route('platform_purchase_order.index'));
});

//Home > 平台商品模板库列表
Breadcrumbs::register('platform_template_goods', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('平台商品模板库列表', route('platform_template_goods.index'));
});

//Home >合伙人商品列表
Breadcrumbs::register('partner_goods', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('合伙人商品列表', route('partner_goods.index'));
});

//Home >合伙人等级列表
Breadcrumbs::register('partner_level', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('合伙人等级列表', route('partner_level.index'));
});

//Home >订单列表
Breadcrumbs::register('order', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('订单列表', route('order.index'));
});

//Home >发货单列表
Breadcrumbs::register('shipments', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('发货单列表', route('shipments.index'));
});

//Home > 退货申请列表
Breadcrumbs::register('sales_return_records', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('退货申请列表', route('sales_return_records.index'));
});

//Home > 实名认证申请列表
Breadcrumbs::register('authentication', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('实名认证申请列表', route('authentication.index'));
});

//Home > 加盟申请列表
Breadcrumbs::register('join_apply_records', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('加盟申请列表', route('join_apply_records.index'));
});

//Home > 区域招商记录列表
Breadcrumbs::register('flagship_store_records', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('区域招商记录列表', route('flagship_store_records.index'));
});

//Home > 标签列表
Breadcrumbs::register('label', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('标签列表', route('label.index'));
});

//Home > 平台标语列表
Breadcrumbs::register('platform_slogan', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('平台标语列表', route('platform_slogan.index'));
});

//Home > 服务保障说明列表
Breadcrumbs::register('service_tips', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('服务保障说明列表', route('service_tips.index'));
});
