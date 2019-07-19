<?php

namespace App\Models;

use App\Transformers\PartnerStoreTransformer;
use Illuminate\Database\Eloquent\Model;

class PartnerStore extends Model
{
    protected $table = 'partner_stores'; //合伙人商铺表,Cart 模型为了展示店铺分类而构建，保证数据完整性
    protected $guarded = ['_token'];

    public function order()
    {
        return $this->morphMany(Order::class, 'store');
    }

    /**
     * 获取商城类型
     * @return string
     */
    public function getTypeAttribute(){
        return get_class($this);
    }

    public function resource(){
        $transform=new PartnerStoreTransformer();
        return $transform->transform($this);
    }
}
