<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AssetHistoryRequest;
use App\Models\AssetHistory;
use App\Models\CouponsRecords;
use App\Transformers\AssetHistoryTransformer;
use App\Transformers\CouponsRecordsTransformer;


class AssetHistoryController extends Controller
{
    /**
     * 资产历史
     */
    public function show(AssetHistoryRequest $request, AssetHistory $assetHistory, CouponsRecords $couponsRecords)
    {
        $user = $this->user();
        $type = $request->type; //100=信用积分,101=金积分,102=银积分,103=优惠卷
        if ($type == 103) {
            $data = $couponsRecords->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data = $assetHistory->where('user_id', $user->id)
                ->where('type', $type)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        $data = $assetHistory->AssetHistoryDataAssembly($data, $type);
        if ($type == 103) {
            return $this->response->paginator($data, new CouponsRecordsTransformer());
        }
        return $this->response->paginator($data, new AssetHistoryTransformer());
    }
}
