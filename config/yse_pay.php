<?php
/**
 * 银盛支付配置文件
 */
return [
    //合作伙伴ID，商户号
    'yse_pay_auth_partner_id' => env('YSE_PAY_PARTNER_ID', 'shanghu_test'),

    //实名认证下单请求地址
    'yse_pay_auth_url' => 'https://openapi.ysepay.com/gateway.do',

    //实名认证下单接口名称
    'yse_pay_auth_method' => 'ysepay.authenticate.four.key.element',

    //实名认证接口响应名称
    'yse_pay_auth_response_name' => 'ysepay_authenticate_four_key_element_response',

    //商户网站编码格式，如：utf-8,gbk,gb2312
    'yse_pay_auth_charset' => 'utf-8',

    //实名认证接口版本
    'yse_pay_auth_version' => '3.0',

    //证书密码
    'yse_pay_pfxpassword' => '123456',
];