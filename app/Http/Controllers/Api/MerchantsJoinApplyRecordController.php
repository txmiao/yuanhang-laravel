<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\FlagshipStoreRecord;
use App\Models\Image;
use App\Models\MerchantsJoinApplyRecord;
use App\Models\Region;
use App\Transformers\ArticleTransformer;
use App\Transformers\MerchantsJoinApplyRecordTransformer;
use Illuminate\Http\Request;

class MerchantsJoinApplyRecordController extends Controller
{
    const CID = 1; //正式上线后请使用名称为[招商加盟]的实际分类ID

    /**
     * 招商加盟政策列表
     * @param Article $article
     * @return \Dingo\Api\Http\Response
     */
    public function index(Article $article)
    {
        $lists = $article->where('category_id', static::CID)->get();
        return $this->response->collection($lists, new ArticleTransformer());
    }

    /**
     * 获取地区代理列表
     * @param Request $request
     * @param FlagshipStoreRecord $flagshipStoreRecord
     * @return \Dingo\Api\Http\Response
     */
    public function mercantile_agent(Request $request, FlagshipStoreRecord $flagshipStoreRecord)
    {
        $parentCode = $request->input('parent_code')
            ? $request->input('parent_code')
            : 86;
        $lists = $flagshipStoreRecord::get_flagship_store_records(
            $parentCode,
            $request->input('level', $flagshipStoreRecord::LEVEL_PROVINCE)
        );
        return $this->response->paginator($lists, new MerchantsJoinApplyRecordTransformer());
    }

    /**
     * 添加招商加盟申请
     * @param Request $request
     * @param MerchantsJoinApplyRecord $merchantsJoinApplyRecord
     * @param FlagshipStoreRecord $flagshipStoreRecord
     * @param Region $region
     * @param Image $image
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request, MerchantsJoinApplyRecord $merchantsJoinApplyRecord, FlagshipStoreRecord $flagshipStoreRecord, Region $region, Image $image)
    {
        try {
            \DB::beginTransaction();
            $requestData = $request->all();
            if ($request->has('other_material_ids')) {
                $essential_material = $image->whereIn('id', explode(',', $request->input('essential_material_ids')))->pluck('path');
                $requestData = array_merge($requestData, compact('essential_material'));
            }
            if ($request->has('other_material_ids')) {
                $other_material = $image->whereIn('id', explode(',', $request->input('other_material_ids')))->pluck('path');
                $requestData = array_merge($requestData, compact('other_material'));
            }
            $merchantsJoinApplyRecord->fill(array_merge($requestData, [
                'user_id' => $this->user()->id,
                'full_address' => $region->getFullAddress(
                        $request->input('province'),
                        $request->input('city'),
                        $request->input('district')) . $request->input('detailed_address')
            ]));
            $merchantsJoinApplyRecord->save();

            //更新区域代理记录
            $flagshipStoreRecord->update_record($merchantsJoinApplyRecord, FlagshipStoreRecord::STATUS_AUDITING);

            \DB::commit();
            return $this->response->noContent();

        } catch (\Exception $e) {
            \DB::rollBack();
            return $this->response->errorForbidden($e->getMessage() ?? '操作失败，请稍后重试');

        }
    }
}
