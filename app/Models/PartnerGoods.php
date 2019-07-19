<?php

namespace App\Models;

use App\Transformers\PartnerGoodsTransformer;
use Illuminate\Database\Eloquent\Model;

class PartnerGoods extends Model
{
    protected $table = 'partner_goods';
    protected $guarded = ['_token'];
    protected $casts = [
        'service_tips_ids' => 'array',
        'pricing_schemes' => 'array',
        'images' => 'array',
        'detail' => 'array',
    ];

    const IS_SALE = 100;
    const UN_SALE = 101;
    const NOT_RECOMMEND = 100;
    const IS_RECOMMEND = 101;
    const NOT_HOT = 100;
    const IS_HOT = 101;

    public static $saleStatusText = [
        self::IS_SALE => '<span class="label label-success">已上架</span>',
        self::UN_SALE => '<span class="label label-default">已下架</span>',
    ];

    public static $recommendStatusText = [
        self::NOT_RECOMMEND => '<span class="label label-default">未推荐</span>',
        self::IS_RECOMMEND => '<span class="label label-success">已推荐</span>',
    ];
    public static $hotStatusText = [
        self::NOT_HOT => '<span class="label label-default">未热销</span>',
        self::IS_HOT => '<span class="label label-success">热销中</span>',
    ];

    public function insert_data(PlatformPurchaseRecord $platformPurchaseRecord)
    {
        $info = self::where('sku_number', $platformPurchaseRecord->sku_number)->first();
        $_insert_data = [
            'partner_store_id' => 1, //此处为固定值，目前合伙人商店只有一个
            'name' => $platformPurchaseRecord->name,
            'subtitle' => $platformPurchaseRecord->subtitle,
            'sku_number' => $platformPurchaseRecord->sku_number,
            'thumbnail' => $platformPurchaseRecord->thumbnail,
            'images' => $platformPurchaseRecord->images,
            'cost_price' => $platformPurchaseRecord->price,
            'pricing_schemes' => [],
            'price' => 0,
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

    /**
     * 构建组合支付方案数据
     * @param array $pricingSchemes
     * @return array
     */
    public function build_pricing_schemes(array $pricingSchemes): array
    {
        $price_schemes_arr = [];
        $arr = [];
        $keys = array_keys($pricingSchemes);
        if ($pricingSchemes) {
            foreach ($pricingSchemes[$keys[0]] as $k => $scheme) {
                for ($i = 0; $i < count($keys); $i++) {
                    $arr = array_merge($arr, [$keys[$i] => $pricingSchemes[$keys[$i]][$k]]);
                }
                array_push($price_schemes_arr, $arr);
                array_splice($arr, 0, count($arr));
            }
        }

        return $price_schemes_arr;
    }

    /**
     * 关联合伙人商城
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner_store()
    {
        return $this->belongsTo(PartnerStore::class);
    }


    /**
     * 获取商品类型
     * @return string
     */
    public function getTypeAttribute()
    {
        return get_class($this);
    }


    /**
     * 商品资源格式化
     * @return PartnerGoodsTransformer
     */
    public function resource()
    {
        $transform = new PartnerGoodsTransformer();
        return $transform->transform($this);
    }

    /**
     * 获取服务保障信息
     * @param PartnerGoods $partnerGoods
     * @return mixed
     */
    public function get_service_tips(PartnerGoods $partnerGoods)
    {
        return ServiceTip::whereIn('id', (array)$partnerGoods->service_tips_ids)->get();
    }
}
