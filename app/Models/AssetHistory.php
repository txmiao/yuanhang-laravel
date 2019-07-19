<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetHistory extends Model
{
    protected $table = 'score_records'; //积分记录表

    /**
     * 数据转换
     *
     *
     */
    public function  AssetHistoryDataAssembly($data,$type)
    {
        foreach ($data as $k => &$v) {
            switch ($type) {
                case "100":
                    $v['type_name'] = '信用积分';
                    break;
                case "101":
                    $v['type_name'] = '金积分';
                    break;
                case "102":
                    $v['type_name'] = '银积分';
                    break;
                case "103":
                    $v['type_name'] = '代金卷';
                    break;
            }

            switch ($v['origin_event']) {
                case "invitation":
                    $v['origin_event_name'] = '邀请';
                    break;
                case "register":
                    $v['origin_event_name'] = '新用户注册';
                    break;
                case "bind_phone":
                    $v['origin_event_name'] = '绑定手机号';
                    break;
                case "sign_in":
                    $v['origin_event_name'] = '签到';
                    break;
                case "deduct":
                    $v['origin_event_name'] = '购买商品抵扣';
                    break;
                case "changed":
                    $v['origin_event_name'] = '积分商城兑换';
                    break;
            }
        }
        return $data;

    }
}
