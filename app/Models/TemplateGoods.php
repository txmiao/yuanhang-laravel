<?php

namespace App\Models;

use App\Http\Requests\Admin\TemplateGoodsRequest;
use Illuminate\Database\Eloquent\Model;

class TemplateGoods extends Model
{
    protected $table = 'template_goods';
    protected $guarded = ['_token', 'images_upload', 'thumbnail_upload'];
    public $timestamps = false;
    protected $casts = [
        'images' => 'array',
        'detail' => 'array',
    ];

    const TYPE_PARTNER = 100;
    const TYPE_OTHER = 101;
    const ON_SALE = 100;
    const UN_SALE = 101;

    public static $saleStatus = [
        self::ON_SALE => '<label class="label label-success">已上架</label>',
        self::UN_SALE => '<label class="label label-danger">已下架</label>',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function sku_number_generate($prefix = '', $length = 10): string
    {
        return $prefix . str_pad(mt_rand(100000, 999999999), $length, 0, STR_PAD_LEFT);
    }

    /**
     * 构建入库数据
     * @param TemplateGoodsRequest $templateGoodsRequest
     * @param TemplateGoods $templateGoods
     * @return TemplateGoods
     */
    public function build_data(TemplateGoodsRequest $templateGoodsRequest, TemplateGoods $templateGoods)
    {
        $detailArr = [];
        $sku_number = $templateGoodsRequest->input('sku_number') ?? $templateGoods->sku_number_generate('P');

        if ($templateGoodsRequest->input('detail')) {
            foreach ($templateGoodsRequest->input('detail')['key'] as $k => $detailKeyItem) {
                array_push($detailArr, [
                    'key' => $detailKeyItem,
                    'value' => $templateGoodsRequest->input('detail')['value'][$k],
                ]);
            }
        }

        $templateGoods->fill(array_merge($templateGoodsRequest->except(['subtitle', 'detail', 'sku_number']),
            ['detail' => $detailArr],
            compact('sku_number')
        ));

        !is_null($templateGoodsRequest->input('subtitle'))
        && $templateGoods->subtitle = $templateGoodsRequest->input('subtitle');

        //商品缩略图
        if ($templateGoodsRequest->hasFile('thumbnail_upload') && $templateGoodsRequest->file('thumbnail_upload')->isValid()) {
            $filename = $templateGoodsRequest->file('thumbnail_upload')->store('goods_thumbnail');

            //删除旧图片
            \Storage::exists($templateGoods->thumbnail) && \Storage::delete($templateGoods->thumbnail);

            $templateGoods->thumbnail = $filename;
        }

        //上传商品相册
        if ($templateGoodsRequest->hasFile('images_upload')) {
            $uploadFiles = $templateGoodsRequest->file('images_upload');
            $storePath = 'goods_images';
            $paths = [];

            foreach ($uploadFiles as $uploadItem) {
                if ($uploadItem->isValid()) {
                    $filename = $uploadItem->store($storePath);
                    array_push($paths, $filename);
                }
            }

            //删除旧图片
            if ($templateGoods->images) {
                foreach ($templateGoods->images as $delItem) {
                    \Storage::exists($delItem) && \Storage::delete($delItem);
                }
            }

            $templateGoods->images = $paths;
        }

        return $templateGoods;
    }

    /**
     * 获取分类的模板商品
     * @return array
     */
    public function get_goods_list_by_type()
    {
        $partner_goods = [];
        $other_goods = [];
        $templateGoods = self::where('is_sale', self::ON_SALE)->get();
        if ($templateGoods) {
            foreach ($templateGoods as $good) {
                self::TYPE_PARTNER == $good->type
                    ? array_push($partner_goods, $good)
                    : array_push($other_goods, $good);
            }
        }
        return array_merge(compact('partner_goods'), compact('other_goods'));
    }
}
