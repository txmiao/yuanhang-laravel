<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformTemplateGoods extends Model
{
    protected $table = 'platform_template_goods';
    protected $guarded = ['_token'];
    public $timestamps = false;
    protected $casts = [
        'images' => 'array',
        'detail' => 'array',
    ];

    const ON_SALE = 100;
    const UN_SALE = 101;

    public static $saleStatus = [
        self::ON_SALE => '<label class="label label-success">已上架</label>',
        self::UN_SALE => '<label class="label label-danger">已下架</label>',
    ];

    public function insert_data(PlatformPurchaseRecord $platformPurchaseRecord)
    {
        $info = self::where('sku_number', $platformPurchaseRecord->sku_number)->first();
        $_insert_data = [
            'name' => $platformPurchaseRecord->name,
            'subtitle' => $platformPurchaseRecord->subtitle,
            'sku_number' => $platformPurchaseRecord->sku_number,
            'thumbnail' => $platformPurchaseRecord->thumbnail,
            'images' => $platformPurchaseRecord->images,
            'cost_price' => $platformPurchaseRecord->price,
            'price' => $platformPurchaseRecord->price,
            'inventory' => $platformPurchaseRecord->number,
            'detail' => $platformPurchaseRecord->detail,
            'detail_ext' => $platformPurchaseRecord->detail_ext ?? '-',
            'is_sale' => self::UN_SALE,
        ];
        if ($info) {
            return $info->increment('inventory', $platformPurchaseRecord->number);
        } else {
            self::fill($_insert_data);
            return self::save();
        }
    }
}
