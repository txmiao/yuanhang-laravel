<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    protected $table = 'authentications';
    protected $guarded = ['_token'];
    protected $casts = [
        'auth_images' => 'array'
    ];

    const STATUS_WAIT_AUDIT = 100;
    const STATUS_PASS = 101;
    const STATUS_FAIL = 102;

    public static $statusText = [
        self::STATUS_WAIT_AUDIT => '<label class="label label-warning">待审核</label>',
        self::STATUS_PASS => '<label class="label label-success">已通过</label>',
        self::STATUS_FAIL => '<label class="label label-danger">已拒绝</label>',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取关联的银盛实名认证记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auth_record_by_yse_pay()
    {
        return $this->hasMany(AuthRecordByYsePay::class, 'authentication_id');
    }

    /**
     * 数据组装
     *
     *
     */
    public function data_assembly($request)
    {
        $attributes['auth_images'] = [];
        if ($request->card_front_id) {
            $image = Image::find($request->card_front_id);
            $arr['img_id'] = $image->id;
            $arr['img_path'] = $image->path;
            $attributes['auth_images'][0] = $arr;
        }
        if ($request->card_reverse_id) {
            $image = Image::find($request->card_reverse_id);
            $arr['img_id'] = $image->id;
            $arr['img_path'] = $image->path;
            $attributes['auth_images'][1] = $arr;
        }

        $attributes['real_name'] = $request->real_name;
        $attributes['id_card_number'] = $request->id_card_number;
        $attributes['open_bank'] = $request->open_bank;
        $attributes['account_number'] = $request->account_number;


        unset($attributes['card_front_id']);
        unset($attributes['card_reverse_id']);
        $attributes['auth_images'] = json_encode($attributes['auth_images']);
        return $attributes;
    }
}
