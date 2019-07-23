<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuditionsArea;
use App\Models\PartnerGoods;
use App\Models\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SystemController extends Controller
{
    /**
     * 系统设置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $config = System::pluck('value', 'code');
        isset($config['participation_fee']) && $config['participation_fee'] = json_decode($config['participation_fee'], true);
        isset($config['register_present_credit_score']) && $config['register_present_credit_score'] = json_decode($config['register_present_credit_score'], true);
        isset($config['partner_level_rights']) && $config['partner_level_rights'] = json_decode($config['partner_level_rights'], true);
        isset($config['special_store_settle_accounts_period']) && $config['special_store_settle_accounts_period'] = json_decode($config['special_store_settle_accounts_period'], true);
        return view('admin.system.index', compact('config'));
    }

    /**
     * 更新系统设置
     * @param Request $request
     * @param PartnerGoods $partnerGoods
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, PartnerGoods $partnerGoods)
    {
        $requestDate = $request->except('_token');


        //专卖店结算周期设置
        if (isset($requestDate['special_store_settle_accounts_period'])) {
            $requestDate['special_store_settle_accounts_period'] = json_encode($requestDate['special_store_settle_accounts_period']);
        }

        //合伙人商城推广奖励政策
        if (isset($requestDate['partner_level_rights'])) {
            $requestDate['partner_level_rights'] = json_encode($requestDate['partner_level_rights']);
        }

        //会员注册规则及权益
        if (isset($requestDate['register_present_credit_score'])) {
            $requestDate['register_present_credit_score'] = json_encode($partnerGoods->build_pricing_schemes($requestDate['register_present_credit_score']));
        }

        //加盟费用方案
        if (isset($requestDate['participation_fee'])) {
            $res = [];
            foreach ($requestDate['participation_fee'] as $k => $v) {
                $res[$k] = $partnerGoods->build_pricing_schemes($v);
            }
            $requestDate['participation_fee'] = json_encode($res);
        }

        foreach ($requestDate as $k => &$item) {
            if ('platform_logo' == $k && empty($item)) continue;
            $system = System::where('code', $k)->first() ?? new System();
            $system->code = $k;
            $system->value = $item;
            if ($system->save()) {
                continue;
            } else {
                return self::error('更新失败');
            }
        }
        unset($item);
        return self::success('更新成功', null, false);

    }

    /**
     * 上传图片
     * @param Request $request
     * @return string
     */
    public function upload(Request $request)
    {

        if ($request->hasFile('uploadImage') && $request->file('uploadImage')->isValid()) {
            $storePath = 'app_background';
            $filename = $request->file('uploadImage')->store($storePath);
            return self::success('上传成功', ['path' => $filename]);
        }
        return self::error('上传失败');
    }

}
