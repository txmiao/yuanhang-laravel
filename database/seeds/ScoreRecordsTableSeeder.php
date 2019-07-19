<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class ScoreRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $array = [1, 2, 3, 4, 5];
         $random = array_random($array);*/

        //来源于事件：invitation=邀请, register=新用户注册, bind_phone=绑定手机号, sign_in=签到, deduct=购买商品抵扣,changed=积分商城兑换
        $array = ['invitation', 'register', 'bind_phone', 'sign_in', 'deduct', 'changed'];
        $arr = [];
        for ($i = 0; $i < 50; $i++) {
            $tmp = [];
            $tmp['user_id'] = rand(1, 3);
            $tmp['type'] = rand(100, 102);
            $tmp['origin_event'] = array_random($array);
            $tmp['number'] = rand(1, 100);
            $tmp['created_at'] = date('Y-m-d H:i:s');
            $tmp['updated_at'] = date('Y-m-d H:i:s');
            $arr[] = $tmp;
        }
        DB::table('score_records')->insert($arr);
    }
}
