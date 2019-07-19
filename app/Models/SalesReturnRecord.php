<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesReturnRecord extends Model
{
    protected $table = 'sales_return_records';
    protected $guarded = ['_token'];

    const STATUS_UN_AUDIT = 100;
    const STATUS_PASS = 101;
    const STATUS_FAIL = 102;

    public static $status = [
        self::STATUS_UN_AUDIT => '待审核',
        self::STATUS_PASS => '已通过',
        self::STATUS_FAIL => '已拒绝',
    ];

    public static $statusText = [
        self::STATUS_UN_AUDIT => '<span class="label label-warning">待审核</span>',
        self::STATUS_PASS => '<span class="label label-success">已通过</span>',
        self::STATUS_FAIL => '<span class="label label-danger">已拒绝</span>',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function store()
    {
        return $this->morphTo();
    }
}
