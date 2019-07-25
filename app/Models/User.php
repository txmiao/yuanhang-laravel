<?php

namespace App\Models;

use App\Services\CommonService;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Dingo\Api\Auth\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    const TYPE_COMMON = 100; //普通用户
    const TYPE_PARTNER = 101; //合伙人用户
    const UN_AUTH = 100;
    const IS_AUTH = 101;

    public static $typeText = [
        self::TYPE_PARTNER => '<span class="label label-info">合伙人用户</span>',
        self::TYPE_COMMON => '<span class="label label-default">普通用户</span>',
    ];

    public static $authText = [
        self::UN_AUTH => '<span class="label label-default">未认证</span>',
        self::IS_AUTH => '<span class="label label-success">已认证</span>',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['_token', 'avatar_image_id'];

    protected $dates = ['last_actived_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 获取关联收藏信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collection()
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * 获取关联的消息记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * 获取关联的图片资源信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }


    /**
     * 关联订单信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }

    /**
     * 关联购物车信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts(){
        return $this->hasMany(Cart::class);
    }

    /**
     * 关联收货地址
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address(){
        return $this->hasMany(Address::class);
    }

    /**
     * 关联合伙人等级
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(){
        return $this->belongsTo(PartnerLevel::class,'partner_level_id');
    }

    /**
     * @param $key
     * @return array|null|string
     */
    public static function message($key){
        return __("messages.user.{$key}");
    }

    /**
     * 关联积分记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function score_records(){
        return $this->hasMany(ScoreRecord::class);
    }

    /**
     * 关联代金券记录
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupon_records(){
        return $this->hasMany(CouponsRecord::class);
    }

    /**
     * 获取关联的认证记录
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function authentication()
    {
        return $this->hasOne(Authentication::class);
    }

    /**
     * 记录积分记录
     * @param int $type
     * @param $event
     * @param $number
     * @return array
     */
    public function log_score($type=100,$event,$number){
        $data=[
            'type'=>$type,
            'origin_event'=>$event,
            'number'=>$number
        ];
        return CommonService::store(ScoreRecord::class,$data,$this->score_records());
    }

    /**
     * 记录代金券记录
     * @param $event
     * @param $number
     * @return array
     */
    public function log_coupon($event,$number){
        $data=[
            'origin_event'=>$event,
            'number'=>$number
        ];
        return CommonService::store(CouponsRecord::class,$data,$this->coupon_records());
    }

    /**
     * 判断是否为合伙人
     */
    public function is_partner(){
        if($this->type==self::TYPE_PARTNER&&!is_null($this->partner)){
            return CommonService::status_return(true,$this->partner);
        }
        return CommonService::status_return(false,[]);
    }

    /**
     * 用户正向关联用户信息。
     */
    public function userinfo()
    {
        return $this->hasOne(UserInfo::class);
    }

}
